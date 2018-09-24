<?php

/**
 *
 *
 */
function consultaNomeDoColaborador($id)
{
  require DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';
  
  $colaborador = array();

  $db = abre_conexao();

  $nome = retornaNomeDoColaborador($db, $id);

  $colaborador['id']   = $id;
  $colaborador['nome'] = $nome;

  return $colaborador;
}
