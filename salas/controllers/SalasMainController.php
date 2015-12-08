<?php

	require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
	require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
	require_once UTILS_DIR.HC_ID_GENERATOR_OBJ;
	require_once UTILS_DIR.HC_FILE_MANAGER_OBJ;
	require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;


	#Navigation CMS includes

		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.SALON_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.COMPUTADORA_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.COMPUTADORA_SOFTWARE_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.ESTUDIANTE_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.IMPRESION_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.MONITOR_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.MONITOR_SALON_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.OBJETO_EN_INVENTARIO_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.OBJETO_PERDIDO_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.PERSONA_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.PRESTAMO_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.RESERVA_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.RESPONSABLE_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.SOFTWARE_CONTROLLER;
		require_once SALAS_COMP_COMMON_CONTROLLER_DIR.TAREA_CONTROLLER;


		require_once SALAS_COMP_DTOS_DIR.SALON_DTO;
		require_once SALAS_COMP_DTOS_DIR.COMPUTADORA_DTO;
		require_once SALAS_COMP_DTOS_DIR.COMPUTADORA_SOFTWARE_DTO;
		require_once SALAS_COMP_DTOS_DIR.ESTUDIANTE_DTO;
		require_once SALAS_COMP_DTOS_DIR.IMPRESION_DTO;
		require_once SALAS_COMP_DTOS_DIR.MONITOR_DTO;
		require_once SALAS_COMP_DTOS_DIR.MONITOR_SALON_DTO;
		require_once SALAS_COMP_DTOS_DIR.OBJETO_EN_INVENTARIO_DTO;
		require_once SALAS_COMP_DTOS_DIR.OBJETO_PERDIDO_DTO;
		require_once SALAS_COMP_DTOS_DIR.PERSONA_DTO;
		require_once SALAS_COMP_DTOS_DIR.PRESTAMO_DTO;
		require_once SALAS_COMP_DTOS_DIR.RESERVA_DTO;
		require_once SALAS_COMP_DTOS_DIR.RESPONSABLE_DTO;
		require_once SALAS_COMP_DTOS_DIR.SOFTWARE_DTO;
		require_once SALAS_COMP_DTOS_DIR.TAREA_DTO;




	class SalasMainController {

		private $ID = 50000;

		private $persistenceManager;



		function SalasMainController(PersistenceManager $pm = null){
			$this->persistenceManager = $pm;
			if($pm == null){
				$this->persistenceManager = new PersistenceManager(SALAS_COMP_DB_HOST,SALAS_COMP_DB_PORT,SALAS_COMP_DB_NAME,SALAS_COMP_DB_USER_NAME,SALAS_COMP_DB_USER_PASS);
			}
		}



		public function setSalon($salonDTO) {
			try{
				$salonCtrl = new SalonController($this->persistenceManager);

				$salonCtrl->setSalon($salonDTO);
				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 1,$salonDTO);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 2) ."->".$e->getCode());
			}
		}

		public function getSalones($firstItem,$orderPriority) {
			try{

				$ctrl = new SalonController($this->persistenceManager);

				$salones = $ctrl->getSalons(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(SalonDTO::$ORDER_BY_SALON_NOMBRE), $orderPriority);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 3,$salones,$ctrl->getLastRequestSize());

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 4) ."->".$e->getCode());
			}
		}

		public function getSalon($idSalon) {
			try{

				$ctrl = new SalonController($this->persistenceManager);
				$salon = new SalonDTO($idSalon);

				$ctrl->getSalon($salon);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 5,$salon);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 6) ."->".$e->getCode());
			}
		}

		public function updateSalon($salonDTO) {
			try{

				$ctrl = new SalonController($this->persistenceManager);
				$salon = new SalonDTO();

				$salon->setId($salonDTO->getId());
				$ctrl->getSalon($salon);

				$salon->setSalonNombre($salonDTO->getSalonNombre());

				$ctrl->updateSalon($salon);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 7,$salon);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 8) ."->".$e->getCode());
			}
		}

		public function removeSalon($idSalon) {
			try{

				$ctrl = new SalonController($this->persistenceManager);

				$ctrl->removeSalon($idSalon);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 9);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 10) ."->".$e->getCode());
			}
		}

