<?php


	# Debug
	define('LOG_ENABLED', true);
	

    # D I R E C T O R I E S
    
    define('ROOT', '../../');
    define('COMMON', ROOT.'common/');
    
    define('SALAS_COMP', ROOT.'salas/');
    
    define('SALAS_COMP_CONFIG_DIR', SALAS_COMP.'config/');
    
    define('CUSTOM_DRIVERS_DIR', COMMON.'customDrivers/');
    define('DB_DIR', CUSTOM_DRIVERS_DIR.'db/');
    define('DB_COMMON_DIR', DB_DIR.'common/');
    
    define('SALAS_COMP_SERVER', ROOT.'salas/');
    
    define('DB_POSTGRES_DIR', DB_DIR.'postgres/');
    
    define('PERSISTENCE_DIR', COMMON.'persistence/');
    
    define('UTILS_DIR', COMMON.'utils/');
    
    define('LOG_DIR', COMMON.'log/');
    
    
    
    
    # F I L E S

    
    
    define('SALAS_COMP_ENUMS_FILE', 'SalasGlobalEnums.php');
    
    define('DELETE_OBJECT_OBJ', 'DeleteObject.php');
    define('INSERT_OBJECT_OBJ', 'InsertObject.php');
    define('SELECT_OBJECT_OBJ', 'SelectObject.php');
    define('UPDATE_OBJECT_OBJ', 'UpdateObject.php');
    define('JOIN_OBJECT_OBJ', 'JoinObject.php');
    
    define('POSTGRES_CONNECTION_OBJ', 'PostgresConnection.php');
    define('POSTGRES_DRIVER_OBJ', 'PostgresDriver.php');
    
    define('DATABASE_CONFIG_OBJ', 'DataBaseConfig.php');
    define('DATABASE_DRIVER_OBJ', 'DataBaseDriver.php');
    define('DB_CONFIG_ENUM_OBJ', 'DBConfigEnum.php');
    define('DB_ENUMS', 'dbEnums.php');
    
    define('PERSISTENCE_MANAGER_OBJ', 'PersistenceManager.php');
    
    define('ENTITY_VALIDATOR_OBJ', 'EntityValidator.php');
    
    define('HC_ID_GENERATOR_OBJ', 'HevoTCoreIDGenerator.php');
    
    define('HC_FILE_MANAGER_OBJ', 'FileManager.php');
    
    define('COMMUNICATION_MESSAGE_OBJ', 'CommunicationMessage.php');
    
    define('COMMUNICATION_SETTING_OBJ', 'CommunicationSetting.php');

    
    define('LOGGER_OBJ', 'Logger.php');
    
    
    # Enumeraciones para los dominios en general

    define('DOMAIN_ONLINE', 'online');
    define('DOMAIN_OFFLINE', 'offline');
    
    
    #    Enumeraciónes para CommunicationMessage
    
    define('CM', 			'CommunicationMessage');
    define('CM_STATUS', 	'status');
    define('CM_ERROR_CODE', 'errorCode');
    define('CM_MSG', 		'msg');
    define('CM_DATA', 		'data');
    define('CM_DATA2', 		'data2');
    
    # Enumeraciones para el contenido estándar de CommunicationSetting
    
    define('CS_IS_OWNER',      'is_owner');
    define('CS_REQUEST_SIZE',  'request_size');
    define('CS_ENTITY_ID',  	'entity_id');
    define('CS_SESSION_ID',  	'session_id');
    define('CS_USER_ROLE',  	'user_role_id');
    define('CS_APP_VERSION_NUMBER',  	'app_version_number');
    
    
    
    # E N U M S
    
    define('GLOBAL_YES', 'y');
    define('GLOBAL_NO', 'n');
    
    define('SQL_ASCENDING_ORDER', 'ASC');
    define('SQL_DESCENDENT_ORDER', 'DESC');
    
?>