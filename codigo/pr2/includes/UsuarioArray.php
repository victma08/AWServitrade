<?php

class Usuario {
  private static $BD;

  static function init() {
    Usuario::$BD = array(
      'admin' => new Usuario(1, 'admin', 'adminpass'),
      'user' => new Usuario(2, 'user', 'userpass')
    );
  }

  public static function login($username, $password) {
    $user = Usuario::$BD[$username] ?? null;
    if ($user && $user->compruebaPassword($password)) {
      return $user;
    }    
    return false;
  }

  private $id;

  private $username;

  private $password;

  private function __construct($id, $username, $password) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
  }

  public function id() {
    return $this->id;
  }

  public function username() {
    return $this->username;
  }

  public function compruebaPassword($password) {
    return strcmp($password, $this->password) === 0;
  }

  public function cambiaPassword($nuevoPassword) {
    $this->password = $nuevoPassword;
  }
}
Usuario::init();
