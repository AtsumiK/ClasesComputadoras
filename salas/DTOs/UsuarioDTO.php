<?php

    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once SALAS_COMP_ENTITIES_DIR.USUARIO_ENTITY;

    class UsuarioDTO {

        # Constantes públicas para soporte de base de datos

        public static $ENTITY_DB_NAME = "usuario";
        public static $PRIMARY_KEY_DB_NAME = "usuario_id";

        public static $ORDER_BY_USUARIO_LOGIN = "usuario_login";
        public static $ORDER_BY_USUARIO_CLAVE = "usuario_clave";
        public static $ORDER_BY_USUARIO_TIPO = "usuario_tipo";

        # Constantes públicas para soporte de interfaz

        public $USUARIO_LOGIN = "USUARIO_LOGIN";
        public $USUARIO_CLAVE = "USUARIO_CLAVE";
        public $USUARIO_TIPO = "USUARIO_TIPO";

        # Atributos privados estandar
        private $id;
        private $usuarioLogin;
        private $usuarioClave;
        private $usuarioTipo;

        function UsuarioDTO($id = null, $usuarioLogin = null, $usuarioClave = null, $usuarioTipo = null){
            $this->id = $id;
            $this->usuarioLogin = $usuarioLogin;
            $this->usuarioClave = $usuarioClave;
            $this->usuarioTipo = $usuarioTipo;
        }

        # Getters y setters estándares

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id=$id;
        }

        public function getUsuarioLogin(){
            return $this->usuarioLogin;
        }

        public function setUsuarioLogin($usuarioLogin){
            $this->usuarioLogin = $usuarioLogin;
        }

        public function getUsuarioClave(){
            return $this->usuarioClave;
        }

        public function setUsuarioClave($usuarioClave){
            $this->usuarioClave = $usuarioClave;
        }

        public function getUsuarioTipo(){
            return $this->usuarioTipo;
        }

        public function setUsuarioTipo($usuarioTipo){
            $this->usuarioTipo = $usuarioTipo;
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
            $this->usuarioLogin = $entity->unscapeString($entity->getUsuarioLogin());
            $this->usuarioClave = $entity->unscapeString($entity->getUsuarioClave());
            $this->usuarioTipo = $entity->unscapeString($entity->getUsuarioTipo());
        }

        public static function loadFromEntities(array $entities){
            $daos = array();
            foreach ($entities as $entity) {
                $dao = new UsuarioDTO();
                $dao->loadFromEntity($entity);
                $daos[] = $dao;
            }
            return $daos;
        }

        public static function toEntity(UsuarioDTO $usuarioDTO){
            $usuario = new Usuario();
            $usuario->setId($usuarioDTO->getId());
            $usuario->setUsuarioLogin($usuarioDTO->getUsuarioLogin());
            $usuario->setUsuarioClave($usuarioDTO->getUsuarioClave());
            $usuario->setUsuarioTipo($usuarioDTO->getUsuarioTipo());
            return $usuario;
        }

        public function isEntityValid(){
            $otherValidations = true;
            return $otherValidations && EntityValidator::validateString($this->usuarioLogin) && EntityValidator::validateString($this->usuarioClave) && EntityValidator::validateString($this->usuarioTipo);
        }
        public function toXML(){
            $xml="";
            $xml .= "<Usuario>";
                $xml .= "<Usuario_Id>";
                    $xml .= $this->getId();
                $xml .= "</Usuario_Id>";
                if($this->getUsuarioLogin() !== null){
                    $xml .= "<usuarioLogin><![CDATA[";
                        $xml .= $this->getUsuarioLogin();
                    $xml .= "]]></usuarioLogin>";
                }
                if($this->getUsuarioClave() !== null){
                    $xml .= "<usuarioClave><![CDATA[";
                        $xml .= $this->getUsuarioClave();
                    $xml .= "]]></usuarioClave>";
                }
                if($this->getUsuarioTipo() !== null){
                    $xml .= "<usuarioTipo><![CDATA[";
                        $xml .= $this->getUsuarioTipo();
                    $xml .= "]]></usuarioTipo>";
                }
            $xml .= "</Usuario>";
            return $xml;
        }
        public static function loadFromXML($xmlDaos){
            $daos = array();
            $doc = new DOMDocument('1.0', 'utf-8');
            $doc-> loadXML($xmlDaos);
            $nodes = $doc->getElementsByTagName("Usuario");
            foreach ($nodes as $node) {
                $dao = new UsuarioDTO();
                $data = $node->getElementsByTagName("Usuario_Id");
                if($data->length>0){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setId($data);
                $data = $node->getElementsByTagName("usuarioLogin");
                if($data->length>0 && !UsuarioDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setUsuarioLogin($data);
                $data = $node->getElementsByTagName("usuarioClave");
                if($data->length>0 && !UsuarioDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setUsuarioClave($data);
                $data = $node->getElementsByTagName("usuarioTipo");
                if($data->length>0 && !UsuarioDTO::isEmpty($data->item(0)->nodeValue)){
                    $data = $data->item(0)->nodeValue;
                }else{
                     $data = null;
                }
                $dao->setUsuarioTipo($data);
                $daos[] = $dao;
            }
            return $daos;
        }
        public function toXML2(){
            $xml = "<Usuarios>";
                $xml .= $this->toXML();
            $xml .= "</Usuarios>";
            return $xml;
        }
        public static function DTOsToXML(array $daos){
            $xml = "<Usuarios>";
            foreach ($daos as $dao) {
                $xml .= $dao->toXML();
            }
            $xml .= "</Usuarios>";
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