//Tabla Persona
		public function setPersona($personaDTO) {
			try{
				$personaCtrl = new PersonaController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

				$personaCtrl->setPersona($personaDTO);
				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 11,$personaDTO);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 12) ."->".$e->getCode());
			}
		}

		public function getPersona($idPersona) {
			try{

				$ctrl = new PersonaController($this->persistenceManager);
				$persona = new PersonaDTO($idPersona);

				$ctrl->getPersona($persona);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 13,$persona);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 14) ."->".$e->getCode());
			}
		}

		public function getPersonas($firstItem,$orderPriority) {
			try{

				$ctrl = new PersonaController($this->persistenceManager);

				$persona = $ctrl->getPersonas(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(PersonaDTO::$ORDER_BY_PERSONA_APELLIDOS), $orderPriority);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 15,$persona,$ctrl->getLastRequestSize());

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 16) ."->".$e->getCode());
			}
		}

		public function removePersona($idPersona) {
			try{

				$ctrl = new PersonaController($this->persistenceManager);

				$ctrl->removePersona($idPersona);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 19);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 20) ."->".$e->getCode());
			}
		}

//Tabla Tarea
		public function setTarea($tareaDTO) {
		  try{
		    $tareaCtrl = new TareaController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $tareaCtrl->setTarea($tareaDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 21,$tareaDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 22) ."->".$e->getCode());
		  }
		}

		public function getTarea($idTarea) {
		  try{

		    $ctrl = new TareaController($this->persistenceManager);
		    $tarea = new TareaDTO($idTarea);

		    $ctrl->getTarea($tarea);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 23,$tarea);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 24) ."->".$e->getCode());
		  }
		}

		public function getTareas($firstItem,$orderPriority) {
		  try{

		    $ctrl = new TareaController($this->persistenceManager);

		    $tarea = $ctrl->getTareas(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(TareaDTO::$ORDER_BY_TAREA_FECHA_FIN), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 25,$tarea,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 26) ."->".$e->getCode());
		  }
		}

		public function updateTarea($tareaDTO) {
		  try{

		    $ctrl = new TareaController($this->persistenceManager);
		    $tarea = new TareaDTO();

		    $tarea->setId($tareaDTO->getId());
		    $ctrl->getTarea($tarea);

		    $tarea->setTareaDescripcion($tareaDTO->getTareaDescripcion());
		    $tarea->setTareaComentarios($tareaDTO->getTareaComentarios());
		    $tarea->setTareaFechaFin($tareaDTO->getTareaFechaInicio());
		    $tarea->setTareaMonitor($tareaDTO->getTareaMonitor());

		    $ctrl->updateTarea($tarea);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 27,$tarea);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 28) ."->".$e->getCode());
		  }
		}

		public function removeTarea($idTarea) {
		  try{

		    $ctrl = new TareaController($this->persistenceManager);

		    $ctrl->removeTarea($idTarea);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 19);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 30) ."->".$e->getCode());
		  }
		}

