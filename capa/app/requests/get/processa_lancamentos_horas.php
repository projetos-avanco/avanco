<?php

require DIRETORIO_MODULES . 'hours/horas.php';

# verificando se houve uma requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  # recuperando o número da issue
  $issue = isset($_GET['issue']) ? $_GET['issue'] : null;

  # verificando se o número da issue foi recuperado
  if (! empty($issue) && $issue != null) {

    $dados = array();

    # chamando função que recupera os dados de uma única issue
    $dados = recuperaDadosDoRegistroDeHoras($issue, $dados);
    
    # trantando o texto
    $dados['observacao'] = ucwords($dados['observacao']);
  }

}