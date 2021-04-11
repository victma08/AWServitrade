<?php


require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Login';

$raizApp = RUTA_APP;
$contenidoPrincipal=<<<EOS
<h1>Acceso al sistema</h1>

<form id="formLogin" action="${raizApp}/procesarLogin.php" method="POST">
<fieldset>
	<legend>Usuario y contraseña</legend>
	<div><label>Name:</label> <input type="text" name="username" /></div>
	<div><label>Password:</label> <input type="password" name="password" /></div>
	<div><button type="submit">Entrar</button></div>
</fieldset>
EOS;

require __DIR__.'/includes/comun/layout.php';