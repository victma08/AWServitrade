<?php
//Objeto y Acceso a la BBDD

class Foro
{
	private $id; //id del foto
	private $tema; //tema del que va el foro
	private $asunto; //tema del que va el foro

	private function __construct($tema, $asunto, $id = NULL){

		$this->id = $id;
		$this->tema = $tema;
		$this->asunto = $asunto;
	}
	public static function getID() {

		return $id;
	}

	public static function getTema() {

		return $tema;
	}

	public static function getAsunto(int $id)  {

		return $asunto;
	}

	public static function crea($tema, $asunto){
		$foro = new Foro($tema, $asunto);
  
		return $foro;
	}

	//busca un foro y lo devuelve
	public static function buscarForoPorId($id) {

		$conn = $getConexionBD();

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

		$conn = $getConexionBD();

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
	public static function mostrarTodos() {
	
		$conn = $getConexionBD();
	
		$query = sprintf("SELECT * FROM FORO ORDER BY TEMA_FOROS asc");
		$rs = $conn->query($query);
		$texto ='';
		
		 for($i=0;$fila= $rs->fetch_assoc(); $i++) {
			$texto.=$texto.'<div id="foro"><h1>'.$fila['TEMA_FOROS'].'</h1><div id="asunto"><p>'.$fila['ASUNTO'].'</div></div>'.

			<form class="inline" action="eliminarForoVista.php" method="POST">
				//$raizMensajesFormParam
				<input type="hidden" name="id" value="$foro->id" />
				<button type="submit">Eliminar</button>
			</form>
			
			//$texto=$texto;
				
		}
		$html= <<<EOF
		$texto
		EOF;

		$rs->free();
	    return $html;
	}

	//no se modifica ni tema ni asunto, por eso no ponemos set

	public static function inserta($foro) {

		$result = false;

		$conn = getConexionBD();
		
		//falta enlazar el tema_foros con el id de la tabla categoria servicios
		$query=sprintf("INSERT INTO FORO(TEMA_FOROS, ASUNTO) VALUES('%s', '%s')"
			, $connex->real_escape_string($foro->tema)
			, $connex->real_escape_string($foro->asunto));

		$result = $conn->query($query);
		if ($result) {
		  $foro->id = $conn->insert_id;
		  $result = $foro;
		} else {
		  error_log($conn->error);  
		}
	
		return $result;
	}

	public static function borra($foro){
		
	  return self::borraPorid($foro->id);
	}

	public static function borraPorid($id){
	
		$result = false;
		$conn = getConexionBD();

		$query = sprintf("DELETE FROM FORO WHERE ID = %d", $id);
		$result = $conn->query($query);
		
		if (!$result) {
		  error_log($conn->error);
		} 
		else if ($conn->affected_rows != 1) {
		  error_log("Se han borrado '$conn->affected_rows' !");
		}
	
		return $result;
	}

	public static function actualiza($foro){
		
		$result = false;

		$conn = getConexionBD();
		$query = sprintf("UPDATE Foro F SET TEMA_FOROS = %s, ASUNTO = '%s' WHERE F.ID = %d"
		  , $foro->id
		  , $conn->real_escape_string($foro->tema)
		  , $conn->real_escape_string($foro->asunto);

		$result = $conn->query($query);

		if (!$result) {
		  error_log($conn->error);  
		} 
		else if ($conn->affected_rows != 1) {
		  error_log("Se han actualizado '$conn->affected_rows' !");
		}
	
		return $result;
	}

	public function guarda()
	{
	  if (!$this->id) {
		self::inserta($this);
	  } else {
		self::actualiza($this);
	  }
  
	  return $this;
	}
}