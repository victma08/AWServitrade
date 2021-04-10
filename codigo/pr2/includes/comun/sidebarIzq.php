<?php
use aw\servitrade as aplicacion;

$app = aplicacion\Aplicacion::getSingleton();
?>

<div id="sidebar-left">
	<h3>Navegación</h3>
	<ul>
		<li><a href="<?= $app->resuelve('/index.php')?>">Inicio</a></li>
		<li><a href="<?= $app->resuelve('/ForoVista.php')?>">Foro</a></li>
		<li><a href="<?= $app->resuelve('/mensajes.php')?>">Mensajes</a></li>
	</ul>
</div>
