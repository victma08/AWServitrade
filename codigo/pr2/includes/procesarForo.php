<?php session_start(); ?>
<?php
//recuperar atributos de la sesion


/* Ya tenemos el foro creado */
$foro = new Foro($id, $tema, $asunto);

/* Insertamos el foro en la BBDD */
$foro->insertBBDD($id, $tema, $asunto);

/* Actualizamos un foro */
$foro->updateBBDD($id, $tema, $asunto);

/*Borrar el foro (solo admin)*/
$foro->deleteBBDD($id);
?>