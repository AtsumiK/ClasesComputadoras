<?php

    require_once SALAS_COMP_ENTITIES_DIR.SOFTWARE_ENTITY;

    

    class SoftwareBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function SoftwareBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getSoftware(Software &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllSoftwares($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllSoftwares($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllSoftwares(){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NUMERO_SERIE." LIKE '".$softwareNumeroSerie."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NUMERO_SERIE." LIKE '".$softwareNumeroSerie."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_NUMERO_SERIE." LIKE '".$softwareNumeroSerie."'");

        }
        public function getSoftwaresBySoftwareNombre($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NOMBRE." LIKE '".$softwareNombre."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNombre($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NOMBRE." LIKE '".$softwareNombre."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNombre($softwareNombre){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_NOMBRE." LIKE '".$softwareNombre."'");

        }
        public function getSoftwaresBySoftwareVersion($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_VERSION." LIKE '".$softwareVersion."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareVersion($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_VERSION." LIKE '".$softwareVersion."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareVersion($softwareVersion){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_VERSION." LIKE '".$softwareVersion."'");

        }
        public function getSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_CADUCIDAD." LIKE '".$softwareFechaCaducidad."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_CADUCIDAD." LIKE '".$softwareFechaCaducidad."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaCaducidad($softwareFechaCaducidad){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_FECHA_CADUCIDAD." LIKE '".$softwareFechaCaducidad."'");

        }
        public function getSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_AQUISICION." LIKE '".$softwareFechaAquisicion."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_AQUISICION." LIKE '".$softwareFechaAquisicion."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaAquisicion($softwareFechaAquisicion){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_FECHA_AQUISICION." LIKE '".$softwareFechaAquisicion."'");

        }
        public function getSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." LIKE '".$softwareEquiposPermitidos."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." LIKE '".$softwareEquiposPermitidos."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareEquiposPermitidos($softwareEquiposPermitidos){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." LIKE '".$softwareEquiposPermitidos."'");

        }
        public function getSoftwaresBySoftwareComentarios($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_COMENTARIOS." LIKE '".$softwareComentarios."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareComentarios($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_COMENTARIOS." LIKE '".$softwareComentarios."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareComentarios($softwareComentarios){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_COMENTARIOS." LIKE '".$softwareComentarios."'");

        }
        public function getSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NUMERO_SERIE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NUMERO_SERIE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNumeroSerieBetween($firstValue, $secondValue){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_NUMERO_SERIE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwaresBySoftwareNombreBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNombreBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNombreBetween($firstValue, $secondValue){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_NOMBRE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwaresBySoftwareVersionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_VERSION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareVersionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_VERSION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareVersionBetween($firstValue, $secondValue){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_VERSION." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_CADUCIDAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_CADUCIDAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaCaducidadBetween($firstValue, $secondValue){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_FECHA_CADUCIDAD." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_AQUISICION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_AQUISICION." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaAquisicionBetween($firstValue, $secondValue){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_FECHA_AQUISICION." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareEquiposPermitidosBetween($firstValue, $secondValue){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareComentariosBetween($firstValue, $secondValue){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->SOFTWARE_COMENTARIOS." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getSoftwaresBySoftwareNumeroSerieBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NUMERO_SERIE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNumeroSerieBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NUMERO_SERIE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNumeroSerieBiggerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_NUMERO_SERIE." > '".$value."'");
        }

        public function getSoftwaresBySoftwareNombreBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NOMBRE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNombreBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NOMBRE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNombreBiggerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_NOMBRE." > '".$value."'");
        }

        public function getSoftwaresBySoftwareVersionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_VERSION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareVersionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_VERSION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareVersionBiggerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_VERSION." > '".$value."'");
        }

        public function getSoftwaresBySoftwareFechaCaducidadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_CADUCIDAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaCaducidadBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_CADUCIDAD." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaCaducidadBiggerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_FECHA_CADUCIDAD." > '".$value."'");
        }

        public function getSoftwaresBySoftwareFechaAquisicionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_AQUISICION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaAquisicionBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_AQUISICION." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaAquisicionBiggerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_FECHA_AQUISICION." > '".$value."'");
        }

        public function getSoftwaresBySoftwareEquiposPermitidosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareEquiposPermitidosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareEquiposPermitidosBiggerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." > '".$value."'");
        }

        public function getSoftwaresBySoftwareComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareComentariosBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_COMENTARIOS." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareComentariosBiggerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_COMENTARIOS." > '".$value."'");
        }

        public function getSoftwaresBySoftwareNumeroSerieLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NUMERO_SERIE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNumeroSerieLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NUMERO_SERIE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNumeroSerieLowerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_NUMERO_SERIE." < '".$value."'");
        }

        public function getSoftwaresBySoftwareNombreLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_NOMBRE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareNombreLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_NOMBRE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareNombreLowerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_NOMBRE." < '".$value."'");
        }

        public function getSoftwaresBySoftwareVersionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_VERSION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareVersionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_VERSION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareVersionLowerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_VERSION." < '".$value."'");
        }

        public function getSoftwaresBySoftwareFechaCaducidadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_CADUCIDAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaCaducidadLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_CADUCIDAD." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaCaducidadLowerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_FECHA_CADUCIDAD." < '".$value."'");
        }

        public function getSoftwaresBySoftwareFechaAquisicionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_FECHA_AQUISICION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareFechaAquisicionLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_FECHA_AQUISICION." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareFechaAquisicionLowerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_FECHA_AQUISICION." < '".$value."'");
        }

        public function getSoftwaresBySoftwareEquiposPermitidosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareEquiposPermitidosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareEquiposPermitidosLowerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_EQUIPOS_PERMITIDOS." < '".$value."'");
        }

        public function getSoftwaresBySoftwareComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->SOFTWARE_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listSoftwaresBySoftwareComentariosLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new Software();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->SOFTWARE_COMENTARIOS." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetSoftwaresBySoftwareComentariosLowerThan($value){
            $entity = new Software();
            return $this->persistenceManager->countAll($entity, array(), $entity->SOFTWARE_COMENTARIOS." < '".$value."'");
        }

        public function getSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareNumeroSerieBeginsWith($softwareNumeroSerie, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareNumeroSerie($softwareNumeroSerie . "%", $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareNumeroSerie("%" . $softwareNumeroSerie, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareNumeroSerie("%" . $softwareNumeroSerie, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareNumeroSerieEndsWith($softwareNumeroSerie, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareNumeroSerie("%" . $softwareNumeroSerie, $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareNumeroSerie("%" . $softwareNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareNumeroSerie("%" . $softwareNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareNumeroSerieContains($softwareNumeroSerie){
            return $this->countGetSoftwaresBySoftwareNumeroSerie("%" . $softwareNumeroSerie . "%");
        }

        public function getSoftwaresBySoftwareNombreBeginsWith($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareNombre($softwareNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareNombreBeginsWith($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareNombre($softwareNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareNombreBeginsWith($softwareNombre, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareNombre($softwareNombre . "%", $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareNombreEndsWith($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareNombre("%" . $softwareNombre, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareNombreEndsWith($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareNombre("%" . $softwareNombre, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareNombreEndsWith($softwareNombre, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareNombre("%" . $softwareNombre, $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareNombreContains($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareNombre("%" . $softwareNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareNombreContains($softwareNombre, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareNombre("%" . $softwareNombre . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareNombreContains($softwareNombre){
            return $this->countGetSoftwaresBySoftwareNombre("%" . $softwareNombre . "%");
        }

        public function getSoftwaresBySoftwareVersionBeginsWith($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareVersion($softwareVersion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareVersionBeginsWith($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareVersion($softwareVersion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareVersionBeginsWith($softwareVersion, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareVersion($softwareVersion . "%", $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareVersionEndsWith($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareVersion("%" . $softwareVersion, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareVersionEndsWith($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareVersion("%" . $softwareVersion, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareVersionEndsWith($softwareVersion, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareVersion("%" . $softwareVersion, $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareVersionContains($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareVersion("%" . $softwareVersion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareVersionContains($softwareVersion, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareVersion("%" . $softwareVersion . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareVersionContains($softwareVersion){
            return $this->countGetSoftwaresBySoftwareVersion("%" . $softwareVersion . "%");
        }

        public function getSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareComentarios($softwareComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareComentarios($softwareComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareComentariosBeginsWith($softwareComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareComentarios($softwareComentarios . "%", $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareComentariosEndsWith($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareComentarios("%" . $softwareComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareComentariosEndsWith($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareComentarios("%" . $softwareComentarios, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareComentariosEndsWith($softwareComentarios, $firstResultNumber = null, $numResults = null){
            return $this->countGetSoftwaresBySoftwareComentarios("%" . $softwareComentarios, $firstResultNumber, $numResults);
        }

        public function getSoftwaresBySoftwareComentariosContains($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getSoftwaresBySoftwareComentarios("%" . $softwareComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listSoftwaresBySoftwareComentariosContains($softwareComentarios, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listSoftwaresBySoftwareComentarios("%" . $softwareComentarios . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetSoftwaresBySoftwareComentariosContains($softwareComentarios){
            return $this->countGetSoftwaresBySoftwareComentarios("%" . $softwareComentarios . "%");
        }

        public function updateSoftwareNumeroSerie(Software $entity,  $softwareNumeroSerie){
            $entity->setSoftwareNumeroSerie($softwareNumeroSerie);
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftwareNombre(Software $entity,  $softwareNombre){
            $entity->setSoftwareNombre($softwareNombre);
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftwareVersion(Software $entity,  $softwareVersion){
            $entity->setSoftwareVersion($softwareVersion);
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftwareFechaCaducidad(Software $entity,  $softwareFechaCaducidad){
            $entity->setSoftwareFechaCaducidad($softwareFechaCaducidad);
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftwareFechaAquisicion(Software $entity,  $softwareFechaAquisicion){
            $entity->setSoftwareFechaAquisicion($softwareFechaAquisicion);
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftwareEquiposPermitidos(Software $entity,  $softwareEquiposPermitidos){
            $entity->setSoftwareEquiposPermitidos($softwareEquiposPermitidos);
            return $this->persistenceManager->update($entity);
        }

        public function updateSoftwareComentarios(Software $entity,  $softwareComentarios){
            $entity->setSoftwareComentarios($softwareComentarios);
            return $this->persistenceManager->update($entity);
        }

        public function setSoftware(Software &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setSoftwares(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateSoftware(Software &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeSoftware(Software $entity){
            return $this->persistenceManager->remove($entity);
        }


    }

?>