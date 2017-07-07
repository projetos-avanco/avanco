<?php

/**
 * cria o hash da senha utilizando criptografia SHA1
 * @param - senha informada no formulário de login
 */
function criaCodigoHash($senha)
{
  return sha1($senha);
}

/**
 * verifica se o usuário está logado
 */
function verificaUsuarioLogado()
{
  if (! isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {

    return false;

  }

  return true;

}
