<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_DTOS_DIR.ESTUDIANTE_DTO;

    class Estudiante {

        # Constantes públicas para soporte de base de datos

        public $ENTITY_DB_NAME = "estudiante";
        public $PRIMARY_KEY_DB_NAME = "estudiante_id";

        public $ESTUDIANTE_CODIGO = "estudiante_codigo";
        public static $ORDER_BY_ESTUDIANTE_CODIGO = "estudiante_codigo";
        public $ESTUDIANTE_FACULTAD = "estudiante_facultad";
        public static $ORDER_BY_ESTUDIANTE_FACULTAD = "estudiante_facultad";
        public $ESTUDIANTE_CARRERRA = "estudiante_carrerra";
        public static $ORDER_BY_ESTUDIANTE_CARRERRA = "estudiante_carrerra";
        public $ESTUDIANTE_PERSONA = "estudiante_persona";
        public static $ORDER_BY_ESTUDIANTE_PERSONA = "estudiante_persona";

        # Constantes privadas que indican el tamaño de los campos que son caracteres

        private $ESTUDIANTE_CODIGO_SIZE = 20;
        private $ESTUDIANTE_FACULTAD_SIZE = 20;
        private $ESTUDIANTE_CARRERRA_SIZE = 20;

        # Atributos privados estandar
        private $id;
        private $estudianteCodigo;
        private $estudianteFacultad;
        private $estudianteCarrerra;
        private $estudiantePersona;

        function Estudiante($estudianteCodigo = null, $estudianteFacultad = null, $estudianteCarrerra = null, $estudiantePersona = null){
            $this->id = null;
            $this->estudianteCodigo = $this->scapeString($estudianteCodigo);
            $this->estudianteFacultad = $this->scapeString($estudianteFacultad);
            $this->estudianteCarrerra = $this->scapeString($estudianteCarrerra);
            $this->estudiantePersona = $this->scapeString($estudiantePersona);
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getEstudianteCodigo(){
            return $this->estudianteCodigo;
        }

        public function setEstudianteCodigo($estudianteCodigo){
            if(strlen($estudianteCodigo) > $this->ESTUDIANTE_CODIGO_SIZE){;
                $this->estudianteCodigo = $this->scapeString(substr($estudianteCodigo, 0, $this->ESTUDIANTE_CODIGO_SIZE));
            }else{
                $this->estudianteCodigo = $this->scapeString($estudianteCodigo);
            }
        }

        public function getEstudianteFacultad(){
            return $this->estudianteFacultad;
        }

        public function setEstudianteFacultad($estudianteFacultad){
            if(strlen($estudianteFacultad) > $this->ESTUDIANTE_FACULTAD_SIZE){;
                $this->estudianteFacultad = $this->scapeString(substr($estudianteFacultad, 0, $this->ESTUDIANTE_FACULTAD_SIZE));
            }else{
                $this->estudianteFacultad = $this->scapeString($estudianteFacultad);
            }
        }

        public function getEstudianteCarrerra(){
            return $this->estudianteCarrerra;
        }

        public function setEstudianteCarrerra($estudianteCarrerra){
            if(strlen($estudianteCarrerra) > $this->ESTUDIANTE_CARRERRA_SIZE){;
                $this->estudianteCarrerra = $this->scapeString(substr($estudianteCarrerra, 0, $this->ESTUDIANTE_CARRERRA_SIZE));
            }else{
                $this->estudianteCarrerra = $this->scapeString($estudianteCarrerra);
            }
        }

        public function getEstudiantePersona(){
            return $this->estudiantePersona;
        }

        public function setEstudiantePersona($estudiantePersona){
            $this->estudiantePersona = $estudiantePersona;
        }


        # Métodos que dan soporte a la base de datos

        public function getExplicitDbFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CODIGO,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CARRERRA,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_PERSONA);
        }

        public function getExplicitDbFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CODIGO,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CARRERRA,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_PERSONA);
        }

        public function getDbFieldNames(){
            return array($this->ESTUDIANTE_CODIGO,$this->ESTUDIANTE_FACULTAD,$this->ESTUDIANTE_CARRERRA,$this->ESTUDIANTE_PERSONA);
        }

        public function getDbFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->ESTUDIANTE_CODIGO,$this->ESTUDIANTE_FACULTAD,$this->ESTUDIANTE_CARRERRA,$this->ESTUDIANTE_PERSONA);
        }

        public function getExplicitDbListFieldNames(){
            return array($this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CODIGO,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CARRERRA,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_PERSONA);
        }

        public function getExplicitDbListFieldNamesWithPK(){
            return array($this->ENTITY_DB_NAME.".".$this->PRIMARY_KEY_DB_NAME,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CODIGO,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_FACULTAD,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_CARRERRA,$this->ENTITY_DB_NAME.".".$this->ESTUDIANTE_PERSONA);
        }

        public function getDbListFieldNames(){
            return array($this->ESTUDIANTE_CODIGO,$this->ESTUDIANTE_FACULTAD,$this->ESTUDIANTE_CARRERRA,$this->ESTUDIANTE_PERSONA);
        }

        public function getDbListFieldNamesWithPK(){
            return array($this->PRIMARY_KEY_DB_NAME,$this->ESTUDIANTE_CODIGO,$this->ESTUDIANTE_FACULTAD,$this->ESTUDIANTE_CARRERRA,$this->ESTUDIANTE_PERSONA);
        }

        public function getDbFieldValues(){
            return array($this->getEstudianteCodigo(),$this->getEstudianteFacultad(),$this->getEstudianteCarrerra(),$this->getEstudiantePersona());
        }

        public function getDbFieldValuesWithPK(){
            return array($this->getId(),$this->getEstudianteCodigo(),$this->getEstudianteFacultad(),$this->getEstudianteCarrerra(),$this->getEstudiantePersona());
        }

        public function getDbListFieldValues(){
            return array($this->getEstudianteCodigo(),$this->getEstudianteFacultad(),$this->getEstudianteCarrerra(),$this->getEstudiantePersona());
        }

        public function getDbListFieldValuesWithPK(){
            return array($this->getId(),$this->getEstudianteCodigo(),$this->getEstudianteFacultad(),$this->getEstudianteCarrerra(),$this->getEstudiantePersona());
        }

        public function loadFromSqlResultQuery($rq){
            $this->id = $rq[$this->PRIMARY_KEY_DB_NAME];
            if(isset($rq[$this->ESTUDIANTE_CODIGO]) && !EstudianteDTO::isEmpty($rq[$this->ESTUDIANTE_CODIGO])){
                $this->estudianteCodigo = $this->scapeString($rq[$this->ESTUDIANTE_CODIGO]);
            }else{
                $this->estudianteCodigo = null;
            }
            if(isset($rq[$this->ESTUDIANTE_FACULTAD]) && !EstudianteDTO::isEmpty($rq[$this->ESTUDIANTE_FACULTAD])){
                $this->estudianteFacultad = $this->scapeString($rq[$this->ESTUDIANTE_FACULTAD]);
            }else{
                $this->estudianteFacultad = null;
            }
            if(isset($rq[$this->ESTUDIANTE_CARRERRA]) && !EstudianteDTO::isEmpty($rq[$this->ESTUDIANTE_CARRERRA])){
                $this->estudianteCarrerra = $this->scapeString($rq[$this->ESTUDIANTE_CARRERRA]);
            }else{
                $this->estudianteCarrerra = null;
            }
            if(isset($rq[$this->ESTUDIANTE_PERSONA]) && !EstudianteDTO::isEmpty($rq[$this->ESTUDIANTE_PERSONA])){
                $this->estudiantePersona = $this->scapeString($rq[$this->ESTUDIANTE_PERSONA]);
            }else{
                $this->estudiantePersona = null;
            }
        }

        public function toDTO(){
            $estudianteDTO = new EstudianteDTO();
            $estudianteDTO->setId($this->getId());
            $estudianteDTO->setEstudianteCodigo($this->unscapeString($this->getEstudianteCodigo()));
            $estudianteDTO->setEstudianteFacultad($this->unscapeString($this->getEstudianteFacultad()));
            $estudianteDTO->setEstudianteCarrerra($this->unscapeString($this->getEstudianteCarrerra()));
            $estudianteDTO->setEstudiantePersona($this->unscapeString($this->getEstudiantePersona()));
            return $estudianteDTO;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->estudianteCodigo) && EntityValidator::validateString($this->estudianteFacultad) && EntityValidator::validateString($this->estudianteCarrerra) && EntityValidator::validateId($this->estudiantePersona);
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