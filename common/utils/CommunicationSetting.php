<?php

    
    class CommunicationSetting {

        # Constantes públicas para soporte de interfaz

        public $PARAM_NAME = "PARAM_NAME";
        public $PARAM_VALUE = "PARAM_VALUE";

        # Atributos privados estandar
        private $id;
        private $paramName;
        private $paramValue;

        function CommunicationSetting($id = null, $paramName = null, $paramValue = null){
            $this->id = $id;
            $this->paramName = $paramName;
            $this->paramValue = $paramValue;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getParamName(){
            return $this->paramName;
        }

        public function setParamName($paramName){
            $this->paramName = $paramName;
        }

        public function getParamValue(){
            return $this->paramValue;
        }

        public function setParamValue($paramValue){
            $this->paramValue = $paramValue;
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
            $this->paramName = $entity->unscapeString($entity->getParamName());
            $this->paramValue = $entity->unscapeString($entity->getParamValue());
        }

        public function toXML(){
            $xml="";
            $xml .= "<CommunicationSetting>";
                $xml .= "<CommunicationSetting_Id>";
                    $xml .= $this->getId();
                $xml .= "</CommunicationSetting_Id>";
                $xml .= "<paramName><![CDATA[";
                    $xml .= $this->getParamName();
                $xml .= "]]></paramName>";
                $xml .= "<paramValue><![CDATA[";
                    $xml .= $this->getParamValue();
                $xml .= "]]></paramValue>";
            $xml .= "</CommunicationSetting>";
            return $xml;
        }
        public static function loadFromXML($xmlDTOs){
            $daos = array();
            if(!empty($xmlDTOs)){
            	
	            $doc = new DOMDocument('1.0', 'utf-8');
	            $doc-> loadXML($xmlDTOs);
	            $nodes = $doc->getElementsByTagName("CommunicationSetting");
	            foreach ($nodes as $node) {
	                $dao = new CommunicationSetting();
	                $data = $node->getElementsByTagName("CommunicationSetting_Id");
	                if($data->length>0){
	                    $data = $data->item(0)->nodeValue;
	                }else{
	                     $data = null;
	                }
	                $dao->setId($data);
	                $data = $node->getElementsByTagName("paramName");
	                if($data->length>0 && !CommunicationSetting::isEmpty($data->item(0)->nodeValue)){
	                    $data = $data->item(0)->nodeValue;
	                }else{
	                     $data = null;
	                }
	                $dao->setParamName($data);
	                $data = $node->getElementsByTagName("paramValue");
	                if($data->length>0 && !CommunicationSetting::isEmpty($data->item(0)->nodeValue)){
	                    $data = $data->item(0)->nodeValue;
	                }else{
	                     $data = null;
	                }
	                $dao->setParamValue($data);
	                $daos[] = $dao;
            	
	            }   
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<CommunicationSettings>";
                $xml .= $this->toXML();
            $xml .= "</CommunicationSettings>";
            return $xml;
        }
        public static function DTOsToXML(array $dtos){
            $xml = "<CommunicationSettings>";
            foreach ($dtos as $dto) {
                $xml .= $dto->toXML();
            }
            $xml .= "</CommunicationSettings>";
            return $xml;
        }
        
        /**
         * Esta función retorna true si la cadena es vacía
         * @param $str
        */
        public static function isEmpty($str){
            return $str == "";
        }
        
        final static function findValueByKey($csArray, $key){
        	foreach ($csArray as $cs) {
        		if($cs->getParamName() === $key){
        			return $cs->getParamValue();
        		}
        	}
        	return null;
        }
    }
?>