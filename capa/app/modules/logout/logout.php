<?php

# importando script de inicialização
require '../../../init.php';

# verificando se existe sessão aberta
if (! isset($_SESSION))
  session_start();

# alterando o índice para falso
$_SESSION['usuario']['logado'] = false;

# finalizando sessões abertas
session_destroy();

# redirecionando
header('Location: ' . FORM_LOGIN);