//Tabla Software
		public function setSoftware($softwareDTO) {
		  try{
		    $softwareCtrl = new SoftwareController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $softwareCtrl->setSoftware($softwareDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 31,$softwareDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 32) ."->".$e->getCode());
		  }
		}

		public function getSoftware($idSoftware) {
		  try{

		    $ctrl = new SoftwareController($this->persistenceManager);
		    $software = new SoftwareDTO($idSoftware);

		    $ctrl->getSoftware($software);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 33,$software);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 34) ."->".$e->getCode());
		  }
		}

		public function getSoftwares($firstItem,$orderPriority) {
		  try{

		    $ctrl = new SoftwareController($this->persistenceManager);

		    $software = $ctrl->getSoftwares(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(SoftwareDTO::$ORDER_BY_SOFTWARE_NOMBRE), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 35,$software,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 36) ."->".$e->getCode());
		  }
		}

		public function updateSoftware($softwareDTO) {
		  try{

		    $ctrl = new SoftwareController($this->persistenceManager);
		    $software = new SoftwareDTO();

		    $software->setId($softwareDTO->getId());
		    $ctrl->getSoftware($software);

		    $software->setSoftwareNombre($softwareDTO->getSoftwareNombre());
		    $software->setSoftwareVersion($softwareDTO->getSoftwareVersion());
		    $software->setSoftwareFechaCaducidad($softwareDTO->getSoftwareFechaCaducidad());
		    $software->setSoftwareFechaAquisicion($softwareDTO->getSoftwareFechaAquisicion());
		    $software->setSoftwareEquiposPermitidos($softwareDTO->getSoftwareEquiposPermitidos());
		    $software->setSoftwareComentarios($softwareDTO->getSoftwareComentarios());

		    $ctrl->updateSoftware($software);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 37,$software);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 38) ."->".$e->getCode());
		  }
		}

		public function removeSoftware($idSoftware) {
		  try{

		    $ctrl = new SoftwareController($this->persistenceManager);

		    $ctrl->removeSoftware($idSoftware);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 39);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 40) ."->".$e->getCode());
		  }
		}

//Tabla Responsable
		public function setResponsable($responsableDTO) {
		  try{
		    $responsableCtrl = new ResponsableController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $responsableCtrl->setResponsable($responsableDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 41,$responsableDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 42) ."->".$e->getCode());
		  }
		}

		public function getResponsable($idResponsable) {
		  try{

		    $ctrl = new ResponsableController($this->persistenceManager);
		    $responsable = new ResponsableDTO($idResponsable);

		    $ctrl->getResponsable($responsable);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 43,$responsable);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 44) ."->".$e->getCode());
		  }
		}

		public function getResponsables($firstItem,$orderPriority) {
		  try{

		    $ctrl = new ResponsableController($this->persistenceManager);

		    $responsable = $ctrl->getResponsables(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(ResponsableDTO::$ORDER_BY_RESPONSABLE_ASIGNATURA), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 45,$responsable,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 46) ."->".$e->getCode());
		  }
		}

		public function updateResponsable($responsableDTO) {
		  try{

		    $ctrl = new ResponsableController($this->persistenceManager);
		    $responsable = new ResponsableDTO();

		    $responsable->setId($responsableDTO->getId());
		    $ctrl->getResponsable($responsable);

		    $responsable->setResponsableFacultad($responsableDTO->getResponsableFacultad());
		    $responsable->setResponsableAsignatura($responsableDTO->getResponsableAsignatura());

		    $ctrl->updateResponsable($responsable);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 47,$responsable);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 48) ."->".$e->getCode());
		  }
		}

		public function removeResponsable($idResponsable) {
		  try{

		    $ctrl = new ResponsableController($this->persistenceManager);

		    $ctrl->removeResponsable($idResponsable);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 49);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 50) ."->".$e->getCode());
		  }
		}

