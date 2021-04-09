<?php
session_start();

    $foro = new Foro(NULL, $tema, $asunto);

    $id = $_POST['id'];

    /*Borrar el foro (solo admin)*/
    $foro->deleteBBDD($id);

?>
