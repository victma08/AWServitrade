<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Mensaje.php';
require_once __DIR__.'/includes/mensajesPaginados.php';

$idMensaje = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$idMensaje) {
    header('Location: '.RUTA_APP.'/mensajeForoVista.php');
    exit();
}

$mensaje = Mensaje::buscaPorId($idMensaje);
if (!$mensaje) {
    header('Location: '.RUTA_APP.'/mensajeForoVista.php');
    exit();
}

$numPagina = filter_input(INPUT_GET, 'numPagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$numPorPagina = filter_input(INPUT_GET, 'numPorPagina', FILTER_SANITIZE_NUMBER_INT) ?? 2;

$tituloPagina = 'Mensaje';

$contenidoPrincipal = "<h1>Mensaje: $mensaje->mensaje</h1>";
$contenidoPrincipal .= listaMensajesPaginados($mensaje->id, true, $idMensaje, $numPorPagina, $numPagina);

if (estaLogado()) {
	$contenidoPrincipal .= <<<EOS
		<h1>Responder</h1>
		<form action="nuevoMensaje.php" method="POST">
			<input type="hidden" name="idMensajePadre" value="$idMensaje" />
			<fieldset>
				<div><label for="mensaje">Respuesta: </label><input id="mensaje" type="text" name="mensaje" /></div>
				<div><button type="submit">Crear</button></div>
			</fieldset>
		</form>
	EOS;
}

require __DIR__.'/includes/comun/layout.php';