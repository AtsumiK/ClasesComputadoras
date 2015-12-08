<?php
	// session_start();
	error_reporting ( E_ALL );
	ini_set ( 'display_errors', 1 );

	require_once '../../common/config/globalEnums.php';
	date_default_timezone_set ( 'America/Bogota' );

	require_once SALAS_COMP_CONFIG_DIR . SALAS_COMP_ENUMS_FILE;
	require_once SALAS_COMP_CONFIG_DIR . SALAS_COMP_CONFIG_FILE;
	require_once SALAS_COMP_CONTROLLER_DIR . SALAS_COMP_MAIN_CONTROLLER;

	require_once UTILS_DIR . COMMUNICATION_MESSAGE_OBJ;

//prueba crear
/* no sale mensaje de error cuando se une sof con pc en ent compSof
 * OBJ PERDIDO PROPRIETARIO ELIMINAR CAMPO
 */

/*
 	$dto = new SalonDTO(null, 'fdsa');
	insertarSalon($dto);

 $dto = new PersonaDTO(null, '542', 'sdfg', 'sgdf');
 insertarPersona($dto);
 $dto = new ResponsableDTO(null, 'SFG', 'SDFG', '1');
 insertarResponsable($dto);
 $dto = new EstudianteDTO(null, '5423','gfs', 'fasd', '1');
 insertarEstudiante($dto);
 $dto = new ComputadoraDTO(null, 'aaa', 'bb', 'cc', 'dd', 'ee', 'ff', null);
 insertarComputadora($dto);
 $dto = new SoftwareDTO(null, '234567', 'aaa', '1', '12/02/2016' , '12/02/2016' , '1', 'fsg');
 insertarSoftware($dto);
 $dto = new ComputadoraSoftwareDTO(null,'234567','12/02/2016', '1', '1');
 insertarComputadoraSoftware($dto);
 $dto = new ImpresionDTO(null, '12/02/2016', 'fasd', '1');
 insertarImpresion($dto);
 $dto = new MonitorDTO(null, 'qr', '12/02/2016' , '1');
 insertarMonitor($dto);
 $dto = new MonitorSalonDTO(null, '12/02/2016', '12/02/2016', 'GSDF', '1', '1');
 insertarMonitorSalon($dto);
 $dto = new ObjetoEnInventarioDTO(null, 'fsd', '524', '1', '1');
 insertarObjetoEnInventario($dto);
 $dto = new ObjetoPerdidoDTO(null, 'sf', '12/02/2016', 'SDF', '12/02/2016', 'gsf', '1', null);
 insertarObjetoPerdido($dto);
 $dto = new PrestamoDTO(null, '12/02/2016', '12/02/2016', 'fsd', '1', '1');
 insertarPrestamo($dto);
 $dto = new ReservaDTO(null, 'SGF', '12/02/2016', '12/02/2016', '1', '1');
 insertarReserva($dto);
 $dto = new TareaDTO(null, 'fgsd', 'gsf', '12/02/2016', '12/02/2016', '1');
 insertarTarea($dto);

//prueba consultar
$te=consultarEstudiante(1);				echo $te["content"]->getId().'<br/>';
$te=consultarImpresion(1);				echo $te["content"]->getId().'<br/>';
$te=consultarMonitor(1);				echo $te["content"]->getId().'<br/>';
$te=consultarMonitorSalon(1);			echo $te["content"]->getId().'<br/>';
$te=consultarObjetoEnInventario(1);		echo $te["content"]->getId().'<br/>';
$te=consultarObjetoPerdido(1);			echo $te["content"]->getId().'<br/>';
$te=consultarPersona(1);				echo $te["content"]->getId().'<br/>';
$te=consultarPrestamo(1);				echo $te["content"]->getId().'<br/>';
$te=consultarReserva(1);				echo $te["content"]->getId().'<br/>';
$te=consultarResponsable(1);			echo $te["content"]->getId().'<br/>';
$te=consultarSoftware(1);				echo $te["content"]->getId().'<br/>';
$te=consultarTarea(1);					echo $te["content"]->getId().'------<br/>';

//prueba lista

	$res = listarComputadoras();			printListas($res,'computadoras');
	$res = listarComputadoraSoftwares();	printListas($res,'computadora softwares');
	$res = listarEstudiantes();				printListas($res,'estudiantes');
	$res = listarImpresiones();				printListas($res,'impresiones');
	$res = listarMonitores();				printListas($res,'monitores');
	$res = listarMonitorSalones();			printListas($res,'monit salnes');
	$res = listarObjetoEnInventarios();		printListas($res,'inventa');
	$res = listarObjetoPerdidos();			printListas($res,'o perdidos');
	$res = listarPersonas();				printListas($res,'persona');
	$res = listarPrestamos();				printListas($res,'prest');
	$res = listarReservas();				printListas($res,'reser');
	$res = listarResponsables();			printListas($res,'respon');
	$res = listarSoftwares();				printListas($res,'soft');
	$res = listarTareas();					printListas($res,'tareas');
	function printListas($res,$mens){
		if($res["exito"]){
			$temp = $res["content"];
			echo '<table style="width:100%">'.$mens.'<tr></tr>';foreach ($temp as $tmp) {echo '<tr><td>'.$tmp->getId().'</td></tr>';}echo'</table>';
		}else{
			echo $res["content"];
		}
	}

//prueba modificar
$te=consultarComputadora(1);
$te = $te["content"];
$te = editarComputadora($te);
echo $te["content"].'<br/>';

$te=consultarEstudiante(1);
$te = $te["content"];
$te = editarEstudiante($te);
echo $te["content"].'<br/>';

$te=consultarMonitor(1);
$te = $te["content"];
$te = editarMonitor($te);
echo $te["content"].'<br/>';

$te=consultarMonitorSalon(1);
$te = $te["content"];
$te = editarMonitorSalon($te);
echo $te["content"].'<br/>';

$te=consultarObjetoEnInventario(1);
$te = $te["content"];
$te = editarObjetoEnInventario($te);
echo $te["content"].'<br/>';

$te=consultarObjetoPerdido(1);
$te = $te["content"];
$te = editarObjetoPerdido($te);
echo $te["content"].'<br/>';

$te=consultarPrestamo(1);
$te = $te["content"];
$te = editarPrestamo($te);
echo $te["content"].'<br/>';

$te=consultarReserva(1);
$te = $te["content"];
$te = editarReserva($te);
echo $te["content"].'<br/>';

$te=consultarResponsable(1);
$te = $te["content"];
$te = editarResponsable($te);
echo $te["content"].'<br/>';

$te=consultarSoftware(1);
$te = $te["content"];
$te = editarSoftware($te);
echo $te["content"].'<br/>';

$te=consultarTarea(1);
$te = $te["content"];
$te = editarTarea($te);
echo $te["content"].'-----<br/>';



//prueba eliminar

	eliminarComputadora(1);
	eliminarComputadoraSoftware(1);
	eliminarEstudiante(1);
	eliminarImpresion(1);
	eliminarMonitor(1);
	eliminarMonitorSalon(1);
	eliminarObjetoEnInventario(1);
	eliminarObjetoPerdido(1);
	eliminarPersona(1);
	eliminarPrestamo(1);
	eliminarReserva(1);
	eliminarResponsable(1);
	eliminarSoftware(1);
	eliminarTarea(1);
*/












