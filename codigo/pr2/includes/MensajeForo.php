<?php

namespace Aw\Servitrade;

class MensajeForo
{
	private $id; //id del foro
	private $idForo;
    private $idUsuario;
    private $mensajeOrigen;
    private $contenido;
    private $fecha;

	private function __construct($id, $tema){
		$this->id = $id;
        $this->idForo = $idForo;
		$this->idUsuario = $idUsuario;
        $this->mensajeOrigen = $mensajeOrigen;
        $this->contenido = $contenido;
		$this->fecha = $fecha;
	}

	public static function addBBDD(MensajeForo $mensaje) : int {


	}

	public static function getBBDD(int $id) {

		
	}

	public static function update() : bool{
	
		
		
	}
}