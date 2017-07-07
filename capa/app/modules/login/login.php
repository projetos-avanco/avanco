<?php

# importando script de inicialização
require '../../../init.php';

# verificando se existe requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $login = array();

  # recuperando dados do formulário de login
  $login['usuario'] = isset($_POST['login']['usuario']) ? $_POST['login']['usuario'] : '';
  $login['senha']   = isset($_POST['login']['senha'])   ? $_POST['login']['senha']   : '';

  # verificando se os dados do formulário estão vazios
  if (empty($login['usuario']) || empty($login['senha'])) {

    echo 'Informe o usuário e senha!';

    exit();

  }

  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # chamando função que irá consultar a base de dados
  consultaDadosDoUsuario($conexao, $login);

}
