<?php

# importando script de inicialização
require '../../../init.php';

# abrindo sessão
session_start();

# alterando o índice para falso
$_SESSION['logado'] = false;

# finalizando sessões abertas
session_destroy();

# redirecionando
header('Location: ' . BASE_URL . 'public/views/login/form-login.php');
