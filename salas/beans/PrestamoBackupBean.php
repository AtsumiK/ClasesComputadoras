<?php

    require_once SALAS_COMP_ENTITIES_DIR.PRESTAMO_BACKUP_ENTITY;

    

    class PrestamoBackupBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function PrestamoBackupBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getPrestamoBackup(PrestamoBackup &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllPrestamoBackups($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllPrestamoBackups($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllPrestamoBackups(){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getPrestamoBackupsByPrestamoId($prestamoId, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ID." LIKE '".$prestamoId."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoId($prestamoId, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ID." LIKE '".$prestamoId."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoId($prestamoId){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ID." LIKE '".$prestamoId."'");

        }
        public function getPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA_BACKUP." LIKE '".$prestamoEntradaBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA_BACKUP." LIKE '".$prestamoEntradaBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEntradaBackup($prestamoEntradaBackup){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ENTRADA_BACKUP." LIKE '".$prestamoEntradaBackup."'");

        }
        public function getPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA_BACKUP." LIKE '".$prestamoSalidaBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA_BACKUP." LIKE '".$prestamoSalidaBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoSalidaBackup($prestamoSalidaBackup){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_SALIDA_BACKUP." LIKE '".$prestamoSalidaBackup."'");

        }
        public function getPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS_BACKUP." LIKE '".$prestamoComentariosBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS_BACKUP." LIKE '".$prestamoComentariosBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMENTARIOS_BACKUP." LIKE '".$prestamoComentariosBackup."'");

        }
        public function getPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ESTUDIANTE_BACKUP." LIKE '".$prestamoEstudianteBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ESTUDIANTE_BACKUP." LIKE '".$prestamoEstudianteBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEstudianteBackup($prestamoEstudianteBackup){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ESTUDIANTE_BACKUP." LIKE '".$prestamoEstudianteBackup."'");

        }
        public function getPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMPUTADORA_BACKUP." LIKE '".$prestamoComputadoraBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMPUTADORA_BACKUP." LIKE '".$prestamoComputadoraBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComputadoraBackup($prestamoComputadoraBackup){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMPUTADORA_BACKUP." LIKE '".$prestamoComputadoraBackup."'");

        }
        public function getPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." LIKE '".$prestamoBackupFechaBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." LIKE '".$prestamoBackupFechaBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoBackupFechaBackup($prestamoBackupFechaBackup){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." LIKE '".$prestamoBackupFechaBackup."'");

        }
        public function getPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ID." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ID." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoIdBetween($firstValue, $secondValue){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_ID." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEntradaBackupBetween($firstValue, $secondValue){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_ENTRADA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoSalidaBackupBetween($firstValue, $secondValue){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_SALIDA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComentariosBackupBetween($firstValue, $secondValue){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ESTUDIANTE_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ESTUDIANTE_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEstudianteBackupBetween($firstValue, $secondValue){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_ESTUDIANTE_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMPUTADORA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMPUTADORA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComputadoraBackupBetween($firstValue, $secondValue){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_COMPUTADORA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoBackupFechaBackupBetween($firstValue, $secondValue){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getPrestamoBackupsByPrestamoIdBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ID." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoIdBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ID." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoIdBiggerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ID." > '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEntradaBackupBiggerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ENTRADA_BACKUP." > '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoSalidaBackupBiggerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_SALIDA_BACKUP." > '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComentariosBackupBiggerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMENTARIOS_BACKUP." > '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ESTUDIANTE_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ESTUDIANTE_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEstudianteBackupBiggerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ESTUDIANTE_BACKUP." > '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMPUTADORA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMPUTADORA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComputadoraBackupBiggerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMPUTADORA_BACKUP." > '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoBackupFechaBackupBiggerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." > '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoIdLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ID." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoIdLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ID." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoIdLowerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ID." < '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoEntradaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ENTRADA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEntradaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ENTRADA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEntradaBackupLowerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ENTRADA_BACKUP." < '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoSalidaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_SALIDA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoSalidaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_SALIDA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoSalidaBackupLowerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_SALIDA_BACKUP." < '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoComentariosBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMENTARIOS_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComentariosBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMENTARIOS_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComentariosBackupLowerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMENTARIOS_BACKUP." < '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_ESTUDIANTE_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_ESTUDIANTE_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoEstudianteBackupLowerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_ESTUDIANTE_BACKUP." < '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_COMPUTADORA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_COMPUTADORA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComputadoraBackupLowerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_COMPUTADORA_BACKUP." < '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetPrestamoBackupsByPrestamoBackupFechaBackupLowerThan($value){
            $entity = new PrestamoBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->PRESTAMO_BACKUP_FECHA_BACKUP." < '".$value."'");
        }

        public function getPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComentariosBackupBeginsWith($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null){
            return $this->countGetPrestamoBackupsByPrestamoComentariosBackup($prestamoComentariosBackup . "%", $firstResultNumber, $numResults);
        }

        public function getPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPrestamoBackupsByPrestamoComentariosBackup("%" . $prestamoComentariosBackup, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPrestamoBackupsByPrestamoComentariosBackup("%" . $prestamoComentariosBackup, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComentariosBackupEndsWith($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null){
            return $this->countGetPrestamoBackupsByPrestamoComentariosBackup("%" . $prestamoComentariosBackup, $firstResultNumber, $numResults);
        }

        public function getPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getPrestamoBackupsByPrestamoComentariosBackup("%" . $prestamoComentariosBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listPrestamoBackupsByPrestamoComentariosBackup("%" . $prestamoComentariosBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetPrestamoBackupsByPrestamoComentariosBackupContains($prestamoComentariosBackup){
            return $this->countGetPrestamoBackupsByPrestamoComentariosBackup("%" . $prestamoComentariosBackup . "%");
        }

        public function updatePrestamoId(PrestamoBackup $entity,  $prestamoId){
            $entity->setPrestamoId($prestamoId);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoEntradaBackup(PrestamoBackup $entity,  $prestamoEntradaBackup){
            $entity->setPrestamoEntradaBackup($prestamoEntradaBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoSalidaBackup(PrestamoBackup $entity,  $prestamoSalidaBackup){
            $entity->setPrestamoSalidaBackup($prestamoSalidaBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoComentariosBackup(PrestamoBackup $entity,  $prestamoComentariosBackup){
            $entity->setPrestamoComentariosBackup($prestamoComentariosBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoEstudianteBackup(PrestamoBackup $entity,  $prestamoEstudianteBackup){
            $entity->setPrestamoEstudianteBackup($prestamoEstudianteBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoComputadoraBackup(PrestamoBackup $entity,  $prestamoComputadoraBackup){
            $entity->setPrestamoComputadoraBackup($prestamoComputadoraBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updatePrestamoBackupFechaBackup(PrestamoBackup $entity,  $prestamoBackupFechaBackup){
            $entity->setPrestamoBackupFechaBackup($prestamoBackupFechaBackup);
            return $this->persistenceManager->update($entity);
        }

        public function setPrestamoBackup(PrestamoBackup &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setPrestamoBackups(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updatePrestamoBackup(PrestamoBackup &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removePrestamoBackup(PrestamoBackup $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>