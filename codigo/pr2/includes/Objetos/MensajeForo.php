<?php
//Objeto y Acceso a la BBDD

namespace Aw\Servitrade;

use Aw\Servitrade\Aplicacion;

class MensajeForo
{
	private $id; //id del foro
	private $idForo; //id del foro al que pertenece el mensaje
    private $idUsuario; //id del que escribio el mensaje
    //private $mensajeOrigen; //id del mensaje padre
    private $contenido;
    private $fecha;

	private function __construct($id, $idForo, $idUsuario, $mensajeOrigen,$contenido, $fecha){
		$this->id = $id;
        $this->idForo = $idForo;
		$this->idUsuario = $idUsuario;
       // $this->mensajeOrigen = $mensajeOrigen;
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

/*	public static function getMensajeOrigen() : int {

		return $mensajeOrigen;
	}*/

	public static function getContenido() :string{

		return $contenido;
	}

	public static function getFecha() :string{

		return $fecha;
	}

	public static function setContenido($contenido) :string{

		$this->contenido = $contenido;
	}

	public static function buscarMensajeForoBBDD($id) {

		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
		
		$query = sprintf("SELECT * FROM COMENTARIOS_FORO WHERE ID='$id'");
		$rs = $conn->query($query);
		if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc();
		  //$id, $username, $password,$name,$phone,$direccion,$fechaNacimiento
		  $foro = new MensajeForo($fila['ID'], /*$fila['ID_MENSAJE_PADRE'], */$fila['FORO'],$fila['CONTENIDO'], $fila['USUARIO_CREADOR'], $fila['FECHA_CREACION']);
		  $rs->free();
	
		  return $foro;
		}

		return null;
	}

	public static function mostrarTodosBBDD($idMensaje, $idForo) {
	
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
	
		$query = sprintf("SELECT * FROM COMENTARIOS_FORO WHERE FORO='$idForo' ORDER BY FECHA_CREACION asc");
		$rs = $conn->query($query);
		$texto ='';
		
		 for($i=0;$fila= $rs->fetch_assoc(); $i++) {
			$texto=$texto.'<div id="creador"><h1>'.$fila['USUARIO_CREADOR'].'<div id="contenido"><h1>'.$fila['CONTENIDO'].'</h1><div id="fecha"><p>'.$fila['FECHA_CREACION'].'</div></div>';
			$texto=$texto;		
		}

		$html= <<<EOF
		$texto
	EOF;
		  $rs->free();
		  return $html;
	}

	public static function devuelveMensajesForo(){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();

		$query = sprintf("SELECT * FROM COMENTARIOS_FORO ");
		$rs = $conn->query($query);
		$tabla =array();
		
		for($i=0;$fila= $rs->fetch_assoc(); $i++) {
		
			$tabla[]=$fila;
		}

		$rs->free();
		return $tabla  ;
	}

	public static function insertBBDD($id, $idForo, $idUsuario,/* $mensajeOrigen,*/$contenido, $fecha) {
	
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();
		
		$query=sprintf("INSERT INTO COMENTARIOS_FORO(ID, /*ID_MENSAJE_PADRE,*/ FORO, CONTENIDO, USUARIO_CREADOR,FECHA_CREACION) VALUES('%s', '%s', '%s', '%s', '%s', '%s')"
		, $connex->real_escape_string($id)
		, $connex->real_escape_string($idForo)
		, $connex->real_escape_string($idUsuario)
		//, $connex->real_escape_string($mensajeOrigen)
		, $connex->real_escape_string($contenido)
		, $connex->real_escape_string($fecha));

		if ( !($connex->query($query)) ) {
			//echo "Error al insertar en la BD: (" . $connex->errno . ") " . utf8_encode($connex->error);
			return false;
		}
		return true;
	}

	public static function deleteBBDD($id) {
	
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

	public static function updateBBDD($id, $idForo, $idUsuario,/* $mensajeOrigen, */$contenido, $fecha){
			
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();

		$query=sprintf("UPDATE INTO COMENTARIOS_FORO WHERE ID=$id"
			, $connex->real_escape_string($id)
			, $connex->real_escape_string($idForo)
			, $connex->real_escape_string($idUsuario)
			//, $connex->real_escape_string($mensajeOrigen)
			, $connex->real_escape_string($contenido)
			, $connex->real_escape_string($fecha));
		if ( !($connex->query($query)) ) {
			//echo "Error al actualizar en la BD: (" . $connex->errno . ") " . utf8_encode($connex->error);
			return false;
		  }
		return true;
	}
}