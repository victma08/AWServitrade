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

	public static function getAsunto(int $id) : string {

		return $asunto;
	}

	//no se modifica ni tema ni asunto, por eso no ponemos set

	public static function insertBBDD($id, $tema, $asunto) : bool{
	
		$app = Aplicacion::getSingleton();
		$connex = $app->conexionBd();
		
		$query=sprintf("INSERT INTO FORO(ID, TEMA_FOROS, ASUNTO) VALUES('%s', '%s', '%s')"
			, $connex->real_escape_string($id)
			, $connex->real_escape_string($tema)
			, $connex->real_escape_string($asunto));

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

	public static function updateBBDD($id, $tema, $asunto) : bool{
	
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