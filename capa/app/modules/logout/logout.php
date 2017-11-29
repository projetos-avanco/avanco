<?php

# importando script de inicialização
require '../../../init.php';

# verificando se existe sessão aberta
if (! isset($_SESSION))
  session_start();

# alterando o índice para falso
$_SESSION['usuario']['logado'] = false;

# finalizando sessões abertas
unset($_SESSION['usuario'], $_SESSION['mensagens']);

# redirecionando
header('Location: ' . BASE_URL . '../capa/public/home.php');
