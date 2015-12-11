<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.SOFTWARE_COMPUTADORA_BACKUP_DTO;

    class SoftwareComputadoraBackup {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "software_computadora_backup";
        public $PRIMARY_KEY_DB_NAME = "software_computadora_backup_id";

        public $ID_SOFTWARE_COMPUTADORA = "id_software_computadora";
        public static $ORDER_BY_ID_SOFTWARE_COMPUTADORA = "id_software_computadora";
        public $NUMERO_SERIE_PROGRAMA_BACKUP = "numero_serie_programa_backup";
        public static $ORDER_BY_NUMERO_SERIE_PROGRAMA_BACKUP = "numero_serie_programa_backup";
        public $COMP_SOFT_FECHA_INSTALACION_BACKUP = "comp_soft_fecha_instalacion_backup";
        public static $ORDER_BY_COMP_SOFT_FECHA_INSTALACION_BACKUP = "comp_soft_fecha_instalacion_backup";
        public $COMPUTADORA_BACKUP = "computadora_backup";
        public static $ORDER_BY_COMPUTADORA_BACKUP = "computadora_backup";
        public $SOFTWARE_BACKUP = "software_backup";
        public static $ORDER_BY_SOFTWARE_BACKUP = "software_backup";
        public $FECHA_BACKUP_S_C = "fecha_backup_s_c";
        public static $ORDER_BY_FECHA_BACKUP_S_C = "fecha_backup_s_c";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $NUMERO_SERIE_PROGRAMA_BACKUP_SIZE = 25;
        private $COMP_SOFT_FECHA_INSTALACION_BACKUP_SIZE = 60;

        # Atributos privados estandar
        private $id;
        private $idSoftwareComputadora;
        private $numeroSerieProgramaBackup;
        private $compSoftFechaInstalacionBackup;
        private $computadoraBackup;
        private $softwareBackup;
        private $fechaBackupSC;

        function SoftwareComputadoraBackup($idSoftwareComputadora = null, $numeroSerieProgramaBackup = null, $compSoftFechaInstalacionBackup = null, $computadoraBackup = null, $softwareBackup = null, $fechaBackupSC = null){
            $this->id = null;
            $this->idSoftwareComputadora = $this->scapeString($idSoftwareComputadora);
            $this->numeroSerieProgramaBackup = $this->scapeString($numeroSerieProgramaBackup);
            $this->compSoftFechaInstalacionBackup = $this->scapeString($compSoftFechaInstalacionBackup);
            $this->computadoraBackup = $this->scapeString($computadoraBackup);
            $this->softwareBackup = $this->scapeString($softwareBackup);
            $this->fechaBackupSC = $this->scapeString($fechaBackupSC);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getIdSoftwareComputadora(){
            return $this->idSoftwareComputadora;
        }

        public function setIdSoftwareComputadora($idSoftwareComputadora){
            $this->idSoftwareComputadora = $idSoftwareComputadora;
        }

        public function getNumeroSerieProgramaBackup(){
            return $this->numeroSerieProgramaBackup;
        }

        public function setNumeroSerieProgramaBackup($numeroSerieProgramaBackup){
            if(strlen($numeroSerieProgramaBackup) > $this->NUMERO_SERIE_PROGRAMA_BACKUP_SIZE){;
                $this->numeroSerieProgramaBackup = $this->scapeString(substr($numeroSerieProgramaBackup, 0, $this->NUMERO_SERIE_PROGRAMA_BACKUP_SIZE));
            }else{
                $this->numeroSerieProgramaBackup = $this->scapeString($numeroSerieProgramaBackup);
            }
        }

        public function getCompSoftFechaInstalacionBackup(){
            return $this->compSoftFechaInstalacionBackup;
        }

        public function setCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup){
            if(strlen($compSoftFechaInstalacionBackup) > $this->COMP_SOFT_FECHA_INSTALACION_BACKUP_SIZE){;
                $this->compSoftFechaInstalacionBackup = $this->scapeString(substr($compSoftFechaInstalacionBackup, 0, $this->COMP_SOFT_FECHA_INSTALACION_BACKUP_SIZE));
            }else{
                $this->compSoftFechaInstalacionBackup = $this->scapeString($compSoftFechaInstalacionBackup);
            }
        }

        public function getComputadoraBackup(){
            return $this->computadoraBackup;
        }

        public function setComputadoraBackup($computadoraBackup){
            $this->computadoraBackup = $computadoraBackup;
        }

        public function getSoftwareBackup(){
            return $this->softwareBackup;
        }

        public function setSoftwareBackup($softwareBackup){
            $this->softwareBackup = $softwareBackup;
        }

        public function getFechaBackupSC(){
            return $this->fechaBackupSC;
        }

        public function setFechaBackupSC($fechaBackupSC){
            $this->fechaBackupSC = $fechaBackupSC;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->ID_SOFTWARE_COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_BACKUP,$this->ENTITY_DB_NAME.".".$this->FECHA_BACKUP_S_C);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->ID_SOFTWARE_COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_BACKUP,$this->ENTITY_DB_NAME.".".$this->FECHA_BACKUP_S_C);
        }

        public function getDbFieldNames(){
            return array($this->ID_SOFTWARE_COMPUTADORA,$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->COMPUTADORA_BACKUP,$this->SOFTWARE_BACKUP,$this->FECHA_BACKUP_S_C);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->ID_SOFTWARE_COMPUTADORA,$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->COMPUTADORA_BACKUP,$this->SOFTWARE_BACKUP,$this->FECHA_BACKUP_S_C);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->ID_SOFTWARE_COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_BACKUP,$this->ENTITY_DB_NAME.".".$this->FECHA_BACKUP_S_C);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->ID_SOFTWARE_COMPUTADORA,$this->ENTITY_DB_NAME.".".$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->ENTITY_DB_NAME.".".$this->COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->SOFTWARE_BACKUP,$this->ENTITY_DB_NAME.".".$this->FECHA_BACKUP_S_C);
        }

        public function getDbListFieldNames(){
            return array($this->ID_SOFTWARE_COMPUTADORA,$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->COMPUTADORA_BACKUP,$this->SOFTWARE_BACKUP,$this->FECHA_BACKUP_S_C);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->ID_SOFTWARE_COMPUTADORA,$this->NUMERO_SERIE_PROGRAMA_BACKUP,$this->COMP_SOFT_FECHA_INSTALACION_BACKUP,$this->COMPUTADORA_BACKUP,$this->SOFTWARE_BACKUP,$this->FECHA_BACKUP_S_C);
        }

        public function getDbFieldValues(){
            return array($this->getIdSoftwareComputadora(),$this->getNumeroSerieProgramaBackup(),$this->getCompSoftFechaInstalacionBackup(),$this->getComputadoraBackup(),$this->getSoftwareBackup(),$this->getFechaBackupSC());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getIdSoftwareComputadora(),$this->getNumeroSerieProgramaBackup(),$this->getCompSoftFechaInstalacionBackup(),$this->getComputadoraBackup(),$this->getSoftwareBackup(),$this->getFechaBackupSC());
        }

        public function getDbListFieldValues(){
            return array($this->getIdSoftwareComputadora(),$this->getNumeroSerieProgramaBackup(),$this->getCompSoftFechaInstalacionBackup(),$this->getComputadoraBackup(),$this->getSoftwareBackup(),$this->getFechaBackupSC());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getIdSoftwareComputadora(),$this->getNumeroSerieProgramaBackup(),$this->getCompSoftFechaInstalacionBackup(),$this->getComputadoraBackup(),$this->getSoftwareBackup(),$this->getFechaBackupSC());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->ID_SOFTWARE_COMPUTADORA]) && !SoftwareComputadoraBackupDTO::isEmpty($rq[$this->ID_SOFTWARE_COMPUTADORA])){
                $this->idSoftwareComputadora = $this->scapeString($rq[$this->ID_SOFTWARE_COMPUTADORA]);
            }else{
                $this->idSoftwareComputadora = null;
            }
            if(isset($rq[$this->NUMERO_SERIE_PROGRAMA_BACKUP]) && !SoftwareComputadoraBackupDTO::isEmpty($rq[$this->NUMERO_SERIE_PROGRAMA_BACKUP])){
                $this->numeroSerieProgramaBackup = $this->scapeString($rq[$this->NUMERO_SERIE_PROGRAMA_BACKUP]);
            }else{
                $this->numeroSerieProgramaBackup = null;
            }
            if(isset($rq[$this->COMP_SOFT_FECHA_INSTALACION_BACKUP]) && !SoftwareComputadoraBackupDTO::isEmpty($rq[$this->COMP_SOFT_FECHA_INSTALACION_BACKUP])){
                $this->compSoftFechaInstalacionBackup = $this->scapeString($rq[$this->COMP_SOFT_FECHA_INSTALACION_BACKUP]);
            }else{
                $this->compSoftFechaInstalacionBackup = null;
            }
            if(isset($rq[$this->COMPUTADORA_BACKUP]) && !SoftwareComputadoraBackupDTO::isEmpty($rq[$this->COMPUTADORA_BACKUP])){
                $this->computadoraBackup = $this->scapeString($rq[$this->COMPUTADORA_BACKUP]);
            }else{
                $this->computadoraBackup = null;
            }
            if(isset($rq[$this->SOFTWARE_BACKUP]) && !SoftwareComputadoraBackupDTO::isEmpty($rq[$this->SOFTWARE_BACKUP])){
                $this->softwareBackup = $this->scapeString($rq[$this->SOFTWARE_BACKUP]);
            }else{
                $this->softwareBackup = null;
            }
            if(isset($rq[$this->FECHA_BACKUP_S_C]) && !SoftwareComputadoraBackupDTO::isEmpty($rq[$this->FECHA_BACKUP_S_C])){
                $this->fechaBackupSC = $this->scapeString($rq[$this->FECHA_BACKUP_S_C]);
            }else{
                $this->fechaBackupSC = null;
            }
        }

        public function toDTO(){
            $softwareComputadoraBackupDTO = new SoftwareComputadoraBackupDTO();
            $softwareComputadoraBackupDTO->setId($this->getId());
            $softwareComputadoraBackupDTO->setIdSoftwareComputadora($this->unscapeString($this->getIdSoftwareComputadora()));
            $softwareComputadoraBackupDTO->setNumeroSerieProgramaBackup($this->unscapeString($this->getNumeroSerieProgramaBackup()));
            $softwareComputadoraBackupDTO->setCompSoftFechaInstalacionBackup($this->unscapeString($this->getCompSoftFechaInstalacionBackup()));
            $softwareComputadoraBackupDTO->setComputadoraBackup($this->unscapeString($this->getComputadoraBackup()));
            $softwareComputadoraBackupDTO->setSoftwareBackup($this->unscapeString($this->getSoftwareBackup()));
            $softwareComputadoraBackupDTO->setFechaBackupSC($this->unscapeString($this->getFechaBackupSC()));
            return $softwareComputadoraBackupDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateNumber($this->idSoftwareComputadora) && EntityValidator::validateString($this->numeroSerieProgramaBackup) && EntityValidator::validateNumber($this->computadoraBackup) && EntityValidator::validateNumber($this->softwareBackup) && EntityValidator::validateString($this->fechaBackupSC);
        }
        /**
         * Esta función trata de prevenir el SQL Injection
         * @param $str
        */
        private function scapeString($str){
            if(!empty($str)){
                return addslashes(stripslashes($str));
            }else{
                return $str;
            }
        }
        public function unscapeString($str){
            if(!empty($str)){
                return stripslashes($str);
            }else{
                return $str;
            }
        }
    }
?>