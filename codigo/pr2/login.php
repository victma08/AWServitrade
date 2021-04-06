<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<!-- <link rel="stylesheet" type="text/css" href="estilo.css" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>
</head>
<body>
    <div id="contenedor">
        <?php 
        require("cabecera.php"); 
        ?>

        <div id="contenido">
            <h1>Acceso al sistema</h1>
            <form action="FormularioLogin.php" method="POST">
            <fieldset>
            <legend>Usuario y contraseña</legend>
            <p><label>Name:</label> <input type="text" name="username" /></p>
            <p><label>Password:</label> <input type="password" name="password" /></p>
            <button type="submit">Entrar</button>
            </fieldset>
            </form>
        </div>

        <?php
        require("pie.php"); 
        ?>
    </div> <!-- Fin del contenedor -->
</body>
</html>