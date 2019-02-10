<?php

require '../../../../../init.php';
require DIRETORIO_HELPERS   . 'datas.php';
require DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
require DIRETORIO_FUNCTIONS . 'schedule/customers/consultas_gestao_cliente.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $filtros = array();
  
  $db = abre_conexao();

  # verificando se o filtro de empresa foi enviado e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id da empresa é numérico
    if (is_numeric($_POST['id'])) {
      $filtros['id'] = (int) $_POST['id'];

      # chamando função que retorna o cnpj da empresa
      $filtros['cnpj'] = consultaCnpjDaEmpresa($db, $filtros['id']);
    }
  } else {
    # cnpj da empresa não foi enviado, retornando 0
    echo json_encode(0); exit;
  }

  # verificando se o filtro data inicial foi enviada e não está vazia
  if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
    # verificando se a data inicial é uma string
    if (is_string($_POST['data_inicial'])) {
      $filtros['data_inicial'] = $_POST['data_inicial'];
    }      
  }

  # verificando se o filtro data final foi enviada e não está vazia
  if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
    # verificando se a data final é uma string
    if (is_string($_POST['data_final'])) {
      $filtros['data_final'] = $_POST['data_final'];
    }      
  }

  $dados = array();

  $dados['atendimentos_realizados'] = consultaAtendimentosRealizados($db, $filtros);
  $dados['percentual_perda']        = calculaTaxaDePerda($db, $filtros);
  $dados['percentual_avancino']     = calculaIndiceAvancino($db, $filtros);
  $dados['percentual_fila']         = calculaFilaAte15Minutos($db, $filtros);

  echo json_encode($dados);
}