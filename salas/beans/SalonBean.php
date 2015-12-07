<?php

    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;

    

    class SalonBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function SalonBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getSalon(Salon &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllSalons($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllSalons($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllSalons(){
            $entity = new Salon();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getSalonsBySalonNombre($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SALON_NOMBRE." LIKE '".$salonNombre."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSalonsBySalonNombre($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SALON_NOMBRE." LIKE '".$salonNombre."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSalonsBySalonNombre($salonNombre){
            $entity = new Salon();
            return $this->persistenceManager->countAll($entity, array(), $entity->SALON_NOMBRE." LIKE '".$salonNombre."'");

        }
        public function getSalonsBySalonNombreBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SALON_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSalonsBySalonNombreBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SALON_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSalonsBySalonNombreBetween($firstValue, $secondValue){
            $entity = new Salon();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SALON_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSalonsBySalonNombreBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SALON_NOMBRE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSalonsBySalonNombreBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SALON_NOMBRE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSalonsBySalonNombreBiggerThan($value){
            $entity = new Salon();
            return $this->persistenceManager->countAll($entity, array(), $entity->SALON_NOMBRE." > '".$value."'");
        }

        public function getSalonsBySalonNombreLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SALON_NOMBRE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSalonsBySalonNombreLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Salon();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SALON_NOMBRE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSalonsBySalonNombreLowerThan($value){
            $entity = new Salon();
            return $this->persistenceManager->countAll($entity, array(), $entity->SALON_NOMBRE." < '".$value."'");
        }

        public function getSalonsBySalonNombreBeginsWith($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSalonsBySalonNombre($salonNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSalonsBySalonNombreBeginsWith($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSalonsBySalonNombre($salonNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSalonsBySalonNombreBeginsWith($salonNombre, $firstResultNumber = null, $numResults = null){
            return $this->countGetSalonsBySalonNombre($salonNombre . "%", $firstResultNumber, $numResults);
        }

        public function getSalonsBySalonNombreEndsWith($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSalonsBySalonNombre("%" . $salonNombre, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSalonsBySalonNombreEndsWith($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSalonsBySalonNombre("%" . $salonNombre, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSalonsBySalonNombreEndsWith($salonNombre, $firstResultNumber = null, $numResults = null){
            return $this->countGetSalonsBySalonNombre("%" . $salonNombre, $firstResultNumber, $numResults);
        }

        public function getSalonsBySalonNombreContains($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSalonsBySalonNombre("%" . $salonNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSalonsBySalonNombreContains($salonNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSalonsBySalonNombre("%" . $salonNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSalonsBySalonNombreContains($salonNombre){
            return $this->countGetSalonsBySalonNombre("%" . $salonNombre . "%");
        }

        public function updateSalonNombre(Salon $entity,  $salonNombre){
            $entity->setSalonNombre($salonNombre);
            return $this->persistenceManager->update($entity);
        }

        public function setSalon(Salon &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setSalons(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateSalon(Salon &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeSalon(Salon $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>