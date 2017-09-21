<?php

# definindo configurações para exibição de erros
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

# importando script com as rotas do servidor web
require_once 'routes/servidor.php';
