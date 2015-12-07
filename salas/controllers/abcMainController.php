<?php

	require_once NAV_CMS_CONFIG_DIR.NAV_CMS_CONFIG_FILE;
	require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
	require_once UTILS_DIR.HC_ID_GENERATOR_OBJ;
	require_once UTILS_DIR.HC_FILE_MANAGER_OBJ;
	require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

	require_once HC_CONTROLLER_DIR.MAIN_CONTROLLER;
	require_once NAV_CMS_CONTROLLER_DIR.NAV_CMS_SECURITY_CONTROLLER;

	#HevoTCore includes
	require_once HC_COMMON_CONTROLLER_DIR.SYSTEM_ALERT_CONTROLLER;
	require_once HC_COMMON_CONTROLLER_DIR.ENTERPRISE_USER_CONTROLLER;
	require_once HC_COMMON_CONTROLLER_DIR.FILE_RESOURCE_CONTROLLER;

	#require_once HC_DTOS_DIR.SYSTEM_ALERT_DTO;
	require_once HC_DTOS_DIR.ENTERPRISE_USER_DTO;
	require_once HC_DTOS_DIR.FILE_RESOURCE_DTO;


	#Navigation CMS includes
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.APP_INSTANCE_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.APP_INSTANCE_USAGE_PLAN_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.USAGE_ACTION_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.USAGE_LOG_UNIT_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.APP_INSTANCE_CATEGORY_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.KIOSKO_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.MAP_USER_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.LANDMARK_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.LANDMARK_CATEGORY_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.G_P_S_ALERT_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.RESOURCE_INDEX_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.RESOURCE_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.RESOURCE_PLATFORM_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.RESOURCE_CATEGORY_CONTROLLER;
	require_once NAV_CMS_COMMON_CONTROLLER_DIR.G_P_S_POINT_CONTROLLER;



	require_once NAV_CMS_DTOS_DIR.APP_INSTANCE_DTO;
	require_once NAV_CMS_DTOS_DIR.APP_INSTANCE_USAGE_PLAN_DTO;
	require_once NAV_CMS_DTOS_DIR.USAGE_ACTION_DTO;
	require_once NAV_CMS_DTOS_DIR.USAGE_LOG_UNIT_DTO;
	require_once NAV_CMS_DTOS_DIR.APP_INSTANCE_CATEGORY_DTO;
	require_once NAV_CMS_DTOS_DIR.KIOSKO_DTO;
	require_once NAV_CMS_DTOS_DIR.MAP_USER_DTO;
	require_once NAV_CMS_DTOS_DIR.LANDMARK_DTO;
	require_once NAV_CMS_DTOS_DIR.LANDMARK_CATEGORY_DTO;
	require_once NAV_CMS_DTOS_DIR.G_P_S_ALERT_DTO;
	require_once NAV_CMS_DTOS_DIR.RESOURCE_INDEX_DTO;
	require_once NAV_CMS_DTOS_DIR.RESOURCE_DTO;
	require_once NAV_CMS_DTOS_DIR.RESOURCE_PLATFORM_DTO;
	require_once NAV_CMS_DTOS_DIR.RESOURCE_CATEGORY_DTO;
	require_once NAV_CMS_DTOS_DIR.G_P_S_POINT_DTO;




	class NavigationCMSMainController {

		private $ID = 20000;

		private $persistenceManager;


		private $securityCtrl;
		private $hcMainCtrl;
		private $alertCtrl;

		function abcMainController(PersistenceManager $pm = null){
			$this->persistenceManager = $pm;
			if($pm == null){
				$this->persistenceManager = new PersistenceManager(NAV_CMS_DB_HOST,NAV_CMS_DB_PORT,NAV_CMS_DB_NAME,NAV_CMS_DB_USER_NAME,NAV_CMS_DB_USER_PASS);
			}
			$this->securityCtrl = new NavigationCMSSecurityController($this->persistenceManager);
			$this->alertCtrl = new SystemAlertController($this->persistenceManager);
			$this->hcMainCtrl = new MainController();
		}
		/**
		 *
		 * Esta función retorna una traducción en el idioma indicado. En caso de que no se encuentra devuelve HC_ID
		 * @param  $lang
		 * @param  $alertCode
		 */
		public function getSystemTranslationByLangAndAlertCode($lang, $alertCode) {

			return $this->hcMainCtrl->getSystemTranslationStringByLangAndAlertCode($lang, $alertCode);
		}

		/**
		 *
		 * Esta función facilita un poco el proceso de traducir un mensaje de comunicación
		 * @param $lang
		 * @param CommunicationMensaje $cm
		 */
		public function translateCommunicationMessage(CommunicationMensaje $cm) {
			#Idioma
			$lang = $this->securityCtrl->getUserLanguageInCurrentSession();

			$cm->setMessage($this->getSystemTranslationByLangAndAlertCode($lang, $cm->getMessage()));
			return $cm;
		}

		public function changePassword($currPass, $newPass, $newPassAgain) {
			try{
				return $this->securityCtrl->changePasswordEnterpriseUser($currPass, $newPass, $newPassAgain);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 1) ."->".$e->getCode()));
			}
		}

		public function logout() {
			try{
				return $this->securityCtrl->logoutEnterpriseUser();
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 2) ."->".$e->getCode()));
			}
		}

		public function setActionLog($action, $data) {
			try{
				$app =  $this->securityCtrl->getNavigationMainAppDTO();
				$user = $this->securityCtrl->getCurrentUserDTO();
				# Ubicamos el tipo de acción para el log
				$uaCtrl = new UsageActionController($this->persistenceManager);
				$uluCtrl = new UsageLogUnitController($this->persistenceManager);
				$uas = $uaCtrl->getUsageActionsByAction($action);

				if(count($uas) > 0){

					#Primero traemos los totales
					$kCtrl = new KioskoController($this->persistenceManager);
					$muCtrl = new MapUserController($this->persistenceManager);
					$lmCtrl = new LandMarkController($this->persistenceManager);
					$aCtrl = new GPSAlertController($this->persistenceManager);
					$riCtrl = new ResourceIndexController($this->persistenceManager);

					$kCtrl->getKioskosByAppInstanceId($app->getId(),true,0,1);
					$totalKiosks = $kCtrl->getLastRequestSize();

					$muCtrl->getMapUsersByAppInstanceId($app->getId(),true,0,1);
					$totalMapUsers = $muCtrl->getLastRequestSize();

					$lmCtrl->getLandmarksByAppInstanceId($app->getId(),true,0,1);
					$totalLandmarks = $lmCtrl->getLastRequestSize();

					$alerts = $aCtrl->getGPSAlertsByAppInstanceId($app->getId());

					$totalGPSInfoAlerts = 0;
					$totalGPSAlerts = 0;
					$totalGPSAdAlerts = 0;

					foreach ($alerts as $a) {
						if($a->getType() == NAV_CMS_ALERT_TYPE_ADVERTISING){
							$totalGPSAdAlerts ++;
						}else if($a->getType() == NAV_CMS_ALERT_TYPE_INFO){
							$totalGPSInfoAlerts ++;
						}else if($a->getType() == NAV_CMS_ALERT_TYPE_ALERT){
							$totalGPSAlerts ++;
						}
					}

					$riCtrl->getResourceIndexesByAppInstanceId($app->getId(),true,0,1);
					$totalResources = $riCtrl->getLastRequestSize();

					#	Actualizamos el consumo de archivos

					$cm = $this->hcMainCtrl->getDomainFilesSize($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass());
                    $memory = 0;
                    if($cm->getStatus()){
                    	$memory = $cm->getData();
                    }

					$ua = $uas[0];
					$ul = new UsageLogUnitDTO(	null, $action ." -> ".$user->getLogin()." - ".$data, date('Y-m-d G:i:s'), $totalKiosks, $totalMapUsers, $totalLandmarks, $totalGPSInfoAlerts,
												$totalGPSAlerts, $totalGPSAdAlerts, $totalResources, $memory, $ua->getId(), $app->getId());


					$uluCtrl->setUsageLogUnit($ul);
				}else{
					throw new Exception(NAV_CMS_ALERT_E_VALIDATION_FAIL, $this->ID + 9998);
				}
			}catch (Exception $e){
				throw new Exception(NAV_CMS_ALERT_E_VALIDATION_FAIL, $this->ID + 9999);
			}
		}

		public function login($xmlData, $sessionID, $versionRequired = false) {
			try{

				$adminAppVersion = $this->securityCtrl->getNavigationMainAppDTO()->getAdminAppVersion();

				$css = CommunicationSetting::loadFromXML($xmlData);
				$user = CommunicationSetting::findValueByKey($css, "user");
				$pass = CommunicationSetting::findValueByKey($css, "pass");
				$clientVersion = CommunicationSetting::findValueByKey($css, "clientVersion");

				// Si la versión es 0, significa que no se requiere validación al respecto.

				if(!$versionRequired || $adminAppVersion == 0 || $clientVersion == $adminAppVersion){
					$cm = $this->securityCtrl->loginUser($user, $pass);

					if($cm->getStatus()){
						#    Verificación de la aplicación
						$cm = $this->securityCtrl->isAppReady();
						if(!$cm->getStatus()){
							return $this->translateCommunicationMessage($cm);
						}
						#----------------------------------

						$user = $this->securityCtrl->getCurrentUserDTO();
						$appI = $this->securityCtrl->getCurrentUserAppInstanceDTO();

						$commSettings = array();
						$commSettings[] = new CommunicationSetting(null,CS_ENTITY_ID, $appI->getId());
						$commSettings[] = new CommunicationSetting(null,CS_SESSION_ID, $sessionID);
						$commSettings[] = new CommunicationSetting(null,CS_USER_ROLE, $this->securityCtrl->getCurrentUserDTO()->getUserRole());

						$cm = new CommunicationMensaje(true,HC_ALERT_A_OPERATION_SUCCESS,$this->ID + 3,CommunicationSetting::DTOsToXML($commSettings));

					}
				}else{
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_CLIENT_VERSION_INVALID,$this->ID + 157,$adminAppVersion);
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 4) ."->".$e->getCode()));
			}

		}

		/**
		 *
		 * Adiciona una nueva instancia de la aplicación.
		 * @param $appInstanceXML
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad.
		 */
		public function setAppInstance($appInstanceXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_APP_INSTANCE);
				if($cm->getStatus()){
					$appIs = AppInstanceDTO::loadFromXML($appInstanceXML);
					if(count($appIs)!=1){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 5);
					}else{
						$appI = $appIs[0];

						$ctrl = new AppInstanceController($this->persistenceManager);
						$ctrl->setAppInstance($appI);
						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 6,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $appI->getId()))));
					}
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 7) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las instancias de aplicación del sistema.
		 * @param $firstItem
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de AppInstanceDTO con los campos mínimos necesarios.
		 */
		public function listAppInstances($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_APP_INSTANCES);
				if($cm->getStatus()){

					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new AppInstanceController($this->persistenceManager);
					$appIs = $ctrl->listAppInstances(true,$firstItem,NAV_CMS_LIST_PAGE_SIZE,array(AppInstance::$ORDER_BY_NAME),$orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 8,AppInstanceDTO::DTOsToXML($appIs),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 9) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las instancias de aplicación asociadas al usuario en sesión.
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de AppInstanceDTO con los campos mínimos necesarios.
		 */
		public function listAppInstancesByUserInSession() {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_APP_INSTANCES_BY_USER_IN_SESSION);
				if($cm->getStatus()){

					$ctrl = new AppInstanceController($this->persistenceManager);

					$appIs = $ctrl->listAppInstancesByMapUserId($this->securityCtrl->getCurrentUserDTO()->getId(),true,null,null,array(AppInstance::$ORDER_BY_NAME));
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 81,AppInstanceDTO::DTOsToXML($appIs),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 82) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Consulta una instancia de aplicación.
		 * @param $appInstanceId
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un AppInstanceDTO.
		 */
		public function getAppInstance($appInstanceId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_APP_INSTANCE);
				if($cm->getStatus()){
					$ctrl = new AppInstanceController($this->persistenceManager);
					$appI = new AppInstanceDTO($appInstanceId);
					$ctrl->getAppInstance($appI);
					$appI->setExtensionPlan(null);
					$appI->setUsageLogUnits(array());
					$appI->setUsagePlan(null);

					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 10,$appI->toXML2());
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 11) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Modifica una instancia de aplicación.
		 * @param $appInstanceXML
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function updateAppInstance($appInstanceXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_UPDATE_APP_INSTANCE);
				if($cm->getStatus()){
					$appIs = AppInstanceDTO::loadFromXML($appInstanceXML);
					if(count($appIs)!=1){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 12);
					}else{
						$ctrl = new AppInstanceController($this->persistenceManager);
						$appI = $appIs[0];
						$appI2 = new AppInstanceDTO($appI->getId());
						$ctrl->getAppInstance($appI2);


						$appI2->setName($appI->getName());
						$appI2->setDescription($appI->getDescription());
						$appI2->setAppInstanceLocationID($appI->getAppInstanceLocationID());
						$appI2->setLang($appI->getLang());
						$appI2->setMapNamePrefix($appI->getMapNamePrefix());
						$appI2->setMapNumColumns($appI->getMapNumColumns());
						$appI2->setMapNumRows($appI->getMapNumRows());
						$appI2->setReferenceMapLatitudeEnd($appI->getReferenceMapLatitudeEnd());
						$appI2->setReferenceMapLatitudeIni($appI->getReferenceMapLatitudeIni());
						$appI2->setReferenceMapLongitudeEnd($appI->getReferenceMapLongitudeEnd());
						$appI2->setReferenceMapLongitudeIni($appI->getReferenceMapLongitudeIni());
						$appI2->setReferenceMapXEnd($appI->getReferenceMapXEnd());
						$appI2->setReferenceMapXIni($appI->getReferenceMapXIni());
						$appI2->setReferenceMapYEnd($appI->getReferenceMapYEnd());
						$appI2->setReferenceMapYIni($appI->getReferenceMapYIni());
						$appI2->setSyncTimeout($appI->getSyncTimeout());

						$ctrl->updateAppInstance($appI2);
						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 13);

					}
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 14) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Elimina una instancia de aplicación existente siempre y cuando no se esté utilizando.
		 * @param $publicConceptualUnitTypeId
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function removeAppInstance($publicConceptualUnitTypeId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_REMOVE_APP_INSTANCE);
				if($cm->getStatus()){
					$ctrl = new AppInstanceController($this->persistenceManager);
					$appI = new AppInstanceDTO($publicConceptualUnitTypeId);
					$ctrl->getAppInstance($appI);

					#    Verificamos que no esté siendo utilizado por kioskos.

					$tmpCtrl = new KioskoController($this->persistenceManager);
					$res = $tmpCtrl->getKioskosByAppInstanceId($appI->getId(),false,0,1);
					if(count($res)>0){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL,$this->ID + 15);
					}else{
						#    Verificamos que no esté siendo utilizado por usuarios.
						$tmpCtrl = new MapUserController($this->persistenceManager);
						$res = $tmpCtrl->getMapUsersByAppInstanceId($appI->getId(),false,0,1);
						if(count($res)>0){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL,$this->ID + 16);
						}else{
							#    Verificamos que no esté siendo utilizado por marcas terrestres.
							$tmpCtrl = new LandmarkController($this->persistenceManager);
							$res = $tmpCtrl->getLandmarksByAppInstanceId($appI->getId(),false,0,1);
							if(count($res)>0){
								$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL,$this->ID + 17);
							}else{
								#    Verificamos que no esté siendo utilizado por alertas GPS.
								$tmpCtrl = new GPSAlertController($this->persistenceManager);
								$res = $tmpCtrl->getGPSAlertsByAppInstanceId($appI->getId(),false,0,1);
								if(count($res)>0){
									$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL,$this->ID + 18);
								}else{
									#    Verificamos que no esté siendo utilizado por índices de recursos.
									$tmpCtrl = new ResourceIndexController($this->persistenceManager);
									$res = $tmpCtrl->getResourceIndexesByAppInstanceId($appI->getId(),false,0,1);
									if(count($res)>0){
										$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL,$this->ID + 19);
									}else{
										# Procedemos a eliminar la entidad. Primero eliminamos el vínculo con las categorías:
										$this->persistenceManager->beginTransaction();

										$tmpCtrl = new AppInstanceCategoryController($this->persistenceManager);
										$res = $tmpCtrl->getAppInstanceCategoriesByAppInstanceId($appI->getId(),false,0,1);

										foreach ($res as $cat) {
											$ctrl->dropAppInstanceFromAppInstanceCategory($appI->getId(), $cat->getId());
										}

										$ctrl->removeAppInstance($appI->getId());
										$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 20);
									}
								}
							}
						}
					}
				}
				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 21) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Adiciona un nuevo índice de recurso a una marca terrestre de la aplicación. Adiciona automáticamente el recurso, por lo que debe ir un archivo adjunto.
		 * @param $resourceIndexXML
		 * @param $categories
		 * @param $platforms
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad.
		 */
		public function setResourceIndexToLandmark($xmlDTOs, $tmpUrl, $fileName) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_RESOURCE_INDEX_TO_LANDMARK);
				if($cm->getStatus()){
					$ris = ResourceIndexDTO::loadFromXML($xmlDTOs);
					$frs = FileResourceDTO::loadFromXML($xmlDTOs);
					$css = CommunicationSetting::loadFromXML($xmlDTOs);
					$categories = CommunicationSetting::findValueByKey($css, "categories");
					$platforms = CommunicationSetting::findValueByKey($css, "platforms");
					$categories = explode(",", $categories);
					$platforms = explode(",", $platforms);

					if(count($ris)!=1 || count($frs)!=1 || count($categories) == 0 || count($platforms) == 0){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 22);
					}else{
						$ri = $ris[0];
						$fr = $frs[0];

						$ctrlRI = new ResourceIndexController($this->persistenceManager);



						#    Se obtienen todos los índices de recursos de la marca terrestre y se ubica en último lugar.
						$ctrlLM = new LandmarkController($this->persistenceManager);
						$lm = new LandmarkDTO($ri->getLandmark());
						$ctrlLM->getLandmark($lm);

						$ris = $ctrlRI->listResourceIndexesByLandmarkId($lm->getId());

						$maxOrder = 0;

						foreach ($ris as $riItem) {
							if($riItem->getResourceOrder() > $maxOrder){
								$maxOrder = $riItem->getResourceOrder();
							}
						}

						#    Aumentamos en 1 y tenemos el nuevo orden
						$maxOrder++;

						$this->persistenceManager->beginTransaction();


						# Creamos el recurso

						//Ubicamos la dirección actual del archivo
                        $fr->setUrl($tmpUrl);
                        $fr->setFileExtension(FileManager::getFileType($fileName));
                        $fr->setHevotCoreFileResourceID("NAV_CMS_FILE_RESOURCE");
                        $fr->setOriginalName($fileName);

                        $this->hcMainCtrl->activateSession();

	                    $app = $this->securityCtrl->getNavigationMainAppDTO();
	                    $cm = $this->hcMainCtrl->setFileResource($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $fr->toXML());

	                    if($cm->getStatus()){

	                        $ctrlR = new ResourceController($this->persistenceManager);
							$r = new ResourceDTO();
							$r->setHevoTCoreID($cm->getData());
							$ctrlR->setResource($r);

							# Adicionamos el índice y preparamos para verificar las relaciones que tiene (plataformas y categorías)

							$ri->setResourceOrder($maxOrder);
							$ri->setResource($r->getId());
							$ctrlRI->setResourceIndex($ri);

							$ctrlP = new ResourcePlatformController($this->persistenceManager);

							if(!empty($platforms)){
								foreach ($platforms as $pid) {
									$p = new ResourcePlatformDTO($pid);
									$ctrlP->getResourcePlatform($p);
									$ctrlRI->addResourceIndexToResourcePlatform($ri->getId(), $pid);
								}
							}

							$ctrlC = new ResourceCategoryController($this->persistenceManager);

							if(!empty($categories)){
								foreach ($categories as $cid) {
									$c = new ResourceCategoryDTO($cid);
									$ctrlC->getResourceCategory($c);
									$ctrlRI->addResourceIndexToResourceCategory($ri->getId(), $cid);
								}
							}

							$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 23,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $ri->getId()))));

							if($cm->getStatus()){
	                        	# Ubicamos el tipo de acción para el log
								$this->setActionLog(NAV_CMS_ACTION_ADD_RESOURCE, $r->getHevoTCoreID()." - ".$fileName);
	                        }
	                    }
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
					$this->hcMainCtrl->commitSession();
				}else{
					$this->persistenceManager->rollbackTransaction();
					$this->hcMainCtrl->rollbackSession();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				$this->hcMainCtrl->rollbackSession();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 24) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Adiciona un nuevo índice de recurso a una marca terrestre de la aplicación. Adiciona automáticamente el recurso, por lo que debe ir un archivo adjunto.
		 * @param $xmlDTOs
		 * @param $tmpUrl
		 * @param $fileName
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad.
		 */
		public function setResourceIndexToAppInstance($xmlDTOs, $tmpUrl, $fileName) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_RESOURCE_INDEX_TO_APP_INSTANCE);
				if($cm->getStatus()){
					$ris = ResourceIndexDTO::loadFromXML($xmlDTOs);
					$frs = FileResourceDTO::loadFromXML($xmlDTOs);
					$css = CommunicationSetting::loadFromXML($xmlDTOs);
					$categories = CommunicationSetting::findValueByKey($css, "categories");
					$platforms = CommunicationSetting::findValueByKey($css, "platforms");
					$categories = explode(",", $categories);
					$platforms = explode(",", $platforms);

					if(count($ris)!=1 || count($frs)!=1 || !is_array($categories) || count($categories) == 0 || !is_array($platforms) || count($platforms) == 0){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 22);
					}else{
						$ri = $ris[0];
						$fr = $frs[0];

						$ctrlRI = new ResourceIndexController($this->persistenceManager);


						#    Se obtienen todos los índices de recursos y se ubica en último lugar.

						$ris = $ctrlRI->listResourceIndexes();

						$maxOrder = 0;

						foreach ($ris as $riItem) {
							if($riItem->getResourceOrder() > $maxOrder){
								$maxOrder = $riItem->getResourceOrder();
							}
						}

						#    Aumentamos en 1 y tenemos el nuevo orden
						$maxOrder++;

						$this->persistenceManager->beginTransaction();

						# Creamos el recurso

						//Ubicamos la dirección actual del archivo
                        $fr->setUrl($tmpUrl);
                        $fr->setFileExtension(FileManager::getFileType($fileName));
                        $fr->setHevotCoreFileResourceID("NAV_CMS_FILE_RESOURCE");
                        $fr->setOriginalName($fileName);

                        $this->hcMainCtrl->activateSession();

	                    $app = $this->securityCtrl->getNavigationMainAppDTO();
	                    $cm = $this->hcMainCtrl->setFileResource($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $fr->toXML());

	                    if($cm->getStatus()){

	                        $ctrlR = new ResourceController($this->persistenceManager);
							$r = new ResourceDTO();
							$r->setHevoTCoreID($cm->getData());
							$ctrlR->setResource($r);

							# Adicionamos el índice y prparamos para verificar las relaciones que tiene (oplataformas y categorías)

							$ri->setResourceOrder($maxOrder);
							$ri->setResource($r->getId());
							$ri->setLandmark(null);
							$ctrlRI->setResourceIndex($ri);

							$ctrlP = new ResourcePlatformController($this->persistenceManager);

							if(!empty($platforms)){
								foreach ($platforms as $pid) {
									$p = new ResourcePlatformDTO($pid);
									$ctrlP->getResourcePlatform($p);
									$ctrlRI->addResourceIndexToResourcePlatform($ri->getId(), $pid);
								}
							}

							$ctrlC = new ResourceCategoryController($this->persistenceManager);

							if(!empty($categories)){
								foreach ($categories as $cid) {
									$c = new ResourceCategoryDTO($cid);
									$ctrlC->getResourceCategory($c);
									$ctrlRI->addResourceIndexToResourceCategory($ri->getId(), $cid);
								}
							}
							#	Si llega aquí es porque todo se realizó con éxito, entonces se deja el cm en true.
							$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 23,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $ri->getId()))));

	                    	if($cm->getStatus()){
	                        	# Ubicamos el tipo de acción para el log
								$this->setActionLog(NAV_CMS_ACTION_ADD_RESOURCE, $r->getHevoTCoreID()." - ".$fileName);
	                        }
	                    }
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
					$this->hcMainCtrl->commitSession();
				}else{
					$this->persistenceManager->rollbackTransaction();
					$this->hcMainCtrl->rollbackSession();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				$this->hcMainCtrl->rollbackSession();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 24) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Modifica un índice de recurso de la aplicación.
		 * @param $resourceIndexXML
		 * @param $categories
		 * @param $platforms
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad.
		 */
		public function updateResourceIndex($xmlDTOs) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$this->persistenceManager->beginTransaction();

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_UPDATE_RESOURCE_INDEX);
				if($cm->getStatus()){
					$ris = ResourceIndexDTO::loadFromXML($xmlDTOs);
					$frs = FileResourceDTO::loadFromXML($xmlDTOs);
					$css = CommunicationSetting::loadFromXML($xmlDTOs);
					$categories = CommunicationSetting::findValueByKey($css, "categories");
					$platforms = CommunicationSetting::findValueByKey($css, "platforms");
					$categories = explode(",", $categories);
					$platforms = explode(",", $platforms);

					if(count($ris)!=1 || count($frs)!=1 || !is_array($categories) || count($categories) == 0 || !is_array($platforms) || count($platforms) == 0){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 25);
					}else{
						$ri = $ris[0];
						$fr = $frs[0];

						$ctrlRI = new ResourceIndexController($this->persistenceManager);
						$ri2 = new ResourceIndexDTO($ri->getId());
						$ctrlRI->getResourceIndex($ri2);


						# Verificar las relaciones que tiene (plataformas y categorías)

						$ctrlP = new ResourcePlatformController($this->persistenceManager);

						if(!empty($platforms)){

							#Eliminamos las relaciones anteriores

							$ps = $ctrlP->listResourcePlatformsByResourceIndexId($ri2->getId());
							foreach ($ps as $p) {
								$ctrlRI->dropResourceIndexFromResourcePlatform($ri2->getId(), $p->getId());
							}

							#Adicionamos las nuevas
							foreach ($platforms as $pid) {
								$p = new ResourcePlatformDTO($pid);
								$ctrlP->getResourcePlatform($p);
								$ctrlRI->addResourceIndexToResourcePlatform($ri->getId(), $pid);
							}
						}

						$ctrlC = new ResourceCategoryController($this->persistenceManager);

						if(!empty($categories)){

							#Eliminamos las relaciones anteriores

							$cs = $ctrlC->listResourceCategoriesByResourceIndexId($ri2->getId());
							foreach ($cs as $c) {
								$ctrlRI->dropResourceIndexFromResourceCategory($ri2->getId(), $c->getId());
							}

							foreach ($categories as $cid) {
								$c = new ResourceCategoryDTO($cid);
								$ctrlC->getResourceCategory($c);
								$ctrlRI->addResourceIndexToResourceCategory($ri->getId(), $cid);
							}
						}

						$app = $this->securityCtrl->getNavigationMainAppDTO();
	                    $cm = $this->hcMainCtrl->updateFileResource($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $fr->toXML());

	                    if($cm->getStatus()){
	                    	$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 26);

	                    	if($cm->getStatus()){
	                        	# Ubicamos el tipo de acción para el log
								$this->setActionLog(NAV_CMS_ACTION_UPDATE_RESOURCE, $fr->getHevotCoreFileResourceID()." - ".$fr->getOriginalName());
	                        }
	                    }

					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 27) ."->".$e->getCode()));
			}
		}


		/**
		 *
		 * Lista todos los índices de recursos de la aplicación de una marca terrestre.
		 * @param $landmarkId
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourceIndexDTO con los campos mínimos necesarios.
		 */
		public function listResourceIndexByLandmarkId($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_RESOURCE_INDEX_BY_LANDMARK_ID);

				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");
					$landmarkId = CommunicationSetting::findValueByKey($css, "landmarkId");

					$ctrl = new ResourceIndexController($this->persistenceManager);
					$ris = $ctrl->listResourceIndexesByLandmarkId($landmarkId, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(ResourceIndexDTO::$ORDER_BY_RESOURCE_ORDER),$orderPriority);

					$frs = array();
					$css = array();
                    $app =  $this->securityCtrl->getNavigationMainAppDTO();
                    foreach ($ris as $ri) {
                        $rCtrl = new ResourceController($this->persistenceManager);
                    	$r = new ResourceDTO($ri->getResource());
                    	$rCtrl->getResource($r);
                        $cm = $this->hcMainCtrl->getFileResourceByHevoTCoreFileResourceID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());

                        if($cm->getStatus()){
                            $frs2 = FileResourceDTO::loadFromXML($cm->getData());
                            if(count($frs2)==1){
                                $frs2[0]->setDescription(null);
                                $frs[] = $frs2[0];
                                $css[] = new CommunicationSetting(null,$ri->getId(),$frs2[0]->getId());
                            }
                        }else{
                        	break;
                        }
                    }
                    if($cm->getStatus()){
                    	$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 28,"<".GENERIC_OBJECTS_TAG.">".ResourceIndexDTO::DTOsToXML($ris).CommunicationSetting::DTOsToXML($css).FileResourceDTO::DTOsToXML($frs)."</".GENERIC_OBJECTS_TAG.">",CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
                    }
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 29) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todos los  índices de recursos de la aplicación.
		 * @param $appInstanceId
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourceIndexDTO con los campos mínimos necesarios.
		 */
		public function listResourceIndexByAppInstanceId($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_RESOURCE_INDEX_BY_APP_INSTANCE_ID);

				if($cm->getStatus()){

					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");
					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");

					$ctrl = new ResourceIndexController($this->persistenceManager);
					$ris = $ctrl->listResourceIndexesByAppInstanceId($appInstanceId, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(ResourceIndexDTO::$ORDER_BY_RESOURCE_ORDER),$orderPriority);

					$frs = array();
					$css = array();
                    $app =  $this->securityCtrl->getNavigationMainAppDTO();
                    foreach ($ris as $ri) {
                    	$rCtrl = new ResourceController($this->persistenceManager);
                    	$r = new ResourceDTO($ri->getResource());
                    	$rCtrl->getResource($r);
                        $cm = $this->hcMainCtrl->getFileResourceByHevoTCoreFileResourceID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());

                        if($cm->getStatus()){
                            $frs2 = FileResourceDTO::loadFromXML($cm->getData());
                            if(count($frs2)==1){
                                $frs2[0]->setDescription(null);
                                $frs[] = $frs2[0];
                                $css[] = new CommunicationSetting(null,$ri->getId(),$frs2[0]->getId());
                            }
                        }else{
                        	break;
                        }
                    }
                    if($cm->getStatus()){
                    	$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 30,"<".GENERIC_OBJECTS_TAG.">".ResourceIndexDTO::DTOsToXML($ris).CommunicationSetting::DTOsToXML($css).FileResourceDTO::DTOsToXML($frs)."</".GENERIC_OBJECTS_TAG.">",CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
                    }

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 31) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todos los índices de recursos de la aplicación que pertenecen a una categoría y sus respectivos recursos.
		 * @param $xmlDTOs
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourceIndexDTO, FileResourceDTO con los campos mínimos necesarios. También devuelve una colección de CommunicationSettings en donde se relaciona el id del FileResourceDTO con el id del ResourceIndex.
		 */
		public function listResourceIndexByAppInstanceIdAndResourcePlatformIdAndResourceCategoryId($xmlDTOs) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_RESOURCE_INDEX_BY_APP_INSTANCE_ID_AND_RESOURCE_PLATFORM_ID_AND_RESOURCE_CATEGORY_ID);

				if($cm->getStatus()){

					$css = CommunicationSetting::loadFromXML($xmlDTOs);
					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");
					$resourcePlatformId = CommunicationSetting::findValueByKey($css, "resourcePlatformId");
					$resourceCategoryId = CommunicationSetting::findValueByKey($css, "resourceCategoryId");

					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new ResourceIndexController($this->persistenceManager);
					$ris = $ctrl->listResourceIndexByAppInstanceIdAndResourcePlatformIdAndResourceCategoryId($appInstanceId, $resourcePlatformId, $resourceCategoryId, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(ResourceIndexDTO::$ORDER_BY_RESOURCE_ORDER),$orderPriority);

					$frs = array();
					$css = array();
                    $app =  $this->securityCtrl->getNavigationMainAppDTO();
                    foreach ($ris as $ri) {
                    	$rCtrl = new ResourceController($this->persistenceManager);
                    	$r = new ResourceDTO($ri->getResource());
                    	$rCtrl->getResource($r);
                        $cm = $this->hcMainCtrl->getFileResourceByHevoTCoreFileResourceID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());

                        if($cm->getStatus()){
                            $frs2 = FileResourceDTO::loadFromXML($cm->getData());
                            if(count($frs2)==1){
                                //$frs2[0]->setDescription(null);
                                $frs[] = $frs2[0];
                                $css[] = new CommunicationSetting(null,$ri->getId(),$frs2[0]->getId());
                            }
                        }else{
                        	break;
                        }
                    }
                    if($cm->getStatus()){
                    	$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 130,"<".GENERIC_OBJECTS_TAG.">".ResourceIndexDTO::DTOsToXML($ris).CommunicationSetting::DTOsToXML($css).FileResourceDTO::DTOsToXML($frs)."</".GENERIC_OBJECTS_TAG.">",CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
                    }

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 131) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todos los índices de recursos de una marca terrestre que pertenecen a una categoría y sus respectivos recursos.
		 * @param $xmlDTOs
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourceIndexDTO, FileResourceDTO con los campos mínimos necesarios. También devuelve una colección de CommunicationSettings en donde se relaciona el id del FileResourceDTO con el id del ResourceIndex.
		 */
		public function listResourceIndexByLandmarkIdAndResourcePlatformIdAndResourceCategoryId($xmlDTOs) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_RESOURCE_INDEX_BY_LANDMARK_ID_AND_RESOURCE_PLATFORM_ID_AND_RESOURCE_CATEGORY_ID);

				if($cm->getStatus()){

					$css = CommunicationSetting::loadFromXML($xmlDTOs);
					$landmarkId = CommunicationSetting::findValueByKey($css, "landmarkId");
					$resourcePlatformId = CommunicationSetting::findValueByKey($css, "resourcePlatformId");
					$resourceCategoryId = CommunicationSetting::findValueByKey($css, "resourceCategoryId");

					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new ResourceIndexController($this->persistenceManager);
					$ris = $ctrl->listResourceIndexByLandmarkIdAndResourcePlatformIdAndResourceCategoryId($landmarkId, $resourcePlatformId, $resourceCategoryId, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(ResourceIndexDTO::$ORDER_BY_RESOURCE_ORDER), $orderPriority);

					$frs = array();
					$css = array();
                    $app =  $this->securityCtrl->getNavigationMainAppDTO();
                    foreach ($ris as $ri) {
                    	$rCtrl = new ResourceController($this->persistenceManager);
                    	$r = new ResourceDTO($ri->getResource());
                    	$rCtrl->getResource($r);
                        $cm = $this->hcMainCtrl->getFileResourceByHevoTCoreFileResourceID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());
                        if($cm->getStatus()){
                            $frs2 = FileResourceDTO::loadFromXML($cm->getData());
                            if(count($frs2)==1){
                                //$frs2[0]->setDescription(null);
                                $frs[] = $frs2[0];
                                $css[] = new CommunicationSetting(null,$ri->getId(),$frs2[0]->getId());
                            }
                        }else{
                        	break;
                        }
                    }
                    if($cm->getStatus()){
                    	$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 132,"<".GENERIC_OBJECTS_TAG.">".ResourceIndexDTO::DTOsToXML($ris).CommunicationSetting::DTOsToXML($css).FileResourceDTO::DTOsToXML($frs)."</".GENERIC_OBJECTS_TAG.">",CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
                    }

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 133) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Consulta un índice de recurso de la aplicación.
		 * @param $resourceIndexId
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un ResourceIndexDTO, un FileResourceDTO y dos CommunicationMessage con la lista de plataformas (atributo platform) y categorías (atributo categories) a las que pertenece el recurso.
		 */
		public function getResourceIndex($resourceIndexId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_RESOURCE_INDEX);
				if($cm->getStatus()){
					$riCtrl = new ResourceIndexController($this->persistenceManager);
					$ri = new ResourceIndexDTO($resourceIndexId);
					$riCtrl->getResourceIndex($ri);

					$rCtrl = new ResourceController($this->persistenceManager);
					$r = new ResourceDTO($ri->getResource());
					$rCtrl->getResource($r);

					$fr = null;
					$app =  $this->securityCtrl->getNavigationMainAppDTO();
					$cm = $this->hcMainCtrl->getFileResourceByHevoTCoreFileResourceID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());
                    if($cm->getStatus()){
                        $frs = FileResourceDTO::loadFromXML($cm->getData());
                        if(count($frs) == 1){
                            $fr = $frs[0];
                        }
                    }

                    $cCtrl = new ResourceCategoryController($this->persistenceManager);
                    $rcs = $cCtrl->getResourceCategoriesByResourceIndexId($ri->getId());

                    $pCtrl = new ResourcePlatformController($this->persistenceManager);
                    $rps = $pCtrl->getResourcePlatformsByResourceIndexId($ri->getId());

                    $categories = array();
                    $platforms = array();

                    foreach ($rcs as $rc) {
                    	$categories[] = $rc->getId();
                    }

                    foreach ($rps as $rp) {
                    	$platforms[] = $rp->getId();
                    }

                    $ri->setCategories($categories);
                    $ri->setPlatforms($platforms);

					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 32,"<".GENERIC_OBJECTS_TAG.">".$ri->toXML2().$fr->toXML2()."</".GENERIC_OBJECTS_TAG.">");
				}

				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 33) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Elimina un un índice de recurso de la aplicación existente. Esta acción elimina el recurso asociado.
		 * @param $resourceIndexId
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function removeResourceIndex($resourceIndexId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_REMOVE_RESOURCE_INDEX);
				if($cm->getStatus()){
					$ctrl = new ResourceIndexController($this->persistenceManager);
					$ri = new ResourceIndexDTO($resourceIndexId);
					$ctrl->getResourceIndex($ri);

					$this->persistenceManager->beginTransaction();

					#    Eliminamos las referencias con las plataformas y categorías.

					$tmpCtrl = new ResourcePlatformController($this->persistenceManager);
					$rps = $tmpCtrl->listResourcePlatformsByResourceIndexId($ri->getId());
					foreach ($rps as $rp) {
						$tmpCtrl->dropResourcePlatformFromResourceIndex($rp->getId(), $ri->getId());
					}

					$tmpCtrl = new ResourceCategoryController($this->persistenceManager);
					$rps = $tmpCtrl->listResourceCategoriesByResourceIndexId($ri->getId());
					foreach ($rps as $rc) {
						$tmpCtrl->dropResourceCategoryFromResourceIndex($rc->getId(), $ri->getId());
					}

					# Obtenemos y eliminamos el recurso

					$ctrl->removeResourceIndex($ri->getId());

					$rCtrl = new ResourceController($this->persistenceManager);
					$r = new ResourceDTO($ri->getResource());

					$rCtrl->getResource($r);

					$app = $this->securityCtrl->getNavigationMainAppDTO();
					$cm = $this->hcMainCtrl->removeFileResourceByHevoTcoreID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());
                    if($cm->getStatus()){
                    	$rCtrl->removeResource($ri->getResource());
						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 34);

						if($cm->getStatus()){
                        	# Ubicamos el tipo de acción para el log
							$this->setActionLog(NAV_CMS_ACTION_REMOVE_RESOURCE, $r->getHevoTCoreID());
                        }
                    }
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 35) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Obtiene todas las plataformas soportadas por el sistema.
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourcePlatformDTO con los campos mínimos necesarios.
		 */
		public function getResourcePlatforms($firstResultNumber = 0) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_RESOURCE_PLATFORMS);

				if($cm->getStatus()){

					$ctrl = new ResourcePlatformController($this->persistenceManager);
					$rps = $ctrl->getResourcePlatforms(false);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 36,ResourcePlatformDTO::DTOsToXML($rps),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 37) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Obtiene todas las plataformas de un índice de recurso.
		 * @param $resourceIndexId
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourcePlatformDTO con los campos mínimos necesarios.
		 */
		public function getResourcePlatformsByResourceIndexId($resourceIndexId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_RESOURCE_PLATFORMS_BY_RESOURCE_INDEX_ID);

				if($cm->getStatus()){

					$ctrl = new ResourcePlatformController($this->persistenceManager);
					$rps = $ctrl->getResourcePlatformsByResourceIndexId($resourceIndexId, false, null, null, array(ResourcePlatformDTO::$ORDER_BY_NAME));
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 38,ResourcePlatformDTO::DTOsToXML($rps),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 39) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 *  Obtiene todas las categorías de recursos soportadas por el sistema.
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourceCategoryDTO con los campos mínimos necesarios.
		 */
		public function getResourceCategories() {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_RESOURCE_CATEGORIES);

				if($cm->getStatus()){

					$ctrl = new ResourceCategoryController($this->persistenceManager);
					$rcs = $ctrl->getResourceCategories(true, null, null, array(ResourceCategoryDTO::$ORDER_BY_NAME));
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 40,ResourceCategoryDTO::DTOsToXML($rcs),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 41) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Obtiene todas las categorías de recursos asociadas a un índice de recurso.
		 * @param $resourceIndexId
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de ResourcePlatformDTO con los campos mínimos necesarios.
		 */
		public function getResourceCategoriesByResourceIndexId($resourceIndexId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_RESOURCE_CATEGORIES_BY_RESOURCE_INDEX_ID);

				if($cm->getStatus()){

					$ctrl = new ResourceCategoryController($this->persistenceManager);
					$rcs = $ctrl->getResourceCategoriesByResourceIndexId($resourceIndexId, false, null, null, array(ResourceCategoryDTO::$ORDER_BY_NAME));
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 42,ResourceCategoryDTO::DTOsToXML($rcs),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 43) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las categorías de marcas terrestres soportadas por el sistema.
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de LandmarkCategoryDTO con los campos mínimos necesarios.
		 */
		public function getLandmarkCategories() {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_LAND_MARK_CATEGORIES);

				if($cm->getStatus()){

					$ctrl = new LandmarkCategoryController($this->persistenceManager);
					$lms = $ctrl->getLandmarkCategories(false, null, null, array(LandmarkDTO::$ORDER_BY_NAME));
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 44,LandmarkCategoryDTO::DTOsToXML($lms),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 45) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Adiciona una nueva marca terrestre a la aplicación.
		 * @param $dtosXML
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad.
		 */
		public function setLandmark($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_LANDMARK);
				if($cm->getStatus()){
					$lms = LandmarkDTO::loadFromXML($dtosXML);
					$gps = GPSPointDTO::loadFromXML($dtosXML);
					$css = CommunicationSetting::loadFromXML($dtosXML);

					$categories = CommunicationSetting::findValueByKey($css, "categories");
					$categories = explode(",", $categories);

					if(count($lms)!=1){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 46);
					}else if(count($gps)==0 || !is_array($categories) || count($categories) == 0){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 47);
					}else if(!EntityValidator::validateGlobalYesNO($lms[0]->getVisibility())){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 144);
					}else{
						$lm = $lms[0];

						$this->persistenceManager->beginTransaction();

						$gpsCtrl = new GPSPointController($this->persistenceManager);

						$ctrl = new LandmarkController($this->persistenceManager);
						$ctrl->setLandmark($lm);

						foreach ($gps as $g) {
							$gpsCtrl->setGPSPoint($g);
							$ctrl->addLandmarkToGPSPoint($lm->getId(), $g->getId());
						}

						// Ahora relacionamos las categorías

						$lcCtrl = new LandmarkCategoryController($this->persistenceManager);

						foreach ($categories as $cid) {
							$c = new LandmarkCategoryDTO($cid);
							$lcCtrl->getLandmarkCategory($c);
							$lcCtrl->addLandmarkCategoryToLandmark($cid, $lm->getId());
						}

						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 48,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $lm->getId()))));

						if($cm->getStatus()){
                        	# Ubicamos el tipo de acción para el log
							$this->setActionLog(NAV_CMS_ACTION_ADD_LANDMARK, " id: ".$lm->getId() . " - " . $lm->getName());
                        }
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 49) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las  marcas terrestres de la aplicación.
		 * @param $dtosXML
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de LandmarkDTO con los campos mínimos necesarios.
		 */
		public function listLandmarks($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_LANDMARKS);
				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new LandmarkController($this->persistenceManager);
					$lms = $ctrl->listLandmarks(true,$firstItem,NAV_CMS_LIST_PAGE_SIZE,array(Landmark::$ORDER_BY_NAME), $orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 50,LandmarkDTO::DTOsToXML($lms),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 51) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las  marcas terrestres de una instancia de aplicación.
		 * @param $appInstanceId
		 * @param $firstItem
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de LandmarkDTO con los campos mínimos necesarios.
		 */
		public function listLandmarksByAppInstanceId($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_LANDMARKS_BY_APP_INSTANCE_ID);
				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");
					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");


					$ctrl = new LandmarkController($this->persistenceManager);
					$lms = $ctrl->listLandmarksByAppInstanceId($appInstanceId, true,$firstItem,NAV_CMS_LIST_PAGE_SIZE,array(Landmark::$ORDER_BY_NAME),$orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 52,LandmarkDTO::DTOsToXML($lms),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 53) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las  marcas terrestres de una instancia de aplicación y de una categoría específica.
		 * @param $csDTOs
		 * @param $firstItem
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de LandmarkDTO con los campos mínimos necesarios.
		 */
		public function listLandmarksByAppInstanceIdAndLandMarkCategoryId($csDTOs) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_LANDMARKS_BY_APP_INSTANCE_ID_AND_LANDMARK_CATEGORY_ID);

				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($csDTOs);

					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");
					$landmarkCategoryId = CommunicationSetting::findValueByKey($css, "landmarkCategoryId");

					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new LandmarkController($this->persistenceManager);
					$lms = $ctrl->listLandmarksByAppInstanceIdAndLandMarkCategoryId($appInstanceId, $landmarkCategoryId, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(Landmark::$ORDER_BY_NAME), $orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 128,LandmarkDTO::DTOsToXML($lms),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 129) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las marcas terrestres de la aplicación dada una visibilidad.
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de LandmarkDTO con los campos mínimos necesarios.
		 */
		public function listLandmarksByVisibility($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_LANDMARKS_BY_VISIBILITY);
				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");
					$visibility = CommunicationSetting::findValueByKey($css, "visibility");

					$ctrl = new LandmarkController($this->persistenceManager);
					$lms = $ctrl->listLandmarksByVisibility($visibility,true,$firstItem,NAV_CMS_LIST_PAGE_SIZE,array(Landmark::$ORDER_BY_NAME), $orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 146,LandmarkDTO::DTOsToXML($lms),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 147) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las  marcas terrestres de una instancia de aplicación y visibilidad.
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de LandmarkDTO con los campos mínimos necesarios.
		 */
		public function listLandmarksByAppInstanceIdAndVisibility($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_LANDMARKS_BY_APP_INSTANCE_ID_AND_VISIBILITY);
				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");
					$visibility = CommunicationSetting::findValueByKey($css, "visibility");
					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");

					$ctrl = new LandmarkController($this->persistenceManager);
					$lms = $ctrl->listLandmarksByAppInstanceIdAndVisibility($appInstanceId,$visibility, true,$firstItem,NAV_CMS_LIST_PAGE_SIZE,array(Landmark::$ORDER_BY_NAME),$orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 148,LandmarkDTO::DTOsToXML($lms),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 149) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las  marcas terrestres de una instancia de aplicación, de una categoría específica y con una visibilidad determinada.
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de LandmarkDTO con los campos mínimos necesarios.
		 */
		public function listLandmarksByAppInstanceIdAndLandMarkCategoryIdAndVisibility($csDTOs) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_LANDMARKS_BY_APP_INSTANCE_ID_AND_LANDMARK_CATEGORY_ID_AND_VISIBILITY);

				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($csDTOs);

					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");
					$landmarkCategoryId = CommunicationSetting::findValueByKey($css, "landmarkCategoryId");
					$visibility = CommunicationSetting::findValueByKey($css, "visibility");

					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new LandmarkController($this->persistenceManager);
					$lms = $ctrl->listLandmarksByAppInstanceIdAndLandMarkCategoryIdAndVisibility($appInstanceId, $landmarkCategoryId,$visibility, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(Landmark::$ORDER_BY_NAME), $orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 150,LandmarkDTO::DTOsToXML($lms),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 151) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Consulta una marca terrestre de la aplicación.
		 * @param $landmarkId
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un LandmarkDTO y una colección de GPSPointDTO.
		 */
		public function getLandmark($landmarkId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_LANDMARK);
				if($cm->getStatus()){
					$lmCtrl = new LandmarkController($this->persistenceManager);
					$lm = new LandmarkDTO($landmarkId);
					$lmCtrl->getLandmark($lm);

					$pCtrl = new GPSPointController($this->persistenceManager);
					$ps = $pCtrl->getGPSPointsByLandmarkId($landmarkId);

					$lcCtrl = new LandmarkCategoryController($this->persistenceManager);
					$lcs = $lcCtrl->getLandmarkCategoriesByLandmarkId($landmarkId);

					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 54,"<".GENERIC_OBJECTS_TAG.">".$lm->toXML2().GPSPointDTO::DTOsToXML($ps).LandmarkCategoryDTO::DTOsToXML($lcs)."</".GENERIC_OBJECTS_TAG.">");
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 55) ."->".$e->getCode()));
			}
		}


		/**
		 *
		 * Modifica una marca terrestre de la aplicación.
		 * @param $dtosXML
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function updateLandmark($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_UPDATE_LANDMARK);
				if($cm->getStatus()){

					$lms = LandmarkDTO::loadFromXML($dtosXML);
					$gps = GPSPointDTO::loadFromXML($dtosXML);

					$css = CommunicationSetting::loadFromXML($dtosXML);

					$categories = CommunicationSetting::findValueByKey($css, "categories");
					if($categories != null){
						$categories = explode(",", $categories);
					}

					if(count($lms)!=1){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 56);
					}else if(!EntityValidator::validateGlobalYesNO($lms[0]->getVisibility())){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 145);
					}else{

						$this->persistenceManager->beginTransaction();

						$lm = $lms[0];

						$lmCtrl = new LandmarkController($this->persistenceManager);
						$lmOrig = new LandmarkDTO($lm->getId());
						$lmCtrl->getLandmark($lmOrig);

						$gpsCtrl = new GPSPointController($this->persistenceManager);

						if(count($gps) > 0){
							$origGps = $gpsCtrl->getGPSPointsByLandmarkId($lmOrig->getId());
							foreach ($origGps as $og) {
								$lmCtrl->dropLandmarkFromGPSPoint($lm->getId(), $og->getId());
								$gpsCtrl->removeGPSPoint($og->getId());
							}

							foreach ($gps as $g) {
								#Adicionamos el punto
								$g->setId(null);

								$gpsCtrl->setGPSPoint($g);
								$lmCtrl->addLandmarkToGPSPoint($lmOrig->getId(), $g->getId());
							}
						}


						$lmOrig->setDescription($lm->getDescription());
						$lmOrig->setName($lm->getName());
						$lmOrig->setVisibility($lm->getVisibility());

						$lmCtrl->updateLandmark($lmOrig);

						// Ahora trabajamos conlas categorías



						//Desvinculamos las que ya no aplican

						if(count($categories) > 0){
							$lcCtrl = new LandmarkCategoryController($this->persistenceManager);

							$cs = $lcCtrl->listLandmarkCategoriesByLandmarkId($lmOrig->getId());
							foreach ($cs as $c) {
								$idx = array_search($c->getId(), $categories);
								if($idx === FALSE){
									$lcCtrl->dropLandmarkCategoryFromLandmark($c->getId(), $lmOrig->getId());
								}else{
									array_splice($categories, $idx, 1);
								}
							}

							foreach ($categories as $cid) {
								$lcCtrl->getLandmarkCategory(new LandmarkCategoryDTO($cid));
								$lcCtrl->addLandmarkCategoryToLandmark($cid, $lm->getId());
							}
						}
						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 57,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $lm->getId()))));

						if($cm->getStatus()){
                        	# Ubicamos el tipo de acción para el log
							$this->setActionLog(NAV_CMS_ACTION_UPDATE_LANDMARK, " id: " . $lm->getId() . " - " . $lm->getName());
                        }
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 58) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Elimina una marca terrestre de la aplicación existente siempre y cuando no tenga recursos asociados.
		 * @param $landmarkId
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function removeLandmark($landmarkId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_REMOVE_LANDMARK);
				if($cm->getStatus()){
					$ctrl = new LandmarkController($this->persistenceManager);
					$lm = new LandmarkDTO($landmarkId);
					$ctrl->getLandmark($lm);


					#    Verificamos que no esté siendo utilizado por recursos.
					$riCtrl = new ResourceIndexController($this->persistenceManager);
					$res = $riCtrl->listResourceIndexesByLandmarkId($lm->getId(),false,0,1);
					if(count($res)>0){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_PERSISTENCE_REMOVE_LINKED_FAIL,$this->ID + 59);
					}else{

						# Procedemos a eliminar la entidad:
						$this->persistenceManager->beginTransaction();

						#Eliminamos los puntos gps
						$gpCtrl = new GPSPointController($this->persistenceManager);
						$gps  = $gpCtrl->listGPSPointsByLandmarkId($lm->getId());

						foreach ($gps as $g) {
							$gpCtrl->dropGPSPointFromLandmark($g->getId(), $lm->getId());
							$gpCtrl->removeGPSPoint($g->getId());
						}

						#Desasociamos las categorías
						$lmcCtrl = new LandmarkCategoryController($this->persistenceManager);
						$lmcs = $lmcCtrl->listLandmarkCategoriesByLandmarkId($lm->getId());

						foreach ($lmcs as $l) {
							$lmcCtrl->dropLandmarkCategoryFromLandmark($l->getId(), $lm->getId());
						}

						$ctrl->removeLandmark($lm->getId());


						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 60);
						if($cm->getStatus()){
                        	# Ubicamos el tipo de acción para el log
							$this->setActionLog(NAV_CMS_ACTION_REMOVE_LANDMARK, " id: ".$lm->getId() . " - " . $lm->getName());
                        }
					}
				}
				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 61) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Adiciona un nuevo usuario administrador a la aplicación.
		 * @param $mapUserXML
		 * @param $password
		 * @param $passwordAgain
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad.
		 */
		public function setMapUser($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$userInSessionRole = $this->securityCtrl->getCurrentUserDTO()->getUserRole();

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_MAP_USER);
				if($cm->getStatus()){
					$mus = MapUserDTO::loadFromXML($dtosXML);
					$css = CommunicationSetting::loadFromXML($dtosXML);
					// Validamos integridad de información y que el tipo de usuario que se pretende guardar coincida con el rol del usuario en sesión.
					if(count($mus)!=1 || count($css)!=2 ||
						(($userInSessionRole == NAV_CMS_USER_ROLE_ADMIN && $mus[0]->getUserRole() != NAV_CMS_USER_ROLE_ADMIN && $mus[0]->getUserRole() != NAV_CMS_USER_ROLE_CONTENT_MANAGER))||
						($userInSessionRole == NAV_CMS_USER_ROLE_CONTENT_MANAGER && $mus[0]->getUserRole() != NAV_CMS_USER_ROLE_CONTENT_MANAGER)){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 62);
					}else{
						$password = CommunicationSetting::findValueByKey($css, "password");
						$passwordAgain = CommunicationSetting::findValueByKey($css, "passwordAgain");
						$mu = $mus[0];
						$mainApp = $this->securityCtrl->getNavigationMainAppDTO();

						#Verificamos que el usuario no exista
						$ctrl = new MapUserController($this->persistenceManager);
						$mus = $ctrl->getMapUsersByLogin($mu->getLogin());
						if(count($mus)>0){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_DUPLICATED_USER_FAIL,$this->ID + 63);
						}else{
							if($password != $passwordAgain){
								$cm = new CommunicationMensaje(false,HC_ALERT_PASSWORD_DONT_MACH,$this->ID + 64);
							}else if (!EntityValidator::validatePassword($password)){
								$cm = new CommunicationMensaje(false,HC_ALERT_INVALID_PASSWORD,$this->ID + 65);
							}else{
								# Buscamos el rol
								$cm = $this->hcMainCtrl->getUserRoleByRoleID($mainApp->getHevoTCoreEnterpriseDomainID(), $mainApp->getHevoTCorePass(), NAV_CMS_USER_ROLE_ADMIN);
								if($cm->getStatus()){
									$urXML = $cm->getData();
									$urs = UserRoleDTO::loadFromXML($urXML);
									$ur = $urs[0];

									$this->persistenceManager->beginTransaction();

									# Ahora creamos el usuario en HC
									$this->hcMainCtrl->activateSession();

									$eu = new EnterpriseUserDTO(null,NAV_CMS_PREFIX.$mu->getLogin(),md5($password),GLOBAL_USER_STATUS_OK,$this->securityCtrl->getUserLanguageInCurrentSession(),$ur->getId());
									$cm = $this->hcMainCtrl->setEnterpriseUser($mainApp->getHevoTCoreEnterpriseDomainID(), $mainApp->getHevoTCorePass(), $eu->toXML2());

									if($cm->getStatus()){
										# Significa que el usuario HC ya está creado. Ahora creamos el usuario Map
										$appI = $this->securityCtrl->getCurrentUserAppInstanceDTO();
										$mu->setHevoTCoreUserID($cm->getData());
										//$mu->setUserRole(NAV_CMS_USER_ROLE_ADMIN);
										$mu->setAppInstance($appI->getId());

										$ctrl->setMapUser($mu);
										$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 66,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $mu->getId()))));

										if($cm->getStatus()){
				                        	# Ubicamos el tipo de acción para el log
											$this->setActionLog(NAV_CMS_ACTION_ADD_MAP_USER, " id: ".$mu->getId() . " - " . $mu->getHevoTCoreUserID() . " - " .$mu->getLogin() . " - ".$mu->getUserRole());
				                        }
									}

								}
							}
						}
					}
				}

				if(!$cm->getStatus()){
					$this->hcMainCtrl->rollbackSession();
					$this->persistenceManager->rollbackTransaction();
				}else{
					$this->hcMainCtrl->commitSession();
					$this->persistenceManager->commitTransaction();
				}

				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				# hacemos rollback para descartar el usuario HC creado.
				$this->hcMainCtrl->rollbackSession();
				$this->persistenceManager->rollbackTransaction();

				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 67) ."->".$e->getCode()));
			}
		}



		/**
		 *
		 * Adiciona un nuevo usuario kiosko a la aplicación. Esta operación crea el kiosko.
		 * @param $dtosXML XML con las entidades necesarias (MapUserDTO, KioskoDTO y GPSPointDTO)
		 * @param $password
		 * @param $passwordAgain
		 */
		public function setKioskoMapUser($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_KIOSKO_MAP_USER);
				if($cm->getStatus()){
					$mus = MapUserDTO::loadFromXML($dtosXML);
					$ks = KioskoDTO::loadFromXML($dtosXML);
					$gps = GPSPointDTO::loadFromXML($dtosXML);
					$css = CommunicationSetting::loadFromXML($dtosXML);
					if(count($mus)!=1 || count($ks)!=1 || count($gps)!=1 || count($css)!=2){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 68);
					}else{
						$password = CommunicationSetting::findValueByKey($css, "password");
						$passwordAgain = CommunicationSetting::findValueByKey($css, "passwordAgain");
						$mu = $mus[0];
						$gp = $gps[0];
						$k = $ks[0];
						$mainApp = $this->securityCtrl->getNavigationMainAppDTO();

						#Verificamos que el usuario no exista
						$muCtrl = new MapUserController($this->persistenceManager);
						$mus = $muCtrl->getMapUsersByLogin($mu->getLogin());

						if(count($mus)>0){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_DUPLICATED_USER_FAIL,$this->ID + 69);
						}else{
							if($password != $passwordAgain){
								$cm = new CommunicationMensaje(false,HC_ALERT_PASSWORD_DONT_MACH,$this->ID + 70);
							}else if (!EntityValidator::validatePassword($password)){
								$cm = new CommunicationMensaje(false,HC_ALERT_INVALID_PASSWORD,$this->ID + 71);
							}else{
								$this->persistenceManager->beginTransaction();

								# Primero creamos el punto GPS
								$gpCtrl = new GPSPointController($this->persistenceManager);
								$gpCtrl->setGPSPoint($gp);

								$k->setGpsPoint($gp->getId());

								#Creamos el kiosko
								$kCtrl = new KioskoController($this->persistenceManager);
								$ks = $kCtrl->getKioskosByKioskoLocationID($k->getKioskoLocationID());
								if(count($ks)>0){
									$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_DUPLICATED_KIOSKO_LOCATION_ID_FAIL,$this->ID + 72);
								}else{
									$kCtrl->setKiosko($k);

									# Buscamos la plataforma
									$rpCtrl = new ResourcePlatformController($this->persistenceManager);
									$rp = new ResourcePlatformDTO($mu->getPlatform());
									$rpCtrl->getResourcePlatform($rp);

									# Buscamos el rol
									$cm = $this->hcMainCtrl->getUserRoleByRoleID($mainApp->getHevoTCoreEnterpriseDomainID(), $mainApp->getHevoTCorePass(), NAV_CMS_USER_ROLE_KIOSKO);
									if($cm->getStatus()){
										$urXML = $cm->getData();
										$urs = UserRoleDTO::loadFromXML($urXML);
										$ur = $urs[0];

										# Ahora creamos el usuario en HC
										$this->hcMainCtrl->activateSession();

										$eu = new EnterpriseUserDTO(null,NAV_CMS_PREFIX.$mu->getLogin(),md5($password),GLOBAL_USER_STATUS_OK,$this->securityCtrl->getUserLanguageInCurrentSession(),$ur->getId());
										$cm = $this->hcMainCtrl->setEnterpriseUser($mainApp->getHevoTCoreEnterpriseDomainID(), $mainApp->getHevoTCorePass(), $eu->toXML2());

										if($cm->getStatus()){

											# Significa que el usuario HC ya está creado. Ahora creamos el usuario Map
											$aiCtrl = new AppInstanceController($this->persistenceManager);
											$ai = new AppInstanceDTO($mu->getAppInstance());
											$aiCtrl->getAppInstance($ai);

											$mu->setKiosko($k->getId());

											$mu->setHevoTCoreUserID($cm->getData());
											$mu->setUserRole(NAV_CMS_USER_ROLE_KIOSKO);
											$mu->setAppInstance($ai->getId());

											$muCtrl->setMapUser($mu);
											$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 73,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $mu->getId()))));

											if($cm->getStatus()){
					                        	# Ubicamos el tipo de acción para el log
												$this->setActionLog(NAV_CMS_ACTION_ADD_KIOSK, " id: ".$k->getId() . " - " . $mu->getHevoTCoreUserID() . " - " .$mu->getLogin() . " - ".$k->getName()." - ".$k->getDescription());
					                        }
										}
									}
								}
							}
						}
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
					$this->hcMainCtrl->commitSession();
				}else{
					$this->persistenceManager->rollbackTransaction();
					$this->hcMainCtrl->rollbackSession();
				}

				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				# hacemos rollback para descartar el usuario HC creado.
				$this->hcMainCtrl->rollbackSession();

				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 74) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todos los usuarios administradores o kioskos de la aplicación.
		 * @param $userRole
		 * @param $firstItem
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de MapUserDTO con los campos mínimos necesarios.
		 */
		public function listMapUsersByUserRole($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_MAP_USERS_BY_USER_ROLE);
				if($cm->getStatus()){

					$css = CommunicationSetting::loadFromXML($xmlParams);
					$userRole = CommunicationSetting::findValueByKey($css, "userRole");
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$userInSessionRole = $this->securityCtrl->getCurrentUserDTO()->getUserRole();

					# Verificamos que el rol sea válido
					if(($userInSessionRole == NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_KIOSKO && $userRole != NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER ) ||
						($userInSessionRole == NAV_CMS_USER_ROLE_CONTENT_MANAGER && $userRole != NAV_CMS_USER_ROLE_KIOSKO && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER)){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 75);
					}else{
						$ctrl = new MapUserController($this->persistenceManager);
						$mus = $ctrl->listMapUsersByUserRole($userRole,true,$firstItem,NAV_CMS_LIST_PAGE_SIZE,array(MapUser::$ORDER_BY_USER_ROLE,MapUser::$ORDER_BY_LOGIN), $orderPriority);
						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 76,MapUserDTO::DTOsToXML($mus),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
					}
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 77) ."->".$e->getCode()));
			}
		}


		/**
		 *
		 * Modifica un usuario kiosko de la aplicación. Si el password es vacío no lo cambia. De lo contrario lo cambia. Si no se tiene el password anterior, la única opción es eliminar el usuario y volverlo a crear.
		 * @param $dtosXML XML con las entidades necesarias (MapUserDTO, KioskoDTO y GPSPointDTO)
		 * @param $prevPassword
		 * @param $password
		 * @param $passwordAgain
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad. CommunicationMessage con el mensaje de confirmación.
		 */
		public function updateKioskoMapUser($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_UPDATE_KIOSKO_MAP_USER);
				if($cm->getStatus()){
					$mus = MapUserDTO::loadFromXML($dtosXML);
					$ks = KioskoDTO::loadFromXML($dtosXML);
					$gps = GPSPointDTO::loadFromXML($dtosXML);
					$css = CommunicationSetting::loadFromXML($dtosXML);
					if(count($mus)!=1 || count($ks)!=1 || count($gps)!=1 || count($css)!=3){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 78);
					}else{
						$oldPassword = CommunicationSetting::findValueByKey($css, "oldPassword");
						$password = CommunicationSetting::findValueByKey($css, "password");
						$passwordAgain = CommunicationSetting::findValueByKey($css, "passwordAgain");

						$mu = $mus[0];
						$gp = $gps[0];
						$k = $ks[0];
						$mainApp = $this->securityCtrl->getNavigationMainAppDTO();

						#Verificamos que el usuario exista
						$muCtrl = new MapUserController($this->persistenceManager);
						$muOrig = new MapUserDTO($mu->getId());
						$muCtrl->getMapUser($muOrig);
						$userRole = $muOrig->getUserRole();

						if($userRole != NAV_CMS_USER_ROLE_KIOSKO ){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 79);
						}else{
							if($mu->getLogin() != $muOrig->getLogin()){
								$mus = $muCtrl->getMapUsersByLogin($mu->getLogin());

								if(count($mus)>0){
									$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 84);
								}
							}

							if($cm->getStatus()){
								if(!empty($password) && $password != $passwordAgain){
									$cm = new CommunicationMensaje(false,HC_ALERT_PASSWORD_DONT_MACH,$this->ID + 85);
								}else if(!empty($password) && !EntityValidator::validatePassword($password)){
									$cm = new CommunicationMensaje(false,HC_ALERT_INVALID_PASSWORD,$this->ID + 86);
								}else{
									$this->persistenceManager->beginTransaction();

									#Obtenemos el kiosko
									$kOrig = new KioskoDTO($muOrig->getKiosko());
									$kCtrl = new KioskoController($this->persistenceManager);
									$kCtrl->getKiosko($kOrig);

									# Actualizamos el punto GPS
									$gpCtrl = new GPSPointController($this->persistenceManager);

									$gp->setId($kOrig->getGpsPoint());

									$gpCtrl->updateGPSPoint($gp);

									$k->setGpsPoint($kOrig->getGpsPoint());

									#Actualizamos el kiosko
									$k->setId($kOrig->getId());


									$ks = array();

									if($k->getKioskoLocationID() != $kOrig->getKioskoLocationID()){
										$ks = $kCtrl->getKioskosByKioskoLocationID($k->getKioskoLocationID());
									}

									if(count($ks)>0){
										$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_DUPLICATED_KIOSKO_LOCATION_ID_FAIL,$this->ID + 87);
									}else{

										$kCtrl->updateKiosko($k);

										# Buscamos la plataforma
										$rpCtrl = new ResourcePlatformController($this->persistenceManager);
										$rp = new ResourcePlatformDTO($mu->getPlatform());
										$rpCtrl->getResourcePlatform($rp);

										# Si la contraseña cambia, entonces se actualiza en HC
										$this->hcMainCtrl->activateSession();

										if(!empty($password)){
											$cm = $this->hcMainCtrl->changeAnotherPassword($mainApp->getHevoTCoreEnterpriseDomainID(), $mainApp->getHevoTCorePass(), $muOrig->getHevoTCoreUserID(), $oldPassword, $password, $passwordAgain);
										}

										if($cm->getStatus()){
											# Significa que el usuario HC ya está actualizado. Ahora actualizamos el usuario Map si tiene un login diferente
											if($mu->getLogin() != $muOrig->getLogin() || $mu->getPlatform() != $muOrig->getPlatform()){
												$muOrig->setLogin($mu->getLogin());
												$muOrig->setPlatform($mu->getPlatform());
												$muCtrl->updateMapUser($muOrig);
											}

											$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 88,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID))));

											if($cm->getStatus()){
					                        	# Ubicamos el tipo de acción para el log
												$this->setActionLog(NAV_CMS_ACTION_UPDATE_KIOSK, " id: ".$k->getId() . " - " . $mu->getHevoTCoreUserID() . " - " .$mu->getLogin() . " - ".$k->getName()." - ".$k->getDescription());
					                        }
										}

									}
								}
							}
						}
					}
				}
				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
					$this->hcMainCtrl->commitSession();
				}else{
					$this->persistenceManager->rollbackTransaction();
					$this->hcMainCtrl->rollbackSession();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				# hacemos rollback para descartar el usuario HC creado.
				$this->hcMainCtrl->rollbackSession();

				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 89) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Actualiza un usuario administrador a la aplicación.
		 * @param  $dtosXML
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function updateMapUser($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_UPDATE_MAP_USER);
				if($cm->getStatus()){
					$mus = MapUserDTO::loadFromXML($dtosXML);
					$css = CommunicationSetting::loadFromXML($dtosXML);
					if(count($mus)!=1 || count($css)!=3){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 121);
					}else{
						$oldPassword = CommunicationSetting::findValueByKey($css, "oldPassword");
						$password = CommunicationSetting::findValueByKey($css, "password");
						$passwordAgain = CommunicationSetting::findValueByKey($css, "passwordAgain");

						$mu = $mus[0];
						$mainApp = $this->securityCtrl->getNavigationMainAppDTO();

						#Verificamos que el usuario exista
						$muCtrl = new MapUserController($this->persistenceManager);
						$muOrig = new MapUserDTO($mu->getId());
						$muCtrl->getMapUser($muOrig);
						$userRole = $muOrig->getUserRole();

						$userInSessionRole = $this->securityCtrl->getCurrentUserDTO()->getUserRole();

						if(($userInSessionRole == NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER)||
							($userInSessionRole == NAV_CMS_USER_ROLE_CONTENT_MANAGER && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER)){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 122);
						}else{
							if($mu->getLogin() != $muOrig->getLogin()){
								$mus = $muCtrl->getMapUsersByLogin($mu->getLogin());

								if(count($mus)>0){
									$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 123);
								}
							}

							if($cm->getStatus()){
								if(!empty($password) && $password != $passwordAgain){
									$cm = new CommunicationMensaje(false,HC_ALERT_PASSWORD_DONT_MACH,$this->ID + 124);
								}else if(!empty($password) && !EntityValidator::validatePassword($password)){
									$cm = new CommunicationMensaje(false,HC_ALERT_INVALID_PASSWORD,$this->ID + 125);
								}else{
									$this->persistenceManager->beginTransaction();

									# Si la contraseña cambia, entonces se actualiza en HC
									$this->hcMainCtrl->activateSession();

									if(!empty($password)){
										$cm = $this->hcMainCtrl->changeAnotherPassword($mainApp->getHevoTCoreEnterpriseDomainID(), $mainApp->getHevoTCorePass(), $muOrig->getHevoTCoreUserID(), $oldPassword, $password, $passwordAgain);
									}

									if($cm->getStatus()){
										# Significa que el usuario HC ya está al día. Ahora actualizamos el usuario Map si tiene un login diferente
										if($mu->getLogin() != $muOrig->getLogin()){
											$muOrig->setLogin($mu->getLogin());
											$muCtrl->updateMapUser($muOrig);
										}

										$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 126);

										if($cm->getStatus()){
				                        	# Ubicamos el tipo de acción para el log
											$this->setActionLog(NAV_CMS_ACTION_UPDATE_MAP_USER, " id: ".$muOrig->getId() . " - " . $muOrig->getHevoTCoreUserID() . " - " .$muOrig->getLogin() . " - ".$muOrig->getUserRole());
				                        }
									}
								}
							}
						}
					}
				}
				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
					$this->hcMainCtrl->commitSession();
				}else{
					$this->persistenceManager->rollbackTransaction();
					$this->hcMainCtrl->rollbackSession();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				# hacemos rollback para descartar el usuario HC creado.
				$this->hcMainCtrl->rollbackSession();

				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 127) ."->".$e->getCode()));
			}
		}



		/**
		 *
		 * Consulta un usuario kiosko de la aplicación.
		 * @param $mapUserId
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un MapUserDTO y un KioskoDTO.
		 */
		public function getKioskoMapUser($mapUserId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_KIOSKO_MAP_USER);
				if($cm->getStatus()){

					#	Consultamos el usuario

					$muCtrl = new MapUserController($this->persistenceManager);
					$mu = new MapUserDTO($mapUserId);
					$muCtrl->getMapUser($mu);

					#	Verificamos que el usuario sea de tipo kiosko
					$userRole = $mu->getUserRole();
					if($userRole != NAV_CMS_USER_ROLE_KIOSKO){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 90);
					}else{

						#	Consultamos el Kiosko

						$kCtrl = new KioskoController($this->persistenceManager);
						$k = new KioskoDTO($mu->getKiosko());
						$kCtrl->getKiosko($k);

						# 	Consultamos el punto GPS
						$gpCtrl = new GPSPointController($this->persistenceManager);
						$gp = new GPSPointDTO($k->getGpsPoint());
						$gpCtrl->getGPSPoint($gp);

						# 	Consultamos la lista de plataformas
						$pCtrl = new ResourcePlatformController($this->persistenceManager);
						$ps =  $pCtrl->getResourcePlatforms();

						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 91,"<".GENERIC_OBJECTS_TAG.">".$mu->toXML2().$k->toXML2().$gp->toXML2().ResourcePlatformDTO::DTOsToXML($ps)."</".GENERIC_OBJECTS_TAG.">");
					}
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 92) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Consulta un usuario administrador de la aplicación.
		 * @param $mapUserId
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un MapUserDTO.
		 */
		public function getMapUser($mapUserId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_MAP_USER);
				if($cm->getStatus()){

					#	Consultamos el usuario

					$muCtrl = new MapUserController($this->persistenceManager);
					$mu = new MapUserDTO($mapUserId);
					$muCtrl->getMapUser($mu);

					#	Verificamos que el usuario sea de tipo admin
					$userRole = $mu->getUserRole();

					$userInSessionRole = $this->securityCtrl->getCurrentUserDTO()->getUserRole();

					if(($userInSessionRole == NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER) ||
						($userInSessionRole == NAV_CMS_USER_ROLE_CONTENT_MANAGER && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER)){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 116);
					}else{
						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 117,$mu->toXML2());
					}
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 118) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Elimina un usuario de la aplicación existente. Si es de tipo kiosko, elimina el kiosko y su respectivo punto GPS.
		 * @param $mapUserId
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function removeMapUser($mapUserId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_REMOVE_MAP_USER);
				if($cm->getStatus()){
					$muCtrl = new MapUserController($this->persistenceManager);
					$mu = new MapUserDTO($mapUserId);
					$muCtrl->getMapUser($mu);

					$userRole = $mu->getUserRole();

					$userInSessionRole = $this->securityCtrl->getCurrentUserDTO()->getUserRole();

					if(	($userInSessionRole == NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_KIOSKO && $userRole != NAV_CMS_USER_ROLE_ADMIN && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER ) ||
						($userInSessionRole == NAV_CMS_USER_ROLE_CONTENT_MANAGER && $userRole != NAV_CMS_USER_ROLE_KIOSKO && $userRole != NAV_CMS_USER_ROLE_CONTENT_MANAGER )){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 93);
					}else{
						$this->persistenceManager->beginTransaction();

						$kid = $mu->getKiosko();

						$mainApp = $this->securityCtrl->getNavigationMainAppDTO();
						#Eliminamos el usuario de HC
						$cm = $this->hcMainCtrl->removeEnterpriseUserByOtherHevoTCoreEnterpriseUserID($mainApp->getHevoTCoreEnterpriseDomainID(), $mainApp->getHevoTCorePass(), $mu->getHevoTCoreUserID());
						if($cm->getStatus()){
							# Ahora eliminamos de NAV

							$muCtrl->removeMapUser($mapUserId);


							if($mu->getUserRole() == NAV_CMS_USER_ROLE_KIOSKO && EntityValidator::validateId($kid)){
								$kCtrl = new KioskoController($this->persistenceManager);
								$k = new KioskoDTO($kid);
								$kCtrl->getKiosko($k);

								$kCtrl->removeKiosko($kid);

								$gpCtrl = new GPSPointController($this->persistenceManager);
								$gpCtrl->removeGPSPoint($k->getGpsPoint());

								if($cm->getStatus()){
		                        	# Ubicamos el tipo de acción para el log - eliminar kiosko
									$this->setActionLog(NAV_CMS_ACTION_REMOVE_KIOSK, " id: ".$k->getId() . " - " . $mu->getHevoTCoreUserID() . " - " .$mu->getLogin() . " - ".$k->getName(). " - ".$k->getDescription());
		                        }
							}else if($cm->getStatus()){
	                        	# Ubicamos el tipo de acción para el log - eliminar usuario
								$this->setActionLog(NAV_CMS_ACTION_REMOVE_MAP_USER, " id: ".$mu->getId() . " - " . $mu->getHevoTCoreUserID() . " - " .$mu->getLogin() . " - ".$mu->getUserRole());
	                        }

						}
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
					$this->hcMainCtrl->commitSession();
				}else{
					$this->persistenceManager->rollbackTransaction();
					$this->hcMainCtrl->rollbackSession();
				}

				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				# hacemos rollback para descartar el usuario HC posiblemente eliminado.
				$this->hcMainCtrl->rollbackSession();

				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 94) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las categorías de la instancia de la aplicación de la aplicación.
		 * @param $firstItem
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de AppInstanceCategoryDTO con los campos mínimos necesarios.
		 */
		public function listAppInstanceCategories() {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}

				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_APP_INSTANCE_CATEGORIES);
				if($cm->getStatus()){

					$ctrl = new AppInstanceCategoryController($this->persistenceManager);
					$appIs = $ctrl->listAppInstanceCategories(false,null,null,array(AppInstanceCategory::$ORDER_BY_NAME));
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 95,AppInstanceCategoryDTO::DTOsToXML($appIs),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 96) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Adiciona una nueva alerta GPS a la aplicación.
		 * @param $dtosXML
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve un Long con el id de la entidad.
		 */
		public function setGPSAlert($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_GPS_ALERT);
				if($cm->getStatus()){
					$gpsAs = GPSAlertDTO::loadFromXML($dtosXML);
					$gps = GPSPointDTO::loadFromXML($dtosXML);
					if(count($gpsAs)!=1 || $gpsAs[0]->getType() == NAV_CMS_ALERT_TYPE_ADVERTISING){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 97);
					}else if(count($gps)==0 || count($gps)>2){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 98);
					}else{
						$gpsA = $gpsAs[0];
						#	Buscamos los puntos inicial y final
						$startPoint = null;
						$endPoint = null;
						foreach ($gps as $g) {
							$lat = $g->getGpsLatitude();
							$lon = $g->getGpsLongitude();
							$alt = $g->getGpsAltitude();
							if($g->getId() != 0 && !empty($lat) && !empty($lon)  && !empty($alt)){
								if($g->getId() === $gpsA->getStartPoint()){
									$startPoint = $g;
								}else if($g->getId() === $gpsA->getEndPoint()){
									$endPoint = $g;
								}
							}
						}
						if(empty($startPoint)){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 99);
						}else{
							$this->persistenceManager->beginTransaction();

							$ctrl = new GPSPointController($this->persistenceManager);
							$ctrl->setGPSPoint($startPoint);
							$gpsA->setStartPoint($startPoint->getId());
							$gpsA->setEndPoint(null);

							if(!empty($endPoint)){
								$ctrl->setGPSPoint($endPoint);
								$gpsA->setEndPoint($endPoint->getId());
							}

							$ctrl = new GPSAlertController($this->persistenceManager);
							$ctrl->setGPSAlert($gpsA);

							$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 100,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $gpsA->getId()))));

							if($cm->getStatus()){
	                        	# Ubicamos el tipo de acción para el log
	                        	$action = "";
	                        	if($gpsA->getType() == NAV_CMS_ALERT_TYPE_INFO){
	                        		$action = NAV_CMS_ACTION_ADD_GPS_INFO_ALERT;
	                        	}else if($gpsA->getType() == NAV_CMS_ALERT_TYPE_ALERT){
	                        		$action = NAV_CMS_ACTION_ADD_GPS_ALERT;
	                        	}else if($gpsA->getType() == NAV_CMS_ALERT_TYPE_ADVERTISING){
	                        		$action = NAV_CMS_ACTION_ADD_GPS_AD_ALERT;
	                        	}

								$this->setActionLog($action, " id: ".$gpsA->getId() . " - " . $gpsA->getName() . " - " .$gpsA->getMsg());
	                        }
						}
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 101) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las alertas GPS de la aplicación de un tipo específico.
		 * @param  $dtosXML
		 * @param  $tmpUrl
		 * @param  $fileName
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve el id de la entidad.
		 */
		public function setAdvertisingGPSAlert($dtosXML, $tmpUrl, $fileName) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SET_ADVERTISING_GPS_ALERT);
				if($cm->getStatus()){
					$gpsAs = GPSAlertDTO::loadFromXML($dtosXML);
					$gps = GPSPointDTO::loadFromXML($dtosXML);
					if(count($gpsAs)!=1){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 134);
					}else if(count($gps)==0 || count($gps)>2){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 135);
					}else{
						$gpsA = $gpsAs[0];
						#	Buscamos los puntos inicial y final
						$startPoint = null;
						$endPoint = null;
						foreach ($gps as $g) {
							$lat = $g->getGpsLatitude();
							$lon = $g->getGpsLongitude();
							$alt = $g->getGpsAltitude();
							if($g->getId() != 0 && !empty($lat) && !empty($lon)  && !empty($alt)){
								if($g->getId() === $gpsA->getStartPoint()){
									$startPoint = $g;
								}else if($g->getId() === $gpsA->getEndPoint()){
									$endPoint = $g;
								}
							}
						}
						if(empty($startPoint)){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 136);
						}else{
							$this->persistenceManager->beginTransaction();

							#	Si es una alerta tipo publicidad adjuntamos el recurso
							if(!empty($tmpUrl)&& !empty($fileName)){
								$this->hcMainCtrl->activateSession();
								//Ubicamos la dirección actual del archivo
								$fr = new FileResourceDTO(null,"NAV_CMS_ALERT_FILE_RESOURCE",$tmpUrl,null,"Recurso de alerta",FileManager::getFileType($fileName),$fileName);

			                    $app = $this->securityCtrl->getNavigationMainAppDTO();
			                    $cm = $this->hcMainCtrl->setFileResource($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $fr->toXML());
							}

		                    if($cm->getStatus()){
		                    	if(!empty($tmpUrl) && !empty($fileName)){
			                    	$rCtrl = new ResourceController($this->persistenceManager);
			                    	$r = new ResourceDTO(null,$cm->getData());
			                    	$rCtrl->setResource($r);
									$gpsA->setResource($r->getId());
		                    	}

								$ctrl = new GPSPointController($this->persistenceManager);
								$ctrl->setGPSPoint($startPoint);
								$gpsA->setStartPoint($startPoint->getId());
								$gpsA->setEndPoint(null);
								$gpsA->setType(NAV_CMS_ALERT_TYPE_ADVERTISING);

								if(!empty($endPoint)){
									$ctrl->setGPSPoint($endPoint);
									$gpsA->setEndPoint($endPoint->getId());
								}

								$ctrl = new GPSAlertController($this->persistenceManager);
								$ctrl->setGPSAlert($gpsA);

								$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 137,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $gpsA->getId()))));

			                    if($cm->getStatus()){
		                        	# Ubicamos el tipo de acción para el log
		                        	$file = "No File";
			                    	if(!empty($tmpUrl) && !empty($fileName)){
		                        		$file = $fileName;
		                        	}
									$this->setActionLog(NAV_CMS_ACTION_ADD_GPS_AD_ALERT, " id: ".$gpsA->getId() . " - " . $gpsA->getName() . " - " .$gpsA->getMsg() . " - ". $fileName);
		                        }
		                    }
						}
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
					$this->hcMainCtrl->commitSession();
				}else{
					$this->persistenceManager->rollbackTransaction();
					$this->hcMainCtrl->rollbackSession();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				$this->hcMainCtrl->rollbackSession();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 138) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Modifica una alerta GPS de la aplicación, junto con sus puntos GPS.
		 * @param $dtosXML
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function updateGPSAlert($dtosXML) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_UPDATE_GPS_ALERT);
				if($cm->getStatus()){
					$gpsAs = GPSAlertDTO::loadFromXML($dtosXML);
					$gps = GPSPointDTO::loadFromXML($dtosXML);
					if(count($gpsAs)!=1){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 102);
					}else if(count($gps)==0 || count($gps)>2){
						$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 103);
					}else{
						$gpsA = $gpsAs[0];
						#	Obtenemos la alerta original
						$aCtrl = new GPSAlertController($this->persistenceManager);
						$gpsAOrig = new GPSAlertDTO($gpsA->getId());
						$aCtrl->getGPSAlert($gpsAOrig);

						#	Buscamos los puntos inicial y final
						$startPoint = null;
						$endPoint = null;
						foreach ($gps as $g) {
							$lat = $g->getGpsLatitude();
							$lon = $g->getGpsLongitude();
							$alt = $g->getGpsAltitude();
							if($g->getId() != 0 && !empty($lat) && !empty($lon)  && !empty($alt)){
								if($g->getId() === $gpsA->getStartPoint()){
									$startPoint = $g;
								}else if($g->getId() === $gpsA->getEndPoint()){
									$endPoint = $g;
								}
							}
						}
						if(empty($startPoint)){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_VALIDATION_FAIL,$this->ID + 104);
						}else{
							$this->persistenceManager->beginTransaction();

							$gpCtrl = new GPSPointController($this->persistenceManager);
							$startPoint->setId($gpsAOrig->getStartPoint());
							$gpCtrl->updateGPSPoint($startPoint);

							if(EntityValidator::validateId($gpsAOrig->getEndPoint()) && empty($endPoint)){
								#	Significa que eliminaron un punto
								$pId = $gpsAOrig->getEndPoint();
								$gpsAOrig->setEndPoint(null);
								$aCtrl->updateGPSAlert($gpsAOrig);

								$gpCtrl->removeGPSPoint($pId);
							}else if(EntityValidator::validateId($gpsAOrig->getEndPoint()) && !empty($endPoint)){
								# Significa que actualizaron el punto final
								$endPoint->setId($gpsAOrig->getEndPoint());
								$gpCtrl->updateGPSPoint($endPoint);
							}else if(!EntityValidator::validateId($gpsAOrig->getEndPoint()) && !empty($endPoint)){
								# Significa que adicionaron el punto final
								$endPoint->setId(null);
								$gpCtrl->setGPSPoint($endPoint);

								$gpsAOrig->setEndPoint($endPoint->getId());
								$aCtrl->updateGPSAlert($gpsAOrig);
							}

							$gpsAOrig->setMsg($gpsA->getMsg());
							$gpsAOrig->setName($gpsA->getName());
							$gpsAOrig->setConfigData($gpsA->getConfigData());
							//$gpsAOrig->setType($gpsA->getType());
							$aCtrl->updateGPSAlert($gpsAOrig);

							$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 105,CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID, $gpsA->getId()))));

							if($cm->getStatus()){
	                        	# Ubicamos el tipo de acción para el log
	                        	$action = "";
	                        	if($gpsA->getType() == NAV_CMS_ALERT_TYPE_INFO){
	                        		$action = NAV_CMS_ACTION_UPDATE_GPS_INFO_ALERT;
	                        	}else if($gpsA->getType() == NAV_CMS_ALERT_TYPE_ALERT){
	                        		$action = NAV_CMS_ACTION_UPDATE_GPS_ALERT;
	                        	}else if($gpsA->getType() == NAV_CMS_ALERT_TYPE_ADVERTISING){
	                        		$action = NAV_CMS_ACTION_UPDATE_GPS_AD_ALERT;
	                        	}

								$this->setActionLog($action, " id: ".$gpsA->getId() . " - " . $gpsA->getName() . " - " .$gpsA->getMsg());
	                        }
						}
					}
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 106) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las alertas GPS de la aplicación de un tipo específico.
		 * @param $appInstanceId
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de GPSAlertDTO con los campos mínimos necesarios.
		 */
		public function listGPSAlertsByAppInstanceId($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_GPS_ALERTS_BY_APP_INSTANCE_ID);

				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");
					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");

					$ctrl = new GPSAlertController($this->persistenceManager);
					$gais = $ctrl->listGPSAlertsByAppInstanceId($appInstanceId, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(GPSAlertDTO::$ORDER_BY_NAME), $orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 107,GPSAlertDTO::DTOsToXML($gais),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 108) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todas las alertas GPS de la aplicación de un tipo específico.
		 * @param  $csDTOs
		 * @param  $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de GPSAlertDTO con los campos mínimos necesarios.
		 */
		public function listGPSAlertsByAppInstanceIdAndAlertType($csDTOs) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_GPS_ALERTS_BY_APP_INSTANCE_ID_AND_ALERT_TYPE);

				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($csDTOs);

					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");
					$alertType = CommunicationSetting::findValueByKey($css, "alertType");

					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new GPSAlertController($this->persistenceManager);
					$gais = $ctrl->listGPSAlertsByAppInstanceIdAndAlertType($appInstanceId, $alertType, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(GPSAlertDTO::$ORDER_BY_NAME), $orderPriority);
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 119,GPSAlertDTO::DTOsToXML($gais),CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize()))));
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 120) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Consulta una alerta GPS de la aplicación y la retorna junto con sus puntos GPS y el recurso FileResource asociado en caso de tenerlo (si es alerta de publicidad).
		 * @param  $gpsAlertId
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de GPSAlertDTO, uno o dos GPSPointDTO y un FileResourceDTO en caso de ser una alerta de publicidad.
		 */
		public function getGPSAlert($gpsAlertId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_GPS_ALERT);
				if($cm->getStatus()){

					#	Consultamosla alerta

					$gaCtrl = new GPSAlertController($this->persistenceManager);
					$ga = new GPSAlertDTO($gpsAlertId);
					$gaCtrl->getGPSAlert($ga);


					#	Consultamos los puntos GPS

					$gpCtrl = new GPSPointController($this->persistenceManager);

					$gpsPoints = array();
					$startPoint = new GPSPointDTO($ga->getStartPoint());
					$endPoint = null;
					$gpCtrl->getGPSPoint($startPoint);
					$gpsPoints[] = $startPoint;
					$fileResourceXML = "";

					if(EntityValidator::validateId($ga->getEndPoint())){
						$endPoint = new GPSPointDTO($ga->getEndPoint());
						$gpCtrl->getGPSPoint($endPoint);
						$gpsPoints[] = $endPoint;
					}
					#	Si es alerta de publicidad obtenemos el recurso
					if($ga->getType() == NAV_CMS_ALERT_TYPE_ADVERTISING && EntityValidator::validateId($ga->getResource())){
						$rCtrl = new ResourceController($this->persistenceManager);
						$r = new ResourceDTO($ga->getResource());
						$rCtrl->getResource($r);
						$app = $this->securityCtrl->getNavigationMainAppDTO();
						$cm = $this->hcMainCtrl->getFileResourceByHevoTCoreFileResourceID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());
						if($cm->getStatus()){
							$frs = FileResourceDTO::loadFromXML($cm->getData());
							if(count($frs) == 1){
								$fileResourceXML = $frs[0]->toXML();
							}
						}
					}

					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 109,"<".GENERIC_OBJECTS_TAG.">".$ga->toXML().GPSPointDTO::DTOsToXML($gpsPoints).$fileResourceXML."</".GENERIC_OBJECTS_TAG.">");

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 110) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Elimina una alerta GPS de la aplicación existente. Esta acción elimina el recurso asociado y los puntos GPS utilizados.
		 * @param  $gpsAlertId
		 * @return CommunicationMessage con el mensaje de confirmación.
		 */
		public function removeGPSAlert($gpsAlertId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_REMOVE_GPS_ALERT);
				if($cm->getStatus()){

					#	Consultamosla alerta

					$gaCtrl = new GPSAlertController($this->persistenceManager);
					$ga = new GPSAlertDTO($gpsAlertId);
					$gaCtrl->getGPSAlert($ga);


					#	Consultamos los puntos GPS

					$gpCtrl = new GPSPointController($this->persistenceManager);

					$gpsPoints = array();
					$startPoint = new GPSPointDTO($ga->getStartPoint());
					$endPoint = null;
					$gpCtrl->getGPSPoint($startPoint);

					if(EntityValidator::validateId($ga->getEndPoint())){
						$endPoint = new GPSPointDTO($ga->getEndPoint());
					}

					$this->persistenceManager->beginTransaction();

					#	Eliminamos la alerta
					$gaCtrl->removeGPSAlert($ga->getId());

					#	Eliminamos los puntos GPS
					$gpCtrl->removeGPSPoint($startPoint->getId());
					if(!empty($endPoint)){
						$gpCtrl->removeGPSPoint($endPoint->getId());
					}

					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 111);

					if($cm->getStatus()){
                     # Ubicamos el tipo de acción para el log
                    	$action = "";
                    	if($ga->getType() == NAV_CMS_ALERT_TYPE_INFO){
                    		$action = NAV_CMS_ACTION_REMOVE_GPS_INFO_ALERT;
                    	}else if($ga->getType() == NAV_CMS_ALERT_TYPE_ALERT){
                      		$action = NAV_CMS_ACTION_REMOVE_GPS_ALERT;
                       	}else if($ga->getType() == NAV_CMS_ALERT_TYPE_ADVERTISING){
                        	$action = NAV_CMS_ACTION_REMOVE_GPS_AD_ALERT;
                        }

						$this->setActionLog($action, " id: ".$ga->getId() . " - " . $ga->getName() . " - " .$ga->getMsg());
                    }
				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 112) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Lista todos los kioskos de una instancia de aplicación.
		 * @param $appInstanceId
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de KioskoDTO con los campos mínimos necesarios y en data2 una colección de CommunicationSetting con la relación entre id kiosko y id de MapUser.
		 */
		public function listKioskosByAppInstanceId($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_LIST_KIOSKOS_BY_APP_INSTANCE_ID);

				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");
					$firstItem = CommunicationSetting::findValueByKey($css, "firstItem");
					$orderPriority = CommunicationSetting::findValueByKey($css, "orderPriority");

					$ctrl = new KioskoController($this->persistenceManager);
					$ks = $ctrl->listKioskosByAppInstanceId($appInstanceId, true, $firstItem, NAV_CMS_LIST_PAGE_SIZE, array(KioskoDTO::$ORDER_BY_NAME), $orderPriority);
					#	Ahora debemos buscar Usuario por usuario para poder relacionar el id del MapUser con el id del kiosko

					$css = array();
					foreach ($ks as $k) {
						$muCtrl = new MapUserController($this->persistenceManager);
						$mus = $muCtrl->getMapUsersByKioskoId($k->getId());
						if(count($mus)!=1){
							$cm = new CommunicationMensaje(false,NAV_CMS_ALERT_E_ENTITY_NOT_FOUND_FAIL,$this->ID + 113);
							break;
						}else{
							$mu = $mus[0];
							$cs = new CommunicationSetting(null,$k->getId(),$mu->getId());
							$css[] = $cs;
						}
					}
					if($cm->getStatus()){
						$css[] = new CommunicationSetting(null,CS_REQUEST_SIZE, $ctrl->getLastRequestSize());
						$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 114,KioskoDTO::DTOsToXML($ks),CommunicationSetting::DTOsToXML($css));
					}

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 115) ."->".$e->getCode()));
			}
		}

		public function getNavigationCMSOfflineData($appInstanceId) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_NAVIGATION_CMS_OFFLINE_DATA);

				if($cm->getStatus()){

					/**
					 *
					 * Agenda del día
					 * 1. Listar todas las entidades que se pueden listar que no dependen de nadie o que sólo dependen de AppInstance
					 * 2. Obtener las entidades que dependen de las obtenidas en el punto 1
					 * 3. Completar los arreglos de dependencias (ids) de las entidades obtenidas en el punto 1.
					 * 4. Retornar todo convertido a XML
					 */

					$aiCtrl = new AppInstanceController($this->persistenceManager);
					$appInstance = new AppInstanceDTO($appInstanceId);
					$aiCtrl->getAppInstance($appInstance);
					$appInstance->setExtensionPlan(null);
					$appInstance->setUsageLogUnits(array());
					$appInstance->setUsagePlan(null);

					#	1. Listar todas las entidades que se pueden listar que no dependen de nadie o que sólo dependen de AppInstance
					$ulCtrl = new UsageLogUnitController($this->persistenceManager);
					$gaCtrl	= new GPSAlertController($this->persistenceManager);
					$gpCtrl	= new GPSPointController($this->persistenceManager);
					$kCtrl 	= new KioskoController($this->persistenceManager);
					$lcCtrl = new LandmarkCategoryController($this->persistenceManager);
					$lCtrl 	= new LandmarkController($this->persistenceManager);
					$rcCtrl	= new ResourceCategoryController($this->persistenceManager);
					$rCtrl 	= new ResourceController($this->persistenceManager);
					$riCtrl	= new ResourceIndexController($this->persistenceManager);
					$frCtrl	= new FileResourceController($this->persistenceManager);
					$rpCtrl	= new ResourcePlatformController($this->persistenceManager);
					$muCtrl	= new MapUserController($this->persistenceManager);


					$gas = $gaCtrl->getGPSAlertsByAppInstanceId($appInstanceId);
					$lcs = $lcCtrl->getLandmarkCategories();
					$ls	 = $lCtrl->getLandmarksByAppInstanceIdAndVisibility($appInstanceId, GLOBAL_YES);
					$lsHidden	 = $lCtrl->getLandmarksByAppInstanceIdAndVisibility($appInstanceId, GLOBAL_NO);
					$rcs = $rcCtrl->getResourceCategories();
					$risFull = $riCtrl->getResourceIndexesByAppInstanceId($appInstanceId,false,null,null,array(ResourceIndexDTO::$ORDER_BY_RESOURCE_ORDER),SQL_ASCENDING_ORDER);
					$ris = array();
					$rs  = array();
					$frs = array();
					$gps = array();
					$ks = array();


					$mapUser = $this->securityCtrl->getCurrentUserDTO();
					$mapUser->setHevoTCoreUserID(null);
					$mapUser->setLogin(null);
					$mus = array($mapUser);

					if(EntityValidator::validateId($mapUser->getKiosko())){
						$k = new KioskoDTO($mapUser->getKiosko());
						$kCtrl->getKiosko($k);
						$ks[] = $k;
					}

					$rp = new ResourcePlatformDTO($mapUser->getPlatform());
					$rpCtrl->getResourcePlatform($rp);

					# 2. Obtener las entidades que dependen de las obtenidas en el punto 1
					// Agregamos algunos ResourceIndexes y Resource

					foreach ($gas as $ga) {
						if(EntityValidator::validateId($ga->getResource())){
							$rTmp = new ResourceDTO($ga->getResource());
							$rCtrl->getResource($rTmp);
							$rs[] = $rTmp;
						}

						#	Adicionamos los Puntos GPS
						$gp = new GPSPointDTO($ga->getStartPoint());
						$gpCtrl->getGPSPoint($gp);
						$gps[] = $gp;
						if(EntityValidator::validateId($ga->getEndPoint())){
							$gp = new GPSPointDTO($ga->getEndPoint());
							$gpCtrl->getGPSPoint($gp);
							$gps[] = $gp;
						}
					}

					# Obtener los resourceIndexes que faltan y GPSpoints
					foreach ($ls as $l) {

						#	2 Obtener las entidades que dependen de las obtenidas en el punto 1 (para  ResourceIndex)

						$risFull = array_merge($risFull,$riCtrl->getResourceIndexesByLandmarkId($l->getId(),false,null,null,array(ResourceIndexDTO::$ORDER_BY_RESOURCE_ORDER),SQL_ASCENDING_ORDER));
						$risFull = array_unique($risFull);

						#	Adicionamos los Puntos GPS

						$gpsTmp = $gpCtrl->getGPSPointsByLandmarkId($l->getId());
						$gps = array_merge($gps, $gpsTmp);


						# Y también asociamos los ids de los puntos y de las categorías
						$gpsIdsTmp = array();
						foreach ($gpsTmp as $gp) {
							$gpsIdsTmp[] = $gp->getId();
						}
						$l->setGpsPoints($gpsIdsTmp);



						$lcsTmp = $lcCtrl->getLandmarkCategoriesByLandmarkId($l->getId());
						$lmcIdsTmp = array();
						foreach ($lcsTmp as $lc) {
							$lmcIdsTmp[] = $lc->getId();
						}
						$l->setLandmarkCategories($lmcIdsTmp);
					}

					# Eliminar los resourceIndexes que pertenecen a establecimientos ocultos
					foreach ($lsHidden as $l) {

						$risTmp = $riCtrl->getResourceIndexesByLandmarkId($l->getId(),false,null,null,array(ResourceIndexDTO::$ORDER_BY_RESOURCE_ORDER),SQL_ASCENDING_ORDER);
						$risFull = array_diff($risFull,$risTmp);

					}

					#  3. Completar los arreglos de dependencias (ids) de las entidades obtenidas en el punto 1 de las entidades que hacen falta.
					foreach ($risFull as $ri) {
						$rpsTmp = $rpCtrl->getResourcePlatformsByResourceIndexId($ri->getId());
						$rpIds = array();
						foreach ($rpsTmp as $rp2) {
							$rpIds[] = $rp2->getId();
						}

						if(in_array($rp->getId(), $rpIds)){
							$ri->setPlatforms($rpIds);
							$ris[] = $ri;
							$rcsTmp = $rcCtrl->getResourceCategoriesByResourceIndexId($ri->getId());
							$rcIds = array();
							foreach ($rcsTmp as $rc) {
								$rcIds[] = $rc->getId();
							}
							$ri->setCategories($rcIds);
						}

					}


					# ResourceIndex en ResourceCategory, descartamos los índices de recursos que no pertenecen a la plataforma del usuario y obtenemos los recursos asociados a los RsourceIndex recolectados hasta el momento.
					foreach ($ris as $ri) {
						$rTmp = new ResourceDTO($ri->getResource());
						$rCtrl->getResource($rTmp);
						$rs[] = $rTmp;

						foreach ($rcs as $rc) {
							if(in_array($rc->getId(), $ri->getCategories())){
								$risT = $rc->getResourceIndexes();
								$risT[] = $ri->getId();
								$rc->SetResourceIndexes($risT);
							}
						}

						foreach ($ls as $l) {
							if($l->getId() == $ri->getLandmark()){
								$risT = $l->getResourceIndexes();
								$risT[] = $ri->getId();
								$l->SetResourceIndexes($risT);
							}
						}
					}

					# Obtenemos los FileResources
					$app = $this->securityCtrl->getNavigationMainAppDTO();

					foreach ($rs as $r) {
						$cm = $this->hcMainCtrl->getFileResourceByHevoTCoreFileResourceID($app->getHevoTCoreEnterpriseDomainID(), $app->getHevoTCorePass(), $r->getHevoTCoreID());

                        if($cm->getStatus()){
                            $frs2 = FileResourceDTO::loadFromXML($cm->getData());
                            if(count($frs2)==1){
                            	$frs[] = $frs2[0];
                            }
                        }
					}

					#	Obtenemos los puntos GPS de los kioskos

					foreach ($ks as $k) {
						$gp = new GPSPointDTO($k->getGpsPoint());
						$gpCtrl->getGPSPoint($gp);
						$gps[] = $gp;
					}


					#	En este punto tenemos todas las entidades cargadas del sistema


					#	4. Retornar todo convertido a XML

					$navXMSXML = 	AppInstanceDTO::DTOsToXML(array($appInstance)).GPSAlertDTO::DTOsToXML($gas).KioskoDTO::DTOsToXML($ks).LandmarkCategoryDTO::DTOsToXML($lcs).LandmarkDTO::DTOsToXML($ls).
									ResourceCategoryDTO::DTOsToXML($rcs).MapUserDTO::DTOsToXML($mus).ResourceIndexDTO::DTOsToXML($ris).ResourceDTO::DTOsToXML($rs).
									FileResourceDTO::DTOsToXML($frs).GPSPointDTO::DTOsToXML($gps);

					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 140,"<".GENERIC_OBJECTS_TAG.">".$navXMSXML."</".GENERIC_OBJECTS_TAG.">");

				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 141) ."->".$e->getCode()));
			}
		}

		/**
		 *
		 * Intercambia el orden de dos índices. El objetivo es ordenar recursos con respecto a otros.
		 * @param	$resourceIndex1Id
		 * @param	$resourceIndex2Id
		 * @return	CommunicationMessage con el mensaje de confirmación.
		 */
		public function swapResourceIndexes($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$this->persistenceManager->beginTransaction();

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_SWAP_RESOURCE_INDEXES);
				if($cm->getStatus()){

					$css = CommunicationSetting::loadFromXML($xmlParams);
					$resourceIndexId1 = CommunicationSetting::findValueByKey($css, "resourceIndexId1");
					$resourceIndexId2 = CommunicationSetting::findValueByKey($css, "resourceIndexId2");

					$ctrlRI = new ResourceIndexController($this->persistenceManager);
					$ri1 = new ResourceIndexDTO($resourceIndexId1);
					$ri2 = new ResourceIndexDTO($resourceIndexId2);

					$ctrlRI->getResourceIndex($ri1);
					$ctrlRI->getResourceIndex($ri2);

					$orderBackup = $ri1->getResourceOrder();

					$ri1->setResourceOrder($ri2->getResourceOrder());
					$ri2->setResourceOrder($orderBackup);

					$ctrlRI->updateResourceIndex($ri1);
					$ctrlRI->updateResourceIndex($ri2);

                    $cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 142);

				}

				if($cm->getStatus()){
					$this->persistenceManager->commitTransaction();
				}else{
					$this->persistenceManager->rollbackTransaction();
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				$this->persistenceManager->rollbackTransaction();
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 143) ."->".$e->getCode()));
			}
		}
		/**
		 *
		 * Lista todos los kioskos de una instancia de aplicación.
		 * @param $appInstanceId
		 * @param $firstResultNumber
		 * @return CommunicationMessage con el mensaje de confirmación. Y en data devuelve una colección de KioskoDTO con los campos mínimos necesarios y en data2 una colección de CommunicationSetting con la relación entre id kiosko y id de MapUser.
		 */
		public function getSyncStatus($xmlParams) {
			try{
				#    Verificación de la aplicación
				$cm = $this->securityCtrl->isAppReady();
				if(!$cm->getStatus()){
					return $this->translateCommunicationMessage($cm);
				}
				#----------------------------------

				$cm = $this->securityCtrl->checkEnterpriseUserPermission(NAV_CMS_PERMISSION_GET_SYNC_STATUS);

				if($cm->getStatus()){
					$css = CommunicationSetting::loadFromXML($xmlParams);
					$appInstanceId = CommunicationSetting::findValueByKey($css, "appInstanceId");

					$ctrl = new UsageLogUnitController($this->persistenceManager);
					$uls = $ctrl->listUsageLogUnitsByAppInstanceId($appInstanceId, false, 0, 1, array(UsageLogUnitDTO::$PRIMARY_KEY_DB_NAME), SQL_DESCENDENT_ORDER);
					$id = 0;
					if(count($uls) > 0){
						$ul = $uls[0];
						$id = $ul->getId();
					}

					$css = CommunicationSetting::DTOsToXML(array(new CommunicationSetting(null,CS_ENTITY_ID,$id)));
					$cm = new CommunicationMensaje(true,NAV_CMS_ALERT_A_OPERATION_SUCCESS,$this->ID + 158,$css);
				}
				return $this->translateCommunicationMessage($cm);
			}catch (Exception $e){
				return $this->translateCommunicationMessage(new CommunicationMensaje(false,$e->getMessage(),($this->ID + 159) ."->".$e->getCode()));
			}
		}

		//159
	}
?>
