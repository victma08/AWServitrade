<?php
    require_once __DIR__.'/includes/config.php';
    //require_once __DIR__.'/includes/Objetos/Foro.php';
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
        
            <?php
                if($app->usuarioLogueado()){
            
				//echo Foro::mostrarTodos();
                
            ?>
                <form>
                    <!--vista de crear un foro-->
                    <a href='crearForoVista.php'>Crear foro</a>;
                    <!--<button type="submit" onclick="location.href='noticiasAdmin.php'">Crear Foro</button> -->
                    
                
                </form>
            <?php
                if ($app->esAdmin("admin")) {
            ?>        
                <form>
                    <!--vista de eliminar un foro-->
                    <a href='eliminarForoVista.php'>Eliminar foro</a>;
                    <!--<button type="submit" onclick="location.href='noticiasAdmin.php'">Crear Foro</button> -->
                </form>
            <?php
                }
		    } //cierre del if de usuario logueado
            ?>      

    </div> <!-- Fin del contenido -->
    <?php
        $app->doInclude("/comun/sidebarDer.php");
        $app->doInclude("/comun/pie.php");
    ?>

</div> <!-- Fin del contenedor -->

</body>
</html>