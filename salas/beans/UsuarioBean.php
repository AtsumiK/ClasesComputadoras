<?php



    require_once SALAS_COMP_ENTITIES_DIR.USUARIO_ENTITY;







    class UsuarioBean {



        # Clase que se encarga de la persistencia

        private $persistenceManager;



        function UsuarioBean(PersistenceManager $persistenceManager){

            $this->persistenceManager = $persistenceManager;

        }



        # Método para conseguir la entidad dado su id primario

        public function getUsuario(Usuario &$entity){

            return $this->persistenceManager->find($entity);

        }



        # Método para conseguir todas las entidades del sistema

        public function getAllUsuarios($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        # Método para listar todas las entidades del sistema

        public function listAllUsuarios($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        # Método para contar todas las entidades del sistema

        public function countAllUsuarios(){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), "TRUE");

        }



        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos



        public function getUsuariosByUsuarioLogin($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLogin($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLogin($usuarioLogin){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."'");



        }

        public function getUsuariosByUsuarioClave($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioClave($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioClave($usuarioClave){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'");



        }

        public function getUsuariosByUsuarioTipo($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." LIKE '".$usuarioTipo."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioTipo($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." LIKE '".$usuarioTipo."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioTipo($usuarioTipo){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_TIPO." LIKE '".$usuarioTipo."'");



        }

        public function getUsuariosByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLoginBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLoginBetween($firstValue, $secondValue){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array("*"), $entity->USUARIO_LOGIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ");

        }



        public function getUsuariosByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioClaveBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioClaveBetween($firstValue, $secondValue){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array("*"), $entity->USUARIO_CLAVE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");

        }



        public function getUsuariosByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioTipoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioTipoBetween($firstValue, $secondValue){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array("*"), $entity->USUARIO_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");

        }



        public function getUsuariosByUsuarioLoginBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLoginBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLoginBiggerThan($value){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_LOGIN." > '".$value."'");

        }



        public function getUsuariosByUsuarioClaveBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioClaveBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioClaveBiggerThan($value){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_CLAVE." > '".$value."'");

        }



        public function getUsuariosByUsuarioTipoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioTipoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioTipoBiggerThan($value){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_TIPO." > '".$value."'");

        }



        public function getUsuariosByUsuarioLoginLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_LOGIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLoginLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_LOGIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLoginLowerThan($value){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_LOGIN." < '".$value."'");

        }



        public function getUsuariosByUsuarioClaveLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_CLAVE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioClaveLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_CLAVE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioClaveLowerThan($value){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_CLAVE." < '".$value."'");

        }



        public function getUsuariosByUsuarioTipoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), $entity->USUARIO_TIPO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioTipoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->USUARIO_TIPO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioTipoLowerThan($value){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), $entity->USUARIO_TIPO." < '".$value."'");

        }



        public function getUsuariosByUsuarioLoginAndUsuarioClave( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), "".$entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."' AND ".$entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLoginAndUsuarioClave( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "".$entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."' AND ".$entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLoginAndUsuarioClave( $usuarioLogin, $usuarioClave){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), "".$entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."' AND ".$entity->USUARIO_CLAVE." LIKE '".$usuarioClave."'");

        }



        public function getUsuariosByUsuarioLoginAndUsuarioClaveBeginsWith( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), "".$entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."%' AND ".$entity->USUARIO_CLAVE." LIKE '".$usuarioClave."%'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLoginAndUsuarioClaveBeginsWith( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "".$entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."%' AND ".$entity->USUARIO_CLAVE." LIKE '".$usuarioClave."%'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLoginAndUsuarioClaveBeginsWith( $usuarioLogin, $usuarioClave){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), "".$entity->USUARIO_LOGIN." LIKE '".$usuarioLogin."%' AND ".$entity->USUARIO_CLAVE." LIKE '".$usuarioClave."%'");

        }



        public function getUsuariosByUsuarioLoginAndUsuarioClaveEndsWith( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), "".$entity->USUARIO_LOGIN." LIKE '%".$usuarioLogin."' AND ".$entity->USUARIO_CLAVE." LIKE '%".$usuarioClave."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLoginAndUsuarioClaveEndsWith( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "".$entity->USUARIO_LOGIN." LIKE '%".$usuarioLogin."' AND ".$entity->USUARIO_CLAVE." LIKE '%".$usuarioClave."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLoginAndUsuarioClaveEndsWith( $usuarioLogin, $usuarioClave){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), "".$entity->USUARIO_LOGIN." LIKE '%".$usuarioLogin."' AND ".$entity->USUARIO_CLAVE." LIKE '%".$usuarioClave."'");

        }



        public function getUsuariosByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioLogin($usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioLogin($usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioLoginBeginsWith($usuarioLogin, $firstResultNumber = null, $numResults = null){

            return $this->countGetUsuariosByUsuarioLogin($usuarioLogin . "%", $firstResultNumber, $numResults);

        }



        public function getUsuariosByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioLogin("%" . $usuarioLogin, $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioLogin("%" . $usuarioLogin, $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioLoginEndsWith($usuarioLogin, $firstResultNumber = null, $numResults = null){

            return $this->countGetUsuariosByUsuarioLogin("%" . $usuarioLogin, $firstResultNumber, $numResults);

        }



        public function getUsuariosByUsuarioLoginContains($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioLogin("%" . $usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioLoginContains($usuarioLogin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioLogin("%" . $usuarioLogin . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioLoginContains($usuarioLogin){

            return $this->countGetUsuariosByUsuarioLogin("%" . $usuarioLogin . "%");

        }



        public function getUsuariosByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioClave($usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioClave($usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioClaveBeginsWith($usuarioClave, $firstResultNumber = null, $numResults = null){

            return $this->countGetUsuariosByUsuarioClave($usuarioClave . "%", $firstResultNumber, $numResults);

        }



        public function getUsuariosByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioClave("%" . $usuarioClave, $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioClave("%" . $usuarioClave, $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioClaveEndsWith($usuarioClave, $firstResultNumber = null, $numResults = null){

            return $this->countGetUsuariosByUsuarioClave("%" . $usuarioClave, $firstResultNumber, $numResults);

        }



        public function getUsuariosByUsuarioClaveContains($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioClave("%" . $usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioClaveContains($usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioClave("%" . $usuarioClave . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioClaveContains($usuarioClave){

            return $this->countGetUsuariosByUsuarioClave("%" . $usuarioClave . "%");

        }



        public function getUsuariosByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioTipo($usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioTipo($usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioTipoBeginsWith($usuarioTipo, $firstResultNumber = null, $numResults = null){

            return $this->countGetUsuariosByUsuarioTipo($usuarioTipo . "%", $firstResultNumber, $numResults);

        }



        public function getUsuariosByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioTipo("%" . $usuarioTipo, $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioTipo("%" . $usuarioTipo, $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioTipoEndsWith($usuarioTipo, $firstResultNumber = null, $numResults = null){

            return $this->countGetUsuariosByUsuarioTipo("%" . $usuarioTipo, $firstResultNumber, $numResults);

        }



        public function getUsuariosByUsuarioTipoContains($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->getUsuariosByUsuarioTipo("%" . $usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function listUsuariosByUsuarioTipoContains($usuarioTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            return $this->listUsuariosByUsuarioTipo("%" . $usuarioTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);

        }



        public function countGetUsuariosByUsuarioTipoContains($usuarioTipo){

            return $this->countGetUsuariosByUsuarioTipo("%" . $usuarioTipo . "%");

        }



        public function getUsuariosByUsuarioLoginAndUsuarioClaveContains( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, array("*"), "".$entity->USUARIO_LOGIN." LIKE '%".$usuarioLogin."%' AND ".$entity->USUARIO_CLAVE." LIKE '%".$usuarioClave."%'",$orderBy, $orderPriority , $firstResultNumber,$numResults);

        }



        public function listUsuariosByUsuarioLoginAndUsuarioClaveContains( $usuarioLogin, $usuarioClave, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            $entity = new Usuario();

            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "".$entity->USUARIO_LOGIN." LIKE '%".$usuarioLogin."%' AND ".$entity->USUARIO_CLAVE." LIKE '%".$usuarioClave."%'", $orderBy, $orderPriority, $firstResultNumber,$numResults);

        }



        public function countGetUsuariosByUsuarioLoginAndUsuarioClaveContains( $usuarioLogin, $usuarioClave){

            $entity = new Usuario();

            return $this->persistenceManager->countAll($entity, array(), "".$entity->USUARIO_LOGIN." LIKE '%".$usuarioLogin."%' AND ".$entity->USUARIO_CLAVE." LIKE '%".$usuarioClave."%'");

        }



        public function updateUsuarioLogin(Usuario $entity,  $usuarioLogin){

            $entity->setUsuarioLogin($usuarioLogin);

            return $this->persistenceManager->update($entity);

        }



        public function updateUsuarioClave(Usuario $entity,  $usuarioClave){

            $entity->setUsuarioClave($usuarioClave);

            return $this->persistenceManager->update($entity);

        }



        public function updateUsuarioTipo(Usuario $entity,  $usuarioTipo){

            $entity->setUsuarioTipo($usuarioTipo);

            return $this->persistenceManager->update($entity);

        }



        public function setUsuario(Usuario &$entity){

            return $this->persistenceManager->save($entity);

        }



        public function setUsuarios(array &$entities){

            return $this->persistenceManager->saveAll($entities);

        }



        public function updateUsuario(Usuario &$entity){

            return $this->persistenceManager->update($entity);

        }



        public function removeUsuario(Usuario $entity){

            return $this->persistenceManager->remove($entity);

        }





    }



?>
