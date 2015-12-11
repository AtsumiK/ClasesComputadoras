<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.PRESTAMO_BACKUP_ENTITY;

    class PrestamoBackupDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "prestamo_backup";
        public static $PRIMARY_KEY_DB_NAME = "prestamo_backup_id";

        public static $ORDER_BY_PRESTAMO_ID = "prestamo_id";
        public static $ORDER_BY_PRESTAMO_ENTRADA_BACKUP = "prestamo_entrada_backup";
        public static $ORDER_BY_PRESTAMO_SALIDA_BACKUP = "prestamo_salida_backup";
        public static $ORDER_BY_PRESTAMO_COMENTARIOS_BACKUP = "prestamo_comentarios_backup";
        public static $ORDER_BY_PRESTAMO_ESTUDIANTE_BACKUP = "prestamo_estudiante_backup";
        public static $ORDER_BY_PRESTAMO_COMPUTADORA_BACKUP = "prestamo_computadora_backup";
        public static $ORDER_BY_PRESTAMO_BACKUP_FECHA_BACKUP = "prestamo_backup_fecha_backup";

        # Constantes públicas para soporte de interfaz

        public $PRESTAMO_ID = "PRESTAMO_ID";
        public $PRESTAMO_ENTRADA_BACKUP = "PRESTAMO_ENTRADA_BACKUP";
        public $PRESTAMO_SALIDA_BACKUP = "PRESTAMO_SALIDA_BACKUP";
        public $PRESTAMO_COMENTARIOS_BACKUP = "PRESTAMO_COMENTARIOS_BACKUP";
        public $PRESTAMO_ESTUDIANTE_BACKUP = "PRESTAMO_ESTUDIANTE_BACKUP";
        public $PRESTAMO_COMPUTADORA_BACKUP = "PRESTAMO_COMPUTADORA_BACKUP";
        public $PRESTAMO_BACKUP_FECHA_BACKUP = "PRESTAMO_BACKUP_FECHA_BACKUP";

        # Atributos privados estandar
        private $id;
        private $prestamoId;
        private $prestamoEntradaBackup;
        private $prestamoSalidaBackup;
        private $prestamoComentariosBackup;
        private $prestamoEstudianteBackup;
        private $prestamoComputadoraBackup;
        private $prestamoBackupFechaBackup;

        function PrestamoBackupDTO($id = null, $prestamoId = null, $prestamoEntradaBackup = null, $prestamoSalidaBackup = null, $prestamoComentariosBackup = null, $prestamoEstudianteBackup = null, $prestamoComputadoraBackup = null, $prestamoBackupFechaBackup = null){
            $this->id = $id;
            $this->prestamoId = $prestamoId;
            $this->prestamoEntradaBackup = $prestamoEntradaBackup;
            $this->prestamoSalidaBackup = $prestamoSalidaBackup;
            $this->prestamoComentariosBackup = $prestamoComentariosBackup;
            $this->prestamoEstudianteBackup = $prestamoEstudianteBackup;
            $this->prestamoComputadoraBackup = $prestamoComputadoraBackup;
            $this->prestamoBackupFechaBackup = $prestamoBackupFechaBackup;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getPrestamoId(){
            return $this->prestamoId;
        }

        public function setPrestamoId($prestamoId){
            $this->prestamoId = $prestamoId;
        }

        public function getPrestamoEntradaBackup(){
            return $this->prestamoEntradaBackup;
        }

        public function setPrestamoEntradaBackup($prestamoEntradaBackup){
            $this->prestamoEntradaBackup = $prestamoEntradaBackup;
        }

        public function getPrestamoSalidaBackup(){
            return $this->prestamoSalidaBackup;
        }

        public function setPrestamoSalidaBackup($prestamoSalidaBackup){
            $this->prestamoSalidaBackup = $prestamoSalidaBackup;
        }

        public function getPrestamoComentariosBackup(){
            return $this->prestamoComentariosBackup;
        }

        public function setPrestamoComentariosBackup($prestamoComentariosBackup){
            $this->prestamoComentariosBackup = $prestamoComentariosBackup;
        }

        public function getPrestamoEstudianteBackup(){
            return $this->prestamoEstudianteBackup;
        }

        public function setPrestamoEstudianteBackup($prestamoEstudianteBackup){
            $this->prestamoEstudianteBackup = $prestamoEstudianteBackup;
        }

        public function getPrestamoComputadoraBackup(){
            return $this->prestamoComputadoraBackup;
        }

        public function setPrestamoComputadoraBackup($prestamoComputadoraBackup){
            $this->prestamoComputadoraBackup = $prestamoComputadoraBackup;
        }

        public function getPrestamoBackupFechaBackup(){
            return $this->prestamoBackupFechaBackup;
        }

        public function setPrestamoBackupFechaBackup($prestamoBackupFechaBackup){
            $this->prestamoBackupFechaBackup = $prestamoBackupFechaBackup;
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
            $this->prestamoId = $entity->unscapeString($entity->getPrestamoId());
            $this->prestamoEntradaBackup = $entity->unscapeString($entity->getPrestamoEntradaBackup());
            $this->prestamoSalidaBackup = $entity->unscapeString($entity->getPrestamoSalidaBackup());
            $this->prestamoComentariosBackup = $entity->unscapeString($entity->getPrestamoComentariosBackup());
            $this->prestamoEstudianteBackup = $entity->unscapeString($entity->getPrestamoEstudianteBackup());
            $this->prestamoComputadoraBackup = $entity->unscapeString($entity->getPrestamoComputadoraBackup());
            $this->prestamoBackupFechaBackup = $entity->unscapeString($entity->getPrestamoBackupFechaBackup());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new PrestamoBackupDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(PrestamoBackupDTO $prestamoBackupDTO){
            $prestamoBackup = new PrestamoBackup();
            $prestamoBackup->setId($prestamoBackupDTO->getId());
            $prestamoBackup->setPrestamoId($prestamoBackupDTO->getPrestamoId());
            $prestamoBackup->setPrestamoEntradaBackup($prestamoBackupDTO->getPrestamoEntradaBackup());
            $prestamoBackup->setPrestamoSalidaBackup($prestamoBackupDTO->getPrestamoSalidaBackup());
            $prestamoBackup->setPrestamoComentariosBackup($prestamoBackupDTO->getPrestamoComentariosBackup());
            $prestamoBackup->setPrestamoEstudianteBackup($prestamoBackupDTO->getPrestamoEstudianteBackup());
            $prestamoBackup->setPrestamoComputadoraBackup($prestamoBackupDTO->getPrestamoComputadoraBackup());
            $prestamoBackup->setPrestamoBackupFechaBackup($prestamoBackupDTO->getPrestamoBackupFechaBackup());
            return $prestamoBackup;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateNumber($this->prestamoId) && EntityValidator::validateString($this->prestamoEntradaBackup) && EntityValidator::validateString($this->prestamoSalidaBackup) && EntityValidator::validateNumber($this->prestamoEstudianteBackup) && EntityValidator::validateNumber($this->prestamoComputadoraBackup) && EntityValidator::validateString($this->prestamoBackupFechaBackup);
        }
        public function toXML(){
            $xml="";
            $xml .= "<PrestamoBackup>";
                $xml .= "<PrestamoBackup_Id>";
                    $xml .= $this->getId();
                $xml .= "</PrestamoBackup_Id>";
                if($this->getPrestamoId() !== null){
                    $xml .= "<prestamoId><![CDATA[";
                        $xml .= $this->getPrestamoId();
                    $xml .= "]]></prestamoId>";
                }
                if($this->getPrestamoEntradaBackup() !== null){
                    $xml .= "<prestamoEntradaBackup><![CDATA[";
                        $xml .= $this->getPrestamoEntradaBackup();
                    $xml .= "]]></prestamoEntradaBackup>";
                }
                if($this->getPrestamoSalidaBackup() !== null){
                    $xml .= "<prestamoSalidaBackup><![CDATA[";
                        $xml .= $this->getPrestamoSalidaBackup();
                    $xml .= "]]></prestamoSalidaBackup>";
                }
                if($this->getPrestamoComentariosBackup() !== null){
                    $xml .= "<prestamoComentariosBackup><![CDATA[";
                        $xml .= $this->getPrestamoComentariosBackup();
                    $xml .= "]]></prestamoComentariosBackup>";
                }
                if($this->getPrestamoEstudianteBackup() !== null){
                    $xml .= "<prestamoEstudianteBackup><![CDATA[";
                        $xml .= $this->getPrestamoEstudianteBackup();
                    $xml .= "]]></prestamoEstudianteBackup>";
                }
                if($this->getPrestamoComputadoraBackup() !== null){
                    $xml .= "<prestamoComputadoraBackup><![CDATA[";
                        $xml .= $this->getPrestamoComputadoraBackup();
                    $xml .= "]]></prestamoComputadoraBackup>";
                }
                if($this->getPrestamoBackupFechaBackup() !== null){
                    $xml .= "<prestamoBackupFechaBackup><![CDATA[";
                        $xml .= $this->getPrestamoBackupFechaBackup();
                    $xml .= "]]></prestamoBackupFechaBackup>";
                }
            $xml .= "</PrestamoBackup>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("PrestamoBackup");
            foreach ($nodes as $node) {
                $dao = new PrestamoBackupDTO();
                $data = $node->getElementsByTagName("PrestamoBackup_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("prestamoId");
                if($data->length>0 && !PrestamoBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoId($data);
                $data = $node->getElementsByTagName("prestamoEntradaBackup");
                if($data->length>0 && !PrestamoBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoEntradaBackup($data);
                $data = $node->getElementsByTagName("prestamoSalidaBackup");
                if($data->length>0 && !PrestamoBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoSalidaBackup($data);
                $data = $node->getElementsByTagName("prestamoComentariosBackup");
                if($data->length>0 && !PrestamoBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoComentariosBackup($data);
                $data = $node->getElementsByTagName("prestamoEstudianteBackup");
                if($data->length>0 && !PrestamoBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoEstudianteBackup($data);
                $data = $node->getElementsByTagName("prestamoComputadoraBackup");
                if($data->length>0 && !PrestamoBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoComputadoraBackup($data);
                $data = $node->getElementsByTagName("prestamoBackupFechaBackup");
                if($data->length>0 && !PrestamoBackupDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setPrestamoBackupFechaBackup($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<PrestamoBackups>";
                $xml .= $this->toXML();
            $xml .= "</PrestamoBackups>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<PrestamoBackups>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</PrestamoBackups>";
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