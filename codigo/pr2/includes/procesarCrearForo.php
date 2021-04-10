<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Foro.php';

$tema = htmlspecialchars(trim(strip_tags($_REQUEST["tema"])));
$asunto = htmlspecialchars(trim(strip_tags($_REQUEST["asunto"])));
$contenido = htmlspecialchars(trim(strip_tags($_REQUEST["contenidoMensaje"])));

    //faltaria validar
    $foro = \aw\servitrade\Foro::crea($tema, $asunto);
    /* Insertamos el foro en la BBDD */
    $foro->insertBBDD($tema, $asunto);

?>