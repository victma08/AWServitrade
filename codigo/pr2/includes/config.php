<?php
// Varios defines para los parámetros de configuración de acceso a la BD y la URL desde la que se sirve la aplicación
define('BD_HOST', 'localhost');
define('BD_NAME', 'servitrade');
define('BD_USER', 'usuario_servitrade');
define('BD_PASS', 'servi trade1');
define('RUTA_APP', '/aw/servitrade');
define('RUTA_IMGS', RUTA_APP.'/img');
define('RUTA_CSS', RUTA_APP.'/css');
define('RUTA_JS', RUTA_APP.'/js');
define('INSTALADA', true );

if (! INSTALADA) {
  echo "La aplicación no está configurada";
  exit();
}

/* */
/* Configuración de Codificación */
/* */

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');

/* */
/* Funciones de gestión de la conexión a la BD */
/* */

$BD = null;

function getConexionBD() {
  global $BD;
  if (!$BD) {
    $BD = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
    if ( $BD->connect_errno ) {
      echo "Error de conexión a la BD: (" . $BD->connect_errno . ") " . $BD->connect_error;
      exit();
    }
    if ( ! $BD->set_charset("utf8mb4")) {
      echo "Error al configurar la codificación de la BD: (" . $BD->errno . ") " . $BD->error;
      exit();
    }
  }
  return $BD;
}

function cierraConexion() {
  // Sólo hacer uso de global para cerrar la conexion !!
  global $BD;
  if ( isset($BD) && ! $BD->connect_errno ) {
    $BD->close();
  }
}

register_shutdown_function('cierraConexion');


/* */
/* Usuario almacenado en memoria */
/* */

/* XXX Quita este comentario y comenta UsuarioBD.php para proba SOLO la funcionalidad de login del usuario.
require_once __DIR__.'/UsuarioArray.php';
*/

/* */
/* Usuario almacenado en BD */
/* */

require_once __DIR__.'/Usuario.php';

// Abrimos la sesión por defecto en todas las peticiones
session_start();