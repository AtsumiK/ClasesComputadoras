<?php

    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.PRESTAMO_ENTITY;

    

    class PrestamoBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function PrestamoBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getPrestamo(Prestamo &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllPrestamos($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllPrestamos($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllPrestamos(){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getPrestamosByPrestamoEntrada($prestamoEntrada, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA." LIKE '".$prestamoEntrada."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoEntrada($prestamoEntrada, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA." LIKE '".$prestamoEntrada."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoEntrada($prestamoEntrada){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ENTRADA." LIKE '".$prestamoEntrada."'");

        }
        public function getPrestamosByPrestamoSalida($prestamoSalida, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA." LIKE '".$prestamoSalida."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoSalida($prestamoSalida, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA." LIKE '".$prestamoSalida."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoSalida($prestamoSalida){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_SALIDA." LIKE '".$prestamoSalida."'");

        }
        public function getPrestamosByPrestamoComentarios($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS." LIKE '".$prestamoComentarios."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoComentarios($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS." LIKE '".$prestamoComentarios."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoComentarios($prestamoComentarios){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMENTARIOS." LIKE '".$prestamoComentarios."'");

        }
        public function getPrestamosByPrestamoEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ESTUDIANTE." = '".$estudiante->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoEstudiante(Estudiante $estudiante, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ESTUDIANTE." = '".$estudiante->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoEstudiante(Estudiante $estudiante){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ESTUDIANTE." = '".$estudiante->getId()."'");
        }

        public function getPrestamosByPrestamoComputadora(Computadora $computadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMPUTADORA." = '".$computadora->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoComputadora(Computadora $computadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMPUTADORA." = '".$computadora->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoComputadora(Computadora $computadora){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMPUTADORA." = '".$computadora->getId()."'");
        }

        public function getPrestamosByPrestamoEntradaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoEntradaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoEntradaBetween($firstValue, $secondValue){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_ENTRADA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamosByPrestamoSalidaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoSalidaBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoSalidaBetween($firstValue, $secondValue){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_SALIDA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamosByPrestamoComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoComentariosBetween($firstValue, $secondValue){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamosByPrestamoEntradaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoEntradaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoEntradaBiggerThan($value){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ENTRADA." > '".$value."'");
        }

        public function getPrestamosByPrestamoSalidaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoSalidaBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoSalidaBiggerThan($value){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_SALIDA." > '".$value."'");
        }

        public function getPrestamosByPrestamoComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoComentariosBiggerThan($value){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMENTARIOS." > '".$value."'");
        }

        public function getPrestamosByPrestamoEntradaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoEntradaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoEntradaLowerThan($value){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ENTRADA." < '".$value."'");
        }

        public function getPrestamosByPrestamoSalidaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoSalidaLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoSalidaLowerThan($value){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_SALIDA." < '".$value."'");
        }

        public function getPrestamosByPrestamoComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamosByPrestamoComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Prestamo();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamosByPrestamoComentariosLowerThan($value){
            $entity = new Prestamo();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMENTARIOS." < '".$value."'");
        }

        public function getPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPrestamosByPrestamoComentarios($prestamoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPrestamosByPrestamoComentarios($prestamoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetPrestamosByPrestamoComentarios($prestamoComentarios . "%", $firstResultNumber, $numResults);
        }

        public function getPrestamosByPrestamoComentariosEndsWith($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPrestamosByPrestamoComentarios("%" . $prestamoComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPrestamosByPrestamoComentariosEndsWith($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPrestamosByPrestamoComentarios("%" . $prestamoComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPrestamosByPrestamoComentariosEndsWith($prestamoComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetPrestamosByPrestamoComentarios("%" . $prestamoComentarios, $firstResultNumber, $numResults);
        }

        public function getPrestamosByPrestamoComentariosContains($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPrestamosByPrestamoComentarios("%" . $prestamoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPrestamosByPrestamoComentariosContains($prestamoComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPrestamosByPrestamoComentarios("%" . $prestamoComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPrestamosByPrestamoComentariosContains($prestamoComentarios){
            return $this->countGetPrestamosByPrestamoComentarios("%" . $prestamoComentarios . "%");
        }

        public function updatePrestamoEntrada(Prestamo $entity,  $prestamoEntrada){
            $entity->setPrestamoEntrada($prestamoEntrada);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoSalida(Prestamo $entity,  $prestamoSalida){
            $entity->setPrestamoSalida($prestamoSalida);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoComentarios(Prestamo $entity,  $prestamoComentarios){
            $entity->setPrestamoComentarios($prestamoComentarios);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoEstudiante(Prestamo $entity, Estudiante $prestamoEstudiante){
            $entity->setPrestamoEstudiante($prestamoEstudiante->getId());
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoComputadora(Prestamo $entity, Computadora $prestamoComputadora){
            $entity->setPrestamoComputadora($prestamoComputadora->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setPrestamo(Prestamo &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setPrestamos(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updatePrestamo(Prestamo &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removePrestamo(Prestamo $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>