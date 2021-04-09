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

     <h1>Crear un foro</h1>
            <form action="/includes/procesarCrearForo.php" method="POST">
            <fieldset>
            <legend>Escriba un tema y asunto para un foro</legend>
            <p><label>Tema:</label> <input type="text" name="tema" /></p>
            <p><label>Asunto:</label> <input type="text" name="asunto" /></p>
            <p><label>Mensaje:</label> <input type="text" name="contenidoMensaje" /></p>
            <button type="submit">Crear</button>
            </fieldset>
            </form>        

    </div> <!-- Fin del contenido -->
    <?php
        $app->doInclude("/comun/sidebarDer.php");
        $app->doInclude("/comun/pie.php");
    ?>

</div> <!-- Fin del contenedor -->

</body>
</html>