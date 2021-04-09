<?php
    require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
   
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
        
        









    </div>
    <?php
        $app->doInclude("/comun/sidebarDer.php");
        $app->doInclude("/comun/pie.php");
    ?>

</div> <!-- Fin del contenedor -->

</body>
</html>