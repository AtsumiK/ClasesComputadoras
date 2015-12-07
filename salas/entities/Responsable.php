<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.RESPONSABLE_DTO;

    class Responsable {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "responsable";
        public $PRIMARY_KEY_DB_NAME = "responsable_id";

        public $RESPONSABLE_FACULTAD = "responsable_facultad";
        public static $ORDER_BY_RESPONSABLE_FACULTAD = "responsable_facultad";
        public $RESPONSABLE_ASIGNATURA = "responsable_asignatura";
        public static $ORDER_BY_RESPONSABLE_ASIGNATURA = "responsable_asignatura";
        public $RESPONSABLE_PERSONA = "responsable_persona";
        public static $ORDER_BY_RESPONSABLE_PERSONA = "responsable_persona";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $RESPONSABLE_FACULTAD_SIZE = 20;
        private $RESPONSABLE_ASIGNATURA_SIZE = 20;

        # Atributos privados estandar
        private $id;
        private $responsableFacultad;
        private $responsableAsignatura;
        private $responsablePersona;

        function Responsable($responsableFacultad = null, $responsableAsignatura = null, $responsablePersona = null){
            $this->id = null;
            $this->responsableFacultad = $this->scapeString($responsableFacultad);
            $this->responsableAsignatura = $this->scapeString($responsableAsignatura);
            $this->responsablePersona = $this->scapeString($responsablePersona);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getResponsableFacultad(){
            return $this->responsableFacultad;
        }

        public function setResponsableFacultad($responsableFacultad){
            if(strlen($responsableFacultad) > $this->RESPONSABLE_FACULTAD_SIZE){;
                $this->responsableFacultad = $this->scapeString(substr($responsableFacultad, 0, $this->RESPONSABLE_FACULTAD_SIZE));
            }else{
                $this->responsableFacultad = $this->scapeString($responsableFacultad);
            }
        }

        public function getResponsableAsignatura(){
            return $this->responsableAsignatura;
        }

        public function setResponsableAsignatura($responsableAsignatura){
            if(strlen($responsableAsignatura) > $this->RESPONSABLE_ASIGNATURA_SIZE){;
                $this->responsableAsignatura = $this->scapeString(substr($responsableAsignatura, 0, $this->RESPONSABLE_ASIGNATURA_SIZE));
            }else{
                $this->responsableAsignatura = $this->scapeString($responsableAsignatura);
            }
        }

        public function getResponsablePersona(){
            return $this->responsablePersona;
        }

        public function setResponsablePersona($responsablePersona){
            $this->responsablePersona = $responsablePersona;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->RESPONSABLE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_ASIGNATURA,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_PERSONA);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_ASIGNATURA,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_PERSONA);
        }

        public function getDbFieldNames(){
            return array($this->RESPONSABLE_FACULTAD,$this->RESPONSABLE_ASIGNATURA,$this->RESPONSABLE_PERSONA);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->RESPONSABLE_FACULTAD,$this->RESPONSABLE_ASIGNATURA,$this->RESPONSABLE_PERSONA);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->RESPONSABLE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_ASIGNATURA,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_PERSONA);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_ASIGNATURA,$this->ENTITY_DB_NAME.".".$this->RESPONSABLE_PERSONA);
        }

        public function getDbListFieldNames(){
            return array($this->RESPONSABLE_FACULTAD,$this->RESPONSABLE_ASIGNATURA,$this->RESPONSABLE_PERSONA);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->RESPONSABLE_FACULTAD,$this->RESPONSABLE_ASIGNATURA,$this->RESPONSABLE_PERSONA);
        }

        public function getDbFieldValues(){
            return array($this->getResponsableFacultad(),$this->getResponsableAsignatura(),$this->getResponsablePersona());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getResponsableFacultad(),$this->getResponsableAsignatura(),$this->getResponsablePersona());
        }

        public function getDbListFieldValues(){
            return array($this->getResponsableFacultad(),$this->getResponsableAsignatura(),$this->getResponsablePersona());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getResponsableFacultad(),$this->getResponsableAsignatura(),$this->getResponsablePersona());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->RESPONSABLE_FACULTAD]) && !ResponsableDTO::isEmpty($rq[$this->RESPONSABLE_FACULTAD])){
                $this->responsableFacultad = $this->scapeString($rq[$this->RESPONSABLE_FACULTAD]);
            }else{
                $this->responsableFacultad = null;
            }
            if(isset($rq[$this->RESPONSABLE_ASIGNATURA]) && !ResponsableDTO::isEmpty($rq[$this->RESPONSABLE_ASIGNATURA])){
                $this->responsableAsignatura = $this->scapeString($rq[$this->RESPONSABLE_ASIGNATURA]);
            }else{
                $this->responsableAsignatura = null;
            }
            if(isset($rq[$this->RESPONSABLE_PERSONA]) && !ResponsableDTO::isEmpty($rq[$this->RESPONSABLE_PERSONA])){
                $this->responsablePersona = $this->scapeString($rq[$this->RESPONSABLE_PERSONA]);
            }else{
                $this->responsablePersona = null;
            }
        }

        public function toDTO(){
            $responsableDTO = new ResponsableDTO();
            $responsableDTO->setId($this->getId());
            $responsableDTO->setResponsableFacultad($this->unscapeString($this->getResponsableFacultad()));
            $responsableDTO->setResponsableAsignatura($this->unscapeString($this->getResponsableAsignatura()));
            $responsableDTO->setResponsablePersona($this->unscapeString($this->getResponsablePersona()));
            return $responsableDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->responsableFacultad) && EntityValidator::validateString($this->responsableAsignatura) && EntityValidator::validateId($this->responsablePersona);
        }
        /**
         * Esta función trata de prevenir el SQL Injection
         * @param $str
        */
        private function scapeString($str){
            if(!empty($str)){
                return str_replace(array("'","’"),"''",$str);
            }else{
                return $str;
            }
        }
        public function unscapeString($str){
            if(!empty($str)){
                return str_replace(array("''"),"'",$str);
            }else{
                return $str;
            }
        }
    }
?>