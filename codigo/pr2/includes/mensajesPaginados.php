<?php

require_once __DIR__.'/config.php';

function listaMensajesPaginados($idMensajePadre = NULL, $recursivo = false, $idRaizMensajes = NULL, $numPorPagina = 5, $numPagina = 1)
{
    return listaMensajesPaginadosRecursivo($idMensajePadre, $recursivo, $idRaizMensajes, 1, $numPorPagina, $numPagina);
}

function listaMensajesPaginadosRecursivo($idMensajePadre = NULL, $recursivo = false, $idRaizMensajes = NULL, $nivel = 1, $numPorPagina = 5, $numPagina = 1)
{
    $html = '<ul>';
    $mensajes = Mensaje::buscaPorMensajePadrePaginado($idMensajePadre, $numPorPagina, $numPagina-1);
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
            $html .= listaMensajesPaginadosRecursivo($mensaje->id, $recursivo, $idRaizMensajes, $nivel+1, $numPagina, $numPorPagina);
        }
        $html .= '</li>';
    }
    $html .= '</ul>';

    if ($nivel == 1) {
        // Controles de paginacion
        $clasesPrevia='deshabilitado';
        $clasesSiguiente = 'deshabilitado';
        $hrefPrevia = '';
        $hrefSiguiente = '';

        if ($numPagina > 1) {
            // Seguro que hay mensajes anteriores
            $paginaPrevia = $numPagina - 1;
            $clasesPrevia = '';
            $hrefPrevia = 'href="' . RUTA_APP . '/mensajes.php?id='.$idMensajePadre . '&numPagina='. $paginaPrevia . '&numPorPagina='. $numPorPagina . '"';
        }

        if (count($mensajes) == $numPorPagina) {
            // Puede que haya mensajes posteriores
            $paginaSiguiente = $numPagina + 1;
            $clasesSiguiente = '';
            $hrefSiguiente = 'href="' . RUTA_APP . '/mensajes.php?id='.$idMensajePadre . '&numPagina='. $paginaSiguiente . '&numPorPagina='. $numPorPagina . '"';
        }

        $html .=<<<EOS
            <div>
                Página: $numPagina, <a class="boton $clasesPrevia" $hrefPrevia>Previa</a><a class="boton $clasesSiguiente" $hrefSiguiente>Siguiente</a>
            </div>
        EOS;
    }

    return $html;
}