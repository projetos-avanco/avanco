<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

session_start();

# importando script com as rotas do servidor web
require_once 'routes/servidor.php';

# importando script com as configuracoes para conexão com a base de dados
require_once 'config/database/configuracoes.php';

# importando script com as funções para conexão com a base de dados
require_once 'database/conexao.php';
