<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Mensaje.php';

$textoMensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS);
$idMensajePadre = filter_input(INPUT_POST, 'idMensajePadre', FILTER_SANITIZE_NUMBER_INT);
if ($textoMensaje) {
    $mensaje = Mensaje::crea(idUsuarioLogado(), $textoMensaje, $idMensajePadre);
    $mensaje->guarda();
}

if ($idMensajePadre) {
    header('Location: '.RUTA_APP.'/mensajes.php?id='.$idMensajePadre);
} else {
    header('Location: '.RUTA_APP.'/mensajeForoVista.php');
}
