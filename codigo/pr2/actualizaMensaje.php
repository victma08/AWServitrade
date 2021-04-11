<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Mensaje.php';

if (! estaLogado()) {
    header('Location: '.RUTA_APP.'/mensajeForoVista.php');
    exit();
}

$idMensaje = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$textoMensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_SPECIAL_CHARS);

if (!$idMensaje ||  !$textoMensaje) {
    header('Location: '.RUTA_APP.'/mensajeForoVista.php');
    exit();
}

$mensaje = Mensaje::buscaPorId($idMensaje);
if (idUsuarioLogado() === $mensaje->idAutor || esAdmin()) {
    $mensaje->mensaje = $textoMensaje;
    $mensaje->guarda();

    $idRaizMensajes = filter_input(INPUT_POST, 'idRaizMensajes', FILTER_SANITIZE_NUMBER_INT);
    if (! is_null($idRaizMensajes)) {
        header('Location: '.RUTA_APP.'/mensajes.php?id='.$idRaizMensajes);
    } else {
        header('Location: '.RUTA_APP.'/mensajeForoVista.php');
    }
} else {
    $tituloPagina = 'Actualiza Mensaje';
    $contenidoPrincipal = <<<EOS
    <h1>No tienes permisos para actualizar este mensaje</h1>
    EOS;

    require __DIR__.'/includes/comun/layout.php';
}