//Tabla Reserva
		public function setReserva($reservaDTO) {
		  try{
		    $reservaCtrl = new ReservaController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $reservaCtrl->setReserva($reservaDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 51,$reservaDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 52) ."->".$e->getCode());
		  }
		}

		public function getReserva($idReserva) {
		  try{

		    $ctrl = new ReservaController($this->persistenceManager);
		    $reserva = new ReservaDTO($idReserva);

		    $ctrl->getReserva($reserva);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 53,$reserva);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 54) ."->".$e->getCode());
		  }
		}

		public function getReservas($firstItem,$orderPriority) {
		  try{

		    $ctrl = new ReservaController($this->persistenceManager);

		    $reserva = $ctrl->getReservas(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(ReservaDTO::$ORDER_BY_RESERVA_SALON), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 55,$reserva,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 56) ."->".$e->getCode());
		  }
		}

		public function updateReserva($reservaDTO) {
		  try{

		    $ctrl = new ReservaController($this->persistenceManager);
		    $reserva = new ReservaDTO();

		    $reserva->setId($reservaDTO->getId());
		    $ctrl->getReserva($reserva);

				$reserva->setReservaClase($reservaDTO->getReservaClase());
		    $reserva->setReservaHoraInicio($reservaDTO->getReservaHoraInicio());
		    $reserva->setReservaHoraFin($reservaDTO->getReservaHoraFin());
		    $reserva->setReservaSalon($reservaDTO->getReservaSalon());
		    $reserva->setReservaHoraFin($reservaDTO->getReservaHoraFin());
		    $reserva->setReservaResponsable($reservaDTO->getReservaResponsable());

		    $ctrl->updateReserva($reserva);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 57,$reserva);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 58) ."->".$e->getCode());
		  }
		}

		public function removeReserva($idReserva) {
		  try{

		    $ctrl = new ReservaController($this->persistenceManager);

		    $ctrl->removeReserva($idReserva);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 59);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 60) ."->".$e->getCode());
		  }
		}

		//Tabla Prestamo
		public function setPrestamo($prestamoDTO) {
		  try{
		    $prestamoCtrl = new PrestamoController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $prestamoCtrl->setPrestamo($prestamoDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 61,$prestamoDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 62) ."->".$e->getCode());
		  }
		}

		public function getPrestamo($idPrestamo) {
		  try{

		    $ctrl = new PrestamoController($this->persistenceManager);
		    $prestamo = new PrestamoDTO($idPrestamo);

		    $ctrl->getPrestamo($prestamo);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 63,$prestamo);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 64) ."->".$e->getCode());
		  }
		}

		public function getPrestamos($firstItem,$orderPriority) {
		  try{

		    $ctrl = new PrestamoController($this->persistenceManager);

		    $prestamo = $ctrl->getPrestamos(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(PrestamoDTO::$ORDER_BY_PRESTAMO_ESTUDIANTE), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 65,$prestamo,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 66) ."->".$e->getCode());
		  }
		}

		public function updatePrestamo($prestamoDTO) {
		  try{

		    $ctrl = new PrestamoController($this->persistenceManager);
		    $prestamo = new PrestamoDTO();

		    $prestamo->setId($prestamoDTO->getId());
		    $ctrl->getPrestamo($prestamo);

		    $prestamo->setPrestamoEntrada($prestamoDTO->getPrestamoEntrada());
		    $prestamo->setPrestamoSalida($prestamoDTO->getPrestamoSalida());
		    $prestamo->setPrestamoComentarios($prestamoDTO->getPrestamoComentarios());
		    $prestamo->setPrestamoComputadora($prestamoDTO->getPrestamoComputadora());

		    $ctrl->updatePrestamo($prestamo);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 67,$prestamo);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 68) ."->".$e->getCode());
		  }
		}

		public function removePrestamo($idPrestamo) {
		  try{

		    $ctrl = new PrestamoController($this->persistenceManager);

		    $ctrl->removePrestamo($idPrestamo);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 69);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 70) ."->".$e->getCode());
		  }
		}

