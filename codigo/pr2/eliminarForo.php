<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/autorizacion.php';
require_once __DIR__.'/includes/Foro.php';
require_once __DIR__.'/includes/MensajeForo.php';
require_once __DIR__.'/includes/Usuario.php';

if (estaLogado() && esAdmin()) {
    
    $idForo = htmlspecialchars(trim(strip_tags($_REQUEST["id"])));


    /*if (!$idMensaje) {
        header('Location: '.RUTA_APP.'/tablon.php');
        exit();
    }*/

   // $foro = Foro::buscarForoPorId($idForo);

    Foro::borraPorId($idForo);

    //borrar tambien los mensajes asociados a ese foro

    header('Location: '.RUTA_APP.'/ForoVista.php');
    
} 
    
require __DIR__.'/includes/comun/layout.php';
