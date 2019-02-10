<?php

/**
 * responsável por verificar por verificar dados duplicados solicitar a inserção dos dados nas tabelas de cnpjs e contratos
 * @param - array com os dados da tabela de cnpjs
 * @param - array com os dados da tabela de contratos
 */
function recebeDadosDaEmpresa($cnpjs, $contratos)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/company/consultas_empresa.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/company/insercoes_empresa.php';

  $db = abre_conexao();
  
  $_SESSION['atividades']['exibe'] = true;

  # chamando função que consulta se o contrato já existe no banco de dados
  $contratos['id'] = consultaContratoExistente($db, $contratos['conta_contrato']);

  # verificando se o contrato já existe no banco de dados
  if ($contratos['id'] != 0) {
    # chamando função que consulta se o cnpj já existe no banco de dados
    $resultado = consultaCnpjExistente($db, $cnpjs['cnpj']);

    # verificando se o cnpj já existe no banco de dados
    if ($resultado) {
      $_SESSION['atividades']['tipo'] = 'warning';
      $_SESSION['atividades']['mensagens'][] = 'Já existe uma empresa cadastrada com esse CNPJ. Feche essa aba e na página de Atendimento pesquise por esse CNPJ.';      
    } else {
      # chamando função que insere um novo registro na tabela de cnpj
      $resultado = insereDadosNaTabelaCnpj($db, $cnpjs, $contratos);

      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['mensagens'][] = 'A nova Empresa foi cadastrada com sucesso. Feche essa aba e na página de Atendimento pesquise pela nova Empresa';
    }

    # redirecionando usuário para página de cadastro de empresa
    header('location:' . BASE_URL . 'public/views/schedule/company/empresa.php'); exit;
  } else {
    # chamando função que insere um novo registro na tabela de contratos
    $resultado = insereDadosNaTabelaContratos($db, $contratos);

    # verificando se o novo registro foi inserido na tabela de contratos
    if ($resultado) {
      # chamando função que consulta se o contrato já existe no banco de dados
      $contratos['id'] = consultaContratoExistente($db, $contratos['conta_contrato']);

      # chamando função que insere um novo registro na tabela de cnpj
      $resultado = insereDadosNaTabelaCnpj($db, $cnpjs, $contratos);

      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['mensagens'][] = 'A nova Empresa foi cadastrada com sucesso. Feche essa aba e na página de Atendimento pesquise pela nova Empresa';
    } else {
      $_SESSION['atividades']['tipo'] = 'danger';
      $_SESSION['atividades']['mensagens'][] = 'Erro ao cadastrar a nova Empresa. Informe ao Wellington Felix.';
    }

    # redirecionando usuário para página de cadastro de empresa
    header('location:' . BASE_URL . 'public/views/schedule/company/empresa.php'); exit;
  }
}