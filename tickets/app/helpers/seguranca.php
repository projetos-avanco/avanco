<?php

/**
 * verifica se o usuário está logado
 */
function verificaUsuarioLogado()
{
  require DIRETORIO_MODELS . 'sessao.php';

  # verificando se não existem as variáveis de sessão do usuário
  if (! isset($_SESSION['usuario']['logado']) OR $_SESSION['usuario']['logado'] !== true) {

    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Faça o login para acessar o sistema.</p>';
    $_SESSION['mensagens']['tipo']     = 'warning';
    $_SESSION['mensagens']['exibe']    = true;

    return false;

  }

  return true;
  
}