//Tabla ObjetoPerdido
		public function setObjetoPerdido($objetoPerdidoDTO) {
		  try{
		    $objetoPerdidoCtrl = new ObjetoPerdidoController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $objetoPerdidoCtrl->setObjetoPerdido($objetoPerdidoDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 71,$objetoPerdidoDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 72) ."->".$e->getCode());
		  }
		}

		public function getObjetoPerdido($idObjetoPerdido) {
		  try{

		    $ctrl = new ObjetoPerdidoController($this->persistenceManager);
		    $objetoPerdido = new ObjetoPerdidoDTO($idObjetoPerdido);

		    $ctrl->getObjetoPerdido($objetoPerdido);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 73,$objetoPerdido);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 74) ."->".$e->getCode());
		  }
		}

		public function getObjetoPerdidos($firstItem,$orderPriority) {
		  try{

		    $ctrl = new ObjetoPerdidoController($this->persistenceManager);

		    $objetoPerdido = $ctrl->getObjetoPerdidos(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(ObjetoPerdidoDTO::$ORDER_BY_OBJETO_PERDIDO_SALON), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 75,$objetoPerdido,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 76) ."->".$e->getCode());
		  }
		}

		public function updateObjetoPerdido($objetoPerdidoDTO) {
		  try{

		    $ctrl = new ObjetoPerdidoController($this->persistenceManager);
		    $objetoPerdido = new ObjetoPerdidoDTO();

		    $objetoPerdido->setId($objetoPerdidoDTO->getId());
		    $ctrl->getObjetoPerdido($objetoPerdido);

		    $objetoPerdido->setObjetoPerdidoProprietario($objetoPerdidoDTO->getObjetoPerdidoProprietario());
		    $objetoPerdido->setObjetoPerdidoCorreo($objetoPerdidoDTO->getObjetoPerdidoCorreo());
		    $objetoPerdido->setObjetoPerdidoFechaDevolucion($objetoPerdidoDTO->getObjetoPerdidoFechaDevolucion());
		    $objetoPerdido->setObjetoPerdidoComentarios($objetoPerdidoDTO->getObjetoPerdidoComentarios());
		    $objetoPerdido->setObjetoPerdidoEstudiante($objetoPerdidoDTO->getObjetoPerdidoEstudiante());

		    $ctrl->updateObjetoPerdido($objetoPerdido);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 77,$objetoPerdido);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 78) ."->".$e->getCode());
		  }
		}

		public function removeObjetoPerdido($idObjetoPerdido) {
		  try{

		    $ctrl = new ObjetoPerdidoController($this->persistenceManager);

		    $ctrl->removeObjetoPerdido($idObjetoPerdido);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 79);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 80) ."->".$e->getCode());
		  }
		}

//Tabla ObjetoEnInventario
		public function setObjetoEnInventario($objetoEnInventarioDTO) {
		  try{
		    $objetoEnInventarioCtrl = new ObjetoEnInventarioController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $objetoEnInventarioCtrl->setObjetoEnInventario($objetoEnInventarioDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 81,$objetoEnInventarioDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 82) ."->".$e->getCode());
		  }
		}

		public function getObjetoEnInventario($idObjetoEnInventario) {
		  try{

		    $ctrl = new ObjetoEnInventarioController($this->persistenceManager);
		    $objetoEnInventario = new ObjetoEnInventarioDTO($idObjetoEnInventario);

		    $ctrl->getObjetoEnInventario($objetoEnInventario);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 83,$objetoEnInventario);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 84) ."->".$e->getCode());
		  }
		}

		public function getObjetoEnInventarios($firstItem,$orderPriority) {
		  try{

		    $ctrl = new ObjetoEnInventarioController($this->persistenceManager);

		    $objetoEnInventario = $ctrl->getObjetoEnInventarios(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(ObjetoEnInventarioDTO::$ORDER_BY_INVENTARIO_ELEMENTO), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 85,$objetoEnInventario,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 86) ."->".$e->getCode());
		  }
		}

		public function updateObjetoEnInventario($objetoEnInventarioDTO) {
		  try{

		    $ctrl = new ObjetoEnInventarioController($this->persistenceManager);
		    $objetoEnInventario = new ObjetoEnInventarioDTO();

		    $objetoEnInventario->setId($objetoEnInventarioDTO->getId());
		    $ctrl->getObjetoEnInventario($objetoEnInventario);

		    $objetoEnInventario->setInventarioSalon($objetoEnInventarioDTO->getInventarioSalon());
		    $objetoEnInventario->setComputadora($objetoEnInventarioDTO->getComputadora());

		    $ctrl->updateObjetoEnInventario($objetoEnInventario);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 87,$objetoEnInventario);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 88) ."->".$e->getCode());
		  }
		}

		public function removeObjetoEnInventario($idObjetoEnInventario) {
		  try{

		    $ctrl = new ObjetoEnInventarioController($this->persistenceManager);

		    $ctrl->removeObjetoEnInventario($idObjetoEnInventario);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 89);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 90) ."->".$e->getCode());
		  }
		}

