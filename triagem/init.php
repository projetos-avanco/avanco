<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

session_start();

# importando script com as rotas do servidor web
require_once 'routes/servidor.php';

# importando script com as rotas do diretório database
require_once 'routes/database.php';

# importando script com as rotas do diretório helpers
require_once 'routes/helpers.php';

# importando script com as rotas do diretório models
require_once 'routes/models.php';

# importando script com as rotas do diretório modules
require_once 'routes/modules.php';

#importando script com as rotas do diretório public
require_once 'routes/public.php';

# importando script com as rotas do diretório requests
require_once 'routes/requests.php';

# importando script com as configuracoes para conexão com a base de dados
require_once 'config/database/configuracoes.php';

# importando script com as funções para conexão com a base de dados
require_once 'database/conexao.php';

# importando script com as funções de sessão
require_once 'app/helpers/sessoes.php';

# importando script com as funções de colaboradores online
require_once 'database/functions/contributors/online.php';

# importando script com as funções de nível de conhecimento
require_once 'database/functions/contributors/conhecimento.php';

# importando script com as funções de quantidade de fila de atendimento
require_once 'database/functions/contributors/fila.php';

# importando script com a função que retorna o modelo de cliente
require_once 'app/models/cliente.php';

# importando script com a função que retorna o modelo de colaboradores
require_once 'app/models/colaboradores.php';

# importando script com as funções de resquisições
require_once 'app/helpers/requisicoes.php';

# importando script com as funções diversas
require_once 'app/helpers/diversas.php';
