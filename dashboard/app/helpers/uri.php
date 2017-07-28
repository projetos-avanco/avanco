<?php

/*
 * define um array de modelo
 */
function defineArrayModelo()
{
  # definindo array de modelo
  $array = array(
    'query_string' => '',
    'quebrado' => array(),
    'valor' => ''
  );

  return $array;
}

/*
 * retorna o nome de usuário do chat do colaborador que requisitou a página
 */
function retornaNomeDeUsuarioDoColaborador()
{
  # definindo array modelo
  $array = defineArrayModelo();

  # recuperando query string com o nome do colaborador
  $array['query_string'] = $_SERVER['QUERY_STRING'];

  # recuperando nome e sobrenome do colaborador
  $array['quebrado']     = explode('=', $array['query_string']);
  $array['valor']        = $array['quebrado'][1];
  $array['quebrado']     = explode('-', $array['valor']);

  # concatenando nome e sobrenome do colaborador
  $usuario = $array['quebrado'][0] . '.' . $array['quebrado'][1];

  # limpando array
  unset($array);

  return $usuario;
}
