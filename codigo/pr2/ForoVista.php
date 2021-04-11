<?php
    require_once __DIR__.'/includes/config.php';
    require_once __DIR__.'/includes/autorizacion.php';

    $tituloPagina = 'Foro';
    $raizApp = RUTA_APP;
    $contenidoPrincipal= <<<EOS
        <h1> Foros </h1>
    EOS;
    if(estaLogado()){
        $contenidoPrincipal .=<<<EOS
            
        <form  action="./crearForoVista.php" method="POST">
            <div><button type="submit">Crear</button></div>
        </form>
        EOS;
        /*if(esAdmin()){
            $contenidoPrincipal .= <<<EOS
                <form>
                    <!--vista de crear un foro-->
                    <a href='eliminarForoVista.php'>Eliminar foro</a>
                    <button type="submit" onclick="location.href='eliminarForoVista.php'">Eliminar Foro</button> 
                </form>
            EOS;
        }
        */
    }


        
    require __DIR__.'/includes/comun/layout.php';
?>
