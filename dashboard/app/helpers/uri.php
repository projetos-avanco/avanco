<?php

/*
 * define um array modelo temporártio
 */
function defineArrayModelo()
{
  # definindo array modelo temporário
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
  # criando array com o modelo temporário
  $temporario = defineArrayModelo();

  # recuperando query string com o nome do colaborador
  $temporario['query_string'] = $_SERVER['QUERY_STRING'];

  # recuperando nome e sobrenome do colaborador
  $temporario['quebrado']     = explode('=', $temporario['query_string']);
  $temporario['valor']        = $temporario['quebrado'][1];
  $temporario['quebrado']     = explode('-', $temporario['valor']);

  # concatenando nome e sobrenome do colaborador
  $usuario = $temporario['quebrado'][0] . '.' . $temporario['quebrado'][1];

  # eliminando array temporário
  unset($temporario);

  return $usuario;
}
