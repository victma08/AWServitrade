<?php
    require_once __DIR__.'/includes/config.php';
    require_once __DIR__.'/includes/autorizacion.php';
    require_once __DIR__.'/includes/Foro.php';
    require_once __DIR__.'/includes/Usuario.php';

    $tituloPagina = 'Foro';
    $raizApp = RUTA_APP;
   $contenidoPrincipal= <<<EOS
        <h1> Foros </h1>
    EOS;
    if(estaLogado()){
        
        $html = Foro::mostrarTodos();
        $contenidoPrincipal .= $html;
        $contenidoPrincipal .=<<<EOS
        <form  action="./crearForoVista.php" method="POST">
            <div><button type="submit">Crear</button></div>
        </form>
        EOS;
    }        
    require __DIR__.'/includes/comun/layout.php';
?>