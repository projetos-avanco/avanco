<?php

require '../../init.php';
require DIRETORIO_MODELS  . 'sessoes.php';
require DIRETORIO_MODULES . 'login/login.php';

# verificando se houve requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # chamando função que cria a sessão de usuário
  criaSessaoDeUsuario();

  # verificando se usuário e senha estão vazios
  if (empty($_POST['login']['usuario']) OR empty($_POST['login']['senha'])) {

    # setando mensagem de dados não preenchidos na sessão
    $_SESSION['usuario']['tipo']     = 2;
    $_SESSION['usuario']['mensagem'] = 'dados do formulário não foram preenchidos.';

    # redirecionando
    redirecionaUsuario();

  }  else {

    # chamando função que valida os dados de usuário e senha enviados pelo formulário de login
    validaFormularioDeLogin($_POST['login']['usuario'], $_POST['login']['senha']);

  }

} else {

  # setando mensagem de envio incorreto de requisição na sessão
  $_SESSION['usuario']['tipo']     = 3;
  $_SESSION['usuario']['mensagem'] = 'requisição realizada não foi via método POST.';

  # redirecionando
  redirecionaUsuario();

}
