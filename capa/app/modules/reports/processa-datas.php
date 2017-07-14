<?php

require ABS_PATH . 'app/helpers/datas.php';
require ABS_PATH . 'database/functions/reports/consultas-clientes.php';
require ABS_PATH . 'database/functions/reports/funcoes-relatorio-geral.php';

# abrindo conexão com a base de dados
$conexao = abre_conexao();

# verificando se existe requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  $datas = array();

  # verificando se o formulário foi preenchido, caso contrário grava a data atual
  $datas['inicial'] = isset($_GET['datas']['inicial']) ? $_GET['datas']['inicial'] : date('Y-m-d');
  $datas['final']   = isset($_GET['datas']['final'])   ? $_GET['datas']['final']   : date('Y-m-d');

  # chamando função que verifica o formato da data enviada
  $datas = formataDataParaMysql($datas);

  # chamando função que busca os clientes e gera as opções para o HTML
  geraOpcoesClientes($conexao);

  # verificando se o relatório será de um cliente especifíco ou geral
  if (isset($_GET['cliente']) && $_GET['cliente'] != '0') {

    # especifíco
    echo 'Especifíco';

  } else {

    # geral
    $datas['inicial'] = '2017-07-03';
    $datas['final'] = '2017-07-03';
    geraRelatorioGeralDoAtendimento($conexao, $datas);

  }
}
