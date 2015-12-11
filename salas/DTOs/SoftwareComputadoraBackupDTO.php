<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_COMPUTADORA_BACKUP_ENTITY;

    class SoftwareComputadoraBackupDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "software_computadora_backup";
        public static $PRIMARY_KEY_DB_NAME = "software_computadora_backup_id";

        public static $ORDER_BY_ID_SOFTWARE_COMPUTADORA = "id_software_computadora";
        public static $ORDER_BY_NUMERO_SERIE_PROGRAMA_BACKUP = "numero_serie_programa_backup";
        public static $ORDER_BY_COMP_SOFT_FECHA_INSTALACION_BACKUP = "comp_soft_fecha_instalacion_backup";
        public static $ORDER_BY_COMPUTADORA_BACKUP = "computadora_backup";
        public static $ORDER_BY_SOFTWARE_BACKUP = "software_backup";
        public static $ORDER_BY_FECHA_BACKUP_S_C = "fecha_backup_s_c";

        # Constantes públicas para soporte de interfaz

        public $ID_SOFTWARE_COMPUTADORA = "ID_SOFTWARE_COMPUTADORA";
        public $NUMERO_SERIE_PROGRAMA_BACKUP = "NUMERO_SERIE_PROGRAMA_BACKUP";
        public $COMP_SOFT_FECHA_INSTALACION_BACKUP = "COMP_SOFT_FECHA_INSTALACION_BACKUP";
        public $COMPUTADORA_BACKUP = "COMPUTADORA_BACKUP";
        public $SOFTWARE_BACKUP = "SOFTWARE_BACKUP";
        public $FECHA_BACKUP_S_C = "FECHA_BACKUP_S_C";

        # Atributos privados estandar
        private $id;
        private $idSoftwareComputadora;
        private $numeroSerieProgramaBackup;
        private $compSoftFechaInstalacionBackup;
        private $computadoraBackup;
        private $softwareBackup;
        private $fechaBackupSC;

        function SoftwareComputadoraBackupDTO($id = null, $idSoftwareComputadora = null, $numeroSerieProgramaBackup = null, $compSoftFechaInstalacionBackup = null, $computadoraBackup = null, $softwareBackup = null, $fechaBackupSC = null){
            $this->id = $id;
            $this->idSoftwareComputadora = $idSoftwareComputadora;
            $this->numeroSerieProgramaBackup = $numeroSerieProgramaBackup;
            $this->compSoftFechaInstalacionBackup = $compSoftFechaInstalacionBackup;
            $this->computadoraBackup = $computadoraBackup;
            $this->softwareBackup = $softwareBackup;
            $this->fechaBackupSC = $fechaBackupSC;
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
            $this->numeroSerieProgramaBackup = $numeroSerieProgramaBackup;
        }

        public function getCompSoftFechaInstalacionBackup(){
            return $this->compSoftFechaInstalacionBackup;
        }

        public function setCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup){
            $this->compSoftFechaInstalacionBackup = $compSoftFechaInstalacionBackup;
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


        # Getters y setters genéricos

        public function getAttributeValue($attrName){
            if(isset($this->$attrName)){
                return $this->$attrName;
            }
            return null;
        }

        public function setAttributeValue($attrName, $attrValue) {
            if(isset($this->$attrName)){
                $this->$attrName = $attrValue;
                return true;
            }
            return null;
        }

        public function loadFromEntity($entity){
            $this->id = $entity->getId();
            $this->idSoftwareComputadora = $entity->unscapeString($entity->getIdSoftwareComputadora());
            $this->numeroSerieProgramaBackup = $entity->unscapeString($entity->getNumeroSerieProgramaBackup());
            $this->compSoftFechaInstalacionBackup = $entity->unscapeString($entity->getCompSoftFechaInstalacionBackup());
            $this->computadoraBackup = $entity->unscapeString($entity->getComputadoraBackup());
            $this->softwareBackup = $entity->unscapeString($entity->getSoftwareBackup());
            $this->fechaBackupSC = $entity->unscapeString($entity->getFechaBackupSC());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new SoftwareComputadoraBackupDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(SoftwareComputadoraBackupDTO $softwareComputadoraBackupDTO){
            $softwareComputadoraBackup = new SoftwareComputadoraBackup();
            $softwareComputadoraBackup->setId($softwareComputadoraBackupDTO->getId());
            $softwareComputadoraBackup->setIdSoftwareComputadora($softwareComputadoraBackupDTO->getIdSoftwareComputadora());
            $softwareComputadoraBackup->setNumeroSerieProgramaBackup($softwareComputadoraBackupDTO->getNumeroSerieProgramaBackup());
            $softwareComputadoraBackup->setCompSoftFechaInstalacionBackup($softwareComputadoraBackupDTO->getCompSoftFechaInstalacionBackup());
            $softwareComputadoraBackup->setComputadoraBackup($softwareComputadoraBackupDTO->getComputadoraBackup());
            $softwareComputadoraBackup->setSoftwareBackup($softwareComputadoraBackupDTO->getSoftwareBackup());
            $softwareComputadoraBackup->setFechaBackupSC($softwareComputadoraBackupDTO->getFechaBackupSC());
            return $softwareComputadoraBackup;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateNumber($this->idSoftwareComputadora) && EntityValidator::validateString($this->numeroSerieProgramaBackup) && EntityValidator::validateNumber($this->computadoraBackup) && EntityValidator::validateNumber($this->softwareBackup) && EntityValidator::validateString($this->fechaBackupSC);
        }
        public function toXML(){
            $xml="";
            $xml .= "<SoftwareComputadoraBackup>";
                $xml .= "<SoftwareComputadoraBackup_Id>";
                    $xml .= $this->getId();
                $xml .= "</SoftwareComputadoraBackup_Id>";
                if($this->getIdSoftwareComputadora() !== null){
                    $xml .= "<idSoftwareComputadora><![CDATA[";
                        $xml .= $this->getIdSoftwareComputadora();
                    $xml .= "]]></idSoftwareComputadora>";
                }
                if($this->getNumeroSerieProgramaBackup() !== null){
                    $xml .= "<numeroSerieProgramaBackup><![CDATA[";
                        $xml .= $this->getNumeroSerieProgramaBackup();
                    $xml .= "]]></numeroSerieProgramaBackup>";
                }
                if($this->getCompSoftFechaInstalacionBackup() !== null){
                    $xml .= "<compSoftFechaInstalacionBackup><![CDATA[";
                        $xml .= $this->getCompSoftFechaInstalacionBackup();
                    $xml .= "]]></compSoftFechaInstalacionBackup>";
                }
                if($this->getComputadoraBackup() !== null){
                    $xml .= "<computadoraBackup><![CDATA[";
                        $xml .= $this->getComputadoraBackup();
                    $xml .= "]]></computadoraBackup>";
                }
                if($this->getSoftwareBackup() !== null){
                    $xml .= "<softwareBackup><![CDATA[";
                        $xml .= $this->getSoftwareBackup();
                    $xml .= "]]></softwareBackup>";
                }
                if($this->getFechaBackupSC() !== null){
                    $xml .= "<fechaBackupSC><![CDATA[";
                        $xml .= $this->getFechaBackupSC();
                    $xml .= "]]></fechaBackupSC>";
                }
            $xml .= "</SoftwareComputadoraBackup>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("SoftwareComputadoraBackup");
            foreach ($nodes as $node) {
                $dao = new SoftwareComputadoraBackupDTO();
                $data = $node->getElementsByTagName("SoftwareComputadoraBackup_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("idSoftwareComputadora");
                if($data->length>0 && !SoftwareComputadoraBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setIdSoftwareComputadora($data);
                $data = $node->getElementsByTagName("numeroSerieProgramaBackup");
                if($data->length>0 && !SoftwareComputadoraBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setNumeroSerieProgramaBackup($data);
                $data = $node->getElementsByTagName("compSoftFechaInstalacionBackup");
                if($data->length>0 && !SoftwareComputadoraBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setCompSoftFechaInstalacionBackup($data);
                $data = $node->getElementsByTagName("computadoraBackup");
                if($data->length>0 && !SoftwareComputadoraBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setComputadoraBackup($data);
                $data = $node->getElementsByTagName("softwareBackup");
                if($data->length>0 && !SoftwareComputadoraBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setSoftwareBackup($data);
                $data = $node->getElementsByTagName("fechaBackupSC");
                if($data->length>0 && !SoftwareComputadoraBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setFechaBackupSC($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<SoftwareComputadoraBackups>";
                $xml .= $this->toXML();
            $xml .= "</SoftwareComputadoraBackups>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<SoftwareComputadoraBackups>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</SoftwareComputadoraBackups>";
            return $xml;
        }
        /**
         * Esta función retorna true si la cadena es vacía
         * @param $str
        */
        public static function isEmpty($str){
            return $str == "";
        }
        /**
         * Esta función es un alias de toXML
        */
        public function __toString(){
            return $this->toXML();
        }
    }
?>