<?php

require DIRETORIO_FUNCTIONS . 'login/alteracao.php';

/**
 * verifica se o usuário existe na base de dados
 * @param - array com os dados para alteração (usuário, nova senha e confirmação)
 */
function verificaUsuario($alteracao)
{
  # abrindo uma conexão com a base de dados
  $conexao = abre_conexao();

  # chamando função que altera a senha de login
  alteraSenhaDeLogin($conexao, $alteracao);
}
