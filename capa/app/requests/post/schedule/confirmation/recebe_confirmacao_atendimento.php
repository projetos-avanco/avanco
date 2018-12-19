<?php

require_once '../../../../../init.php';
require_once DIRETORIO_MODULES . 'schedule/modulo_confirmacao.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $copia = array();

  # verificando se o id do atendimento externo existe e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id do atendimento externo é uma string numérica
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
    solicitaEnvioDeEmailDeConfirmacaoExterno($id, $cnpj, $contato, $copia);
  } elseif (isset($_POST['pagina']) && $_POST['pagina'] === 'remoto') {
    solicitaEnvioDeEmailDeConfirmacaoRemoto($id, $cnpj, $contato, $copia);
  }
}