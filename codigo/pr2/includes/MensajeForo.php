<?php
//Objeto y Acceso a la BBDD

class MensajeForo
{
	private $id; //id del foro
	private $idForo; //id del foro al que pertenece el mensaje
    private $idUsuario; //id del que escribio el mensaje
    private $idmensajePadre; //id del mensaje padre
    private $contenido;
    private $fecha;

	private function __construct($idForo, $idUsuario, $contenido, $idmensajePadre = NULL, $fecha = NULL, $id = NULL){
		$this->id = $id;
        $this->idForo = $idForo;
		$this->idUsuario = $idUsuario;
        $this->idmensajePadre = $idmensajePadre;
        $this->contenido = $contenido;
		$this->fecha = $fecha ?? date('Y-m-d H:i:s');
	}

	public static function getID() {

		return $id;
	}

	public static function getIdForo(){

		return $idForo;
	}

	public static function getIdUsuario(){

		return $idUsuario;
	}

    public function getAutor(){
        if ($this->idUsuario) {
            $this->autor = Usuario::buscaPorId($this->idUsuario);
        }

        return $this->autor;
    }
  
    public function setIdMensajePadre($idmensajePadre)
    {
      $this->idmensajePadre = $idmensajePadre;
    }

    
	public static function getIdMensajePadre()  {

		return $idmensajePadre;
	}

	public static function getContenido(){

		return $contenido;
	}

	public static function getFecha(){

		return $fecha;
	}

	public static function setContenido($contenido){

		$this->contenido = $contenido;
	}

    public static function crea($idForo, $idUsuario, $contenido, $idmensajePadre = NULL) {

      $mensaje = new MensajeForo($idForo, $idUsuario, $contenido, $idmensajePadre, date('Y-m-d H:i:s'));
      return $mensaje;
    }

	public static function buscarMensajeporId($id) {

        $result = null;

        $conn = getConexionBD();
		
		$query = sprintf("SELECT * FROM COMENTARIOS_FORO WHERE ID='$id'");
		$rs = $conn->query($query);

		if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc();
		  $result = new MensajeForo($fila['ID'], $fila['ID_MENSAJE_PADRE'], $fila['FORO'],$fila['CONTENIDO'], $fila['USUARIO_CREADOR'], $fila['FECHA_CREACION']);
		  $rs->free();
		}

        return $result;	
    }

	public static function mostrarMensajesForoBBDD($idForo) {
	
        $conn = getConexionBD();
	
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
        $conn = getConexionBD();

		$query = sprintf("SELECT * FROM COMENTARIOS_FORO ");
		$rs = $conn->query($query);
		$tabla =array();
		
		for($i=0;$fila= $rs->fetch_assoc(); $i++) {
		
			$tabla[]=$fila;
		}

		$rs->free();
		return $tabla  ;
	}

	public static function inserta($mensaje) {
	
        $result = false;
        $conn = getConexionBD();
		
		$query=sprintf("INSERT INTO COMENTARIOS_FORO( ID_MENSAJE_PADRE,FORO, CONTENIDO, USUARIO_CREADOR,FECHA_CREACION) VALUES('%d', '%d', '%s', '%d', '%s')"
		, $connex->real_escape_string($mensaje->idmensajePadre)
        , $connex->real_escape_string($mensaje->idForo)
        , $connex->real_escape_string($mensaje->contenido)
		, $connex->real_escape_string($mensaje->idUsuario)
		, $connex->real_escape_string($mensaje->fecha));
        $result = $conn->query($query);

		if ($result) {
            $mensaje->id = $conn->insert_id;
            $result = $mensaje;
          } else {
            error_log($conn->error);  
          }
      
          return $result;
	}

	public static function borra($mensaje){
		
        return self::borraPorid($mensaje->id);
      }
  
      public static function borraPorid($id){
      
          $result = false;
          $conn = getConexionBD();
  
          $query = sprintf("DELETE FROM COMENTARIOS_FORO WHERE ID = %d", $id);
          $result = $conn->query($query);
          
          if (!$result) {
            error_log($conn->error);
          } 
          else if ($conn->affected_rows != 1) {
            error_log("Se han borrado '$conn->affected_rows' !");
          }
      
          return $result;
      }

	public static function actualiza($mensaje){
			
        $result = false;
		$conn = getConexionBD();

		$query = sprintf("UPDATE COMENTARIOS_FORO C SET ID_MENSAJE_PADRE = %d, FORO = '%d', CONTENIDO = %s, USUARIO_CREADOR = '%d', FECHA_CREACION = %s WHERE C.ID = %d"
		  , $mensaje->id
		  , $conn->real_escape_string($mensaje->idmensajePadre)
          , $conn->real_escape_string($mensaje->idForo)
          , $conn->real_escape_string($mensaje->contenido)
          , $conn->real_escape_string($mensaje->idUsuario)
		  , $conn->real_escape_string($mensaje->fecha);

		$result = $conn->query($query);

		if ( !($connex->query($query)) ) {
			//echo "Error al actualizar en la BD: (" . $connex->errno . ") " . utf8_encode($connex->error);
			return false;
		  }
		return true;
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