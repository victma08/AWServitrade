<?php

function estaLogado()
{
  return isset($_SESSION['login']);
}


function esUsuario($idUsuario)
{
  return estaLogado() && $_SESSION['idUsuario'] === $idUsuario;
}

function idUsuarioLogado()
{
  $result = false;
  if (estaLogado()) {
    $result = $_SESSION['idUsuario'];
  }
  return $result;
}

function esAdmin()
{
  return estaLogado() && isset($_SESSION['esAdmin']);
}
