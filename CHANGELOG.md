# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)

## [Unreleased]

## [0.15.1] - 2020-03-09

### Fixed

- Allow plus in LDAP usernames - [#490](https://github.com/owncloud/user_ldap/issues/490)
- Easier tls - [#512](https://github.com/owncloud/user_ldap/issues/512)

## [0.15.0] - 2019-12-20

### Fixed

- Don't delete / disable Users if they change their DN - [#470](https://github.com/owncloud/user_ldap/issues/470)

### Changed

- Drop PHP 7.0 - [#474](https://github.com/owncloud/user_ldap/issues/474)

## [0.14.0] - 2019-11-11

### Added

- Add network timeout setting - [#324](https://github.com/owncloud/user_ldap/issues/324)
- Log bind errors [#436](https://github.com/owncloud/user_ldap/pull/436)
- Reuse existing LDAP accounts if available [#165](https://github.com/owncloud/user_ldap/pull/165)

### Changed

- Allow avatars to be changed by users if not provided by LDAP - [#188](https://github.com/owncloud/user_ldap/issues/188)
- Remove PHP 5.6 support - [#388](https://github.com/owncloud/user_ldap/issues/388)
- Clean up Application initialization code - [#396](https://github.com/owncloud/user_ldap/issues/396)
- Remove unused use statements - [#399](https://github.com/owncloud/user_ldap/issues/399) [#400](https://github.com/owncloud/user_ldap/issues/400)
- Simplify connection: Get rid of init method [#437](https://github.com/owncloud/user_ldap/pull/437)
- Replace magic numbers with constants [#435](https://github.com/owncloud/user_ldap/pull/435)

### Fixed

- Only return users valid for ownCloud when getting LDAP group members - [#12](https://github.com/owncloud/user_ldap/issues/12)
- Fix paging when limit is used - [#315](https://github.com/owncloud/user_ldap/issues/315)
- Extract housekeeping part from new LDAP wizard - [#396](https://github.com/owncloud/user_ldap/pull/396)
- loginName2UserName is already called for an object, not a class - [#398](https://github.com/owncloud/user_ldap/pull/398)
- Remove unused use statements - [#400](https://github.com/owncloud/user_ldap/pull/400) - [#399](https://github.com/owncloud/user_ldap/pull/399)
- Include port only if there is port [#425](https://github.com/owncloud/user_ldap/pull/425)
- Remove no longer existing job from appinfo [#430](https://github.com/owncloud/user_ldap/pull/430)


## [0.13.0] - 2018-12-11

### Changed

- Set max version to 10 because core is switching to Semver - [#319](https://github.com/owncloud/user_ldap/issues/319)
- Update Screenshot - [#306](https://github.com/owncloud/user_ldap/issues/306)

### Fixed

- Remove legacy table and resolve dn encoding issues - [#248](https://github.com/owncloud/user_ldap/issues/248)
- Suppress "invalid quota" message if quota isn't set for the user - [#237](https://github.com/owncloud/user_ldap/issues/237)


## [0.12.0] - 2018-11-05

### Added

- Store "samaccountname" in user preferences table - [#254](https://github.com/owncloud/user_ldap/issues/254)
- PHP 7.2 support - [#280](https://github.com/owncloud/user_ldap/issues/280)

### Fixed

- Display name and email will not be editable from the profile page - [#218](https://github.com/owncloud/user_ldap/issues/218)
- Do not throw exception when user not found on LDAP during login - [#269](https://github.com/owncloud/user_ldap/issues/269)
- Users with no avatar in LDAP are now able to add avatar again, like in ownCloud 9.1 - [#256](https://github.com/owncloud/user_ldap/pull/256)
- Replaced deprecated config API calls - [#258](https://github.com/owncloud/user_ldap/pull/258)

### Removed

- Removed obsolete comment reference to ldapUserCleanupInterval - [#213](https://github.com/owncloud/user_ldap/issues/213)

## [0.11.0] - 2018-04-19

### Added

- Ability to output ldap configurations (`ldap:show-config`) as json [#185](https://github.com/owncloud/user_ldap/pull/185)

### Changed

- Frontend routes converted to proper Controllers [#199](https://github.com/owncloud/user_ldap/pull/199)
- Fully leverage core account synchronisation [#156](https://github.com/owncloud/user_ldap/pull/156)
- Improved error log messages [#194](https://github.com/owncloud/user_ldap/pull/194)

### Fixed

- Error with encrypted storage when a unsynchronized user logs in for the first time [#178](https://github.com/owncloud/user_ldap/pull/178)
- Properly use filters when synchronizing mapped users by dn [#168](https://github.com/owncloud/user_ldap/pull/168)
- Fallback to ownClouds default quota, if the provided quota by ldap can not be parsed correctly [#153](https://github.com/owncloud/user_ldap/issues/153)

## [0.10.0] - 2017-12-20

### Fixed

- Rework LDAP app to match account table logic [#125](https://github.com/owncloud/user_ldap/issues/125)
- Use custom uuid attribute if configured - [#158](https://github.com/owncloud/user_ldap/issues/158)
- Sync displayname on login - [#157](https://github.com/owncloud/user_ldap/issues/157)
- Fix working with LDAP replica server - [#138](https://github.com/owncloud/user_ldap/issues/138)
- Allow specifying the prefix for occ ldap:create-empty-config - [#7](https://github.com/owncloud/user_ldap/issues/7)
- Remove fix for ldap installation - [#132](https://github.com/owncloud/user_ldap/issues/132)
- Make the time between needsRefresh configurable - [#120](https://github.com/owncloud/user_ldap/issues/120)
- Keep the current quota if no suitable quota is found - [#123](https://github.com/owncloud/user_ldap/issues/123)
- Only use IndexIgnore if mod_autoindex.c is enabled/loaded - [#112](https://github.com/owncloud/user_ldap/issues/112)
- Remove unneeded account updates during sync - [#109](https://github.com/owncloud/user_ldap/issues/109)
- Fix possible race condition - [#8](https://github.com/owncloud/user_ldap/issues/8)
- Remove automatic enable of a configuration - [#10](https://github.com/owncloud/user_ldap/issues/10)
- Add missing spaces to log message - [#110](https://github.com/owncloud/user_ldap/issues/110)
- Add hint for max search term length - [#105](https://github.com/owncloud/user_ldap/issues/105)
- Allow proxy to check next server - [#101](https://github.com/owncloud/user_ldap/issues/101)

[Unreleased]: https://github.com/owncloud/user_ldap/compare/v0.15.1...master
[0.15.1]: https://github.com/owncloud/user_ldap/compare/v0.15.0...v0.15.1
[0.15.0]: https://github.com/owncloud/user_ldap/compare/v0.14.0...v0.15.0
[0.14.0]: https://github.com/owncloud/user_ldap/compare/v0.13.0...v0.14.0
[0.13.0]: https://github.com/owncloud/user_ldap/compare/v0.12.0...v0.13.0
[0.12.0]: https://github.com/owncloud/user_ldap/compare/v0.11.0...v0.12.0
[0.11.0]: https://github.com/owncloud/user_ldap/compare/v0.10.0...v0.11.0
[0.10.0]: https://github.com/owncloud/user_ldap/compare/0.9.1...v0.10.0
