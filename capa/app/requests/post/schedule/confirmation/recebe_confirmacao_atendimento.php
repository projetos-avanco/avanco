<?php

require_once '../../../../../init.php';
require_once DIRETORIO_MODULES . 'schedule/modulo_confirmacao.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $flag = false;

  $erros = array();

  $copia = array();  

  # verificando se o id do atendimento existe e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id do atendimento é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = (int) $_POST['id'];
    }
  }

  # verificando se o id do cnpj existe e não está vazio
  if (isset($_POST['id-cnpj']) && (!empty($_POST['id-cnpj']))) {
    # verificando se o id do cnpj é uma string numérica
    if (is_numeric($_POST['id-cnpj'])) {
      $cnpj = (int) $_POST['id-cnpj'];        
    }
  }

  # verificando se o id do contato existe e não está vazio
  if (isset($_POST['id-contato']) && (!empty($_POST['id-contato']))) {
    # verificando se o id do contato é uma string numérica
    if (is_numeric($_POST['id-contato'])) {
      $contato = (int) $_POST['id-contato'];
    }
  }

  # verificando se o índice cópia existe e não está vazio
  if (isset($_POST['copia']) && (!empty($_POST['copia']))) {
    # recuperando todos os ids em cópia
    for ($i = 0; $i < count($_POST['copia']); $i++) {
      array_push($copia, $_POST['copia'][$i]);
    }
  }
  
  # verificando qual página realizou a requisição
  if (isset($_POST['pagina']) && $_POST['pagina'] === 'externo') {
    # verificando se foi enviado algum arquivo em anexo
    if (isset($_FILES['externo']) && $_FILES['externo']['error']['anexo'] == 0) {          
      # verificando se o tamanho do arquivo em anexo é maior que 2MB
      if ($_FILES['externo']['size']['anexo'] > 2097152) {
        $flag = true;
        $erros['mensagens'][] = 'O arquivo em anexo deve ter o tamanho máximo de 2MB.';      
      }
    }
  } elseif (isset($_POST['pagina']) && $_POST['pagina'] === 'remoto') {
    # verificando se foi enviado algum arquivo em anexo
    if (isset($_FILES['remoto']) && $_FILES['remoto']['error']['anexo'] == 0) {          
      # verificando se o tamanho do arquivo em anexo é maior que 2MB
      if ($_FILES['remoto']['size']['anexo'] > 2097152) {
        $flag = true;
        $erros['mensagens'][] = 'O arquivo em anexo deve ter o tamanho máximo de 2MB.';      
      }
    }
  }

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  if ($flag) {
    $_SESSION['atividades']['exibe'] = true;

    # repassando mensagens de erros para sessão
    for ($i = 0; $i < count($erros); $i++) {
      $_SESSION['atividades']['mensagens'][] = $erros[$i];
    }

    # redirecionando usuário para página de atendimento remoto
    header('location:' . BASE_URL . 'public/views/schedule/confirma_atendimento_externo.php?id=' . $id . '&id-cnpj=' . $cnpj . '&id-contato=' . $contato); exit;
  } else {
    # verificando qual página realizou a requisição
    if (isset($_POST['pagina']) && $_POST['pagina'] === 'externo') {
      solicitaEnvioDeEmailDeConfirmacaoExterno($id, $cnpj, $contato, $copia);
    } elseif (isset($_POST['pagina']) && $_POST['pagina'] === 'remoto') {
      solicitaEnvioDeEmailDeConfirmacaoRemoto($id, $cnpj, $contato, $copia);
    }
  }  
}