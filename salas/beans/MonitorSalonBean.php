<?php

    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.MONITOR_SALON_ENTITY;

    

    class MonitorSalonBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function MonitorSalonBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getMonitorSalon(MonitorSalon &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllMonitorSalons($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllMonitorSalons($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllMonitorSalons(){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_ENTRADA." LIKE '".$monitorSalonEntrada."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_ENTRADA." LIKE '".$monitorSalonEntrada."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonEntrada($monitorSalonEntrada){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_ENTRADA." LIKE '".$monitorSalonEntrada."'");

        }
        public function getMonitorSalonsByMonitorSalonSalida($monitorSalonSalida, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_SALIDA." LIKE '".$monitorSalonSalida."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonSalida($monitorSalonSalida, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_SALIDA." LIKE '".$monitorSalonSalida."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonSalida($monitorSalonSalida){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_SALIDA." LIKE '".$monitorSalonSalida."'");

        }
        public function getMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_COMENTARIOS." LIKE '".$monitorSalonComentarios."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_COMENTARIOS." LIKE '".$monitorSalonComentarios."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_COMENTARIOS." LIKE '".$monitorSalonComentarios."'");

        }
        public function getMonitorSalonsByMonitor(Monitor $monitor, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR." = '".$monitor->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitor(Monitor $monitor, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR." = '".$monitor->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitor(Monitor $monitor){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR." = '".$monitor->getId()."'");
        }

        public function getMonitorSalonsBySalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SALON." = '".$salon->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsBySalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SALON." = '".$salon->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsBySalon(Salon $salon){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->SALON." = '".$salon->getId()."'");
        }

        public function getMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_ENTRADA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_ENTRADA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonEntradaBetween($firstValue, $secondValue){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->MONITOR_SALON_ENTRADA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_SALIDA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_SALIDA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonSalidaBetween($firstValue, $secondValue){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->MONITOR_SALON_SALIDA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonComentariosBetween($firstValue, $secondValue){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->MONITOR_SALON_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getMonitorSalonsByMonitorSalonEntradaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_ENTRADA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonEntradaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_ENTRADA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonEntradaBiggerThan($value){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_ENTRADA." > '".$value."'");
        }

        public function getMonitorSalonsByMonitorSalonSalidaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_SALIDA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonSalidaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_SALIDA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonSalidaBiggerThan($value){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_SALIDA." > '".$value."'");
        }

        public function getMonitorSalonsByMonitorSalonComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonComentariosBiggerThan($value){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_COMENTARIOS." > '".$value."'");
        }

        public function getMonitorSalonsByMonitorSalonEntradaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_ENTRADA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonEntradaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_ENTRADA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonEntradaLowerThan($value){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_ENTRADA." < '".$value."'");
        }

        public function getMonitorSalonsByMonitorSalonSalidaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_SALIDA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonSalidaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_SALIDA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonSalidaLowerThan($value){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_SALIDA." < '".$value."'");
        }

        public function getMonitorSalonsByMonitorSalonComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->MONITOR_SALON_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listMonitorSalonsByMonitorSalonComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new MonitorSalon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->MONITOR_SALON_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonComentariosLowerThan($value){
            $entity = new MonitorSalon();
            return $this->persistenceManager->countAll($entity, array(), $entity->MONITOR_SALON_COMENTARIOS." < '".$value."'");
        }

        public function getMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonComentariosBeginsWith($monitorSalonComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetMonitorSalonsByMonitorSalonComentarios($monitorSalonComentarios . "%", $firstResultNumber, $numResults);
        }

        public function getMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorSalonsByMonitorSalonComentarios("%" . $monitorSalonComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorSalonsByMonitorSalonComentarios("%" . $monitorSalonComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonComentariosEndsWith($monitorSalonComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetMonitorSalonsByMonitorSalonComentarios("%" . $monitorSalonComentarios, $firstResultNumber, $numResults);
        }

        public function getMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getMonitorSalonsByMonitorSalonComentarios("%" . $monitorSalonComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listMonitorSalonsByMonitorSalonComentarios("%" . $monitorSalonComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetMonitorSalonsByMonitorSalonComentariosContains($monitorSalonComentarios){
            return $this->countGetMonitorSalonsByMonitorSalonComentarios("%" . $monitorSalonComentarios . "%");
        }

        public function updateMonitorSalonEntrada(MonitorSalon $entity,  $monitorSalonEntrada){
            $entity->setMonitorSalonEntrada($monitorSalonEntrada);
            return $this->persistenceManager->update($entity);
        }

        public function updateMonitorSalonSalida(MonitorSalon $entity,  $monitorSalonSalida){
            $entity->setMonitorSalonSalida($monitorSalonSalida);
            return $this->persistenceManager->update($entity);
        }

        public function updateMonitorSalonComentarios(MonitorSalon $entity,  $monitorSalonComentarios){
            $entity->setMonitorSalonComentarios($monitorSalonComentarios);
            return $this->persistenceManager->update($entity);
        }

        public function updateMonitor(MonitorSalon $entity, Monitor $monitor){
            $entity->setMonitor($monitor->getId());
            return $this->persistenceManager->update($entity);
        }

        public function updateSalon(MonitorSalon $entity, Salon $salon){
            $entity->setSalon($salon->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setMonitorSalon(MonitorSalon &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setMonitorSalons(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateMonitorSalon(MonitorSalon &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeMonitorSalon(MonitorSalon $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>