<?php

/**
 * verifica se o usuário está logado
 */
function verificaUsuarioLogado()
{
  # verificando se não existem as variáveis de sessão do usuário
  if (! isset($_SESSION['usuario']['logado']) OR $_SESSION['usuario']['logado'] !== true) {

    $_SESSION['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Faça o login para acessar o sistema.</p>';
    $_SESSION['tipo']     = 'warning';    

    return false;

  }

  if ($_SESSION['usuario']['nivel'] != 2) {

    $_SESSION['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Seu nível de usuário não permite acessar essa página.</p>';
    $_SESSION['tipo']     = 'warning';

    return false;

  } else {

    return true;

  }

}
