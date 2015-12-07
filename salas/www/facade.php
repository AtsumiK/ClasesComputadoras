<?php
    //session_start();

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once '../../common/config/globalEnums.php';
    date_default_timezone_set('America/Bogota');


    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_ENUMS_FILE;
    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once SALAS_COMP_CONTROLLER_DIR.SALAS_COMP_MAIN_CONTROLLER;
    require_once UTILS_DIR.COMMUNICATION_MESSAGE_OBJ;



	function listarSalones($firstItem = 0){
	    $mainCtrl = new SalasMainController();

    	$cm = $mainCtrl->getSalones($firstItem, "ASC");
    	$salones = $cm->getData();
      return array("exito"=>$cm->getStatus(),"content"=>$salones);
	}
  function consultarSalon($idSalon){
	    $mainCtrl = new SalasMainController();
      $cm = $mainCtrl->getSalon($idSalon);
      $salon = $cm->getData();
      if($cm->getStatus()){
        return array("exito"=>$cm->getStatus(),"content"=>$salon);
      }else{
        return array("exito"=>$cm->getStatus(),"content"=>$cm->getMessage());
      }
  }
  function eliminarSalon($idSalon){
	    $mainCtrl = new SalasMainController();
      $cm = $mainCtrl->removeSalon($idSalon);
      return array("exito"=>$cm->getStatus(),"content"=>$cm->getMessage());
  }

  function editarSalon($salon){
	    $mainCtrl = new SalasMainController();
      $cm = $mainCtrl->updateSalon($salon);
      return array("exito"=>$cm->getStatus(),"content"=>$cm->getMessage());
  }
  function insertarSalon($salon){
	    $mainCtrl = new SalasMainController();
      $cm = $mainCtrl->setSalon($salon);
      return array("exito"=>$cm->getStatus(),"content"=>$cm->getMessage());
  }

?>
