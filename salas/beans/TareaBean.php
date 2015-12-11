<?php

    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.TAREA_ENTITY;

    

    class TareaBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function TareaBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getTarea(Tarea &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllTareas($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllTareas($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllTareas(){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getTareasByTareaDescripcion($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_DESCRIPCION." LIKE '".$tareaDescripcion."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaDescripcion($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_DESCRIPCION." LIKE '".$tareaDescripcion."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaDescripcion($tareaDescripcion){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_DESCRIPCION." LIKE '".$tareaDescripcion."'");

        }
        public function getTareasByTareaComentarios($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_COMENTARIOS." LIKE '".$tareaComentarios."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaComentarios($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_COMENTARIOS." LIKE '".$tareaComentarios."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaComentarios($tareaComentarios){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_COMENTARIOS." LIKE '".$tareaComentarios."'");

        }
        public function getTareasByTareaFechaInicio($tareaFechaInicio, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_INICIO." LIKE '".$tareaFechaInicio."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaInicio($tareaFechaInicio, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_INICIO." LIKE '".$tareaFechaInicio."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaInicio($tareaFechaInicio){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_FECHA_INICIO." LIKE '".$tareaFechaInicio."'");

        }
        public function getTareasByTareaFechaFin($tareaFechaFin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_FIN." LIKE '".$tareaFechaFin."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaFin($tareaFechaFin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_FIN." LIKE '".$tareaFechaFin."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaFin($tareaFechaFin){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_FECHA_FIN." LIKE '".$tareaFechaFin."'");

        }
        public function getTareasByTareaMonitor(Monitor $monitor, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_MONITOR." = '".$monitor->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaMonitor(Monitor $monitor, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_MONITOR." = '".$monitor->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaMonitor(Monitor $monitor){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_MONITOR." = '".$monitor->getId()."'");
        }

        public function getTareasByTareaDescripcionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_DESCRIPCION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaDescripcionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_DESCRIPCION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaDescripcionBetween($firstValue, $secondValue){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->TAREA_DESCRIPCION." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getTareasByTareaComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaComentariosBetween($firstValue, $secondValue){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->TAREA_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getTareasByTareaFechaInicioBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_INICIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaInicioBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_INICIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaInicioBetween($firstValue, $secondValue){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->TAREA_FECHA_INICIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getTareasByTareaFechaFinBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_FIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaFinBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_FIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaFinBetween($firstValue, $secondValue){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->TAREA_FECHA_FIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getTareasByTareaDescripcionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_DESCRIPCION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaDescripcionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_DESCRIPCION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaDescripcionBiggerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_DESCRIPCION." > '".$value."'");
        }

        public function getTareasByTareaComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaComentariosBiggerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_COMENTARIOS." > '".$value."'");
        }

        public function getTareasByTareaFechaInicioBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_INICIO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaInicioBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_INICIO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaInicioBiggerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_FECHA_INICIO." > '".$value."'");
        }

        public function getTareasByTareaFechaFinBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_FIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaFinBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_FIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaFinBiggerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_FECHA_FIN." > '".$value."'");
        }

        public function getTareasByTareaDescripcionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_DESCRIPCION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaDescripcionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_DESCRIPCION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaDescripcionLowerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_DESCRIPCION." < '".$value."'");
        }

        public function getTareasByTareaComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaComentariosLowerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_COMENTARIOS." < '".$value."'");
        }

        public function getTareasByTareaFechaInicioLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_INICIO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaInicioLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_INICIO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaInicioLowerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_FECHA_INICIO." < '".$value."'");
        }

        public function getTareasByTareaFechaFinLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->TAREA_FECHA_FIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listTareasByTareaFechaFinLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Tarea();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->TAREA_FECHA_FIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetTareasByTareaFechaFinLowerThan($value){
            $entity = new Tarea();
            return $this->persistenceManager->countAll($entity, array(), $entity->TAREA_FECHA_FIN." < '".$value."'");
        }

        public function getTareasByTareaDescripcionBeginsWith($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getTareasByTareaDescripcion($tareaDescripcion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listTareasByTareaDescripcionBeginsWith($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listTareasByTareaDescripcion($tareaDescripcion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetTareasByTareaDescripcionBeginsWith($tareaDescripcion, $firstResultNumber = null, $numResults = null){
            return $this->countGetTareasByTareaDescripcion($tareaDescripcion . "%", $firstResultNumber, $numResults);
        }

        public function getTareasByTareaDescripcionEndsWith($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getTareasByTareaDescripcion("%" . $tareaDescripcion, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listTareasByTareaDescripcionEndsWith($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listTareasByTareaDescripcion("%" . $tareaDescripcion, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetTareasByTareaDescripcionEndsWith($tareaDescripcion, $firstResultNumber = null, $numResults = null){
            return $this->countGetTareasByTareaDescripcion("%" . $tareaDescripcion, $firstResultNumber, $numResults);
        }

        public function getTareasByTareaDescripcionContains($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getTareasByTareaDescripcion("%" . $tareaDescripcion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listTareasByTareaDescripcionContains($tareaDescripcion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listTareasByTareaDescripcion("%" . $tareaDescripcion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetTareasByTareaDescripcionContains($tareaDescripcion){
            return $this->countGetTareasByTareaDescripcion("%" . $tareaDescripcion . "%");
        }

        public function getTareasByTareaComentariosBeginsWith($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getTareasByTareaComentarios($tareaComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listTareasByTareaComentariosBeginsWith($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listTareasByTareaComentarios($tareaComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetTareasByTareaComentariosBeginsWith($tareaComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetTareasByTareaComentarios($tareaComentarios . "%", $firstResultNumber, $numResults);
        }

        public function getTareasByTareaComentariosEndsWith($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getTareasByTareaComentarios("%" . $tareaComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listTareasByTareaComentariosEndsWith($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listTareasByTareaComentarios("%" . $tareaComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetTareasByTareaComentariosEndsWith($tareaComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetTareasByTareaComentarios("%" . $tareaComentarios, $firstResultNumber, $numResults);
        }

        public function getTareasByTareaComentariosContains($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getTareasByTareaComentarios("%" . $tareaComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listTareasByTareaComentariosContains($tareaComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listTareasByTareaComentarios("%" . $tareaComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetTareasByTareaComentariosContains($tareaComentarios){
            return $this->countGetTareasByTareaComentarios("%" . $tareaComentarios . "%");
        }

        public function updateTareaDescripcion(Tarea $entity,  $tareaDescripcion){
            $entity->setTareaDescripcion($tareaDescripcion);
            return $this->persistenceManager->update($entity);
        }

        public function updateTareaComentarios(Tarea $entity,  $tareaComentarios){
            $entity->setTareaComentarios($tareaComentarios);
            return $this->persistenceManager->update($entity);
        }

        public function updateTareaFechaInicio(Tarea $entity,  $tareaFechaInicio){
            $entity->setTareaFechaInicio($tareaFechaInicio);
            return $this->persistenceManager->update($entity);
        }

        public function updateTareaFechaFin(Tarea $entity,  $tareaFechaFin){
            $entity->setTareaFechaFin($tareaFechaFin);
            return $this->persistenceManager->update($entity);
        }

        public function updateTareaMonitor(Tarea $entity, Monitor $tareaMonitor){
            $entity->setTareaMonitor($tareaMonitor->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setTarea(Tarea &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setTareas(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateTarea(Tarea &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeTarea(Tarea $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>