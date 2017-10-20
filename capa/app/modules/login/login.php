<?php

/**
 * responsável por realizar o login do usuário na aplicação
 * @param - array com email, senha digitada pelo usuário e senha criptografada
 * @param - array com o modelo para receber os dados do usuário
 */
function realizaLoginNaAplicacao($login, $usuario)
{
  $db = abre_conexao();

  # chamando função que irá consultar a base de dados
  consultaDadosDoUsuario($login, $usuario, $db);
}
