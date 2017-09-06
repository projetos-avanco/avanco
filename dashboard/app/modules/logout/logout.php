<?php

# importando script de rotas do servidor web
require '../../../routes/servidor.php';

# verificando se a sessão não está aberta
if (! isset($_SESSION)) {

  # abrindo sessão
  session_start();

}

# alterando o índice da sessão de usuário para falso
$_SESSION['usuario']['logado'] = false;

# finalizando sessões abertas
unset($_SESSION['usuario'], $_SESSION['colaborador'], $_SESSION['colaboradores'], $_SESSION['graficos'], $_SESSION['mensagens']);

# redirecionando para a página de login
header('Location: ' . BASE_URL . 'public/views/login/form_login.php');
