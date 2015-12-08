<?php

    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.OBJETO_PERDIDO_ENTITY;

    

    class ObjetoPerdidoBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function ObjetoPerdidoBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getObjetoPerdido(ObjetoPerdido &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllObjetoPerdidos($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllObjetoPerdidos($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllObjetoPerdidos(){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_ELEMENTO." LIKE '".$objetoPerdidoElemento."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_ELEMENTO." LIKE '".$objetoPerdidoElemento."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_ELEMENTO." LIKE '".$objetoPerdidoElemento."'");

        }
        public function getObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA." LIKE '".$objetoPerdidoFecha."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA." LIKE '".$objetoPerdidoFecha."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFecha($objetoPerdidoFecha){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_FECHA." LIKE '".$objetoPerdidoFecha."'");

        }
        public function getObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_CORREO." LIKE '".$objetoPerdidoCorreo."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_CORREO." LIKE '".$objetoPerdidoCorreo."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_CORREO." LIKE '".$objetoPerdidoCorreo."'");

        }
        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." LIKE '".$objetoPerdidoFechaDevolucion."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." LIKE '".$objetoPerdidoFechaDevolucion."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." LIKE '".$objetoPerdidoFechaDevolucion."'");

        }
        public function getObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_COMENTARIOS." LIKE '".$objetoPerdidoComentarios."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_COMENTARIOS." LIKE '".$objetoPerdidoComentarios."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_COMENTARIOS." LIKE '".$objetoPerdidoComentarios."'");

        }
        public function getObjetoPerdidosByObjetoPerdidoSalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_SALON." = '".$salon->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoSalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_SALON." = '".$salon->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoSalon(Salon $salon){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_SALON." = '".$salon->getId()."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_ESTUDIANTE." = '".$estudiante->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_ESTUDIANTE." = '".$estudiante->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoEstudiante(Estudiante $estudiante){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_ESTUDIANTE." = '".$estudiante->getId()."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_ELEMENTO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_ELEMENTO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoElementoBetween($firstValue, $secondValue){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->OBJETO_PERDIDO_ELEMENTO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFechaBetween($firstValue, $secondValue){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_CORREO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_CORREO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoCorreoBetween($firstValue, $secondValue){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->OBJETO_PERDIDO_CORREO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionBetween($firstValue, $secondValue){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoComentariosBetween($firstValue, $secondValue){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->OBJETO_PERDIDO_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_ELEMENTO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_ELEMENTO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoElementoBiggerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_ELEMENTO." > '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFechaBiggerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_FECHA." > '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_CORREO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_CORREO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoCorreoBiggerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_CORREO." > '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionBiggerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." > '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoComentariosBiggerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_COMENTARIOS." > '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoElementoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_ELEMENTO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoElementoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_ELEMENTO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoElementoLowerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_ELEMENTO." < '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoFechaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFechaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFechaLowerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_FECHA." < '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_CORREO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_CORREO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoCorreoLowerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_CORREO." < '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoFechaDevolucionLowerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_FECHA_DEVOLUCION." < '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->OBJETO_PERDIDO_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->OBJETO_PERDIDO_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoComentariosLowerThan($value){
            $entity = new ObjetoPerdido();
            return $this->persistenceManager->countAll($entity, array(), $entity->OBJETO_PERDIDO_COMENTARIOS." < '".$value."'");
        }

        public function getObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoElementoBeginsWith($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoPerdidosByObjetoPerdidoElemento($objetoPerdidoElemento . "%", $firstResultNumber, $numResults);
        }

        public function getObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoElemento("%" . $objetoPerdidoElemento, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoElemento("%" . $objetoPerdidoElemento, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoElementoEndsWith($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoPerdidosByObjetoPerdidoElemento("%" . $objetoPerdidoElemento, $firstResultNumber, $numResults);
        }

        public function getObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoElemento("%" . $objetoPerdidoElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoElemento("%" . $objetoPerdidoElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoElementoContains($objetoPerdidoElemento){
            return $this->countGetObjetoPerdidosByObjetoPerdidoElemento("%" . $objetoPerdidoElemento . "%");
        }

        public function getObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoCorreoBeginsWith($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoPerdidosByObjetoPerdidoCorreo($objetoPerdidoCorreo . "%", $firstResultNumber, $numResults);
        }

        public function getObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoCorreo("%" . $objetoPerdidoCorreo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoCorreo("%" . $objetoPerdidoCorreo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoCorreoEndsWith($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoPerdidosByObjetoPerdidoCorreo("%" . $objetoPerdidoCorreo, $firstResultNumber, $numResults);
        }

        public function getObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoCorreo("%" . $objetoPerdidoCorreo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoCorreo("%" . $objetoPerdidoCorreo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoCorreoContains($objetoPerdidoCorreo){
            return $this->countGetObjetoPerdidosByObjetoPerdidoCorreo("%" . $objetoPerdidoCorreo . "%");
        }

        public function getObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoComentariosBeginsWith($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoPerdidosByObjetoPerdidoComentarios($objetoPerdidoComentarios . "%", $firstResultNumber, $numResults);
        }

        public function getObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoComentarios("%" . $objetoPerdidoComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoComentarios("%" . $objetoPerdidoComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoComentariosEndsWith($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoPerdidosByObjetoPerdidoComentarios("%" . $objetoPerdidoComentarios, $firstResultNumber, $numResults);
        }

        public function getObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoPerdidosByObjetoPerdidoComentarios("%" . $objetoPerdidoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoPerdidosByObjetoPerdidoComentarios("%" . $objetoPerdidoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoPerdidosByObjetoPerdidoComentariosContains($objetoPerdidoComentarios){
            return $this->countGetObjetoPerdidosByObjetoPerdidoComentarios("%" . $objetoPerdidoComentarios . "%");
        }

        public function updateObjetoPerdidoElemento(ObjetoPerdido $entity,  $objetoPerdidoElemento){
            $entity->setObjetoPerdidoElemento($objetoPerdidoElemento);
            return $this->persistenceManager->update($entity);
        }

        public function updateObjetoPerdidoFecha(ObjetoPerdido $entity,  $objetoPerdidoFecha){
            $entity->setObjetoPerdidoFecha($objetoPerdidoFecha);
            return $this->persistenceManager->update($entity);
        }

        public function updateObjetoPerdidoCorreo(ObjetoPerdido $entity,  $objetoPerdidoCorreo){
            $entity->setObjetoPerdidoCorreo($objetoPerdidoCorreo);
            return $this->persistenceManager->update($entity);
        }

        public function updateObjetoPerdidoFechaDevolucion(ObjetoPerdido $entity,  $objetoPerdidoFechaDevolucion){
            $entity->setObjetoPerdidoFechaDevolucion($objetoPerdidoFechaDevolucion);
            return $this->persistenceManager->update($entity);
        }

        public function updateObjetoPerdidoComentarios(ObjetoPerdido $entity,  $objetoPerdidoComentarios){
            $entity->setObjetoPerdidoComentarios($objetoPerdidoComentarios);
            return $this->persistenceManager->update($entity);
        }

        public function updateObjetoPerdidoSalon(ObjetoPerdido $entity, Salon $objetoPerdidoSalon){
            $entity->setObjetoPerdidoSalon($objetoPerdidoSalon->getId());
            return $this->persistenceManager->update($entity);
        }

        public function updateObjetoPerdidoEstudiante(ObjetoPerdido $entity, Estudiante $objetoPerdidoEstudiante){
            $entity->setObjetoPerdidoEstudiante($objetoPerdidoEstudiante->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setObjetoPerdido(ObjetoPerdido &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setObjetoPerdidos(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateObjetoPerdido(ObjetoPerdido &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeObjetoPerdido(ObjetoPerdido $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>