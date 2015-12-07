<?php

    require_once SALAS_COMP_CONFIG_DIR.SALAS_COMP_CONFIG_FILE;
    require_once UTILS_DIR.ENTITY_VALIDATOR_OBJ;
    require_once PERSISTENCE_DIR.PERSISTENCE_MANAGER_OBJ;

    require_once SALAS_COMP_ENTITIES_DIR.ESTUDIANTE_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.ESTUDIANTE_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.COMPUTADORA_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.COMPUTADORA_BEAN;
    require_once SALAS_COMP_ENTITIES_DIR.PRESTAMO_ENTITY;
    require_once SALAS_COMP_BEANS_DIR.PRESTAMO_BEAN;

    

    class PrestamoController {

        private $ID = 8000;

        private $persistenceManager;
        private $lastRequestSize;

        private $prestamoBean;

        function PrestamoController(PersistenceManager $persistenceManager = null){
            $this->lastRequestSize = 0;
            if($persistenceManager == null){
                $this->persistenceManager = new PersistenceManager(DB_HOST,DB_PORT,DB_NAME,DB_USER_NAME,DB_USER_PASS);
            }else{
                $this->persistenceManager = $persistenceManager;
            }
            $this->prestamoBean = new PrestamoBean($this->persistenceManager);
        }

        public function getLastRequestSize(){
            return $this->lastRequestSize;
        }

        /**
         * Agregar Prestamo al sistema.
         * 
         * @param PrestamoDTO $prestamoDTO
        */
        public function setPrestamo(PrestamoDTO &$prestamoDTO){
            $prestamo = PrestamoDTO::toEntity($prestamoDTO);
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();
            $computadoraBean = new ComputadoraBean($this->persistenceManager);
            $computadora = new Computadora();

            # Validamos los campos
            if(!$prestamo->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 2);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($prestamo->getPrestamoEstudiante() !== null){
                $estudiante->setId($prestamo->getPrestamoEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 0);
                }
            }

            if($prestamo->getPrestamoComputadora() !== null){
                $computadora->setId($prestamo->getPrestamoComputadora());
                if(!$computadoraBean->getComputadora($computadora)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 1);
                }
            }

            # Almacenamos la entidad
            if(!$this->prestamoBean->setPrestamo($prestamo)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_SET_FAIL, $this->ID + 3);
            }

            $prestamoDTO->loadFromEntity($prestamo);
        }
        /**
         * Actualizar Prestamo al sistema.
         * 
         * @param PrestamoDTO $prestamoDTO
        */
        public function updatePrestamo(PrestamoDTO &$prestamoDTO){
            $prestamo = PrestamoDTO::toEntity($prestamoDTO);
            $estudianteBean = new EstudianteBean($this->persistenceManager);
            $estudiante = new Estudiante();
            $computadoraBean = new ComputadoraBean($this->persistenceManager);
            $computadora = new Computadora();

            # Validamos los campos
            if(!$prestamo->isEntityValid()){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 6);
            }

            # Si las entidades complejas relacionan un ID válido entonces se verifica que exista la entidad correspondiente
            if($prestamo->getPrestamoEstudiante() !== null){
                $estudiante->setId($prestamo->getPrestamoEstudiante());
                if(!$estudianteBean->getEstudiante($estudiante)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 4);
                }
            }

            if($prestamo->getPrestamoComputadora() !== null){
                $computadora->setId($prestamo->getPrestamoComputadora());
                if(!$computadoraBean->getComputadora($computadora)){
                    throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 5);
                }
            }

            # Actualizamos la entidad
            if(!$this->prestamoBean->updatePrestamo($prestamo)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_UPDATE_FAIL, $this->ID + 7);
            }

            $prestamoDTO->loadFromEntity($prestamo);
        }
        /**
         * Obtener un Prestamo único.
         * 
         * @param PrestamoDTO &$prestamoDTO
        */

        public function getPrestamo(PrestamoDTO &$prestamoDTO){

            $prestamo = PrestamoDTO::toEntity($prestamoDTO);
            # Validamos los campos
            if(!EntityValidator::validateId($prestamo->getId())){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 8);
            }

            # Obtenemos la entidad
            if(!$this->prestamoBean->getPrestamo($prestamo)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND2_FAIL, $this->ID + 9);
            }

            $prestamoDTO->loadFromEntity($prestamo);
        }
        /**
         * Obtener todos los Prestamo
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function getPrestamos($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countAllPrestamos();
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getAllPrestamos($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Listar todos los Prestamo
         * 
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */

        public function listPrestamos($performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){

            # Validamos los campos

            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 10);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 11);
            }

            # Obtenemos las entidades

            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countAllPrestamos();
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listAllPrestamos($firstResultNumber,$numResults, $orderBy, $orderPriority));
        }

        /**
         * Obtener algunos Prestamo dado $prestamoEntrada
         * 
         * @param $prestamoEntrada
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoEntrada($prestamoEntrada, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 12);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 14);
            }

            if( !(EntityValidator::validateDate($prestamoEntrada))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 16);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntrada($prestamoEntrada );
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoEntrada($prestamoEntrada, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado $prestamoEntrada
         * 
         * @param $prestamoEntrada
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoEntrada($prestamoEntrada, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 13);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 15);
            }

            if( !(EntityValidator::validateDate($prestamoEntrada))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 17);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntrada($prestamoEntrada);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoEntrada($prestamoEntrada, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoEntradaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 18);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 20);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 22);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntradaBetween($firstValue, $secondValue);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoEntradaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoEntradaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 19);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 21);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 23);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntradaBetween($firstValue, $secondValue);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoEntradaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoEntradaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 24);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 26);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 28);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntradaBiggerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoEntradaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoEntradaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 25);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 27);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 29);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntradaBiggerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoEntradaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoEntradaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 30);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 32);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 34);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntradaLowerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoEntradaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoEntradaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 31);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 33);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 35);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEntradaLowerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoEntradaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado $prestamoSalida
         * 
         * @param $prestamoSalida
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoSalida($prestamoSalida, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 36);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 38);
            }

            if( !(EntityValidator::validateDate($prestamoSalida))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 40);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalida($prestamoSalida );
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoSalida($prestamoSalida, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado $prestamoSalida
         * 
         * @param $prestamoSalida
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoSalida($prestamoSalida, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 37);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 39);
            }

            if( !(EntityValidator::validateDate($prestamoSalida))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 41);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalida($prestamoSalida);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoSalida($prestamoSalida, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoSalidaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 42);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 44);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 46);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalidaBetween($firstValue, $secondValue);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoSalidaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoSalidaBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 43);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 45);
            }

            if( !(EntityValidator::validateDate($firstValue) && EntityValidator::validateDate($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 47);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalidaBetween($firstValue, $secondValue);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoSalidaBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoSalidaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 48);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 50);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 52);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalidaBiggerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoSalidaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoSalidaBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 49);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 51);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 53);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalidaBiggerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoSalidaBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoSalidaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 54);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 56);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 58);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalidaLowerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoSalidaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoSalidaLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 55);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 57);
            }

            if( !(EntityValidator::validateDate($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 59);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoSalidaLowerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoSalidaLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComentarios($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 60);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 62);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 64);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentarios($prestamoComentarios );
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComentarios($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComentarios($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 61);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 63);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 65);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentarios($prestamoComentarios);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComentarios($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 66);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 68);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 70);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosBetween($firstValue, $secondValue);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango
         * 
         * @param $firstValue
         * @param $secondValue
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComentariosBetween($firstValue, $secondValue, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 67);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 69);
            }

            if( !(EntityValidator::validateString($firstValue) && EntityValidator::validateString($secondValue))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 71);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosBetween($firstValue, $secondValue);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComentariosBetween($firstValue, $secondValue, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 72);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 74);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 76);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosBiggerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango superior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComentariosBiggerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 73);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 75);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 77);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosBiggerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComentariosBiggerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 78);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 80);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 82);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosLowerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado un rango inferior
         * 
         * @param $value
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComentariosLowerThan($value, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 79);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 81);
            }

            if( !(EntityValidator::validateString($value))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 83);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosLowerThan($value);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComentariosLowerThan($value, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Obtener algunos Prestamo comenzando por $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 84);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 86);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 88);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         *1. Listar algunos Prestamo comenzando por $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 85);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 87);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 89);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComentariosBeginsWith($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo terminando por $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComentariosEndsWith($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 90);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 92);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 94);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosEndsWith($prestamoComentarios);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComentariosEndsWith($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo terminando por $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComentariosEndsWith($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 91);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 93);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 95);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosEndsWith($prestamoComentarios);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComentariosEndsWith($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo que contenga $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComentariosContains($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 96);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 98);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 100);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosContains($prestamoComentarios);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComentariosContains($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo que contenga $prestamoComentarios
         * 
         * @param $prestamoComentarios
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComentariosContains($prestamoComentarios, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 97);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 99);
            }

            if( !(EntityValidator::validateString($prestamoComentarios))){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 101);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComentariosContains($prestamoComentarios);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComentariosContains($prestamoComentarios, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Obtener algunos Prestamo dado el $prestamoEstudianteId
         * 
         * @param $prestamoEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoEstudianteId($prestamoEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($prestamoEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 102);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 104);
            }

            if( !EntityValidator::validateId($prestamoEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 106);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 108);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEstudiante($obj);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado el $prestamoEstudianteId
         * 
         * @param $prestamoEstudianteId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoEstudianteId($prestamoEstudianteId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new EstudianteBean($this->persistenceManager);
            $obj = new Estudiante();
            $obj->setId($prestamoEstudianteId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 103);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 105);
            }

            if( !EntityValidator::validateId($prestamoEstudianteId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 107);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getEstudiante($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 109);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoEstudiante($obj);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoEstudiante($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }
        /**
         * Obtener algunos Prestamo dado el $prestamoComputadoraId
         * 
         * @param $prestamoComputadoraId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function getPrestamosByPrestamoComputadoraId($prestamoComputadoraId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ComputadoraBean($this->persistenceManager);
            $obj = new Computadora();
            $obj->setId($prestamoComputadoraId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 110);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 112);
            }

            if( !EntityValidator::validateId($prestamoComputadoraId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 114);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getComputadora($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 116);
            }

            # Obtenemos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComputadora($obj);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->getPrestamosByPrestamoComputadora($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Listar algunos Prestamo dado el $prestamoComputadoraId
         * 
         * @param $prestamoComputadoraId
         * @param $performSize
         * @param $firstResultNumber
         * @param $numResults
        */
        public function listPrestamosByPrestamoComputadoraId($prestamoComputadoraId, $performSize = false, $firstResultNumber = null, $numResults = null, $orderBy = null, $orderPriority = SQL_ASCENDING_ORDER){
            $objBean = new ComputadoraBean($this->persistenceManager);
            $obj = new Computadora();
            $obj->setId($prestamoComputadoraId);

            # Validamos los campos
            if($firstResultNumber !== null && !EntityValidator::validatePositiveNumber($firstResultNumber)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 111);
            }

            if(!EntityValidator::validateGlobalOrderPriority($orderPriority)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 113);
            }

            if( !EntityValidator::validateId($prestamoComputadoraId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 115);
            }

            # Verificamos que la entidad exista
            if(!$objBean->getComputadora($obj)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 117);
            }

            # Listamos las entidades
            if($performSize){
                $this->lastRequestSize = $this->prestamoBean->countGetPrestamosByPrestamoComputadora($obj);
            }

            return PrestamoDTO::loadFromEntities($this->prestamoBean->listPrestamosByPrestamoComputadora($obj, $firstResultNumber, $numResults, $orderBy, $orderPriority));

        }

        /**
         * Eliminar un Prestamo Dado el $prestamoId
         * 
         * @param $prestamoId
        */
        public function removePrestamo($prestamoId){

            $prestamo = new Prestamo();
            $prestamo->setId($prestamoId); 

            # Validamos los campos
            if( !EntityValidator::validateId($prestamoId)){
                throw new Exception(SALAS_COMP_ALERT_E_VALIDATION_FAIL, $this->ID + 118);
            }

            # Verificamos que la entidad exista.
            if(!$this->prestamoBean->getPrestamo($prestamo)){
                throw new Exception(SALAS_COMP_ALERT_E_ENTITY_NOT_FOUND_FAIL, $this->ID + 119);
            }

            # Verificamos que la entidad no esté siendo utilziada en alguna otra.

            # Eliminamos la entidad
            if(!$this->prestamoBean->removePrestamo($prestamo)){
                throw new Exception(SALAS_COMP_ALERT_E_PERSISTENCE_REMOVE_FAIL, $this->ID + 120);
            }

        }

    }

?>