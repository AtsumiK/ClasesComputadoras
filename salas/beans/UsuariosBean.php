<?php

    require_once SALAS_COMP_ENTITIES_DIR.USUARIOS_ENTITY;

    

    class UsuariosBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function UsuariosBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getUsuarios(Usuarios &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllUsuarioses($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllUsuarioses($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllUsuarioses(){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getUsuariosesByUsuarioLogin($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioLogin($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioLogin($usuarioLogin){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."'");

        }
        public function getUsuariosesByUsuarioClave($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioClave($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioClave($usuarioClave){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'");

        }
        public function getUsuariosesByUsuarioTipo($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." LIKE '".$usuarioTipo."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioTipo($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." LIKE '".$usuarioTipo."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioTipo($usuarioTipo){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_TIPO." LIKE '".$usuarioTipo."'");

        }
        public function getUsuariosesByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioLoginBetween($firstValue, $secondValue){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->USUARIO_LOGIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getUsuariosesByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioClaveBetween($firstValue, $secondValue){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->USUARIO_CLAVE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getUsuariosesByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioTipoBetween($firstValue, $secondValue){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->USUARIO_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getUsuariosesByUsuarioLoginBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioLoginBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioLoginBiggerThan($value){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_LOGIN." > '".$value."'");
        }

        public function getUsuariosesByUsuarioClaveBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioClaveBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioClaveBiggerThan($value){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_CLAVE." > '".$value."'");
        }

        public function getUsuariosesByUsuarioTipoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioTipoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioTipoBiggerThan($value){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_TIPO." > '".$value."'");
        }

        public function getUsuariosesByUsuarioLoginLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioLoginLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioLoginLowerThan($value){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_LOGIN." < '".$value."'");
        }

        public function getUsuariosesByUsuarioClaveLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioClaveLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioClaveLowerThan($value){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_CLAVE." < '".$value."'");
        }

        public function getUsuariosesByUsuarioTipoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listUsuariosesByUsuarioTipoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Usuarios();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetUsuariosesByUsuarioTipoLowerThan($value){
            $entity = new Usuarios();
            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_TIPO." < '".$value."'");
        }

        public function getUsuariosesByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioLogin($usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioLogin($usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber = null, $numResults = null){
            return $this->countGetUsuariosesByUsuarioLogin($usuarioLogin . "%", $firstResultNumber, $numResults);
        }

        public function getUsuariosesByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioLogin("%" . $usuarioLogin, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioLogin("%" . $usuarioLogin, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber = null, $numResults = null){
            return $this->countGetUsuariosesByUsuarioLogin("%" . $usuarioLogin, $firstResultNumber, $numResults);
        }

        public function getUsuariosesByUsuarioLoginContains($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioLogin("%" . $usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioLoginContains($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioLogin("%" . $usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioLoginContains($usuarioLogin){
            return $this->countGetUsuariosesByUsuarioLogin("%" . $usuarioLogin . "%");
        }

        public function getUsuariosesByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioClave($usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioClave($usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber = null, $numResults = null){
            return $this->countGetUsuariosesByUsuarioClave($usuarioClave . "%", $firstResultNumber, $numResults);
        }

        public function getUsuariosesByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioClave("%" . $usuarioClave, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioClave("%" . $usuarioClave, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber = null, $numResults = null){
            return $this->countGetUsuariosesByUsuarioClave("%" . $usuarioClave, $firstResultNumber, $numResults);
        }

        public function getUsuariosesByUsuarioClaveContains($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioClave("%" . $usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioClaveContains($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioClave("%" . $usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioClaveContains($usuarioClave){
            return $this->countGetUsuariosesByUsuarioClave("%" . $usuarioClave . "%");
        }

        public function getUsuariosesByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioTipo($usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioTipo($usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber = null, $numResults = null){
            return $this->countGetUsuariosesByUsuarioTipo($usuarioTipo . "%", $firstResultNumber, $numResults);
        }

        public function getUsuariosesByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioTipo("%" . $usuarioTipo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioTipo("%" . $usuarioTipo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber = null, $numResults = null){
            return $this->countGetUsuariosesByUsuarioTipo("%" . $usuarioTipo, $firstResultNumber, $numResults);
        }

        public function getUsuariosesByUsuarioTipoContains($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getUsuariosesByUsuarioTipo("%" . $usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listUsuariosesByUsuarioTipoContains($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listUsuariosesByUsuarioTipo("%" . $usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetUsuariosesByUsuarioTipoContains($usuarioTipo){
            return $this->countGetUsuariosesByUsuarioTipo("%" . $usuarioTipo . "%");
        }

        public function updateUsuarioLogin(Usuarios $entity,  $usuarioLogin){
            $entity->setUsuarioLogin($usuarioLogin);
            return $this->persistenceManager->update($entity);
        }

        public function updateUsuarioClave(Usuarios $entity,  $usuarioClave){
            $entity->setUsuarioClave($usuarioClave);
            return $this->persistenceManager->update($entity);
        }

        public function updateUsuarioTipo(Usuarios $entity,  $usuarioTipo){
            $entity->setUsuarioTipo($usuarioTipo);
            return $this->persistenceManager->update($entity);
        }

        public function setUsuarios(Usuarios &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setUsuarioses(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateUsuarios(Usuarios &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeUsuarios(Usuarios $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>