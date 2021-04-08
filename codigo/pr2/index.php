<?php
    require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?= $app->resuelve('/css/styles.css') ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Portada</title>
</head>

<body>

<div id="contenedor">
    <?php
        $app->doInclude("/comun/cabecera.php");
        $app->doInclude("/comun/sidebarIzq.php");
    ?>
    <div id="contenido">
        <h1>Página principal</h1>
        <p> Aquí está el contenido público, visible para todos los usuarios. </p>
    </div>
    <?php
        $app->doInclude("/comun/sidebarDer.php");
        $app->doInclude("/comun/pie.php");
    ?>

</div> <!-- Fin del contenedor -->

</body>
</html>

