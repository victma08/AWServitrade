<?php
use aw\servitrade as aplicacion;

function mostrarSaludo() {
  $html = '';
  $app = aplicacion\Aplicacion::getSingleton();
  if ($app->usuarioLogueado()) {
    $nombreUsuario = $app->nombreUsuario();
    $logoutUrl = $app->resuelve('/logout.php');
    $html = "Bienvenido, ${nombreUsuario}.<a href='${logoutUrl}'>(salir)</a>";
  } else {
    $loginUrl = $app->resuelve('/login.php');
    $html = "Usuario desconocido. <a href='${loginUrl}'>Login</a>";
  }

  return $html;
}

?>
<div id="cabecera">
	<h1>Servitrade</h1>
	<div class="saludo">
	  <?=	mostrarSaludo() ?>
	</div>
</div>