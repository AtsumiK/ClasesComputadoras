<?php


    # Tiempo de sesión en milisegundos

    define('SALAS_COMP_SESSION_TIME_OUT', 900000); //15 MINUTOS

    # Número de elementos por página en las listas
    define('SALAS_COMP_LIST_PAGE_SIZE', 2000); //20 ELEMENTOS POR PÁGINA


    define('SALAS_COMP_SESSION_USER_NAME_CONTAINER', 'salasUserNameContainer');




    # D I R E C T O R I E S

    define('SALAS_COMP_CONTROLLER_DIR', SALAS_COMP_SERVER.'controllers/');

    define('SALAS_COMP_COMMON_CONTROLLER_DIR', SALAS_COMP_CONTROLLER_DIR.'common/');

    define('SALAS_COMP_BEANS_DIR', SALAS_COMP_SERVER.'beans/');

    define('SALAS_COMP_ENTITIES_DIR', SALAS_COMP_SERVER.'entities/');

    define('SALAS_COMP_DTOS_DIR', SALAS_COMP_SERVER.'DTOs/');



    # F I L E S

    define('SALAS_COMP_CONFIG_FILE', 'config.php');

    define('SALAS_COMP_MAIN_CONTROLLER', 'SalasMainController.php');


    # Mensajes del sistema

    #    MENSAJES GENÉRICOS


    /**
     * Cuando no pasa la prueba de validación de atributos/campos.
     *
     */
    define('SALAS_COMP_ALERT_E_VALIDATION_FAIL', 			'Se produjo un error de validaci&oacute;n.');
    /**
     * Cuando no se puede persistir la entidad.
     *
     */
    define('SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL', 		'SALAS_COMP_{SalasAlert}_E_{persistence_set}_{fail}');
    /**
     * Cuando no se puede eliminar la entidad.
     *
     */
    define('SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL',	'SALAS_COMP_{SalasAlert}_E_{persistence_remove}_{fail}');
    /**
     * Cuando no se puede eliminar la entidad porque está siendo utilizada en alguna parte.
     *
     */
    define('SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL',	'SALAS_COMP_{SalasAlert}_E_{remove_entity_linked}_{fail}');
    /**
     * Cuando no se puede actualizar la entidad.
     *
     */
    define('SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL',	'SALAS_COMP_{SalasAlert}_E_{persistence_update}_{fail}');
    /**
     * Cuando no se puede hacer drop de la entidad.
     *
     */
    define('SALAS_COMP_ALERT_E_PERSISTENCE_SET_DROP', 		'SALAS_COMP_{SalasAlert}_E_{persistence_drop}_{fail}');
    /**
     * Cuando no se puede hacer add de la entidad.
     *
     */
    define('SALAS_COMP_ALERT_E_PERSISTENCE_SET_ADD', 		'SALAS_COMP_{SalasAlert}_E_{persistence_add}_{fail}');

    /**
     * Cuando no se encuentra alguna entidad necesaria.
     *
     */
    define('SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL', 		'SALAS_COMP_{SalasAlert}_E_{entity_not_found}_{fail}');

	/**
     * Cuando no se encuentra la entidad solicitada
     *
     */
    define('SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL', 	'No se encontró la entidad solicitada.');
    /**
     * Cuando no hay entidades
     *
     */
    define('SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND3_FAIL', 	'SALAS_COMP_{SalasAlert}_E_{entity_not_found3}_{fail}');
    /**
     * Cuando la operación es exitosa
     *
     */
    define('SALAS_COMP_ALERT_A_OPERATION_SUCCESS', 			'Operación realizada exitosamente');


    /**
     * Cuando no se tiene información del dominio
     *
     */
    define('SALAS_COMP_ALERT_E_DOMAIN_IS_OFFLINE', 	'SALAS_COMP_{SalasAlert}_E_{domain_is_offline}_{fail}');

    /**
     *
     * Cuando La entidad pertenece a otra aplicación
     *
     */
    define('SALAS_COMP_ALERT_E_ENTITY_NOT_IN_APP_FAIL', 	'SALAS_COMP_{SalasAlert}_E_{entity_not_in_app}_{fail}');

    /**
     *
     * Cuando el usuario ya existe
     *
     */
    define('SALAS_COMP_ALERT_E_DUPLICATED_USER_FAIL', 	'SALAS_COMP_{SalasAlert}_E_{duplicated_user}_{fail}');




    /**
     *
     * Cuando la ubicación única del kiosko está repetida
     *
     */
    define('SALAS_COMP_ALERT_E_DUPLICATED_KIOSKO_LOCATION_ID_FAIL', 	'SALAS_COMP_{NavCMSAlert}_E_{duplicated_kiosko_location_id}_{fail}');


    /**
     *
     * Cuando la versión de la aplicación cliente no coincide con la del server
     *
     */
    define('SALAS_COMP_ALERT_E_CLIENT_VERSION_INVALID', 	'SALAS_COMP_{NavCMSAlert}_E_{client_version_invalid}_{fail}');




    #E N U M S

    define('SALAS_COMP_PREFIX', 'SALAS_COMP_');



    # Constantes autogeneradas



	    define('SOFTWARE_BEAN', 'SoftwareBean.php');
    define('SOFTWARE_ENTITY', 'Software.php');
    define('SOFTWARE_DTO', 'SoftwareDTO.php');
    define('SOFTWARE_CONTROLLER', 'SoftwareController.php');

    define('OBJETO_EN_INVENTARIO_BEAN', 'ObjetoEnInventarioBean.php');
    define('OBJETO_EN_INVENTARIO_ENTITY', 'ObjetoEnInventario.php');
    define('OBJETO_EN_INVENTARIO_DTO', 'ObjetoEnInventarioDTO.php');
    define('OBJETO_EN_INVENTARIO_CONTROLLER', 'ObjetoEnInventarioController.php');

    define('COMPUTADORA_BEAN', 'ComputadoraBean.php');
    define('COMPUTADORA_ENTITY', 'Computadora.php');
    define('COMPUTADORA_DTO', 'ComputadoraDTO.php');
    define('COMPUTADORA_CONTROLLER', 'ComputadoraController.php');

    define('COMPUTADORA_SOFTWARE_BEAN', 'ComputadoraSoftwareBean.php');
    define('COMPUTADORA_SOFTWARE_ENTITY', 'ComputadoraSoftware.php');
    define('COMPUTADORA_SOFTWARE_DTO', 'ComputadoraSoftwareDTO.php');
    define('COMPUTADORA_SOFTWARE_CONTROLLER', 'ComputadoraSoftwareController.php');

    define('OBJETO_PERDIDO_BEAN', 'ObjetoPerdidoBean.php');
    define('OBJETO_PERDIDO_ENTITY', 'ObjetoPerdido.php');
    define('OBJETO_PERDIDO_DTO', 'ObjetoPerdidoDTO.php');
    define('OBJETO_PERDIDO_CONTROLLER', 'ObjetoPerdidoController.php');

    define('TAREA_BEAN', 'TareaBean.php');
    define('TAREA_ENTITY', 'Tarea.php');
    define('TAREA_DTO', 'TareaDTO.php');
    define('TAREA_CONTROLLER', 'TareaController.php');

    define('SALON_BEAN', 'SalonBean.php');
    define('SALON_ENTITY', 'Salon.php');
    define('SALON_DTO', 'SalonDTO.php');
    define('SALON_CONTROLLER', 'SalonController.php');

    define('PRESTAMO_BEAN', 'PrestamoBean.php');
    define('PRESTAMO_ENTITY', 'Prestamo.php');
    define('PRESTAMO_DTO', 'PrestamoDTO.php');
    define('PRESTAMO_CONTROLLER', 'PrestamoController.php');

    define('MONITOR_SALON_BEAN', 'MonitorSalonBean.php');
    define('MONITOR_SALON_ENTITY', 'MonitorSalon.php');
    define('MONITOR_SALON_DTO', 'MonitorSalonDTO.php');
    define('MONITOR_SALON_CONTROLLER', 'MonitorSalonController.php');

    define('IMPRESION_BEAN', 'ImpresionBean.php');
    define('IMPRESION_ENTITY', 'Impresion.php');
    define('IMPRESION_DTO', 'ImpresionDTO.php');
    define('IMPRESION_CONTROLLER', 'ImpresionController.php');

    define('MONITOR_BEAN', 'MonitorBean.php');
    define('MONITOR_ENTITY', 'Monitor.php');
    define('MONITOR_DTO', 'MonitorDTO.php');
    define('MONITOR_CONTROLLER', 'MonitorController.php');

    define('RESERVA_BEAN', 'ReservaBean.php');
    define('RESERVA_ENTITY', 'Reserva.php');
    define('RESERVA_DTO', 'ReservaDTO.php');
    define('RESERVA_CONTROLLER', 'ReservaController.php');

    define('RESPONSABLE_BEAN', 'ResponsableBean.php');
    define('RESPONSABLE_ENTITY', 'Responsable.php');
    define('RESPONSABLE_DTO', 'ResponsableDTO.php');
    define('RESPONSABLE_CONTROLLER', 'ResponsableController.php');

    define('ESTUDIANTE_BEAN', 'EstudianteBean.php');
    define('ESTUDIANTE_ENTITY', 'Estudiante.php');
    define('ESTUDIANTE_DTO', 'EstudianteDTO.php');
    define('ESTUDIANTE_CONTROLLER', 'EstudianteController.php');

    define('PERSONA_BEAN', 'PersonaBean.php');
    define('PERSONA_ENTITY', 'Persona.php');
    define('PERSONA_DTO', 'PersonaDTO.php');
    define('PERSONA_CONTROLLER', 'PersonaController.php');


?>
