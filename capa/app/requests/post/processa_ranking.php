<?php

# verificando se houve uma requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $datas = array(
    'data1' => '', 
    'data2' => ''
  );

  # recuperando data atual
  $datas{'data1'} = $datas['data2'] = date('Y-m-d');

}

# verificando se houve uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $datas = array(
    'data1' => isset($_POST['form']['data1']) ? $_POST['form']['data1'] : date('Y-m-d'),
    'data2' => isset($_POST['form']['data2']) ? $_POST['form']['data2'] : date('Y-m-d')
  );

}

# chamando função responsável por gerar o relatório de ranking dos colaboradores
geraRelatorioDeRankingDosColaboradores($datas);