<?php
session_start();
$tema = htmlspecialchars(trim(strip_tags($_REQUEST["tema"])));
$asunto = htmlspecialchars(trim(strip_tags($_REQUEST["asunto"])));
$contenido = htmlspecialchars(trim(strip_tags($_REQUEST["contenidoMensaje"])));

//faltaria validar
    $foro = new Foro(NULL, $tema, $asunto);

   /* Insertamos el foro en la BBDD */
   $foro->insertBBDD($tema, $asunto);

?>