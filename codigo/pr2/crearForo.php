<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Foro.php';
require_once __DIR__.'/includes/MensajeForo.php';
require_once __DIR__.'/includes/Usuario.php';

$tema = htmlspecialchars(trim(strip_tags($_REQUEST["tema"])));
$asunto = htmlspecialchars(trim(strip_tags($_REQUEST["asunto"])));
$contenido = htmlspecialchars(trim(strip_tags($_REQUEST["contenidoMensaje"])));


    //faltaria validar
    /* Crear foro */
    $foro = Foro::crea($tema, $asunto);

    /* Insertamos el foro en la BBDD */
    $foroInsertado = $foro->inserta($foro);
    $idForo = $foroInsertado->getId();
    $idUsuario = idUsuarioLogado();
    
     /* Crear mensaje */
    $mensajeForo = MensajeForo::crea($idForo, $idUsuario, $contenido, NULL);

    /* Insertamos el mensaje en la BBDD */
    $mensajeForo->inserta($mensajeForo);

    header('Location: '.RUTA_APP.'/ForoVista.php');
?>