//Tabla MonitorSalon
		public function setMonitorSalon($monitorSalonDTO) {
		  try{
		    $monitorSalonCtrl = new MonitorSalonController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

		    $monitorSalonCtrl->setMonitorSalon($monitorSalonDTO);
		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 91,$monitorSalonDTO);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 92) ."->".$e->getCode());
		  }
		}

		public function getMonitorSalon($idMonitorSalon) {
		  try{

		    $ctrl = new MonitorSalonController($this->persistenceManager);
		    $monitorSalon = new MonitorSalonDTO($idMonitorSalon);

		    $ctrl->getMonitorSalon($monitorSalon);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 93,$monitorSalon);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 94) ."->".$e->getCode());
		  }
		}

		public function getMonitorSalons($firstItem,$orderPriority) {
		  try{

		    $ctrl = new MonitorSalonController($this->persistenceManager);

		    $monitorSalon = $ctrl->getMonitorSalons(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(MonitorSalonDTO::$ORDER_BY_SALON), $orderPriority);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 95,$monitorSalon,$ctrl->getLastRequestSize());

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 96) ."->".$e->getCode());
		  }
		}

		public function updateMonitorSalon($monitorSalonDTO) {
		  try{

		    $ctrl = new MonitorSalonController($this->persistenceManager);
		    $monitorSalon = new MonitorSalonDTO();

		    $monitorSalon->setId($monitorSalonDTO->getId());
		    $ctrl->getMonitorSalon($monitorSalon);

		    $monitorSalon->setMonitorSalonEntrada($monitorSalonDTO->getMonitorSalonEntrada());
		    $monitorSalon->setMonitorSalonSalida($monitorSalonDTO->getMonitorSalonSalida());
		    $monitorSalon->setMonitorSalonComentarios($monitorSalonDTO->getMonitorSalonComentarios());

		    $ctrl->updateMonitorSalon($monitorSalon);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 97,$monitorSalon);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 98) ."->".$e->getCode());
		  }
		}

		public function removeMonitorSalon($idMonitorSalon) {
		  try{

		    $ctrl = new MonitorSalonController($this->persistenceManager);

		    $ctrl->removeMonitorSalon($idMonitorSalon);

		    $cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 99);

		    return $cm;
		  }catch (Exception $e){
		    return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 100) ."->".$e->getCode());
		  }
		}

//Tabla Monitor
		public function setMonitor($monitorDTO) {
			try{
				$monitorCtrl = new MonitorController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

				$monitorCtrl->setMonitor($monitorDTO);
				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 101,$monitorDTO);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 102) ."->".$e->getCode());
			}
		}

		public function getMonitor($idMonitor) {
			try{

				$ctrl = new MonitorController($this->persistenceManager);
				$monitor = new MonitorDTO($idMonitor);

				$ctrl->getMonitor($monitor);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 103,$monitor);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 104) ."->".$e->getCode());
			}
		}

		public function getMonitors($firstItem,$orderPriority) {
			try{

				$ctrl = new MonitorController($this->persistenceManager);

				$monitor = $ctrl->getMonitors(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(MonitorDTO::$ORDER_BY_MONITOR_HORARIO), $orderPriority);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 105,$monitor,$ctrl->getLastRequestSize());

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 106) ."->".$e->getCode());
			}
		}

		public function updateMonitor($monitorDTO) {
			try{

				$ctrl = new MonitorController($this->persistenceManager);
				$monitor = new MonitorDTO();

				$monitor->setId($monitorDTO->getId());
				$ctrl->getMonitor($monitor);

				$monitor->setMonitorTipo($monitorDTO->getMonitorTipo());
				$monitor->setMonitorHorario($monitorDTO->getMonitorHorario());

				$ctrl->updateMonitor($monitor);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 107,$monitor);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 108) ."->".$e->getCode());
			}
		}

		public function removeMonitor($idMonitor) {
			try{

				$ctrl = new MonitorController($this->persistenceManager);

				$ctrl->removeMonitor($idMonitor);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 109);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 110) ."->".$e->getCode());
			}
		}

