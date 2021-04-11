<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Foro.php';
require_once __DIR__.'/includes/MensajeForo.php';
require_once __DIR__.'/includes/Foro.php';

$tema = filter_input(INPUT_POST, 'tema', FILTER_SANITIZE_SPECIAL_CHARS);
$asunto = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_SPECIAL_CHARS);
$contenido = filter_input(INPUT_POST, 'contenidoMensaje', FILTER_SANITIZE_SPECIAL_CHARS);

if ($contenido) {
    $foro = Foro::crea(idUsuarioLogado(), $tema, $asunto);
    $foro->guarda();
    
    $mensaje = Mensaje::crea(idUsuarioLogado(), $textoMensaje, $idMensajePadre);
    //$mensajeForo = MensajeForo::crea($foro->getId(), $usuario->getId(), $contenido, NULL);
    $mensaje->guarda();
}

if ($idMensajePadre) {
    header('Location: '.RUTA_APP.'/mensajes.php?id='.$idMensajePadre);
} else {
    header('Location: '.RUTA_APP.'/mensajeForoVista.php');
}



<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Foro.php';

$tema = htmlspecialchars(trim(strip_tags($_REQUEST["tema"])));
$asunto = htmlspecialchars(trim(strip_tags($_REQUEST["asunto"])));
$contenido = htmlspecialchars(trim(strip_tags($_REQUEST["contenidoMensaje"])));

    //faltaria validar

    /* Crear foro */
    $foro = Foro::crea($tema, $asunto);

    /* Insertamos el foro en la BBDD */
    $foro->inserta($foro);

    $usuario = Usuario::buscaUsuario($_SESION[user]);

     /* Crear mensaje */
    $mensajeForo = MensajeForo::crea($foro->getId(), $usuario->getId(), $contenido, NULL);

    /* Insertamos el mensaje en la BBDD */
    $mensajeForo->inserta($mensajeForo);

    header('Location: '.RUTA_APP.'/ForoVista.php');
?>