<?php

    require_once SALAS_COMP_ENTITIES_DIR.SALON_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;
    require_once SALAS_COMP_ENTITIES_DIR.OBJETO_EN_INVENTARIO_ENTITY;



    class ObjetoEnInventarioBean {

        # Clase que se encarga de la persistencia
        private $persistenceManager;

        function ObjetoEnInventarioBean(PersistenceManager $persistenceManager){
            $this->persistenceManager = $persistenceManager;
        }

        # Método para conseguir la entidad dado su id primario
        public function getObjetoEnInventario(ObjetoEnInventario &$entity){
            return $this->persistenceManager->find($entity);
        }

        # Método para conseguir todas las entidades del sistema
        public function getAllObjetoEnInventarios($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para listar todas las entidades del sistema
        public function listAllObjetoEnInventarios($firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), "TRUE", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        # Método para contar todas las entidades del sistema
        public function countAllObjetoEnInventarios(){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), "TRUE");
        }

        # Métodos para obtener la entidad dado sus atributos y posbiles combinaciones de ellos

        public function getObjetoEnInventariosByInventarioElemento($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_ELEMENTO." LIKE '".$inventarioElemento."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioElemento($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_ELEMENTO." LIKE '".$inventarioElemento."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioElemento($inventarioElemento){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->INVENTARIO_ELEMENTO." LIKE '".$inventarioElemento."'");

        }
        public function getObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_NUMERO_SERIE." LIKE '".$inventarioNumeroSerie."'", $orderBy , $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_NUMERO_SERIE." LIKE '".$inventarioNumeroSerie."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->INVENTARIO_NUMERO_SERIE." LIKE '".$inventarioNumeroSerie."'");

        }
        public function getObjetoEnInventariosByInventarioSalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_SALON." = '".$salon->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioSalon(Salon $salon, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_SALON." = '".$salon->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioSalon(Salon $salon){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->INVENTARIO_SALON." = '".$salon->getId()."'");
        }

        public function getObjetoEnInventariosByComputadora(Computadora $computadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->COMPUTADORA." = '".$computadora->getId()."'",$orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByComputadora(Computadora $computadora, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->COMPUTADORA." = '".$computadora->getId()."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByComputadora(Computadora $computadora){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->COMPUTADORA." = '".$computadora->getId()."'");
        }

        public function getObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_ELEMENTO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_ELEMENTO." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioElementoBetween($firstValue, $secondValue){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->INVENTARIO_ELEMENTO." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_NUMERO_SERIE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_NUMERO_SERIE." BETWEEN '".$firstValue."' AND '".$secondValue."' ", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioNumeroSerieBetween($firstValue, $secondValue){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array("*"), $entity->INVENTARIO_NUMERO_SERIE." BETWEEN '".$firstValue."' AND '".$secondValue."' ");
        }

        public function getObjetoEnInventariosByInventarioElementoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_ELEMENTO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioElementoBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_ELEMENTO." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioElementoBiggerThan($value){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->INVENTARIO_ELEMENTO." > '".$value."'");
        }

        public function getObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_NUMERO_SERIE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_NUMERO_SERIE." > '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioNumeroSerieBiggerThan($value){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->INVENTARIO_NUMERO_SERIE." > '".$value."'");
        }

        public function getObjetoEnInventariosByInventarioElementoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_ELEMENTO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioElementoLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_ELEMENTO." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioElementoLowerThan($value){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->INVENTARIO_ELEMENTO." < '".$value."'");
        }

        public function getObjetoEnInventariosByInventarioNumeroSerieLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, array("*"), $entity->INVENTARIO_NUMERO_SERIE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function listObjetoEnInventariosByInventarioNumeroSerieLowerThan($value, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->findAll($entity, $entity->getExplicitDbListFieldNamesWithPK(), $entity->INVENTARIO_NUMERO_SERIE." < '".$value."'", $orderBy, $orderPriority, $firstResultNumber,$numResults);
        }

        public function countGetObjetoEnInventariosByInventarioNumeroSerieLowerThan($value){
            $entity = new ObjetoEnInventario();
            return $this->persistenceManager->countAll($entity, array(), $entity->INVENTARIO_NUMERO_SERIE." < '".$value."'");
        }

        public function getObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoEnInventariosByInventarioElemento($inventarioElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoEnInventariosByInventarioElemento($inventarioElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoEnInventariosByInventarioElementoBeginsWith($inventarioElemento, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoEnInventariosByInventarioElemento($inventarioElemento . "%", $firstResultNumber, $numResults);
        }

        public function getObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoEnInventariosByInventarioElemento("%" . $inventarioElemento, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoEnInventariosByInventarioElemento("%" . $inventarioElemento, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoEnInventariosByInventarioElementoEndsWith($inventarioElemento, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoEnInventariosByInventarioElemento("%" . $inventarioElemento, $firstResultNumber, $numResults);
        }

        public function getObjetoEnInventariosByInventarioElementoContains($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoEnInventariosByInventarioElemento("%" . $inventarioElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoEnInventariosByInventarioElementoContains($inventarioElemento, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoEnInventariosByInventarioElemento("%" . $inventarioElemento . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoEnInventariosByInventarioElementoContains($inventarioElemento){
            return $this->countGetObjetoEnInventariosByInventarioElemento("%" . $inventarioElemento . "%");
        }

        public function getObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoEnInventariosByInventarioNumeroSerieBeginsWith($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoEnInventariosByInventarioNumeroSerie($inventarioNumeroSerie . "%", $firstResultNumber, $numResults);
        }

        public function getObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoEnInventariosByInventarioNumeroSerie("%" . $inventarioNumeroSerie, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoEnInventariosByInventarioNumeroSerie("%" . $inventarioNumeroSerie, $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoEnInventariosByInventarioNumeroSerieEndsWith($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null){
            return $this->countGetObjetoEnInventariosByInventarioNumeroSerie("%" . $inventarioNumeroSerie, $firstResultNumber, $numResults);
        }

        public function getObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->getObjetoEnInventariosByInventarioNumeroSerie("%" . $inventarioNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function listObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            return $this->listObjetoEnInventariosByInventarioNumeroSerie("%" . $inventarioNumeroSerie . "%", $orderBy, $orderPriority, $firstResultNumber, $numResults);
        }

        public function countGetObjetoEnInventariosByInventarioNumeroSerieContains($inventarioNumeroSerie){
            return $this->countGetObjetoEnInventariosByInventarioNumeroSerie("%" . $inventarioNumeroSerie . "%");
        }

        public function updateInventarioElemento(ObjetoEnInventario $entity,  $inventarioElemento){
            $entity->setInventarioElemento($inventarioElemento);
            return $this->persistenceManager->update($entity);
        }

        public function updateInventarioNumeroSerie(ObjetoEnInventario $entity,  $inventarioNumeroSerie){
            $entity->setInventarioNumeroSerie($inventarioNumeroSerie);
            return $this->persistenceManager->update($entity);
        }

        public function updateInventarioSalon(ObjetoEnInventario $entity, Salon $inventarioSalon){
            $entity->setInventarioSalon($inventarioSalon->getId());
            return $this->persistenceManager->update($entity);
        }

        public function updateComputadora(ObjetoEnInventario $entity, Computadora $computadora){
            $entity->setComputadora($computadora->getId());
            return $this->persistenceManager->update($entity);
        }

        public function setObjetoEnInventario(ObjetoEnInventario &$entity){
            return $this->persistenceManager->save($entity);
        }

        public function setObjetoEnInventarios(array &$entities){
            return $this->persistenceManager->saveAll($entities);
        }

        public function updateObjetoEnInventario(ObjetoEnInventario &$entity){
            return $this->persistenceManager->update($entity);
        }

        public function removeObjetoEnInventario(ObjetoEnInventario $entity){
            return $this->persistenceManager->remove($entity);
        }

//Funciones personalizadas
        public function darInventarioComputador(){
            $inventario = array();

            $res = $this->persistenceManager->performCustomQuery("SELECT * FROM objeto_en_inventario WHERE exists
                (SELECT * FROM computadora WHERE objeto_en_inventario.computadora_id = computadora.computadora_id)");
            if(!$res){
                return $inventario;
            }

            foreach($res as $rsEntity){
                $entityTmp = new ObjetoEnInventario();
                $entityTmp->loadFromSqlResultQuery($rsEntity);
                $inventario[] = $entityTmp;
            }
            return $inventario;
        }

    }

?>
