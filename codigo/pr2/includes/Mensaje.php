<?php

require_once __DIR__.'/Usuario.php';

class Mensaje
{

  const MAX_SIZE = 140;

  public static function crea($idAutor, $mensaje, $respuestaAMensaje = NULL)
  {
    $m = new Mensaje($idAutor, $mensaje, date('Y-m-d H:i:s'), $respuestaAMensaje);
    return $m;
  }

  public static function buscaPorMensajePadre($idMensajePadre=NULL)
  {
    $result = [];

    $conn = getConexionBD();
    $query = 'SELECT * FROM Mensajes M WHERE';
    if($idMensajePadre) {
      $query = $query . ' M.idMensajePadre = %d';
      $query = sprintf($query, $idMensajePadre);
    } else {
      $query = $query . ' M.idMensajePadre IS NULL';
    }

    $query .= ' ORDER BY M.fechaHora DESC';

    $rs = $conn->query($query);
    if ($rs) {
      while($fila = $rs->fetch_assoc()) {
        $result[] = new Mensaje($fila['autor'], $fila['mensaje'], $fila['fechaHora'], $fila['idMensajePadre'], $fila['id']);
      }
      $rs->free();
    }

    return $result;
  }

  /* Sólo se debería de tener este método ya podría implemantar la misma funcionalidad que buscaPorMensajePadre */
  public static function buscaPorMensajePadrePaginado($idMensajePadre=NULL, $numPorPagina = NULL, $numPagina = 5)
  {
    $result = [];

    $conn = getConexionBD();
    $query = 'SELECT * FROM Mensajes M WHERE';
    if($idMensajePadre) {
      $query = $query . ' M.idMensajePadre = %d';
      $query = sprintf($query, $idMensajePadre);
    } else {
      $query = $query . ' M.idMensajePadre IS NULL';
    }

    $query .= ' ORDER BY M.fechaHora DESC';

    if ($numPorPagina) {
      $query .= " LIMIT $numPorPagina";
    
      /* XXX NOTA: Este método funciona pero poco eficiente (OFFSET y LIMIT se aplican una vez se ha ejecutado la
       * consulta), lo utilizo por simplicidad. En un entorno real se debe utilizar la cláusula WHERE para "saltar"
       * los elementos que NO interesen y utilizar exclusivamente la cláusula LIMIT
       */
      $offset = $numPagina * $numPorPagina;
      if ($offset > 0) {
        $query .= " OFFSET $offset";
      }
    }

    $rs = $conn->query($query);
    if ($rs) {
      while($fila = $rs->fetch_assoc()) {
        $result[] = new Mensaje($fila['autor'], $fila['mensaje'], $fila['fechaHora'], $fila['idMensajePadre'], $fila['id']);
      }
      $rs->free();
    }

    return $result;
  }

  public static function numMensajes($idMensajePadre=NULL)
  {
    $result = 0;

    $conn = getConexionBD();
    $query = 'SELECT COUNT(*) FROM Mensajes M';
    if($idMensajePadre) {
      $query = $query . ' AND M.idMensajePadre = %d';
      $query = sprintf($query, $idMensajePadre);
    } else {
      $query = $query . ' AND M.idMensajePadre IS NULL';
    }

    $rs = $conn->query($query);
    if ($rs) {
      $result = (int) $rs->fetch_row()[0];
      $rs->free();
    }
    return $result;
  }

