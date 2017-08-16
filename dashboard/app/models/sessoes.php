<?php

/*
 * cria uma sessão para usuário
 */
function criaSessaoDeUsuario()
{
  $_SESSION['usuario'] = array(
    'id' => '0',
    'nome' => '',
    'sobrenome' => '',
    'nivel' => 0,
    'logado' => false,
    'tipo' => 0,
    'mensagem' => ''
  );
}

/*
 * cria uma sessão para colaborador
 */
function criaSessaoDeColaborador()
{
  $_SESSION['colaborador'] = array(
    'id' => '0',
    'tipo' => 0,
    'mensagem' => ''
  );
}
