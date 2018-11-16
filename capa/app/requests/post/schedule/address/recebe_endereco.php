<?php

# verificando se houve requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # requisitando script de configurações
  require_once '../../../../../init.php';

  $validacao = array(
    'flag'  => false,
    'erros' => array()
  );

  $endereco = array();

  # verificando se o id do cnpj da empresa foi enviado
  if ((!empty($_POST['endereco']['id-cnpj'])) && is_numeric($_POST['endereco']['id-cnpj'])) {
    $endereco['id'] = $_POST['endereco']['id-cnpj'];
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'Código da Empresa não foi enviado. Volte para tela de Atendimento Externo e selecione uma Empresa.';
  }

  # verificando se o tipo do endereço foi enviado
  if ((!empty($_POST['endereco']['tipo'])) && is_numeric($_POST['endereco']['tipo'])) {
    $endereco['tipo'] = $_POST['endereco']['tipo'];
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O tipo do endereço não foi enviado.';
  }

  # verificando se o logradouro do endereço foi enviado
  if ((!empty($_POST['endereco']['logradouro'])) && is_string($_POST['endereco']['logradouro'])) {
    $endereco['logradouro'] = addslashes(mb_strtolower($_POST['endereco']['logradouro'], 'utf-8'));
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O logradouro do endereço não foi enviado.';
  }

  # verificando se o complemento do endereço foi enviado
  if ((!empty($_POST['endereco']['complemento'])) && is_string($_POST['endereco']['complemento'])) {
    $endereco['complemento'] = addslashes(mb_strtolower( $_POST['endereco']['complemento'], 'utf-8'));
  } else {
    $endereco['complemento'] = '';
  }

  # verificando se o número do endereço foi enviado
  if ((!empty($_POST['endereco']['numero'])) && is_string($_POST['endereco']['numero'])) {
    $endereco['numero'] = $_POST['endereco']['numero'];
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O número do endereço não foi enviado.';
  }

  # verificando se o cep do endereço foi enviado
  if ((!empty($_POST['endereco']['cep'])) && is_string($_POST['endereco']['cep'])) {
    $endereco['cep'] = $_POST['endereco']['cep'];
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O cep do endereço não foi enviado.';
  }

  # verificando se a referência do endereço foi enviada
  if ((!empty($_POST['endereco']['referencia'])) && is_string($_POST['endereco']['referencia'])) {
    $endereco['referencia'] = addslashes(mb_strtolower($_POST['endereco']['referencia'], 'utf-8'));
  } else {
    $endereco['referencia'] = '';
  }

  # verificando se o distrito do endereço foi enviado
  if ((!empty($_POST['endereco']['distrito'])) && is_string($_POST['endereco']['distrito'])) {
    $endereco['distrito'] = addslashes(mb_strtolower($_POST['endereco']['distrito'], 'utf-8'));
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O bairro do endereço não foi enviado.';
  }

  # verificando se a localidade do endereço foi enviada
  if ((!empty($_POST['endereco']['localidade'])) && is_string($_POST['endereco']['localidade'])) {
    $endereco['localidade'] = addslashes(mb_strtolower($_POST['endereco']['localidade'], 'utf-8'));
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'A cidade do endereço não foi enviado.';
  }

  # verificando se o uf do endereço foi enviado
  if ((!empty($_POST['endereco']['uf'])) && is_numeric($_POST['endereco']['uf'])) {
    $endereco['uf'] = $_POST['endereco']['uf'];
  } else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O estado do endereço não foi enviado.';
  }

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  # verificando se houveram erros de validação
  if ($validacao['flag']) {
    $_SESSION['atividades']['exibe'] = true;

    # repassando mensagens de erros para sessão
    for ($i = 0; $i < count($validacao['erros']); $i++) {
      $_SESSION['atividades']['mensagens'][] = $validacao['erros'][$i];
    }

    # redirecionando usuário para página de endereço
    header('Location:' . BASE_URL . 'public/views/schedule/address/endereco.php?id=' . $endereco['id']); exit;
  } else {
    # requisitando script
    require DIRETORIO_MODULES . '/schedule/modulo_endereco.php';

    # chamando função responsável por solicitar a inserção do endereço no banco de dados
    recebeNovoEndereco($endereco);
  }
}
