<?php

/**
 * retorna os dados pessoais do colaborador (id, nome e sobrenome cadastrados no chat)
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 */
function retornaDadosPessoaisDoColaborador($conexao, $colaborador)
{
  $query =
    "SELECT
    	id,
    	name,
    	surname
    FROM lh_users
    WHERE username = '{$colaborador['pessoal']['usuario']}'";

  $resultado = mysqli_query($conexao, $query);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $colaborador['pessoal']['id']        = $registro['id'];
    $colaborador['pessoal']['nome']      = $registro['name'];
    $colaborador['pessoal']['sobrenome'] = $registro['surname'];

  }

  return $colaborador;
}
