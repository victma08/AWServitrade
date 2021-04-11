<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Mensaje.php';
require_once __DIR__.'/includes/mensajes.php';

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


$tituloPagina = 'Actualiza Mensaje';

if (idUsuarioLogado() !== $mensaje->idAutor && ! esAdmin()) {
    $contenidoPrincipal = <<<EOS
    	<h1>No tienes permisos para editar este mensaje</h1>
    EOS;
	require __DIR__.'/includes/comun/layout.php';
	exit();
}

$idRaizMensajes = filter_input(INPUT_GET, 'idRaizMensajes', FILTER_SANITIZE_NUMBER_INT);
$raizMensajesFormParam = '';
if (! is_null($idRaizMensajes)) {
	$raizMensajesFormParam = <<<EOS
		<input type="hidden" name="idRaizMensajes" value="$idRaizMensajes" />
	EOS;
}

$contenidoPrincipal = "<h1>Mensaje: $mensaje->mensaje</h1>";
$contenidoPrincipal .= <<<EOS
	<form action="actualizaMensaje.php" method="POST">
		$raizMensajesFormParam
		<input type="hidden" name="id" value="$idMensaje" />
		<fieldset>
			<div><label for="mensaje">Mensaje: </label><input id="mensaje" type="text" name="mensaje" value="$mensaje->mensaje"/></div>
			<div><button type="submit">Actualiza</button></div>
		</fieldset>
	</form>
EOS;

require __DIR__.'/includes/comun/layout.php';