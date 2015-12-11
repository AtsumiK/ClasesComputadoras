<?php

    require_once SALAS_COMP_ENTITIES_DIR.RESPONSABLE_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.RESERVA_ENTITY;

    

    class ReservaBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function ReservaBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getReserva(Reserva &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllReservas($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllReservas($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllReservas(){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getReservasByReservaClase($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_CLASE." LIKE '".$reservaClase."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaClase($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_CLASE." LIKE '".$reservaClase."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaClase($reservaClase){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_CLASE." LIKE '".$reservaClase."'");

        }
        public function getReservasByReservaHoraInicio($reservaHoraInicio, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_INICIO." LIKE '".$reservaHoraInicio."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraInicio($reservaHoraInicio, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_INICIO." LIKE '".$reservaHoraInicio."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraInicio($reservaHoraInicio){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_HORA_INICIO." LIKE '".$reservaHoraInicio."'");

        }
        public function getReservasByReservaHoraFin($reservaHoraFin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_FIN." LIKE '".$reservaHoraFin."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraFin($reservaHoraFin, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_FIN." LIKE '".$reservaHoraFin."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraFin($reservaHoraFin){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_HORA_FIN." LIKE '".$reservaHoraFin."'");

        }
        public function getReservasByReservaResponsable(Responsable $responsable, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_RESPONSABLE." = '".$responsable->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaResponsable(Responsable $responsable, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_RESPONSABLE." = '".$responsable->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaResponsable(Responsable $responsable){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_RESPONSABLE." = '".$responsable->getId()."'");
        }

        public function getReservasByReservaSalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_SALON." = '".$salon->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaSalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_SALON." = '".$salon->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaSalon(Salon $salon){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_SALON." = '".$salon->getId()."'");
        }

        public function getReservasByReservaClaseBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_CLASE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaClaseBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_CLASE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaClaseBetween($firstValue, $secondValue){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->RESERVA_CLASE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getReservasByReservaHoraInicioBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_INICIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraInicioBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_INICIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraInicioBetween($firstValue, $secondValue){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->RESERVA_HORA_INICIO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getReservasByReservaHoraFinBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_FIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraFinBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_FIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraFinBetween($firstValue, $secondValue){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->RESERVA_HORA_FIN." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getReservasByReservaClaseBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_CLASE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaClaseBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_CLASE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaClaseBiggerThan($value){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_CLASE." > '".$value."'");
        }

        public function getReservasByReservaHoraInicioBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_INICIO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraInicioBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_INICIO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraInicioBiggerThan($value){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_HORA_INICIO." > '".$value."'");
        }

        public function getReservasByReservaHoraFinBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_FIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraFinBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_FIN." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraFinBiggerThan($value){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_HORA_FIN." > '".$value."'");
        }

        public function getReservasByReservaClaseLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_CLASE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaClaseLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_CLASE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaClaseLowerThan($value){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_CLASE." < '".$value."'");
        }

        public function getReservasByReservaHoraInicioLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_INICIO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraInicioLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_INICIO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraInicioLowerThan($value){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_HORA_INICIO." < '".$value."'");
        }

        public function getReservasByReservaHoraFinLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->RESERVA_HORA_FIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listReservasByReservaHoraFinLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Reserva();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->RESERVA_HORA_FIN." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetReservasByReservaHoraFinLowerThan($value){
            $entity = new Reserva();
            return $this->persistenceManager->countAll($entity, array(), $entity->RESERVA_HORA_FIN." < '".$value."'");
        }

        public function getReservasByReservaClaseBeginsWith($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getReservasByReservaClase($reservaClase . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listReservasByReservaClaseBeginsWith($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listReservasByReservaClase($reservaClase . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetReservasByReservaClaseBeginsWith($reservaClase, $firstResultNumber = null, $numResults = null){
            return $this->countGetReservasByReservaClase($reservaClase . "%", $firstResultNumber, $numResults);
        }

        public function getReservasByReservaClaseEndsWith($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getReservasByReservaClase("%" . $reservaClase, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listReservasByReservaClaseEndsWith($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listReservasByReservaClase("%" . $reservaClase, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetReservasByReservaClaseEndsWith($reservaClase, $firstResultNumber = null, $numResults = null){
            return $this->countGetReservasByReservaClase("%" . $reservaClase, $firstResultNumber, $numResults);
        }

        public function getReservasByReservaClaseContains($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getReservasByReservaClase("%" . $reservaClase . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listReservasByReservaClaseContains($reservaClase, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listReservasByReservaClase("%" . $reservaClase . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetReservasByReservaClaseContains($reservaClase){
            return $this->countGetReservasByReservaClase("%" . $reservaClase . "%");
        }

        public function updateReservaClase(Reserva $entity,  $reservaClase){
            $entity->setReservaClase($reservaClase);
            return $this->persistenceManager->update($entity);
        }

        public function updateReservaHoraInicio(Reserva $entity,  $reservaHoraInicio){
            $entity->setReservaHoraInicio($reservaHoraInicio);
            return $this->persistenceManager->update($entity);
        }

        public function updateReservaHoraFin(Reserva $entity,  $reservaHoraFin){
            $entity->setReservaHoraFin($reservaHoraFin);
            return $this->persistenceManager->update($entity);
        }

        public function updateReservaResponsable(Reserva $entity, Responsable $reservaResponsable){
            $entity->setReservaResponsable($reservaResponsable->getId());
            return $this->persistenceManager->update($entity);
        }

        public function updateReservaSalon(Reserva $entity, Salon $reservaSalon){
            $entity->setReservaSalon($reservaSalon->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setReserva(Reserva &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setReservas(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateReserva(Reserva &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeReserva(Reserva $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>