<?php

# verificando se houve requisição via método post
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
  # requisitando script de configurações
  require_once '../../../../../init.php';
  
  $cnpjs = array(
    'id' => 0,
    'id_contrato' => null,
    'cnpj' => null,
    'razao_social' => null
  );

  $contratos = array(
    'id' => 0,
    'conta_contrato' => null
  );

  $flag = false;

  $erros = array();

  # verificando se o cnpj da empresa foi enviado
  if (!empty($_POST['empresa']['cnpj'])) {
    # verificando se o cnpj da empresa é uma string
    if (is_string($_POST['empresa']['cnpj'])) {
      # verificando se o cnpj foi preenchido corretamente
      if (strlen($_POST['empresa']['cnpj']) == 18) {
        $cnpjs['cnpj'] = str_replace('.', '', $_POST['empresa']['cnpj']);
        $cnpjs['cnpj'] = str_replace('/', '', $cnpjs['cnpj']);
        $cnpjs['cnpj'] = str_replace('-', '', $cnpjs['cnpj']);
      } else {
        $flag = true;
        $erros[] = 'O campo CNPJ não foi preenchido corretamente.';  
      }
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do CNPJ da Empresa não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O CNPJ da Empresa não foi informado.';
  }

  # verificando se a razão social foi enviada
  if (!empty($_POST['empresa']['razao-social'])) {
    # verificando se a razão social é uma string
    if (is_string($_POST['empresa']['razao-social'])) {
      $cnpjs['razao_social'] = addslashes(mb_strtolower($_POST['empresa']['razao-social'], 'utf-8'));
      $cnpjs['razao_social'] = trim($cnpjs['razao_social']);
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados da Razão Social da Empresa não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A Razão Social da empresa não foi informada.';
  }

  # verificando se a conta contrato foi enviada
  if (!empty($_POST['empresa']['contrato'])) {
    # verificando se a conta contrato é uma string
    if (is_string($_POST['empresa']['contrato'])) {
      # verificando se a conta contrato foi preenchida corretamente
      if (strlen($_POST['empresa']['contrato']) == 8) {
        $contratos['conta_contrato'] = str_replace('-', '', $_POST['empresa']['contrato']);
      } else {
        $flag = true;
        $erros[] = 'O campo Conta Contrato não foi preenchido corretamente.';
      }
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do Contrato da Empresa não está correto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O Contrato da Empresa não foi informado.';
  }

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  # verificando se houveram erros de validação
  if ($flag) {
    $_SESSION['empresa'] = array(
      'cnpj'         => $_POST['empresa']['cnpj'],
      'contrato'     => $_POST['empresa']['contrato'],
      'razao_social' => $_POST['empresa']['razao-social']
    );

    $_SESSION['atividades']['exibe'] = true;

    # repassando mensagens de erros para sessão
    for ($i = 0; $i < count($erros); $i++) {
      $_SESSION['atividades']['mensagens'][] = $erros[$i];
    }

    # redirecionando usuário para página de cadastro de empresa
    header('location:' . BASE_URL . 'public/views/schedule/company/empresa.php'); exit;
  } else {
    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_empresa.php';

    recebeDadosDaEmpresa($cnpjs, $contratos);
  }
}