<?php

namespace Aw\Servitrade;

class Foro
{
	private $id; //id del foto
	private $tema; //tema del que va el foro

	private function __construct($id, $tema){
		$this->id = $id;
		$this->tema = $tema;
	}

	public static function addBBDD(MensajeForo $mensaje) : int {


	}

	public static function getBBDD(int $id) {

		
	}

	public static function getMessagesBBDD(){
		

	}
	public static function update() : bool{
	
		

	  }
}