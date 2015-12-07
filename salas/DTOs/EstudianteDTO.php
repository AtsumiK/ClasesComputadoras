<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;

    class EstudianteDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "estudiante";
        public static $PRIMARY_KEY_DB_NAME = "estudiante_id";

        public static $ORDER_BY_ESTUDIANTE_CODIGO = "estudiante_codigo";
        public static $ORDER_BY_ESTUDIANTE_FACULTAD = "estudiante_facultad";
        public static $ORDER_BY_ESTUDIANTE_CARRERRA = "estudiante_carrerra";
        public static $ORDER_BY_ESTUDIANTE_PERSONA = "estudiante_persona";

        # Constantes públicas para soporte de interfaz

        public $ESTUDIANTE_CODIGO = "ESTUDIANTE_CODIGO";
        public $ESTUDIANTE_FACULTAD = "ESTUDIANTE_FACULTAD";
        public $ESTUDIANTE_CARRERRA = "ESTUDIANTE_CARRERRA";
        public $ESTUDIANTE_PERSONA = "ESTUDIANTE_PERSONA";

        # Atributos privados estandar
        private $id;
        private $estudianteCodigo;
        private $estudianteFacultad;
        private $estudianteCarrerra;
        private $estudiantePersona;

        function EstudianteDTO($id = null, $estudianteCodigo = null, $estudianteFacultad = null, $estudianteCarrerra = null, $estudiantePersona = null){
            $this->id = $id;
            $this->estudianteCodigo = $estudianteCodigo;
            $this->estudianteFacultad = $estudianteFacultad;
            $this->estudianteCarrerra = $estudianteCarrerra;
            $this->estudiantePersona = $estudiantePersona;
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
            $this->estudianteCodigo = $estudianteCodigo;
        }

        public function getEstudianteFacultad(){
            return $this->estudianteFacultad;
        }

        public function setEstudianteFacultad($estudianteFacultad){
            $this->estudianteFacultad = $estudianteFacultad;
        }

        public function getEstudianteCarrerra(){
            return $this->estudianteCarrerra;
        }

        public function setEstudianteCarrerra($estudianteCarrerra){
            $this->estudianteCarrerra = $estudianteCarrerra;
        }

        public function getEstudiantePersona(){
            return $this->estudiantePersona;
        }

        public function setEstudiantePersona($estudiantePersona){
            $this->estudiantePersona = $estudiantePersona;
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
            $this->estudianteCodigo = $entity->unscapeString($entity->getEstudianteCodigo());
            $this->estudianteFacultad = $entity->unscapeString($entity->getEstudianteFacultad());
            $this->estudianteCarrerra = $entity->unscapeString($entity->getEstudianteCarrerra());
            $this->estudiantePersona = $entity->unscapeString($entity->getEstudiantePersona());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new EstudianteDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(EstudianteDTO $estudianteDTO){
            $estudiante = new Estudiante();
            $estudiante->setId($estudianteDTO->getId());
            $estudiante->setEstudianteCodigo($estudianteDTO->getEstudianteCodigo());
            $estudiante->setEstudianteFacultad($estudianteDTO->getEstudianteFacultad());
            $estudiante->setEstudianteCarrerra($estudianteDTO->getEstudianteCarrerra());
            $estudiante->setEstudiantePersona($estudianteDTO->getEstudiantePersona());
            return $estudiante;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->estudianteCodigo) && EntityValidator::validateString($this->estudianteFacultad) && EntityValidator::validateString($this->estudianteCarrerra) && EntityValidator::validateId($this->estudiantePersona);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Estudiante>";
                $xml .= "<Estudiante_Id>";
                    $xml .= $this->getId();
                $xml .= "</Estudiante_Id>";
                if($this->getEstudianteCodigo() !== null){
                    $xml .= "<estudianteCodigo><![CDATA[";
                        $xml .= $this->getEstudianteCodigo();
                    $xml .= "]]></estudianteCodigo>";
                }
                if($this->getEstudianteFacultad() !== null){
                    $xml .= "<estudianteFacultad><![CDATA[";
                        $xml .= $this->getEstudianteFacultad();
                    $xml .= "]]></estudianteFacultad>";
                }
                if($this->getEstudianteCarrerra() !== null){
                    $xml .= "<estudianteCarrerra><![CDATA[";
                        $xml .= $this->getEstudianteCarrerra();
                    $xml .= "]]></estudianteCarrerra>";
                }
                if($this->estudiantePersona !== null){
                    $xml .= "<estudiantePersona>";
                        $xml .= "<estudiantePersona_id>";
                            $xml .= $this->estudiantePersona;
                        $xml .= "</estudiantePersona_id>";
                    $xml .= "</estudiantePersona>";
                }
            $xml .= "</Estudiante>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Estudiante");
            foreach ($nodes as $node) {
                $dao = new EstudianteDTO();
                $data = $node->getElementsByTagName("Estudiante_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("estudianteCodigo");
                if($data->length>0 && !EstudianteDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setEstudianteCodigo($data);
                $data = $node->getElementsByTagName("estudianteFacultad");
                if($data->length>0 && !EstudianteDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setEstudianteFacultad($data);
                $data = $node->getElementsByTagName("estudianteCarrerra");
                if($data->length>0 && !EstudianteDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setEstudianteCarrerra($data);
                $data = $node->getElementsByTagName("estudiantePersona");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setEstudiantePersona($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Estudiantes>";
                $xml .= $this->toXML();
            $xml .= "</Estudiantes>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Estudiantes>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Estudiantes>";
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