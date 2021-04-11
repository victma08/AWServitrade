<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Objetos/Foro.php';

$tema = htmlspecialchars(trim(strip_tags($_REQUEST["tema"])));
$asunto = htmlspecialchars(trim(strip_tags($_REQUEST["asunto"])));
$contenido = htmlspecialchars(trim(strip_tags($_REQUEST["contenidoMensaje"])));

    //faltaria validar

    /* Crear foro */
    $foro = \aw\servitrade\Foro::crea($tema, $asunto);

    /* Insertamos el foro en la BBDD */
    $foro->inserta($foro);

    $usuario = \aw\servitrade\Usuario::buscaUsuario($_SESION[user]);

     /* Crear mensaje */
    $mensajeForo = \aw\servitrade\MensajeForo::crea($foro->getId(), $usuario->getId(), $contenido, NULL);

    /* Insertamos el mensaje en la BBDD */
    $mensajeForo->inserta($mensajeForo);
?>