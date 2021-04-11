<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Mensaje.php';
require_once __DIR__.'/includes/mensajes.php';


$tituloPagina = 'Tablon';


$contenidoPrincipal = '<h1>Tablon de Anuncios</h1>';
$contenidoPrincipal .= listaMensajes();
if (estaLogado()) {
	$contenidoPrincipal .= <<<EOS
		<h1>Nuevo Tablon</h1>
		<form action="nuevoMensaje.php" method="POST">
			<fieldset>
				<div><label for="mensaje">Nuevo mensaje: </label><input id="mensaje" type="text" name="mensaje" /></div>
				<div><button type="submit">Crear</button></div>
			</fieldset>
		</form>
	EOS;
}

require __DIR__.'/includes/comun/layout.php';