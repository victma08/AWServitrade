<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarios.php';

logout();

$tituloPagina = 'Logout';

$contenidoPrincipal=<<<EOS
	<h1>Hasta pronto!</h1>
EOS;

require __DIR__.'/includes/comun/layout.php';