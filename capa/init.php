<?php

# importando script com as rotas do servidor web
require_once 'routes/servidor.php';

# importando script com as configurações para conexão com a base de dados
require_once 'config/database/configuracoes.php';


echo ABS_PATH;
echo '<br>';
echo BASE_URL;
echo '<br>';
echo DB_HOST;
echo '<br>';
echo DB_USER;
echo '<br>';
echo DB_PASSWORD;
echo '<br>';
echo DB_NAME;
