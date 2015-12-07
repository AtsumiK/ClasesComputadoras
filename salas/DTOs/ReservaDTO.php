<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.RESERVA_ENTITY;

    class ReservaDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "reserva";
        public static $PRIMARY_KEY_DB_NAME = "reserva_id";

        public static $ORDER_BY_RESERVA_CLASE = "reserva_clase";
        public static $ORDER_BY_RESERVA_HORA_INICIO = "reserva_hora_inicio";
        public static $ORDER_BY_RESERVA_HORA_FIN = "reserva_hora_fin";
        public static $ORDER_BY_RESERVA_RESPONSABLE = "reserva_responsable";
        public static $ORDER_BY_RESERVA_SALON = "reserva_salon";

        # Constantes públicas para soporte de interfaz

        public $RESERVA_CLASE = "RESERVA_CLASE";
        public $RESERVA_HORA_INICIO = "RESERVA_HORA_INICIO";
        public $RESERVA_HORA_FIN = "RESERVA_HORA_FIN";
        public $RESERVA_RESPONSABLE = "RESERVA_RESPONSABLE";
        public $RESERVA_SALON = "RESERVA_SALON";

        # Atributos privados estandar
        private $id;
        private $reservaClase;
        private $reservaHoraInicio;
        private $reservaHoraFin;
        private $reservaResponsable;
        private $reservaSalon;

        function ReservaDTO($id = null, $reservaClase = null, $reservaHoraInicio = null, $reservaHoraFin = null, $reservaResponsable = null, $reservaSalon = null){
            $this->id = $id;
            $this->reservaClase = $reservaClase;
            $this->reservaHoraInicio = $reservaHoraInicio;
            $this->reservaHoraFin = $reservaHoraFin;
            $this->reservaResponsable = $reservaResponsable;
            $this->reservaSalon = $reservaSalon;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getReservaClase(){
            return $this->reservaClase;
        }

        public function setReservaClase($reservaClase){
            $this->reservaClase = $reservaClase;
        }

        public function getReservaHoraInicio(){
            return $this->reservaHoraInicio;
        }

        public function setReservaHoraInicio($reservaHoraInicio){
            $this->reservaHoraInicio = $reservaHoraInicio;
        }

        public function getReservaHoraFin(){
            return $this->reservaHoraFin;
        }

        public function setReservaHoraFin($reservaHoraFin){
            $this->reservaHoraFin = $reservaHoraFin;
        }

        public function getReservaResponsable(){
            return $this->reservaResponsable;
        }

        public function setReservaResponsable($reservaResponsable){
            $this->reservaResponsable = $reservaResponsable;
        }

        public function getReservaSalon(){
            return $this->reservaSalon;
        }

        public function setReservaSalon($reservaSalon){
            $this->reservaSalon = $reservaSalon;
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
            $this->reservaClase = $entity->unscapeString($entity->getReservaClase());
            $this->reservaHoraInicio = $entity->unscapeString($entity->getReservaHoraInicio());
            $this->reservaHoraFin = $entity->unscapeString($entity->getReservaHoraFin());
            $this->reservaResponsable = $entity->unscapeString($entity->getReservaResponsable());
            $this->reservaSalon = $entity->unscapeString($entity->getReservaSalon());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new ReservaDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(ReservaDTO $reservaDTO){
            $reserva = new Reserva();
            $reserva->setId($reservaDTO->getId());
            $reserva->setReservaClase($reservaDTO->getReservaClase());
            $reserva->setReservaHoraInicio($reservaDTO->getReservaHoraInicio());
            $reserva->setReservaHoraFin($reservaDTO->getReservaHoraFin());
            $reserva->setReservaResponsable($reservaDTO->getReservaResponsable());
            $reserva->setReservaSalon($reservaDTO->getReservaSalon());
            return $reserva;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->reservaClase) && EntityValidator::validateString($this->reservaHoraInicio) && EntityValidator::validateString($this->reservaHoraFin) && EntityValidator::validateId($this->reservaResponsable) && EntityValidator::validateId($this->reservaSalon);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Reserva>";
                $xml .= "<Reserva_Id>";
                    $xml .= $this->getId();
                $xml .= "</Reserva_Id>";
                if($this->getReservaClase() !== null){
                    $xml .= "<reservaClase><![CDATA[";
                        $xml .= $this->getReservaClase();
                    $xml .= "]]></reservaClase>";
                }
                if($this->getReservaHoraInicio() !== null){
                    $xml .= "<reservaHoraInicio><![CDATA[";
                        $xml .= $this->getReservaHoraInicio();
                    $xml .= "]]></reservaHoraInicio>";
                }
                if($this->getReservaHoraFin() !== null){
                    $xml .= "<reservaHoraFin><![CDATA[";
                        $xml .= $this->getReservaHoraFin();
                    $xml .= "]]></reservaHoraFin>";
                }
                if($this->reservaResponsable !== null){
                    $xml .= "<reservaResponsable>";
                        $xml .= "<reservaResponsable_id>";
                            $xml .= $this->reservaResponsable;
                        $xml .= "</reservaResponsable_id>";
                    $xml .= "</reservaResponsable>";
                }
                if($this->reservaSalon !== null){
                    $xml .= "<reservaSalon>";
                        $xml .= "<reservaSalon_id>";
                            $xml .= $this->reservaSalon;
                        $xml .= "</reservaSalon_id>";
                    $xml .= "</reservaSalon>";
                }
            $xml .= "</Reserva>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Reserva");
            foreach ($nodes as $node) {
                $dao = new ReservaDTO();
                $data = $node->getElementsByTagName("Reserva_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("reservaClase");
                if($data->length>0 && !ReservaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setReservaClase($data);
                $data = $node->getElementsByTagName("reservaHoraInicio");
                if($data->length>0 && !ReservaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setReservaHoraInicio($data);
                $data = $node->getElementsByTagName("reservaHoraFin");
                if($data->length>0 && !ReservaDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setReservaHoraFin($data);
                $data = $node->getElementsByTagName("reservaResponsable");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setReservaResponsable($data);
                $data = $node->getElementsByTagName("reservaSalon");
                if($data->length>0 && !empty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setReservaSalon($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Reservas>";
                $xml .= $this->toXML();
            $xml .= "</Reservas>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Reservas>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Reservas>";
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