<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';
require_once __DIR__.'/includes/autorizacion.php';

checkLogin();

$contenidoPrincipal='';
if (! estaLogado()) {
	$contenidoPrincipal=<<<EOS
		<h1>Error</h1>
		<p>El usuario o contraseña no son válidos.</p>
	EOS;
} else {
	$contenidoPrincipal=<<<EOS
		<h1>Bienvenido ${_SESSION['nombre']}</h1>
		<p>Usa el menú de la izquierda para navegar.</p>
	EOS;
} 

require __DIR__.'/includes/comun/layout.php';