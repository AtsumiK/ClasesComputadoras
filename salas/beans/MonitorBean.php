<?php

    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_ENTITY;

    

    class MonitorBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function MonitorBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getMonitor(Monitor &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllMonitors($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllMonitors($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllMonitors(){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getMonitorsByMonitorTipo($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_TIPO." LIKE '".$monitorTipo."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorTipo($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_TIPO." LIKE '".$monitorTipo."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorTipo($monitorTipo){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_TIPO." LIKE '".$monitorTipo."'");

        }
        public function getMonitorsByMonitorHorario($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_HORARIO." LIKE '".$monitorHorario."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorHorario($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_HORARIO." LIKE '".$monitorHorario."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorHorario($monitorHorario){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_HORARIO." LIKE '".$monitorHorario."'");

        }
        public function getMonitorsByMonitorEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_ESTUDIANTE." = '".$estudiante->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_ESTUDIANTE." = '".$estudiante->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorEstudiante(Estudiante $estudiante){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_ESTUDIANTE." = '".$estudiante->getId()."'");
        }

        public function getMonitorsByMonitorTipoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorTipoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorTipoBetween($firstValue, $secondValue){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->MONITOR_TIPO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getMonitorsByMonitorHorarioBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_HORARIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorHorarioBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_HORARIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorHorarioBetween($firstValue, $secondValue){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->MONITOR_HORARIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getMonitorsByMonitorTipoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_TIPO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorTipoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_TIPO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorTipoBiggerThan($value){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_TIPO." > '".$value."'");
        }

        public function getMonitorsByMonitorHorarioBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_HORARIO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorHorarioBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_HORARIO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorHorarioBiggerThan($value){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_HORARIO." > '".$value."'");
        }

        public function getMonitorsByMonitorTipoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_TIPO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorTipoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_TIPO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorTipoLowerThan($value){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_TIPO." < '".$value."'");
        }

        public function getMonitorsByMonitorHorarioLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_HORARIO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorsByMonitorHorarioLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Monitor();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_HORARIO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorsByMonitorHorarioLowerThan($value){
            $entity = new Monitor();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_HORARIO." < '".$value."'");
        }

        public function getMonitorsByMonitorTipoBeginsWith($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorsByMonitorTipo($monitorTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorsByMonitorTipoBeginsWith($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorsByMonitorTipo($monitorTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorsByMonitorTipoBeginsWith($monitorTipo, $firstResultNumber = null, $numResults = null){
            return $this->countGetMonitorsByMonitorTipo($monitorTipo . "%", $firstResultNumber, $numResults);
        }

        public function getMonitorsByMonitorTipoEndsWith($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorsByMonitorTipo("%" . $monitorTipo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorsByMonitorTipoEndsWith($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorsByMonitorTipo("%" . $monitorTipo, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorsByMonitorTipoEndsWith($monitorTipo, $firstResultNumber = null, $numResults = null){
            return $this->countGetMonitorsByMonitorTipo("%" . $monitorTipo, $firstResultNumber, $numResults);
        }

        public function getMonitorsByMonitorTipoContains($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorsByMonitorTipo("%" . $monitorTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorsByMonitorTipoContains($monitorTipo, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorsByMonitorTipo("%" . $monitorTipo . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorsByMonitorTipoContains($monitorTipo){
            return $this->countGetMonitorsByMonitorTipo("%" . $monitorTipo . "%");
        }

        public function getMonitorsByMonitorHorarioBeginsWith($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorsByMonitorHorario($monitorHorario . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorsByMonitorHorarioBeginsWith($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorsByMonitorHorario($monitorHorario . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorsByMonitorHorarioBeginsWith($monitorHorario, $firstResultNumber = null, $numResults = null){
            return $this->countGetMonitorsByMonitorHorario($monitorHorario . "%", $firstResultNumber, $numResults);
        }

        public function getMonitorsByMonitorHorarioEndsWith($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorsByMonitorHorario("%" . $monitorHorario, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorsByMonitorHorarioEndsWith($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorsByMonitorHorario("%" . $monitorHorario, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorsByMonitorHorarioEndsWith($monitorHorario, $firstResultNumber = null, $numResults = null){
            return $this->countGetMonitorsByMonitorHorario("%" . $monitorHorario, $firstResultNumber, $numResults);
        }

        public function getMonitorsByMonitorHorarioContains($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorsByMonitorHorario("%" . $monitorHorario . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorsByMonitorHorarioContains($monitorHorario, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorsByMonitorHorario("%" . $monitorHorario . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorsByMonitorHorarioContains($monitorHorario){
            return $this->countGetMonitorsByMonitorHorario("%" . $monitorHorario . "%");
        }

        public function updateMonitorTipo(Monitor $entity,  $monitorTipo){
            $entity->setMonitorTipo($monitorTipo);
            return $this->persistenceManager->update($entity);
        }

        public function updateMonitorHorario(Monitor $entity,  $monitorHorario){
            $entity->setMonitorHorario($monitorHorario);
            return $this->persistenceManager->update($entity);
        }

        public function updateMonitorEstudiante(Monitor $entity, Estudiante $monitorEstudiante){
            $entity->setMonitorEstudiante($monitorEstudiante->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setMonitor(Monitor &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setMonitors(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateMonitor(Monitor &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeMonitor(Monitor $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>