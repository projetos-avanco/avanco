<?php

# definindo configurações para exibição de erros
ini_set('display_errors', 0);
ini_set('log_errors', 0);
error_reporting(E_ALL);

# abrindo sessão
session_start();

# importando script com as rotas do servidor web
require_once 'routes/servidor.php';

# importando script com as rotas do diretório database
require_once 'routes/database.php';

# importando script com as rotas do diretório modules
require_once 'routes/modules.php';

# importando script com as rotas do diretório models
require_once 'routes/models.php';

# importando script com as rotas do diretório requests
require_once 'routes/requests.php';

# importando script com as rotas do diretório helpers
require_once 'routes/helpers.php';

# importando script com as configurações para conexão com a base de dados
require_once 'config/database/configuracoes.php';

# importando script com as funções para conexão com a base de dados
require_once 'database/conexao.php';

# importando script com as funções de segurança
require_once 'app/helpers/seguranca.php';
