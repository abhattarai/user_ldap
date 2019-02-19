<?php
/**
 * @author Arthur Schiwon <blizzz@arthur-schiwon.de>
 * @author Bart Visscher <bartv@thisnet.nl>
 * @author Joas Schilling <coding@schilljs.com>
 * @author Jörn Friedrich Dreyer <jfd@butonic.de>
 * @author Lukas Reschke <lukas@statuscode.ch>
 * @author Lyonel Vincent <lyonel@ezix.org>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Robin McCorkell <robin@mccorkell.me.uk>
 *
 * @copyright Copyright (c) 2016, ownCloud GmbH.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCA\User_LDAP;

use OC\ServerNotAvailableException;
use OCA\User_LDAP\Config\Config;
use OCA\User_LDAP\Config\ConfigMapper;
use OCP\Util;

/**
 * magic properties (incomplete)
 * responsible for LDAP connections in context with the provided configuration
 *
 * @property string ldapHost
 * @property string ldapPort holds the port number
 * @property string ldapUserFilter
 * @property string ldapUserDisplayName
 * @property string ldapUserDisplayName2
 * @property boolean hasPagedResultSupport
 * @property string[] ldapBaseUsers
 * @property int|string ldapPagingSize holds an integer
 * @property bool|mixed|void ldapGroupMemberAssocAttr
 */
class Connection extends LDAPUtility {
	private $ldapConnectionRes;
	private $configPrefix;
	private $configID;
	private $configured = false;
	private $hasPagedResultSupport = true;

	// for now, these are the autodetected unique attributes
	public $uuidAttributes = [
		'entryuuid', 'nsuniqueid', 'objectguid', 'guid', 'ipauniqueid'
	];

	/**
	 * TODO currently redundant with ldapExpertUsernameAttr. fix when core properly distinguishes uid and username
	 * @var string|null attribute to use for username
	 */
	public $userNameAttribute = 'samaccountname';

	/**
	 * @var bool runtime flag that indicates whether supported primary groups are available
	 */
	public $hasPrimaryGroups = true;

	//cache handler
	protected $cache;

	/** @var ConfigMapper */
	protected $mapper;

	/** @var Config settings handler **/
	protected $config;

	protected $ignoreValidation = false;

	/**
	 * Constructor
	 *
	 * @param ILDAPWrapper $ldap
	 * @param ConfigMapper $configMapper
	 * @param Config $config
	 * @param string|null $configID a string with the value for the appid column (appconfig table) or null for on-the-fly connections // TODO might be obsolete
	 */
	public function __construct(ILDAPWrapper $ldap, ConfigMapper $configMapper, Config $config, $configID = 'user_ldap') {
		parent::__construct($ldap);
		$this->configPrefix = $config->getId();
		$this->configID = $configID;
		$this->mapper = $configMapper;
		$this->config = $config;

		$memcache = \OC::$server->getMemCacheFactory();
		if ($memcache->isAvailable()) {
			$this->cache = $memcache->create();
		}

		$this->hasPagedResultSupport =
			(int)$this->config->ldapPagingSize !== 0
			&& $this->getLDAP()->hasPagedResultSupport();
	}

	public function __destruct() {
		if ($this->getLDAP()->isResource($this->ldapConnectionRes)) {
			@$this->getLDAP()->unbind($this->ldapConnectionRes);
		}
	}

	/**
	 * defines behaviour when the instance is cloned
	 */
	public function __clone() {
		$this->config = new Config($this->config->jsonSerialize());
		$this->ldapConnectionRes = null;
	}

	/**
	 * @param string $name
	 * @return bool|mixed
	 */
	public function __get($name) {
		if (!$this->configured) {
			$this->readConfiguration();
		}

		if ($name === 'hasPagedResultSupport') {
			return $this->hasPagedResultSupport;
		}

		return $this->config->$name;
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value) {
		$before = $this->config->$name;
		$this->config->$name = $value;
		$after = $this->config->$name;
		if ($before !== $after) {
			if ($this->configID !== '') {
				$this->mapper->update($this->config);
			}
			$this->validateConfiguration();
		}
	}

