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
function verificaUsuarioLogado($pagina = null)
{
  require DIRETORIO_MODELS . 'sessao.php';

  criaModeloDeSessaoParaMensagens();

  # verificando se não existem as variáveis de sessão do usuário
  if (! isset($_SESSION['usuario']['logado']) OR $_SESSION['usuario']['logado'] !== true) {

    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Faça o login para acessar o sistema.</p>';
    $_SESSION['mensagens']['tipo']     = 'warning';
    $_SESSION['mensagens']['exibe']    = true;

    return false;

  }

  # verificando se o nível de acesso do usuário permite abrir a página
  if ($_SESSION['usuario']['nivel'] == 2 AND $pagina == 'colaboradores_logados.php') {

    return true;

  } else {

    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Sinto Muito!</strong> Seu nível de usuário não permite acessar esse módulo.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

}