//Tabla Impresion
		public function setImpresion($impresionDTO) {
			try{
				$impresionCtrl = new ImpresionController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

				$impresionCtrl->setImpresion($impresionDTO);
				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 111,$impresionDTO);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 112) ."->".$e->getCode());
			}
		}

		public function getImpresion($idImpresion) {
			try{

				$ctrl = new ImpresionController($this->persistenceManager);
				$impresion = new ImpresionDTO($idImpresion);

				$ctrl->getImpresion($impresion);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 113,$impresion);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 114) ."->".$e->getCode());
			}
		}

		public function getImpresions($firstItem,$orderPriority) {
			try{

				$ctrl = new ImpresionController($this->persistenceManager);

				$impresion = $ctrl->getImpresions(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(ImpresionDTO::$ORDER_BY_IMPRESION_ESTUDIANTE), $orderPriority);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 115,$impresion,$ctrl->getLastRequestSize());

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 116) ."->".$e->getCode());
			}
		}

		public function removeImpresion($idImpresion) {
			try{

				$ctrl = new ImpresionController($this->persistenceManager);

				$ctrl->removeImpresion($idImpresion);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 117);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 118) ."->".$e->getCode());
			}
		}

//Tabla Estudiante
		public function setEstudiante($estudianteDTO) {
			try{
				$estudianteCtrl = new EstudianteController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

				$estudianteCtrl->setEstudiante($estudianteDTO);
				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 119,$estudianteDTO);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 120) ."->".$e->getCode());
			}
		}

		public function getEstudiante($idEstudiante) {
			try{

				$ctrl = new EstudianteController($this->persistenceManager);
				$estudiante = new EstudianteDTO($idEstudiante);

				$ctrl->getEstudiante($estudiante);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 121,$estudiante);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 122) ."->".$e->getCode());
			}
		}

		public function getEstudiantes($firstItem,$orderPriority) {
			try{

				$ctrl = new EstudianteController($this->persistenceManager);

				$estudiante = $ctrl->getEstudiantes(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(EstudianteDTO::$ORDER_BY_ESTUDIANTE_CODIGO), $orderPriority);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 123,$estudiante,$ctrl->getLastRequestSize());

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 124) ."->".$e->getCode());
			}
		}

		public function updateEstudiante($estudianteDTO) {
			try{

				$ctrl = new EstudianteController($this->persistenceManager);
				$estudiante = new EstudianteDTO();

				$estudiante->setId($estudianteDTO->getId());
				$ctrl->getEstudiante($estudiante);

				$estudiante->setEstudianteCodigo($estudianteDTO->getEstudianteCodigo());
				$estudiante->setEstudianteFacultad($estudianteDTO->getEstudianteFacultad());
				$estudiante->setEstudianteCarrerra($estudianteDTO->getEstudianteCarrerra());

				$ctrl->updateEstudiante($estudiante);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 125,$estudiante);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 126) ."->".$e->getCode());
			}
		}

		public function removeEstudiante($idEstudiante) {
			try{

				$ctrl = new EstudianteController($this->persistenceManager);

				$ctrl->removeEstudiante($idEstudiante);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 127);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 128) ."->".$e->getCode());
			}
		}