	/**
	 * sets whether the result of the configuration validation shall
	 * be ignored when establishing the connection. Used by the Wizard
	 * in early configuration state.
	 * @param bool $state
	 */
	public function setIgnoreValidation($state) {
		$this->ignoreValidation = (bool)$state;
	}

	/**
	 * Returns the LDAP handler
	 * @return resource | null
	 *
	 * @throws \OC\ServerNotAvailableException
	 * @return resource
	 */
	public function getConnectionResource() {
		if ($this->ldapConnectionRes === null) {
			$this->readConfiguration();
			$this->establishConnection();
		}
		return $this->ldapConnectionRes;
	}

	/**
	 * resets the connection resource
	 */
	public function resetConnectionResource() {
		if ($this->ldapConnectionRes !== null) {
			@$this->getLDAP()->unbind($this->ldapConnectionRes);
			$this->ldapConnectionRes = null;
		}
	}

	/**
	 * @param string|null $key
	 * @return string
	 */
	private function getCacheKey($key) {
		$prefix = 'LDAP-'.$this->configID.'-'.$this->configPrefix.'-';
		if ($key === null) {
			return $prefix;
		}
		return $prefix.\md5($key);
	}

	/**
	 * @param string $key
	 * @return mixed|null
	 */
	public function getFromCache($key) {
		if (!$this->configured) {
			$this->readConfiguration();
		}
		if ($this->cache === null || !$this->config->ldapCacheTTL) {
			return null;
		}
		$key = $this->getCacheKey($key);

		return \json_decode(\base64_decode($this->cache->get($key)), true);
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public function writeToCache($key, $value) {
		if (!$this->configured) {
			$this->readConfiguration();
		}
		if ($this->cache === null
			|| !$this->config->ldapCacheTTL
			|| !$this->config->ldapConfigurationActive) {
			return;
		}
		$key   = $this->getCacheKey($key);
		$value = \base64_encode(\json_encode($value));
		$this->cache->set($key, $value, $this->config->ldapCacheTTL);
	}

	public function clearCache() {
		if ($this->cache !== null) {
			$this->cache->clear($this->getCacheKey(null));
		}
	}

	/**
	 * Caches the general LDAP configuration.
	 * @param bool $force optional. true, if the re-read should be forced. defaults
	 * to false.
	 */
	private function readConfiguration($force = false) {
		if ((!$this->configured || $force) && $this->configID !== null) {
			$this->configured = $this->validateConfiguration();
		}
	}

	/**
	 * set LDAP configuration with values delivered by an array, not read from configuration
	 * @param array $config array that holds the config parameters in an associated array
	 * @param array &$setParameters optional; array where the set fields will be given to
	 * @return boolean true if config validates, false otherwise. Check with $setParameters for detailed success on single parameters
	 */
	public function setConfiguration($config, &$setParameters = null) {
		if ($setParameters === null) {
			$setParameters = [];
		}
		$this->config->setConfiguration($config, $setParameters);
		if (\count($setParameters) > 0) {
			$this->configured = $this->validateConfiguration();
		}

		return $this->configured;
	}

	/**
	 * saves the current Configuration in the database and empties the
	 * cache
	 */
	public function saveConfiguration() {
		$this->mapper->update($this->config);
		$this->clearCache();
	}

	/**
	 * get the current LDAP configuration
	 * @return array
	 */
	public function getConfiguration() {
		$this->readConfiguration();
		$config = $this->config->getData();
		$defaults = $this->config->getDefaults();
		$result = [];
		foreach (\array_keys($defaults) as $configkey) {
			switch ($configkey) {
				case 'homeFolderNamingRule':
					if (\strpos($config[$configkey], 'attr:') === 0) {
						$result[$configkey] = \substr($config[$configkey], 5);
					} else {
						$result[$configkey] = '';
					}
					break;
				case 'ldapBase':
				case 'ldapBaseUsers':
				case 'ldapBaseGroups':
				case 'ldapAttributesForUserSearch':
				case 'ldapAttributesForGroupSearch':
					if (\is_array($config[$configkey])) {
						$result[$configkey] = \implode("\n", $config[$configkey]);
						break;
					} //else follows default
					// no break
				default:
					$result[$configkey] = $config[$configkey];
			}
		}
		return $result;
	}

	private function doSoftValidation() {
		//if User or Group Base are not set, take over Base DN setting
		foreach (['ldapBaseUsers', 'ldapBaseGroups'] as $keyBase) {
			$val = $this->config->$keyBase;
			if (empty($val)) {
				$obj = \strpos('Users', $keyBase) !== false ? 'Users' : 'Groups';
				Util::writeLog('user_ldap',
									'Base tree for '.$obj.
									' is empty, using Base DN',
									Util::DEBUG);
				$this->config->$keyBase = $this->config->ldapBase;
			}
		}

		foreach (['ldapExpertUUIDUserAttr'  => 'ldapUuidUserAttribute',
					  'ldapExpertUUIDGroupAttr' => 'ldapUuidGroupAttribute']
				as $expertSetting => $effectiveSetting) {
			$uuidOverride = $this->config->$expertSetting;
			if (!empty($uuidOverride)) {
				$this->config->$effectiveSetting = $uuidOverride;
			} else {
				if ($this->configID !== null &&
					!\in_array($this->config->$effectiveSetting,
						\array_merge(['auto'], $this->uuidAttributes), true)
				) {
					$this->config->$effectiveSetting = 'auto';
					$this->mapper->update($this->config);
					Util::writeLog('user_ldap',
										'Illegal value for the '.
										$effectiveSetting.', '.'reset to '.
										'autodetect.', Util::INFO);
				}
			}
		}

		$backupPort = (int)$this->config->ldapBackupPort;
		if ($backupPort <= 0) {
			$this->config->backupPort = $this->config->ldapPort;
		}

		//make sure empty search attributes are saved as simple, empty array
		$saKeys = ['ldapAttributesForUserSearch',
						'ldapAttributesForGroupSearch'];
		foreach ($saKeys as $key) {
			$val = $this->config->$key;
			if (\is_array($val) && \count($val) === 1 && empty($val[0])) {
				$this->config->$key = [];
			}
		}

		if ($this->config->ldapTLS
			&& \stripos($this->config->ldapHost, 'ldaps://') === 0
		) {
			$this->config->ldapTLS = false;
			Util::writeLog('user_ldap',
								'LDAPS (already using secure connection) and '.
								'TLS do not work together. Switched off TLS.',
								Util::INFO);
		}
	}

	/**
	 * @return bool
	 */
	private function doCriticalValidation() {
		$configurationOK = true;
		$errorStr = "Configuration Error (prefix {$this->configPrefix}): ";

		//options that shall not be empty
		$options = ['ldapHost', 'ldapPort', 'ldapUserDisplayName',
						 'ldapGroupDisplayName', 'ldapLoginFilter'];
		foreach ($options as $key) {
			$val = $this->config->$key;
			if (empty($val)) {
				switch ($key) {
					case 'ldapHost':
						$subj = 'LDAP Host';
						break;
					case 'ldapPort':
						$subj = 'LDAP Port';
						break;
					case 'ldapUserDisplayName':
						$subj = 'LDAP User Display Name';
						break;
					case 'ldapGroupDisplayName':
						$subj = 'LDAP Group Display Name';
						break;
					case 'ldapLoginFilter':
						$subj = 'LDAP Login Filter';
						break;
					default:
						$subj = $key;
						break;
				}
				$configurationOK = false;
				Util::writeLog('user_ldap',
									$errorStr.'No '.$subj.' given!',
									Util::WARN);
			}
		}

		//combinations
		$agent = $this->config->ldapAgentName;
		$pwd = $this->config->ldapAgentPassword;
		if (
			($agent === ''  && $pwd !== '')
			|| ($agent !== '' && $pwd === '')
		) {
			Util::writeLog('user_ldap',
								$errorStr.'either no password is given for the '.
								'user agent or a password is given, but not an '.
								'LDAP agent.',
				Util::WARN);
			$configurationOK = false;
		}

		$base = $this->config->ldapBase;
		$baseUsers = $this->config->ldapBaseUsers;
		$baseGroups = $this->config->ldapBaseGroups;

		if (empty($base) && empty($baseUsers) && empty($baseGroups)) {
			Util::writeLog('user_ldap',
								$errorStr.'Not a single Base DN given.',
								Util::WARN);
			$configurationOK = false;
		}

		if (\mb_strpos($this->config->ldapLoginFilter, '%uid', 0, 'UTF-8')
		   === false) {
			Util::writeLog('user_ldap',
								$errorStr.'login filter does not contain %uid '.
								'place holder.',
								Util::WARN);
			$configurationOK = false;
		}

		return $configurationOK;
	}

	/**
	 * Validates the user specified configuration
	 * @return bool true if configuration seems OK, false otherwise
	 */
	private function validateConfiguration() {
		if ($this->config->ldapHost === ''
			&& $this->config->ldapPort === ''
		) {
			//don't do a validation if both host and port are default (empty)
			return false;
		}

		// first step: "soft" checks: settings that are not really
		// necessary, but advisable. If left empty, give an info message
		$this->doSoftValidation();

		//second step: critical checks. If left empty or filled wrong, mark as
		//not configured and give a warning.
		return $this->doCriticalValidation();
	}

	/**
	 * Connects and Binds to LDAP
	 *
	 * @throws \OC\ServerNotAvailableException
	 */
	private function establishConnection() {
		if (!$this->config->ldapConfigurationActive) {
			throw new ServerNotAvailableException('Connection not active');
		}
		if (!$this->ignoreValidation && !$this->configured) {
			\OC::$server->getLogger()->warning(
				'Configuration is invalid, cannot connect',
				['app' => 'user_ldap']
			);
			return false;
		}

		$backupHostEmpty = \trim($this->config->ldapBackupHost) === '';
		// skip contacting main server after failed connection attempt
		// until cache TTL is reached
		$shouldTryMainServer = $backupHostEmpty
			|| (!$this->config->ldapOverrideMainServer && !$this->getFromCache('overrideMainServer'));
		$hosts = [
			'main' => [
				'host' => $this->config->ldapHost,
				'port' => $this->config->ldapPort,
				'skip' => $shouldTryMainServer !== true
			],
			'backup' => [
				'host' => $this->config->ldapBackupHost,
				'port' => $this->config->ldapBackupPort,
				'skip' => $backupHostEmpty
			]
		];
		foreach ($hosts as $configName => $config) {
			if ($config['skip'] === true) {
				continue;
			}

			try {
				$ldapServer = new Ldap\Server(
					$this->ldap,
					\OC::$server->getLogger(),
					$config['host'],
					$config['port'],
					$this->config
				);
				if ($ldapServer->openConnection("{$this->configID} $configName")) {
					$this->ldapConnectionRes = $ldapServer->getResource();
					if ($configName === 'backup' && !$this->getFromCache('overrideMainServer')) {
						//when bind to backup server succeeded and failed to main server,
						//skip contacting him until next cache refresh
						$this->writeToCache('overrideMainServer', true);
					}

					return true;
				}
				$reason = $this->ldap->getLastError();
				\OC::$server->getLogger()->warning(
					"Bind to {$configName} server {$config['host']} failed: $reason",
					['app' => 'user_ldap']
				);
			} catch (ServerNotAvailableException $e) {
				$reason = $this->ldap->getLastError();
				\OC::$server->getLogger()->warning(
					"Bind to {$configName} server {$config['host']} failed: $reason",
					['app' => 'user_ldap']
				);
				if (
					($hosts['main']['skip'] === true && $configName === 'backup')
					|| ($hosts['backup']['skip'] === true && $configName === 'main')
				) {
					$this->ldapConnectionRes = null;
					throw $e;
				}
			}
		}

		throw new ServerNotAvailableException('Connection to LDAP server could not be established');
	}

	/**
	 * Binds to LDAP
	 * @throws \OC\ServerNotAvailableException
	 */
	public function bind() {
		if (!$this->config->ldapConfigurationActive) {
			return false;
		}

		// binding is done via getConnectionResource()
		$cr = $this->getConnectionResource();

		return $this->getLDAP()->isResource($cr);
	}
}
