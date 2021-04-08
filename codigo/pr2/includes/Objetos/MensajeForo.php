<?php
//Objeto y Acceso a la BBDD

namespace Aw\Servitrade;

use Aw\Servitrade\Aplicacion;

class MensajeForo
{
	private $id; //id del foro
	private $idForo; //id del foro al que pertenece el mensaje
    private $idUsuario; //id del que escribio el mensaje
    private $mensajeOrigen; //id del mensaje padre
    private $contenido;
    private $fecha;

	private function __construct($id, $idForo, $idUsuario, $mensajeOrigen,$contenido, $fecha){
		$this->id = $id;
        $this->idForo = $idForo;
		$this->idUsuario = $idUsuario;
        $this->mensajeOrigen = $mensajeOrigen;
        $this->contenido = $contenido;
		$this->fecha = $fecha;
	}

	public static function getID() : int {

		return $id;
	}

	public static function getIdForo() :int{

		return $idForo;
	}

	public static function getIdUsuario() :int{

		return $idUsuario;
	}

	public static function getMensajeOrigen() : int {

		return $mensajeOrigen;
	}

	public static function getContenido() :string{

		return $contenido;
	}

	public static function getFecha() :string{

		return $fecha;
	}

	public static function setContenido($contenido) :string{

		$this->contenido = $contenido;
	}

	public static function insertBBDD($id, $idForo, $idUsuario, $mensajeOrigen,$contenido, $fecha) : bool{
	
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();
		
		$query=sprintf("INSERT INTO COMENTARIOS_FORO(ID, ID_MENSAJE_PADRE, FORO, CONTENIDO, USUARIO_CREADOR,FECHA_CREACION) VALUES('%s', '%s', '%s', '%s', '%s', '%s')"
		, $connex->real_escape_string($id)
		, $connex->real_escape_string($idForo)
		, $connex->real_escape_string($idUsuario)
		, $connex->real_escape_string($mensajeOrigen)
		, $connex->real_escape_string($contenido)
		, $connex->real_escape_string($fecha));

		if ( !($connex->query($query)) ) {
			//echo "Error al insertar en la BD: (" . $connex->errno . ") " . utf8_encode($connex->error);
			return false;
		}
		return true;
	}

	public static function deleteBBDD($id) : bool{
	
		//$result = array();
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();
		
		$query=sprintf("DELETE FROM COMENTARIOS_FORO WHERE ID=$id");
		$rs = $conn->query($query);
		
		if($rs){
			//$result[]='El mensaje ha sido eliminado';
			return true;
		}
		else{
			//$result[]='Error al eliminar el mensaje';
			return false;
		}
	}

	public static function updateBBDD($id, $idForo, $idUsuario, $mensajeOrigen, $contenido, $fecha) : bool{
			
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();

		$query=sprintf("UPDATE INTO COMENTARIOS_FORO WHERE ID=$id"
			, $connex->real_escape_string($id)
			, $connex->real_escape_string($idForo)
			, $connex->real_escape_string($idUsuario)
			, $connex->real_escape_string($mensajeOrigen)
			, $connex->real_escape_string($contenido)
			, $connex->real_escape_string($fecha));
		if ( !($connex->query($query)) ) {
			//echo "Error al actualizar en la BD: (" . $connex->errno . ") " . utf8_encode($connex->error);
			return false;
		  }
		return true;
	}
}