<?php

    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_COMPUTADORA_BACKUP_ENTITY;

    

    class SoftwareComputadoraBackupBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function SoftwareComputadoraBackupBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getSoftwareComputadoraBackup(SoftwareComputadoraBackup &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllSoftwareComputadoraBackups($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllSoftwareComputadoraBackups($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllSoftwareComputadoraBackups(){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ID_SOFTWARE_COMPUTADORA." LIKE '".$idSoftwareComputadora."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ID_SOFTWARE_COMPUTADORA." LIKE '".$idSoftwareComputadora."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByIdSoftwareComputadora($idSoftwareComputadora){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->ID_SOFTWARE_COMPUTADORA." LIKE '".$idSoftwareComputadora."'");

        }
        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." LIKE '".$numeroSerieProgramaBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." LIKE '".$numeroSerieProgramaBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." LIKE '".$numeroSerieProgramaBackup."'");

        }
        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." LIKE '".$compSoftFechaInstalacionBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." LIKE '".$compSoftFechaInstalacionBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." LIKE '".$compSoftFechaInstalacionBackup."'");

        }
        public function getSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_BACKUP." LIKE '".$computadoraBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_BACKUP." LIKE '".$computadoraBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByComputadoraBackup($computadoraBackup){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_BACKUP." LIKE '".$computadoraBackup."'");

        }
        public function getSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_BACKUP." LIKE '".$softwareBackup."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_BACKUP." LIKE '".$softwareBackup."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsBySoftwareBackup($softwareBackup){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_BACKUP." LIKE '".$softwareBackup."'");

        }
        public function getSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->FECHA_BACKUP_S_C." LIKE '".$fechaBackupSC."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->FECHA_BACKUP_S_C." LIKE '".$fechaBackupSC."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByFechaBackupSC($fechaBackupSC){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->FECHA_BACKUP_S_C." LIKE '".$fechaBackupSC."'");

        }
        public function getSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ID_SOFTWARE_COMPUTADORA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ID_SOFTWARE_COMPUTADORA." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraBetween($firstValue, $secondValue){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->ID_SOFTWARE_COMPUTADORA." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBetween($firstValue, $secondValue){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBetween($firstValue, $secondValue){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByComputadoraBackupBetween($firstValue, $secondValue){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->COMPUTADORA_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsBySoftwareBackupBetween($firstValue, $secondValue){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_BACKUP." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->FECHA_BACKUP_S_C." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->FECHA_BACKUP_S_C." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByFechaBackupSCBetween($firstValue, $secondValue){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->FECHA_BACKUP_S_C." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ID_SOFTWARE_COMPUTADORA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ID_SOFTWARE_COMPUTADORA." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraBiggerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->ID_SOFTWARE_COMPUTADORA." > '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBiggerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." > '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBiggerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." > '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByComputadoraBackupBiggerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_BACKUP." > '".$value."'");
        }

        public function getSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_BACKUP." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsBySoftwareBackupBiggerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_BACKUP." > '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->FECHA_BACKUP_S_C." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->FECHA_BACKUP_S_C." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByFechaBackupSCBiggerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->FECHA_BACKUP_S_C." > '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->ID_SOFTWARE_COMPUTADORA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->ID_SOFTWARE_COMPUTADORA." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByIdSoftwareComputadoraLowerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->ID_SOFTWARE_COMPUTADORA." < '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupLowerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->NUMERO_SERIE_PROGRAMA_BACKUP." < '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupLowerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMP_SOFT_FECHA_INSTALACION_BACKUP." < '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByComputadoraBackupLowerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA_BACKUP." < '".$value."'");
        }

        public function getSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_BACKUP." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsBySoftwareBackupLowerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_BACKUP." < '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->FECHA_BACKUP_S_C." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->FECHA_BACKUP_S_C." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwareComputadoraBackupsByFechaBackupSCLowerThan($value){
            $entity = new SoftwareComputadoraBackup();
            return $this->persistenceManager->countAll($entity, array(), $entity->FECHA_BACKUP_S_C." < '".$value."'");
        }

        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupBeginsWith($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackup($numeroSerieProgramaBackup . "%", $firstResultNumber, $numResults);
        }

        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackup("%" . $numeroSerieProgramaBackup, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackup("%" . $numeroSerieProgramaBackup, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupEndsWith($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackup("%" . $numeroSerieProgramaBackup, $firstResultNumber, $numResults);
        }

        public function getSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwareComputadoraBackupsByNumeroSerieProgramaBackup("%" . $numeroSerieProgramaBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwareComputadoraBackupsByNumeroSerieProgramaBackup("%" . $numeroSerieProgramaBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackupContains($numeroSerieProgramaBackup){
            return $this->countGetSoftwareComputadoraBackupsByNumeroSerieProgramaBackup("%" . $numeroSerieProgramaBackup . "%");
        }

        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupBeginsWith($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup . "%", $firstResultNumber, $numResults);
        }

        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup("%" . $compSoftFechaInstalacionBackup, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup("%" . $compSoftFechaInstalacionBackup, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupEndsWith($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup("%" . $compSoftFechaInstalacionBackup, $firstResultNumber, $numResults);
        }

        public function getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup("%" . $compSoftFechaInstalacionBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup("%" . $compSoftFechaInstalacionBackup . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackupContains($compSoftFechaInstalacionBackup){
            return $this->countGetSoftwareComputadoraBackupsByCompSoftFechaInstalacionBackup("%" . $compSoftFechaInstalacionBackup . "%");
        }

        public function updateIdSoftwareComputadora(SoftwareComputadoraBackup $entity,  $idSoftwareComputadora){
            $entity->setIdSoftwareComputadora($idSoftwareComputadora);
            return $this->persistenceManager->update($entity);
        }

        public function updateNumeroSerieProgramaBackup(SoftwareComputadoraBackup $entity,  $numeroSerieProgramaBackup){
            $entity->setNumeroSerieProgramaBackup($numeroSerieProgramaBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updateCompSoftFechaInstalacionBackup(SoftwareComputadoraBackup $entity,  $compSoftFechaInstalacionBackup){
            $entity->setCompSoftFechaInstalacionBackup($compSoftFechaInstalacionBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadoraBackup(SoftwareComputadoraBackup $entity,  $computadoraBackup){
            $entity->setComputadoraBackup($computadoraBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftwareBackup(SoftwareComputadoraBackup $entity,  $softwareBackup){
            $entity->setSoftwareBackup($softwareBackup);
            return $this->persistenceManager->update($entity);
        }

        public function updateFechaBackupSC(SoftwareComputadoraBackup $entity,  $fechaBackupSC){
            $entity->setFechaBackupSC($fechaBackupSC);
            return $this->persistenceManager->update($entity);
        }

        public function setSoftwareComputadoraBackup(SoftwareComputadoraBackup &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setSoftwareComputadoraBackups(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateSoftwareComputadoraBackup(SoftwareComputadoraBackup &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeSoftwareComputadoraBackup(SoftwareComputadoraBackup $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>