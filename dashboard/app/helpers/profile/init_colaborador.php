<?php

# verificando se os dados do colaborador foram consultados no chat
if (isset($_SESSION['colaborador'])) {

  # verificando se os dados do colaborador foram inseridos ou atualizados na tabela
  if ($_SESSION['colaborador']['id'] != '0' && $_SESSION['colaborador']['tipo'] == 1) {

    # chamando função que gera (busca e retorna os dados processados na tabela) a sessão com os dados para o navegador
    geraDadosParaDashboard($_SESSION['colaborador']['id']);

    # recuperando dados que serão exibidos no dashboard
    $dashboard  = $_SESSION['navegador']['dashboard'];

    # verificando se os dados do colaborador não foram inseridos ou atualizados na tabela
  } elseif ($_SESSION['colaborador']['id'] == '0' && $_SESSION['colaborador']['tipo'] == 2) {

    echo 'query INSERT ou UPDATE não foi executada!';

    # verificando se o usuário que requisitou a página possui cadastro no chat
  } elseif ($_SESSION['colaborador']['id'] == '0' && $_SESSION['colaborador']['tipo'] == 3) {

    echo 'usuário não existe na base de dados do chat!';

  }

  # eliminando sessões
  unset($_SESSION['colaborador'], $_SESSION['navegador']['dashboard'], $_SESSION['navegador']['documentos']);

}

# nome para o link da base de conhecimento
$base =
  strtolower(removeAcentos($dashboard['pessoal']['nome'])) .
  strtolower(removeAcentos($dashboard['pessoal']['sobrenome']));

# nome para o link do infovarejo
$info = '/author/' .
  strtolower(removeAcentos($dashboard['pessoal']['nome'])) .
  '-' .
  strtolower(removeAcentos($dashboard['pessoal']['sobrenome'])) .
  '/';
