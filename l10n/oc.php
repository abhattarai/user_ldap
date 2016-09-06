<?php
$TRANSLATIONS = array(
"Failed to clear the mappings." => "Error al moment de la supression de las associacions.",
"Failed to delete the server configuration" => "Fracàs de la supression de la configuracion del servidor",
"The configuration is invalid: anonymous bind is not allowed." => "La configuracion es pas valida : lo ligam anonim es pas autorizat.",
"The configuration is valid and the connection could be established!" => "La configuracion es valida e la connexion pòt èsser establida !",
"The configuration is valid, but the Bind failed. Please check the server settings and credentials." => "La configuracion es valabla, mas lo bind a fracassat. Verificatz los paramètres del servidor e tanben vòstres identificants de connexion.",
"The configuration is invalid. Please have a look at the logs for further details." => "La configuracion es pas valabla. Consultatz los logs per mai de detalhs.",
"No action specified" => "Cap d'accion pas especificada",
"No configuration specified" => "Cap de configuration pas especificada",
"No data specified" => "Cap de donada pas especificada",
" Could not set configuration %s" => "Impossible d'especificar la configuracion %s",
"Action does not exist" => "L'accion existís pas",
"The Base DN appears to be wrong" => "Lo DN de basa es erronèu",
"Configuration incorrect" => "Configuracion incorrècta",
"Configuration incomplete" => "Configuracion incompleta",
"Configuration OK" => "Configuracion OK",
"Select groups" => "Seleccionatz los gropes",
"Select object classes" => "Seleccionar las classas d'objècte",
"Please check the credentials, they seem to be wrong." => "Verificatz vòstras informacions d'identificacion",
"Please specify the port, it could not be auto-detected." => "Especificatz lo pòrt, a pas pogut èsser detectat automaticament",
"Base DN could not be auto-detected, please revise credentials, host and port." => "Lo DN de basa a pas pogut èsser detectat automaticament. Verificatz las informacions d'identificacion, l'òste e lo pòrt.",
"Could not detect Base DN, please enter it manually." => "Impossible de detectar lo DN de basa, especificatz-lo manualament",
"{nthServer}. Server" => "{nthServer}. Servidor",
"No object found in the given Base DN. Please revise." => "Cap d'objècte pas trobat dins lo DN de basa especificat. Verificatz-lo.",
"More than 1,000 directory entries available." => "I a mai de 1000 entradas de repertòri disponiblas.",
" entries available within the provided Base DN" => "entradas disponiblas dins lo DN de basa especificat",
"An error occurred. Please check the Base DN, as well as connection settings and credentials." => "Una error s'es produsida. Verificatz lo DN de basa, e tanben los paramètres de connexion e las informacions d'identificacion.",
"Do you really want to delete the current Server Configuration?" => "Sètz segur que volètz escafar la configuracion servidor actuala ?",
"Confirm Deletion" => "Confirmar la supression",
"Mappings cleared successfully!" => "Associacions suprimidas amb succès !",
"Error while clearing the mappings." => "Error al moment de la supression de las associacions.",
"Anonymous bind is not allowed. Please provide a User DN and Password." => "Lo ligam anonim es pas autorizat. Mercé de provesir lo DN d'un utilizaire e un senhal.",
"LDAP Operations error. Anonymous bind might not be allowed." => "Error LDAP. La connexion anonima al servidor es probablament pas acceptada.",
"Saving failed. Please make sure the database is in Operation. Reload before continuing." => "Lo salvament a fracassat. Verificatz que la banca de donadas es operacionala. Recargatz abans de contunhar.",
"Switching the mode will enable automatic LDAP queries. Depending on your LDAP size they may take a while. Do you still want to switch the mode?" => "Cambiar de mòde activarà las requèstas LDAP automaticas. Segon la talha de vòstre annuari LDAP, aquò pòt préner del temps. Volètz totjorn cambiar de mòde ?",
"Mode switch" => "Cambiar de mòde",
"Select attributes" => "Seleccionar los atributs",
"User not found. Please check your login attributes and username. Effective filter (to copy-and-paste for command line validation): <br/>" => "Utilizaire introbable. Verificatz los atributs de login e lo nom d'utilizaire. Filtre efectiu (de copiar-pegar per validar en linha de comanda):<br/>",
"User found and settings verified." => "Utilizaire trobat e paramètres verificats.",
"Settings verified, but one user found. Only the first will be able to login. Consider a more narrow filter." => "Paramètres verificats, mas sol lo primièr utilizaire se poirà connectar. Utilizatz puslèu un filtre mens restrictiu.",
"An unspecified error occurred. Please check the settings and the log." => "Una error desconeguda s'es produsida. Verificatz los paramètres e lo log.",
"The search filter is invalid, probably due to syntax issues like uneven number of opened and closed brackets. Please revise." => "Lo filtre de recèrca es pas valid, probablament a causa de problèmas de sintaxi tals coma de parentèsis mancantas. Corregissètz-los.",
"A connection error to LDAP / AD occurred, please check host, port and credentials." => "Una error s'es produsida al moment de la connexion al LDAP / AD. Verificatz l'òste, lo pòrt e las informacions d'identificacion.",
"The %uid placeholder is missing. It will be replaced with the login name when querying LDAP / AD." => "La cadena %uid es mancanta. Aquesta cadena es remplaçada per l'identificant de connexion al moment de las requèstas LDAP / AD.",
"Please provide a login name to test against" => "Indicatz un identificant de connexion amb lo qual cal testar.",
"The group box was disabled, because the LDAP / AD server does not support memberOf." => "Los gropes son desactivats perque lo servidor LDAP / AD pren pas en carga memberOf.",
"_%s group found_::_%s groups found_" => array("%s grop trobat","%s gropes trobats"),
"_%s user found_::_%s users found_" => array("%s utilizaire trobat","%s utilizaires trobats"),
"Could not detect user display name attribute. Please specify it yourself in advanced ldap settings." => "Impossible de detectar l'atribut que conten lo nom d'afichatge des utilizaires. Indicatz-lo vos-meteis dins los paramètres ldap avançats.",
"Could not find the desired feature" => "Impossible de trobar la foncion desirada",
"Invalid Host" => "Òste invalid",
"Server" => "Servidor",
"Users" => "Utilizaires",
"Login Attributes" => "Atributs de login",
"Groups" => "Gropes",
"Test Configuration" => "Testar la configuracion",
"Help" => "Ajuda",
"Groups meeting these criteria are available in %s:" => "Los gropes que respèctan aquestes critèris son disponibles dins %s :",
"Only these object classes:" => "Solament aquestas classes d'objèctes :",
"Only from these groups:" => "Solament dins aquestes gropes :",
"Search groups" => "Cercar dins los gropes",
"Available groups" => "Gropes disponibles",
"Selected groups" => "Gropes seleccionats",
"Edit LDAP Query" => "Modificar la requèsta LDAP",
"LDAP Filter:" => "Filtre LDAP :",
"The filter specifies which LDAP groups shall have access to the %s instance." => "Lo filtre especifica quins gropes LDAP an accès a l'instància %s.",
"Verify settings and count groups" => "Verificar los paramètres e comptar los gropes",
"When logging in, %s will find the user based on the following attributes:" => "Al login, %s cercarà l'utilizaire sus basa d'aquestes atributs :",
"LDAP / AD Username:" => "Nom d'utilizaire LDAP / AD :",
"Allows login against the LDAP / AD username, which is either uid or samaccountname and will be detected." => "Autorizar lo login amb lo nom d'utilizaire LDAP / AD (uid o samaccountname, la deteccion es automatica). ",
"LDAP / AD Email Address:" => "Adreça mail LDAP / AD :",
"Allows login against an email attribute. Mail and mailPrimaryAddress will be allowed." => "Autorizar lo login amb una adreça mail. Mail e mailPrimaryAddress son autorizats.",
"Other Attributes:" => "Autres atributs :",
"Defines the filter to apply, when login is attempted. %%uid replaces the username in the login action. Example: \"uid=%%uid\"" => "Definís lo filtre d'aplicar al moment d'una temptativa de connexion. %%uid remplaça lo nom d'utilizaire. Exemple : \"uid=%%uid\"",
"Test Loginname" => "Loginname de tèst",
"Verify settings" => "Testar los paramètres",
"1. Server" => "1. Servidor",
"%s. Server:" => "%s. Servidor :",
"Add a new and blank configuration" => "Apondre una novèla configuracion verge",
"Copy current configuration into new directory binding" => "Copiar la configuracion actuala cap a una novèla",
"Delete the current configuration" => "Suprimir la configuracion actuala",
"Host" => "Òste",
"You can omit the protocol, except you require SSL. Then start with ldaps://" => "Podètz ometre lo protocòl, levat se avètz besonh de SSL. Dins aqueste cas, prefixatz amb ldaps://",
"Port" => "Pòrt",
"Detect Port" => "Detectar lo pòrt",
"User DN" => "DN Utilizaire",
"The DN of the client user with which the bind shall be done, e.g. uid=agent,dc=example,dc=com. For anonymous access, leave DN and Password empty." => "DN de l'utilizaire client pel qual la ligason se deu far, per exemple uid=agent,dc=example,dc=com. Per un accès anonim, daissar lo DN e lo senhal voids.",
"Password" => "Senhal",
"For anonymous access, leave DN and Password empty." => "Per un accès anonim, daissar lo DN utilizaire e lo senhal voids.",
"One Base DN per line" => "Un DN de basa per linha",
"You can specify Base DN for users and groups in the Advanced tab" => "Podètz especificar los DN de basa de vòstres utilizaires e gropes via l'onglet Avançat",
"Detect Base DN" => "Detectar lo DN de basa",
"Test Base DN" => "Testar lo DN de basa",
"Avoids automatic LDAP requests. Better for bigger setups, but requires some LDAP knowledge." => "Evita las requèstas LDAP automaticas. Melhor per las installacions de grand ample, mas demanda de coneissenças en LDAP.",
"Manually enter LDAP filters (recommended for large directories)" => "Sasir los filtres LDAP manualament (recomandat pels annuaris de grand ample)",
"The most common object classes for users are organizationalPerson, person, user, and inetOrgPerson. If you are not sure which object class to select, please consult your directory admin." => "Las classas d'objèctes frequentas pels utilizaires son : organizationalPerson, person, user e inetOrgPerson. Se sètz pas segur de la classa d'utilizar, demandatz a l'administrator de l'annuari.",
"The filter specifies which LDAP users shall have access to the %s instance." => "Lo filtre especifica quins utilizaires LDAP auràn accès a l'instància %s.",
"Verify settings and count users" => "Verificar los paramètres e comptar los utilizaires",
"Saving" => "Enregistrament...",
"Back" => "Retorn",
"Continue" => "Contunhar",
"LDAP" => "LDAP",
"Expert" => "Expèrt",
"Advanced" => "Avançat",
"<b>Warning:</b> Apps user_ldap and user_webdavauth are incompatible. You may experience unexpected behavior. Please ask your system administrator to disable one of them." => "<b>Avertiment :</b> Las aplicacions user_ldap e user_webdavauth son incompatiblas. De disfoncionaments se pòdon provesir. Contactatz vòstre administrator sistèma per que ne desactive una.",
"<b>Warning:</b> The PHP LDAP module is not installed, the backend will not work. Please ask your system administrator to install it." => "<b>Atencion :</b> Lo modul php LDAP es pas installat, per consequéncia aquesta extension poirà pas foncionar. Contactatz vòstre administrator sistèma per tal que l'installe.",
"Connection Settings" => "Paramètres de connexion",
"Configuration Active" => "Configuracion activa",
"When unchecked, this configuration will be skipped." => "Quand pas marcada, la configuracion serà ignorada.",
"Backup (Replica) Host" => "Servidor de backup (replica)",
"Give an optional backup host. It must be a replica of the main LDAP/AD server." => "Provesir un servidor de backup opcional.  Se deu agir d'una replica del servidor LDAP/AD principal.",
"Backup (Replica) Port" => "Pòrt del servidor de backup (replica)",
"Disable Main Server" => "Desactivar lo servidor principal",
"Only connect to the replica server." => "Se connectar unicament a la replica",
"Turn off SSL certificate validation." => "Desactivar la validacion dels certificats SSL",
"Not recommended, use it for testing only! If connection only works with this option, import the LDAP server's SSL certificate in your %s server." => "Pas recomandat, d'utilizar amb d'objectius de tèsts unicament. Se la connexion fonciona pas qu'amb aquesta opcion, importatz lo certificat SSL del servidor LDAP dins lo servidor %s.",
"Cache Time-To-Live" => "Durada de vida de l'escondedor (TTL)",
"in seconds. A change empties the cache." => "en segondas. Tot cambiament voida l'escondedor.",
"Directory Settings" => "Paramètres del repertòri",
"User Display Name Field" => "Camp \"nom d'afichatge\" de l'utilizaire",
"The LDAP attribute to use to generate the user's display name." => "L'atribut LDAP utilizat per generar lo nom d'afichatge de l'utilizaire.",
"Base User Tree" => "DN raiç de l'arbre utilizaires",
"One User Base DN per line" => "Un DN de basa utilizaire per linha",
"User Search Attributes" => "Atributs de recèrca utilizaires",
"Optional; one attribute per line" => "Opcional, un atribut per linha",
"Group Display Name Field" => "Camp \"nom d'afichatge\" del grop",
"The LDAP attribute to use to generate the groups's display name." => "L'atribut LDAP utilizat per generar lo nom d'afichatge del grop.",
"Base Group Tree" => "DN raiç de l'arbre gropes",
"One Group Base DN per line" => "Un DN de basa grop per linha",
"Group Search Attributes" => "Atributs de recèrca des gropes",
"Group-Member association" => "Associacion grop-membre",
"Nested Groups" => "Gropes imbricats",
"When switched on, groups that contain groups are supported. (Only works if the group member attribute contains DNs.)" => "Se activat, los gropes que contenon d'autres gropes son preses en carga (fonciona unicament se l'atribut membre del grop conten de DNs).",
"Paging chunksize" => "Paging chunksize",
"Chunksize used for paged LDAP searches that may return bulky results like user or group enumeration. (Setting it 0 disables paged LDAP searches in those situations.)" => "Chunksize utilizada per las recèrcas LDAP paginadas que pòdon tornar de resultats per lòts coma una enumeracion d'utilizaires o de gropes. (Configurar a 0 per desactivar las recèrcas LDAP paginadas)",
"Special Attributes" => "Atributs especials",
"Quota Field" => "Camp del quòta",
"Quota Default" => "Quòta per defaut",
"in bytes" => "en octets",
"Email Field" => "Camp Email",
"User Home Folder Naming Rule" => "Règla de nomenatge del repertòri utilizaire",
"Leave empty for user name (default). Otherwise, specify an LDAP/AD attribute." => "Daissar void per user name (defaut). Podètz tanben especificar un atribut LDAP / AD.",
"Internal Username" => "Nom d'utilizaire intèrne",
"By default the internal username will be created from the UUID attribute. It makes sure that the username is unique and characters do not need to be converted. The internal username has the restriction that only these characters are allowed: [ a-zA-Z0-9_.@- ].  Other characters are replaced with their ASCII correspondence or simply omitted. On collisions a number will be added/increased. The internal username is used to identify a user internally. It is also the default name for the user home folder. It is also a part of remote URLs, for instance for all *DAV services. With this setting, the default behavior can be overridden. To achieve a similar behavior as before ownCloud 5 enter the user display name attribute in the following field. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users." => "Per defaut lo nom d'utilizaire intèrne serà creat a partir de l'atribut UUID. Aquò permet d'assegurar que lo nom d'utilizaire es unic e que los caractèrs necessitan pas de conversion. Lo nom d'utilizaire intèrne deu contenir unicament los caractèrs seguents : [ a-zA-Z0-9_.@- ]. Los autres caractèrs son remplaçats per lor correspondéncia ASCII o simplament omeses. En cas de collision, un nombre es apondut/incrementat. Lo nom d'utilizaire intèrne es utilizat per identificar l'utilizaire al dintre del sistèma. Es tanben lo nom per defaut del repertòri utilizaire dins ownCloud. Fa tanben partida de certans URL de servicis, per exemple per totes los servicis *DAV. Lo comportament per defaut pòt èsser modificat amb l'ajuda d'aqueste paramètre. Per obtenir un comportament similar a las versions precedentas a ownCloud 5, sasir lo nom d'utilizaire d'afichar dins lo camp seguent. Daissar a blanc pel comportement per defaut. Las modificacions prendràn efièch solament pels novèls (aponduts) utilizaires LDAP.",
"Internal Username Attribute:" => "Nom d'utilizaire intèrne :",
"Override UUID detection" => "Passar outra la deteccion des UUID",
"By default, the UUID attribute is automatically detected. The UUID attribute is used to doubtlessly identify LDAP users and groups. Also, the internal username will be created based on the UUID, if not specified otherwise above. You can override the setting and pass an attribute of your choice. You must make sure that the attribute of your choice can be fetched for both users and groups and it is unique. Leave it empty for default behavior. Changes will have effect only on newly mapped (added) LDAP users and groups." => "Per defaut, l'atribut UUID es detectat automaticament. Aqueste atribut es utilizat per identificar los utilizaires e gropes de faiçon fisabla. Un nom d'utilizaire intèrne basat sus l'UUID serà automaticament creat, levat s'es especificat autrament çaisús. Podètz modificar aqueste comportament e definir l'atribut que volètz. Vos cal alara vos assegurar que l'atribut que volètz pòt èsser recuperat pels utilizaires e tanben pels gropes e que siá unic. Daissar a blanc pel comportament per defaut. Las modificacions seràn efectivas unicament pels novèls (aponduts) utilizaires e gropes LDAP.",
"UUID Attribute for Users:" => "Atribut UUID pels Utilizaires :",
"UUID Attribute for Groups:" => "Atribut UUID pels Gropes :",
"Username-LDAP User Mapping" => "Associacion Nom d'utilizaire-Utilizaire LDAP",
"Usernames are used to store and assign (meta) data. In order to precisely identify and recognize users, each LDAP user will have an internal username. This requires a mapping from username to LDAP user. The created username is mapped to the UUID of the LDAP user. Additionally the DN is cached as well to reduce LDAP interaction, but it is not used for identification. If the DN changes, the changes will be found. The internal username is used all over. Clearing the mappings will have leftovers everywhere. Clearing the mappings is not configuration sensitive, it affects all LDAP configurations! Never clear the mappings in a production environment, only in a testing or experimental stage." => "Los noms d'utilizaires son utilizats per l'emmagazinatge e l'assignacion de (meta) donadas. Per identificar e reconéisser precisament los utilizaires, cada utilizaire LDAP aurà un nom intèrne especific. Aquò requerís l'associacion d'un nom d'utilizaire ownCloud a un nom d'utilizaire LDAP. Lo nom d'utilizaire creat es associat a l'atribut UUID de l'utilizaire LDAP. Amai, lo DN es memorizat en escondedor per limitar las interaccions LDAP mas es pas utilizat per l'identificacion. Se lo DN es modificat, aquelas modificacions seràn retrobadas. Sol lo nom intèrne a ownCloud es utilizat al dintre del produch. Suprimir las associacions crearà d'orfanèls e l'accion afectarà totas las configuracions LDAP. SUPRIMISSÈTZ PAS JAMAI LAS ASSOCIACIONS EN ENVIRONAMENT DE PRODUCCION, mas unicament sus d'environaments de tèsts e d'experimentacions.",
"Clear Username-LDAP User Mapping" => "Suprimir l'associacion utilizaire intèrne-utilizaire LDAP",
"Clear Groupname-LDAP Group Mapping" => "Suprimir l'associacion nom de grop-grop LDAP"
);
$PLURAL_FORMS = "nplurals=2; plural=(n > 1);";
