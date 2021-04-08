<?php
use Aw\Servitrade\Aplicacion;

function mostrarSaludo() {
  $html = '';
  $app = Aplicacion::getSingleton();
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