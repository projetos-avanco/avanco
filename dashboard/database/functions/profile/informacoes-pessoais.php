<?php

/**
 * retorna as informações pessoais do colaborador (id do chat, nome e sobrenome cadastrados no chat)
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 * @param - string com o nome de usuário do colaborador cadastrado no chat
 */
function retornaInformacoesPessoaisDoColaborador($conexao, $colaborador, $usuario)
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

    $colaborador['informacoes_pessoais']['id']        = $registro['id'];
    $colaborador['informacoes_pessoais']['nome']      = $registro['name'];
    $colaborador['informacoes_pessoais']['sobrenome'] = $registro['surname'];

  }

  return $colaborador;
}
