<?php
//Objeto y Acceso a la BBDD

namespace Aw\Servitrade;

use Aw\Servitrade\Aplicacion;

class Foro
{
	private $id; //id del foto
	private $tema; //tema del que va el foro
	private $asunto; //tema del que va el foro

	private function __construct($id, $tema, $asunto){

		//quitar id???
		$this->id = $id;
		$this->tema = $tema;
		$this->asunto = $asunto;
	}

	public static function getID() : int {

		return $id;
	}

	public static function getTema(): int  {

		return $tema;
	}

	public static function getAsunto(int $id)  {

		return $asunto;
	}

	//busca un foro y lo devuelve
	public static function buscarForoBBDD($id) {

		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
		
		$query = sprintf("SELECT * FROM FORO WHERE ID='$id'");
		$rs = $conn->query($query);
		if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc();
		  
		  $foro = new Foro($fila['ID'], $fila['TEMA_FOROS'], $fila['ASUNTO']);
		  $rs->free();
	
		  return $foro;
		}

		return null;
	}

	//para devolver todos los foros
	public static function devuelveForos(){
		$app = Aplicacion::getSingleton();
  		$conn = $app->conexionBd();

  		$query = sprintf("SELECT * FROM FORO ");
  		$rs = $conn->query($query);
  		$listaForos =array();
  
  		for($i=0;$fila= $rs->fetch_assoc(); $i++) {
   
	  		$tabla[]=$fila;
  		}

		$rs->free();
		return $listaForos;
	}

	//para mostrar el título de todos los foros
	public static function mostrarTodos($id) {
	
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
	
		$query = sprintf("SELECT * FROM FORO ORDER BY TEMA_FOROS asc");
		$rs = $conn->query($query);
		$texto ='';
		
		 for($i=0;$fila= $rs->fetch_assoc(); $i++) {
			$texto=$texto.'<div id="foro"><h1>'.$fila['TEMA_FOROS'].'</h1><div id="asunto"><p>'.$fila['ASUNTO'].'</div></div>';
			$texto=$texto;
			
			
		}
		$html= <<<EOF
		$texto
	EOF;
		  $rs->free();
		  return $html;
	}

	//no se modifica ni tema ni asunto, por eso no ponemos set

	public static function insertBBDD($tema, $asunto) {
	
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();
		
		$query=sprintf("INSERT INTO FORO(ID, TEMA_FOROS, ASUNTO) VALUES(NULL,'%s', '%s')"
			, $connex->real_escape_string($id)
			, $connex->real_escape_string($tema)
			, $connex->real_escape_string($asunto));

		if ( !($connex->query($query)) ) {
			//echo "Error al insertar en la BD: (" . $connex->errno . ") " . utf8_encode($connex->error);
			return false;
		}
		return true;
	}

	public static function deleteBBDD($id){
	
		//$result = array();
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();
		
		$query=sprintf("DELETE FROM FORO WHERE ID=$id");
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

	public static function updateBBDD($id, $tema, $asunto){
	
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();

		$query=sprintf("UPDATE INTO FORO WHERE ID=$id"
			, $connex->real_escape_string($id)
			, $connex->real_escape_string($tema)
			, $connex->real_escape_string($asunto));

	  if ( !($connex->query($query)) ) {
		//echo "Error al actualizar en la BD: (" . $connex->errno . ") " . utf8_encode($connex->error);
		return false;
	  }
		return true;
	}
}