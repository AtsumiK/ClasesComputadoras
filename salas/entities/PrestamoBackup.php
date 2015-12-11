<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.PRESTAMO_BACKUP_DTO;

    class PrestamoBackup {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "prestamo_backup";
        public $PRIMARY_KEY_DB_NAME = "prestamo_backup_id";

        public $PRESTAMO_ID = "prestamo_id";
        public static $ORDER_BY_PRESTAMO_ID = "prestamo_id";
        public $PRESTAMO_ENTRADA_BACKUP = "prestamo_entrada_backup";
        public static $ORDER_BY_PRESTAMO_ENTRADA_BACKUP = "prestamo_entrada_backup";
        public $PRESTAMO_SALIDA_BACKUP = "prestamo_salida_backup";
        public static $ORDER_BY_PRESTAMO_SALIDA_BACKUP = "prestamo_salida_backup";
        public $PRESTAMO_COMENTARIOS_BACKUP = "prestamo_comentarios_backup";
        public static $ORDER_BY_PRESTAMO_COMENTARIOS_BACKUP = "prestamo_comentarios_backup";
        public $PRESTAMO_ESTUDIANTE_BACKUP = "prestamo_estudiante_backup";
        public static $ORDER_BY_PRESTAMO_ESTUDIANTE_BACKUP = "prestamo_estudiante_backup";
        public $PRESTAMO_COMPUTADORA_BACKUP = "prestamo_computadora_backup";
        public static $ORDER_BY_PRESTAMO_COMPUTADORA_BACKUP = "prestamo_computadora_backup";
        public $PRESTAMO_BACKUP_FECHA_BACKUP = "prestamo_backup_fecha_backup";
        public static $ORDER_BY_PRESTAMO_BACKUP_FECHA_BACKUP = "prestamo_backup_fecha_backup";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $PRESTAMO_COMENTARIOS_BACKUP_SIZE = 5000;

        # Atributos privados estandar
        private $id;
        private $prestamoId;
        private $prestamoEntradaBackup;
        private $prestamoSalidaBackup;
        private $prestamoComentariosBackup;
        private $prestamoEstudianteBackup;
        private $prestamoComputadoraBackup;
        private $prestamoBackupFechaBackup;

        function PrestamoBackup($prestamoId = null, $prestamoEntradaBackup = null, $prestamoSalidaBackup = null, $prestamoComentariosBackup = null, $prestamoEstudianteBackup = null, $prestamoComputadoraBackup = null, $prestamoBackupFechaBackup = null){
            $this->id = null;
            $this->prestamoId = $this->scapeString($prestamoId);
            $this->prestamoEntradaBackup = $this->scapeString($prestamoEntradaBackup);
            $this->prestamoSalidaBackup = $this->scapeString($prestamoSalidaBackup);
            $this->prestamoComentariosBackup = $this->scapeString($prestamoComentariosBackup);
            $this->prestamoEstudianteBackup = $this->scapeString($prestamoEstudianteBackup);
            $this->prestamoComputadoraBackup = $this->scapeString($prestamoComputadoraBackup);
            $this->prestamoBackupFechaBackup = $this->scapeString($prestamoBackupFechaBackup);
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
            if(strlen($prestamoComentariosBackup) > $this->PRESTAMO_COMENTARIOS_BACKUP_SIZE){;
                $this->prestamoComentariosBackup = $this->scapeString(substr($prestamoComentariosBackup, 0, $this->PRESTAMO_COMENTARIOS_BACKUP_SIZE));
            }else{
                $this->prestamoComentariosBackup = $this->scapeString($prestamoComentariosBackup);
            }
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


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->PRESTAMO_ID,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ID,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getDbFieldNames(){
            return array($this->PRESTAMO_ID,$this->PRESTAMO_ENTRADA_BACKUP,$this->PRESTAMO_SALIDA_BACKUP,$this->PRESTAMO_COMENTARIOS_BACKUP,$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->PRESTAMO_COMPUTADORA_BACKUP,$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->PRESTAMO_ID,$this->PRESTAMO_ENTRADA_BACKUP,$this->PRESTAMO_SALIDA_BACKUP,$this->PRESTAMO_COMENTARIOS_BACKUP,$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->PRESTAMO_COMPUTADORA_BACKUP,$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->PRESTAMO_ID,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ID,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ENTRADA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_SALIDA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMENTARIOS_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_COMPUTADORA_BACKUP,$this->ENTITY_DB_NAME.".".$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getDbListFieldNames(){
            return array($this->PRESTAMO_ID,$this->PRESTAMO_ENTRADA_BACKUP,$this->PRESTAMO_SALIDA_BACKUP,$this->PRESTAMO_COMENTARIOS_BACKUP,$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->PRESTAMO_COMPUTADORA_BACKUP,$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->PRESTAMO_ID,$this->PRESTAMO_ENTRADA_BACKUP,$this->PRESTAMO_SALIDA_BACKUP,$this->PRESTAMO_COMENTARIOS_BACKUP,$this->PRESTAMO_ESTUDIANTE_BACKUP,$this->PRESTAMO_COMPUTADORA_BACKUP,$this->PRESTAMO_BACKUP_FECHA_BACKUP);
        }

        public function getDbFieldValues(){
            return array($this->getPrestamoId(),$this->getPrestamoEntradaBackup(),$this->getPrestamoSalidaBackup(),$this->getPrestamoComentariosBackup(),$this->getPrestamoEstudianteBackup(),$this->getPrestamoComputadoraBackup(),$this->getPrestamoBackupFechaBackup());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getPrestamoId(),$this->getPrestamoEntradaBackup(),$this->getPrestamoSalidaBackup(),$this->getPrestamoComentariosBackup(),$this->getPrestamoEstudianteBackup(),$this->getPrestamoComputadoraBackup(),$this->getPrestamoBackupFechaBackup());
        }

        public function getDbListFieldValues(){
            return array($this->getPrestamoId(),$this->getPrestamoEntradaBackup(),$this->getPrestamoSalidaBackup(),$this->getPrestamoComentariosBackup(),$this->getPrestamoEstudianteBackup(),$this->getPrestamoComputadoraBackup(),$this->getPrestamoBackupFechaBackup());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getPrestamoId(),$this->getPrestamoEntradaBackup(),$this->getPrestamoSalidaBackup(),$this->getPrestamoComentariosBackup(),$this->getPrestamoEstudianteBackup(),$this->getPrestamoComputadoraBackup(),$this->getPrestamoBackupFechaBackup());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->PRESTAMO_ID]) && !PrestamoBackupDTO::isEmpty($rq[$this->PRESTAMO_ID])){
                $this->prestamoId = $this->scapeString($rq[$this->PRESTAMO_ID]);
            }else{
                $this->prestamoId = null;
            }
            if(isset($rq[$this->PRESTAMO_ENTRADA_BACKUP]) && !PrestamoBackupDTO::isEmpty($rq[$this->PRESTAMO_ENTRADA_BACKUP])){
                $this->prestamoEntradaBackup = $this->scapeString($rq[$this->PRESTAMO_ENTRADA_BACKUP]);
            }else{
                $this->prestamoEntradaBackup = null;
            }
            if(isset($rq[$this->PRESTAMO_SALIDA_BACKUP]) && !PrestamoBackupDTO::isEmpty($rq[$this->PRESTAMO_SALIDA_BACKUP])){
                $this->prestamoSalidaBackup = $this->scapeString($rq[$this->PRESTAMO_SALIDA_BACKUP]);
            }else{
                $this->prestamoSalidaBackup = null;
            }
            if(isset($rq[$this->PRESTAMO_COMENTARIOS_BACKUP]) && !PrestamoBackupDTO::isEmpty($rq[$this->PRESTAMO_COMENTARIOS_BACKUP])){
                $this->prestamoComentariosBackup = $this->scapeString($rq[$this->PRESTAMO_COMENTARIOS_BACKUP]);
            }else{
                $this->prestamoComentariosBackup = null;
            }
            if(isset($rq[$this->PRESTAMO_ESTUDIANTE_BACKUP]) && !PrestamoBackupDTO::isEmpty($rq[$this->PRESTAMO_ESTUDIANTE_BACKUP])){
                $this->prestamoEstudianteBackup = $this->scapeString($rq[$this->PRESTAMO_ESTUDIANTE_BACKUP]);
            }else{
                $this->prestamoEstudianteBackup = null;
            }
            if(isset($rq[$this->PRESTAMO_COMPUTADORA_BACKUP]) && !PrestamoBackupDTO::isEmpty($rq[$this->PRESTAMO_COMPUTADORA_BACKUP])){
                $this->prestamoComputadoraBackup = $this->scapeString($rq[$this->PRESTAMO_COMPUTADORA_BACKUP]);
            }else{
                $this->prestamoComputadoraBackup = null;
            }
            if(isset($rq[$this->PRESTAMO_BACKUP_FECHA_BACKUP]) && !PrestamoBackupDTO::isEmpty($rq[$this->PRESTAMO_BACKUP_FECHA_BACKUP])){
                $this->prestamoBackupFechaBackup = $this->scapeString($rq[$this->PRESTAMO_BACKUP_FECHA_BACKUP]);
            }else{
                $this->prestamoBackupFechaBackup = null;
            }
        }

        public function toDTO(){
            $prestamoBackupDTO = new PrestamoBackupDTO();
            $prestamoBackupDTO->setId($this->getId());
            $prestamoBackupDTO->setPrestamoId($this->unscapeString($this->getPrestamoId()));
            $prestamoBackupDTO->setPrestamoEntradaBackup($this->unscapeString($this->getPrestamoEntradaBackup()));
            $prestamoBackupDTO->setPrestamoSalidaBackup($this->unscapeString($this->getPrestamoSalidaBackup()));
            $prestamoBackupDTO->setPrestamoComentariosBackup($this->unscapeString($this->getPrestamoComentariosBackup()));
            $prestamoBackupDTO->setPrestamoEstudianteBackup($this->unscapeString($this->getPrestamoEstudianteBackup()));
            $prestamoBackupDTO->setPrestamoComputadoraBackup($this->unscapeString($this->getPrestamoComputadoraBackup()));
            $prestamoBackupDTO->setPrestamoBackupFechaBackup($this->unscapeString($this->getPrestamoBackupFechaBackup()));
            return $prestamoBackupDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateNumber($this->prestamoId) && EntityValidator::validateString($this->prestamoEntradaBackup) && EntityValidator::validateString($this->prestamoSalidaBackup) && EntityValidator::validateNumber($this->prestamoEstudianteBackup) && EntityValidator::validateNumber($this->prestamoComputadoraBackup) && EntityValidator::validateString($this->prestamoBackupFechaBackup);
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