//Salones
	function listarSalones($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getSalones ( $firstItem, "ASC" );
		$salones = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $salones
		);
	}
	function consultarSalon($idSalon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getSalon ( $idSalon );
		$salon = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $salon
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarSalon($idSalon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeSalon ( $idSalon );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarSalon($salon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateSalon ( $salon );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarSalon($salon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setSalon ( $salon );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Computadoras
	function listarComputadoras($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getComputadoras( $firstItem, "ASC" );
		$computadoras = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $computadoras
		);
	}
	function consultarComputadora($idComputadora) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getComputadora( $idComputadora );
		$computadora = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $computadora
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarComputadora($idComputadora) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeComputadora( $idComputadora );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarComputadora($computadora) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateComputadora( $computadora );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarComputadora($computadora) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setComputadora( $computadora );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//ComputadoraSoftwares
	function listarComputadoraSoftwares($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getComputadoraSoftwares( $firstItem, "ASC" );
		$computadoraSoftware = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $computadoraSoftware
		);
	}
	function consultarComputadoraSoftware($idComputadoraSoftware) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getComputadoraSoftware( $idComputadoraSoftware );
		$computadoraSoftware = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $computadoraSoftware
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarComputadoraSoftware($idComputadoraSoftware) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeComputadoraSoftware( $idComputadoraSoftware );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarComputadoraSoftware($computadoraSoftware) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setComputadoraSoftware( $computadoraSoftware );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Estudiantes
	function listarEstudiantes($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getEstudiantes ( $firstItem, "ASC" );
		$estudiantes = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $estudiantes
		);
	}
	function consultarEstudiante($idEstudiante) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getEstudiante ( $idEstudiante );
		$estudiante = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $estudiante
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarEstudiante($idEstudiante) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeEstudiante ( $idEstudiante );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarEstudiante($estudiante) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateEstudiante ( $estudiante );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarEstudiante($estudiante) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setEstudiante ( $estudiante );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Impresiones
	function listarImpresiones($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getImpresions ( $firstItem, "ASC" );
		$impresiones = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $impresiones
		);
	}
	function consultarImpresion($idImpresion) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getImpresion ( $idImpresion );
		$impresion = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $impresion
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarImpresion($idImpresion) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeImpresion ( $idImpresion );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarImpresion($impresion) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setImpresion ( $impresion );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Monitores
	function listarMonitores($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getMonitors ( $firstItem, "ASC" );
		$monitores = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $monitores
		);
	}
	function consultarMonitor($idMonitor) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getMonitor ( $idMonitor );
		$monitor = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $monitor
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarMonitor($idMonitor) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeMonitor ( $idMonitor );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarMonitor($monitor) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateMonitor ( $monitor );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarMonitor($monitor) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setMonitor ( $monitor );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Monitor Salones
	function listarMonitorSalones($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getMonitorSalons ( $firstItem, "ASC" );
		$monitorSalones = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $monitorSalones
		);
	}
	function consultarMonitorSalon($idMonitorSalon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getMonitorSalon ( $idMonitorSalon );
		$monitorSalon = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $monitorSalon
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarMonitorSalon($idMonitorSalon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeMonitorSalon ( $idMonitorSalon );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarMonitorSalon($monitorSalon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateMonitorSalon ( $monitorSalon );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarMonitorSalon($monitorSalon) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setMonitorSalon ( $monitorSalon );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Objetos Inventario
	function listarObjetoEnInventarios($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getObjetoEnInventarios ( $firstItem, "ASC" );
		$objetoEnInventarios = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $objetoEnInventarios
		);
	}
	function consultarObjetoEnInventario($idObjetoEnInventario) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getObjetoEnInventario ( $idObjetoEnInventario );
		$objetoEnInventario = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $objetoEnInventario
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarObjetoEnInventario($idObjetoEnInventario) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeObjetoEnInventario ( $idObjetoEnInventario );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarObjetoEnInventario($objetoEnInventario) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateObjetoEnInventario ( $objetoEnInventario );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarObjetoEnInventario($objetoEnInventario) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setObjetoEnInventario ( $objetoEnInventario );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Objetos Perdidos
	function listarObjetoPerdidos($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getObjetoPerdidos ( $firstItem, "ASC" );
		$objetoPerdidos = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $objetoPerdidos
		);
	}
	function consultarObjetoPerdido($idObjetoPerdido) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getObjetoPerdido ( $idObjetoPerdido );
		$objetoPerdido = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $objetoPerdido
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarObjetoPerdido($idObjetoPerdido) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeObjetoPerdido ( $idObjetoPerdido );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarObjetoPerdido($objetoPerdido) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateObjetoPerdido ( $objetoPerdido );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarObjetoPerdido($objetoPerdido) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setObjetoPerdido ( $objetoPerdido );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Personas
	function listarPersonas($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getPersonas ( $firstItem, "ASC" );
		$personas = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $personas
		);
	}
	function consultarPersona($idPersona) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getPersona ( $idPersona );
		$persona = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $persona
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarPersona($idPersona) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removePersona ( $idPersona );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarPersona($persona) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setPersona ( $persona );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Prestamos
	function listarPrestamos($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getPrestamos ( $firstItem, "ASC" );
		$prestamos = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $prestamos
		);
	}
	function consultarPrestamo($idPrestamo) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getPrestamo ( $idPrestamo );
		$prestamo = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $prestamo
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarPrestamo($idPrestamo) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removePrestamo ( $idPrestamo );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarPrestamo($prestamo) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updatePrestamo ( $prestamo );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarPrestamo($prestamo) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setPrestamo ( $prestamo );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Reservas
	function listarReservas($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getReservas ( $firstItem, "ASC" );
		$reservas = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $reservas
		);
	}
	function consultarReserva($idReserva) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getReserva ( $idReserva );
		$reserva = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $reserva
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarReserva($idReserva) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeReserva ( $idReserva );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarReserva($reserva) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateReserva ( $reserva );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarReserva($reserva) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setReserva ( $reserva );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Responsables
	function listarResponsables($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getResponsables ( $firstItem, "ASC" );
		$responsables = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $responsables
		);
	}
	function consultarResponsable($idResponsable) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getResponsable ( $idResponsable );
		$responsable = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $responsable
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarResponsable($idResponsable) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeResponsable ( $idResponsable );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarResponsable($responsable) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateResponsable ( $responsable );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarResponsable($responsable) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setResponsable ( $responsable );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Softawares
	function listarSoftwares($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getSoftwares ( $firstItem, "ASC" );
		$softwares = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $softwares
		);
	}
	function consultarSoftware($idSoftware) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getSoftware ( $idSoftware );
		$software = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $software
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarSoftware($idSoftware) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeSoftware ( $idSoftware );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarSoftware($software) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateSoftware ( $software );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarSoftware($software) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setSoftware ( $software );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

//Tareas
	function listarTareas($firstItem = 0) {
		$mainCtrl = new SalasMainController ();

		$cm = $mainCtrl->getTareas ( $firstItem, "ASC" );
		$tareas = $cm->getData ();
		return array (
				"exito" => $cm->getStatus (),
				"content" => $tareas
		);
	}
	function consultarTarea($idTarea) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->getTarea ( $idTarea );
		$tarea = $cm->getData ();
		if ($cm->getStatus ()) {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $tarea
			);
		} else {
			return array (
					"exito" => $cm->getStatus (),
					"content" => $cm->getMessage ()
			);
		}
	}
	function eliminarTarea($idTarea) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->removeTarea ( $idTarea );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function editarTarea($tarea) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->updateTarea ( $tarea );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}
	function insertarTarea($tarea) {
		$mainCtrl = new SalasMainController ();
		$cm = $mainCtrl->setTarea ( $tarea );
		return array (
				"exito" => $cm->getStatus (),
				"content" => $cm->getMessage ()
		);
	}

?>
