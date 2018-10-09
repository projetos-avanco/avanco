<?php

# verificando se houve requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require '../../../../../init.php';

  $validacao = array(
    'flag'  => false,
    'erros' => array()
  );

  $endereco = array();

  if (! empty($_POST['endereco']['id-cnpj']) && is_numeric($_POST['endereco']['id-cnpj'])) {
    $endereco['id'] = $_POST['endereco']['id-cnpj'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'Código da Empresa não foi enviado. Volte para tela de Atendimento Externo e selecione uma Empresa.';
  }

  if (! empty($_POST['endereco']['tipo']) && is_numeric($_POST['endereco']['tipo'])) {
    $endereco['tipo'] = $_POST['endereco']['tipo'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'O tipo do endereço não foi enviado.';
  }

  if (! empty($_POST['endereco']['logradouro']) && is_string($_POST['endereco']['logradouro'])) {
    $endereco['logradouro'] = $_POST['endereco']['logradouro'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'O logradouro do endereço não foi enviado.';
  }

  if (! empty($_POST['endereco']['complemento']) && is_string($_POST['endereco']['complemento'])) {
    $endereco['complemento'] = $_POST['endereco']['complemento'];
  } else {
    $endereco['complemento'] = '';
  }

  if (! empty($_POST['endereco']['numero']) && is_string($_POST['endereco']['numero'])) {
    $endereco['numero'] = $_POST['endereco']['numero'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'O número do endereço não foi enviado.';
  }

  if (! empty($_POST['endereco']['cep']) && is_string($_POST['endereco']['cep'])) {
    $endereco['cep'] = $_POST['endereco']['cep'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'O cep do endereço não foi enviado.';
  }

  if (! empty($_POST['endereco']['referencia']) && is_string($_POST['endereco']['referencia'])) {
    $endereco['referencia'] = $_POST['endereco']['referencia'];
  } else {
    $endereco['referencia'] = '';
  }

  if (! empty($_POST['endereco']['distrito']) && is_string($_POST['endereco']['distrito'])) {
    $endereco['distrito'] = $_POST['endereco']['distrito'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'O bairro do endereço não foi enviado.';
  }

  if (! empty($_POST['endereco']['localidade']) && is_string($_POST['endereco']['localidade'])) {
    $endereco['localidade'] = $_POST['endereco']['localidade'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'A cidade do endereço não foi enviado.';
  }

  if (! empty($_POST['endereco']['uf']) && is_numeric($_POST['endereco']['uf'])) {
    $endereco['uf'] = $_POST['endereco']['uf'];
  } else {
    $validacao['flag']  = true;
    $validacao['erros'][] = 'O estado do endereço não foi enviado.';
  }

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
    header('Location:' . BASE_URL . 'public/views/schedule/endereco.php?id=' . $endereco['id']);
    exit;
  } else {
    require DIRETORIO_MODULES . '/schedule/modulo_endereco.php';

    # chamando função responsável por solicitar a inserção do endereço no banco de dados
    recebeNovoEndereco($endereco);
  }
}
