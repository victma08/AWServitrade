<?php

require_once __DIR__.'/includes/config.php';

$app->logout();

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!-- <link rel="stylesheet" type="text/css" href="estilo.css" /> -->
  <title>Logout</title>
</head>
<body>
<div id="contenedor">
<?php
require("cabecera.php");
?>
	<div id="contenido">
		<h1>Hasta pronto!</h1>
	</div>
<?php
require("pie.php"); 
?>
</div>
</body>
</html>