//Tabla ComputadoraSoftware
		public function setComputadoraSoftware($computadoraSoftwareDTO) {
			try{
				$computadoraSoftwareCtrl = new ComputadoraSoftwareController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

				$computadoraSoftwareCtrl->setComputadoraSoftware($computadoraSoftwareDTO);
				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 129,$computadoraSoftwareDTO);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 130) ."->".$e->getCode());
			}
		}

		public function getComputadoraSoftware($idComputadoraSoftware) {
			try{

				$ctrl = new ComputadoraSoftwareController($this->persistenceManager);
				$computadoraSoftware = new ComputadoraSoftwareDTO($idComputadoraSoftware);

				$ctrl->getComputadoraSoftware($computadoraSoftware);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 131,$computadoraSoftware);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 132) ."->".$e->getCode());
			}
		}

		public function getComputadoraSoftwares($firstItem,$orderPriority) {
			try{

				$ctrl = new ComputadoraSoftwareController($this->persistenceManager);

				$computadoraSoftware = $ctrl->getComputadoraSoftwares(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(ComputadoraSoftwareDTO::$ORDER_BY_COMPUTADORA), $orderPriority);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 133,$computadoraSoftware,$ctrl->getLastRequestSize());

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 134) ."->".$e->getCode());
			}
		}

		public function removeComputadoraSoftware($idComputadoraSoftware) {
			try{

				$ctrl = new ComputadoraSoftwareController($this->persistenceManager);

				$ctrl->removeComputadoraSoftware($idComputadoraSoftware);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 135);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 136) ."->".$e->getCode());
			}
		}

//Tabla Computadora
		public function setComputadora($computadoraDTO) {
			try{
				$computadoraCtrl = new ComputadoraController($this->persistenceManager);//crea una instancia,persistenceManager se encarga de persistencia, y controladores lo usa para hacer las op en bd

				$computadoraCtrl->setComputadora($computadoraDTO);
				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 137,$computadoraDTO);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 138) ."->".$e->getCode());
			}
		}

		public function getComputadora($idComputadora) {
			try{

				$ctrl = new ComputadoraController($this->persistenceManager);
				$computadora = new ComputadoraDTO($idComputadora);

				$ctrl->getComputadora($computadora);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 139,$computadora);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 140) ."->".$e->getCode());
			}
		}

		public function getComputadoras($firstItem,$orderPriority) {
			try{

				$ctrl = new ComputadoraController($this->persistenceManager);

				$computadora = $ctrl->getComputadoras(true,$firstItem,SALAS_COMP_LIST_PAGE_SIZE,array(ComputadoraDTO::$ORDER_BY_COMPUTADORA_NOMBRE), $orderPriority);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 141,$computadora,$ctrl->getLastRequestSize());

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 142) ."->".$e->getCode());
			}
		}

		public function updateComputadora($computadoraDTO) {
			try{

				$ctrl = new ComputadoraController($this->persistenceManager);
				$computadora = new ComputadoraDTO();

				$computadora->setId($computadoraDTO->getId());
				$ctrl->getComputadora($computadora);

				$computadora->setComputadoraNombre($computadoraDTO->getComputadoraNombre());
				$computadora->setComputadoraRam($computadoraDTO->getComputadoraRam());
				$computadora->setComputadoraProcesador($computadoraDTO->getComputadoraProcesador());
				$computadora->setComputadoraDiscoDuro($computadoraDTO->getComputadoraDiscoDuro());
				$computadora->setComputadoraDirIp($computadoraDTO->getComputadoraDirIp());
				$computadora->setComputadoraDirMac($computadoraDTO->getComputadoraDirMac());

				$ctrl->updateComputadora($computadora);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 143,$computadora);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 144) ."->".$e->getCode());
			}
		}

		public function removeComputadora($idComputadora) {
			try{

				$ctrl = new ComputadoraController($this->persistenceManager);

				$ctrl->removeComputadora($idComputadora);

				$cm = new CommunicationMensaje(true,SALAS_COMP_ALERT_A_OPERATION_SUCCESS,$this->ID + 145);

				return $cm;
			}catch (Exception $e){
				return new CommunicationMensaje(false,$e->getMessage(),($this->ID + 146) ."->".$e->getCode());
			}
		}
	}
?>