  public static function buscaPorId($idMensaje)
  {
    $result = null;

    $conn = getConexionBD();
    $query = sprintf('SELECT * FROM Mensajes M WHERE M.id = %d;', $idMensaje);
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      while($fila = $rs->fetch_assoc()) {
        $result = new Mensaje($fila['autor'], $fila['mensaje'], $fila['fechaHora'], $fila['idMensajePadre'], $fila['id']);
      }
      $rs->free();
    }
    return $result;
  }

  public static function inserta($mensaje)
  {
    $result = false;

    $conn = getConexionBD();
    $query = sprintf("INSERT INTO Mensajes (autor, mensaje, fechaHora, idMensajePadre) VALUES (%d, '%s', '%s', %s)"
      , $mensaje->idAutor
      , $conn->real_escape_string($mensaje->mensaje)
      , $conn->real_escape_string($mensaje->fechaHora)
      , !is_null($mensaje->idMensajePadre) ? $mensaje->idMensajePadre : 'NULL');
    $result = $conn->query($query);
    if ($result) {
      $mensaje->id = $conn->insert_id;
      $result = $mensaje;
    } else {
      error_log($conn->error);  
    }

    return $result;
  }

  public static function actualiza($mensaje)
  {
    $result = false;

    $conn = getConexionBD();
    $query = sprintf("UPDATE Mensajes M SET autor = %d, mensaje = '%s', fechaHora = '%s', idMensajePadre = %d WHERE M.id = %d"
      , $mensaje->idAutor
      , $conn->real_escape_string($mensaje->mensaje)
      , $conn->real_escape_string($mensaje->fechaHora)
      , !is_null($mensaje->idMensajePadre)?$mensaje->idMensajePadre : 'NULL'
      , $mensaje->id);
    $result = $conn->query($query);
    if (!$result) {
      error_log($conn->error);  
    } else if ($conn->affected_rows != 1) {
      error_log("Se han actualizado '$conn->affected_rows' !");
    }

    return $result;
  }

  public static function borra($mensaje)
  {
    return self::borraPorid($mensaje->id);
  }

  public static function borraPorId($idMensaje)
  {
    $result = false;

    $conn = getConexionBD();
    $query = sprintf("DELETE FROM Mensajes WHERE id = %d", $idMensaje);
    $result = $conn->query($query);
    if (!$result) {
      error_log($conn->error);
    } else if ($conn->affected_rows != 1) {
      error_log("Se han borrado '$conn->affected_rows' !");
    }

    return $result;
  }

  private $id;

  private $idAutor;

  private $autor;

  private $mensaje;

  private $fechaHora;

  private $idMensajePadre;

  private $mensajePadre;

  private function __construct($idAutor, $mensaje, $fechaHora = NULL, $idMensajePadre = NULL, $id = NULL)
  {
    $this->idAutor = $idAutor;
    $this->mensaje = $mensaje;
    $this->fechaHora = $fechaHora ?? date('Y-m-d H:i:s');
    $this->idMensajePadre = $idMensajePadre;
    $this->id = $id;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getAutor()
  {
    if ($this->idAutor) {
      $this->autor = Usuario::buscaPorId($this->idAutor);
    }
    return $this->autor;
  }

  public function setAutor($nuevoAutor)
  {
    $this->autor = $nuevoAutor;
    $this->idAutor = $nuevoAutor->id();
  }

  public function getMensaje()
  {
    return $this->mensaje;
  }

  public function getMensajePadre()
  {
    if ($this->idMensajePadre) {
      $this->mensajePadre = self::buscaPorId($this->idMensajePadre);
    }
    return $this->mensajePadre;
  }

  public function setMensajePadre($nuevoMensajePadre)
  {
    $this->mensajePadre = $nuevoMensajePadre;
    $this->idMensajePadre = $nuevoMensajePadre->id();
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

  /* Métodos mágicos para que si existen métodos setPropiedad / getPropiedad se pueda hacer:
   *   $var->propiedad, que equivale a $var->getPropiedad()
   *   $var->propiedad = $valor, que equivale a $var->setPropiedad($valor)
   */
  public function __get($property)
  {
    $methodName = 'get'. ucfirst($property);
    if (method_exists($this, $methodName)) {
      return $this->$methodName();
    } else if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value)
  {
    $methodName = 'set'. ucfirst($property);
    if (method_exists($this, $methodName)) {
      $this->$methodName($property, $value);
    } else if (property_exists($this, $property)) {
      $this->$property = $value;
    }
  }

}
