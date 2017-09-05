<?php

require '../../init.php';

require DIRETORIO_MODELS . 'sessoes.php';
require DIRETORIO_MODULES . 'login/altera_senha.php';

# chamando função que cria a sessão para mensagens
criaSessaoDeMensagens();

# verificando se foi realizado uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $alteracao = array();

  # verificando se os campos do formulário foram preenchidos
  if (! empty($_POST['alteracao']['senha']) AND ! empty($_POST['alteracao']['confirmacao']) AND ! empty($_POST['alteracao']['usuario'])) {

    # recuperando dados do formulário
    $alteracao['usuario']     = $_POST['alteracao']['usuario'];
    $alteracao['senha']       = $_POST['alteracao']['senha'];
    $alteracao['confirmacao'] = $_POST['alteracao']['confirmacao'];

    if ($alteracao['senha'] != $alteracao['confirmacao']) {

      $_SESSION['mensagens']['alteracao_senha']['tipo']     = 3;
      $_SESSION['mensagens']['alteracao_senha']['mensagem'] = 'Senhas diferentes!';

      header('Location: ' . BASE_URL . 'public/views/login/form_alteracao_senha.php');

    } else {

      verificaUsuario($alteracao);
      
    }

  } else {

    $_SESSION['mensagens']['alteracao_senha']['tipo']     = 4;
    $_SESSION['mensagens']['alteracao_senha']['mensagem'] = 'Preencha todos os campos!';

    header('Location: ' . BASE_URL . 'public/views/login/form_alteracao_senha.php');

  }

}
