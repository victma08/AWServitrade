<?php
    require_once __DIR__.'/includes/config.php';
    
    //mostrar los foros como en mensajeForoVista
    
    $tituloPagina = 'Nuevo foro';
     $contenidoPrincipal =<<<EOS
            <h1>Crear un foro</h1>
            <form id="formForo" action="crearForo.php" method="POST">
            <fieldset>
            <legend>Escriba un tema y asunto para un foro</legend>
            <div><label>Tema:</label> <input type="text" name="tema" /></div>
            <div><label>Asunto:</label> <input type="text" name="asunto" /></div>
            <div><label>Mensaje:</label> <input type="text" name="contenidoMensaje" /></div>
            <div><button type="submit">Crear</button></div>
            </fieldset>
            </form>
     EOS;

require __DIR__.'/includes/comun/layout.php';
