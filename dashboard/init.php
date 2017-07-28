<?php

# definindo configurações para exibição de erros
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

# importando script com as rotas do servidor web
require_once 'routes/servidor.php';

# importando script com as configurações para conexão com a base de dados
require_once 'config/database/configuracoes.php';

# importando script com as funções para conexão com a base de dados
require_once 'database/conexao.php';

$conexao = abre_conexao();

exit(var_dump($conexao));
