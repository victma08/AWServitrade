<?php

require_once __DIR__.'/config.php';


// XXX Esta función es muy similar a la funcion listaMensajesPaginados y en un proyecto real sólo debería de existir una de ellas
function listaMensajes($idMensajePadre = NULL, $recursivo = false, $idRaizMensajes = NULL)
{
    $html = '<ul>';
    $mensajes = Mensaje::buscaPorMensajePadre($idMensajePadre);
    foreach($mensajes as $mensaje) {
        $href = RUTA_APP . '/mensajes.php?id=' . $mensaje->id;
        $username = $mensaje->autor->username();
        $html .= '<li>';
        $html .= "<a href=\"$href\">$mensaje->mensaje ($username) ($mensaje->fechaHora)</a>";
        if (estaLogado() && (esUsuario($mensaje->idAutor) || esAdmin())) {
            $raizMensajesFormParam = '';
            $raizMensajesParam = '';
            if ($idRaizMensajes) {
                $raizMensajesFormParam = <<<EOS
                    <input type="hidden" name="idRaizMensajes" value="$idRaizMensajes" />
                EOS;
                $raizMensajesParam = '&idRaizMensajes='. $idRaizMensajes;
            }
            $html .= <<<EOS
                <a class="boton" href="editarMensaje.php?id={$mensaje->id}{$raizMensajesParam}">Editar</a>
                <form class="inline" action="borraMensaje.php" method="POST">
                    $raizMensajesFormParam
                    <input type="hidden" name="id" value="$mensaje->id" />
                    <button type="submit">Borrar</button>
                </form>
            EOS;
        }
        if ($recursivo) {
            $html .= listaMensajes($mensaje->id, $recursivo, $idRaizMensajes);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';

    return $html;
}