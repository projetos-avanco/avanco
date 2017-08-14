<?php

/*
 * define um array modelo para usuário de login
 */
function defineArrayModeloDeUsuarioParaLogin()
{
  $login = array(
    'id' => '',
    'nome' => '',
    'sobrenome' => '',
    'nivel' => 0,
    'usuario' => '',
    'senha' => ''
  );

  return $login;
}
