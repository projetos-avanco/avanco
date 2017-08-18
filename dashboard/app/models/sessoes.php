<?php

/*
 * cria uma sessão para usuário (utilizado para gravar os dados do usuário que está logando no sistema)
 */
function criaSessaoDeUsuario()
{
  $_SESSION['usuario'] = array(
    'id' => '0',
    'nome' => '',
    'sobrenome' => '',
    'usuario' => '',
    'nivel' => 0,
    'logado' => false,
    'tipo' => 0,
    'mensagem' => ''
  );
}

/*
 * cria uma sessão para colaborador (utilizado para gravar o retorno da consultas de INSERT ou UPDATE dos dados do colaborador)
 */
function criaSessaoDeColaborador()
{
  $_SESSION['colaborador'] = array(
    'id' => '0',
    'tipo' => 0,
    'mensagem' => ''
  );
}

/*
 * cria uma sessão para colaboradores (utilizado para montar o select da página de administrador)
 */
function criaSessaoDeColaboradores()
{
  $_SESSION['colaboradores'] = array(
    'options' => array(),
  );
}
