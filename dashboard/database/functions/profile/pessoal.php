<?php

/**
 * retorna as informações pessoais do colaborador (id do chat, nome e sobrenome cadastrados no chat)
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 * @param - string com o nome de usuário do colaborador cadastrado no chat
 */
function retornaDadosPessoaisDoColaborador($conexao, $colaborador, $usuario)
{
  $sql =
    "SELECT
    	id,
    	name,
    	surname
    FROM lh_users
    WHERE username = '$usuario'";

  $resultado = mysqli_query($conexao, $sql);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $colaborador['pessoal']['id']        = $registro['id'];
    $colaborador['pessoal']['nome']      = $registro['name'];
    $colaborador['pessoal']['sobrenome'] = $registro['surname'];

  }

  return $colaborador;
}
