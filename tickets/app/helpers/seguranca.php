<?php

/**
 * verifica se o usuário está logado
 */
function verificaUsuarioLogado()
{
  require DIRETORIO_MODELS . 'sessao.php';

  $mensagem = isset($_SESSION['mensagens']['mensagem']) ? $_SESSION['mensagens']['mensagem'] : '';

  # verificando se a sessão de mensagem contém a mensagem de nível de usuário
  if ($mensagem == '<p class="text-center"><strong>Sinto Muito!</strong> Seu nível de usuário não permite acessar esse módulo.</p>') {

    # chamando função que cria o modelo de mensagem para limpar a mensagem existente na sessão
    criaModeloDeSessaoParaMensagens();

  }

  # verificando se não existem as variáveis de sessão do usuário
  if (! isset($_SESSION['usuario']['logado']) OR $_SESSION['usuario']['logado'] !== true) {

    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Faça o login para acessar o sistema.</p>';
    $_SESSION['mensagens']['tipo']     = 'warning';
    $_SESSION['mensagens']['exibe']    = true;

    return false;

  }

  return true;

}
