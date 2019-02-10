<?php

# verificando se houve uma requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  require '../../../init.php';
  require DIRETORIO_MODULES . 'hours/horas.php';

  # verificando se o id da issue foi enviado e se ele é um número
  if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    # chamando a função responsável por deletar os dados da issue nas tabelas de issues, despesas e lançamentos
    deletaDadosDoRegistroDeHoras($_GET['id']);

  } else {

    # o id não foi enviado ou o id não é um número
    echo 
      '<h2>O id da issue não foi enviado ou não é um número!</h2>
      <p>
        <a href='.BASE_URL.'public/views/hours/consulta_lancamentos.php>Voltar</a>
      </p>';
      exit;

  }

}