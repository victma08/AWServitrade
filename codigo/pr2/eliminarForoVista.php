<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Foro.php';

if (estaLogado() && esAdmin()) {
    
    $idForo = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    /*if (!$idMensaje) {
        header('Location: '.RUTA_APP.'/tablon.php');
        exit();
    }*/

    $foro = Foro::buscarForoPorId($idForo);

    //borrar tambien los mensajes asociados a ese foro
    Foro::borraPorId($idForo);

    header('Location: '.RUTA_APP.'/ForoVista.php');
    
} 
    
require __DIR__.'/includes/comun/layout.php';