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

  <nav class="menu">
    <ul>
        <li><a href="<?= $app->resuelve('/index.php')?>">Inicio</a></li> <!--servicios-->
        <li><a href="<?= $app->resuelve('/Foro_Vista.php')?>">Foro</a></li>
        <li><a href="<?= $app->resuelve('/Mensaje_Vista.php')?>">Mensajes</a></li>
    </ul>
  </nav>

    <?=	mostrarSaludo() ?>
  
	</div>
</div>