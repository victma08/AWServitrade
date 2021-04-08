<?php session_start(); ?>
<?php
//recuperar atributos de la sesion


/* Ya tenemos el foro creado */
$MensaForo = new MensajeForo($id, $idForo, $idUsuario, $mensajeOrigen,$contenido, $fecha);

/* Insertamos el foro en la BBDD */
$MensaForo->insertBBDD($id, $idForo, $idUsuario, $mensajeOrigen,$contenido, $fecha);

/* Actualizamos un foro */
$MensaForo->updateBBDD($id, $idForo, $idUsuario, $mensajeOrigen,$contenido, $fecha);

/*Borrar el foro (solo admin)*/
$MensaForo->deleteBBDD($id);
?>