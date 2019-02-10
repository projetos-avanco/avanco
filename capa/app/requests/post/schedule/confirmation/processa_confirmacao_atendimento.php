<?php

require_once '../../../../../init.php';
require_once DIRETORIO_FUNCTIONS . 'schedule/external/atualizacoes_externo.php';
require_once DIRETORIO_FUNCTIONS . 'schedule/remote/atualizacoes_remoto.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $db = abre_conexao();

  # verificando se o id do atendimento existe e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id do atendimento é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = (int) $_POST['id'];      
    }
  }

  # verificando se o id do atendimento existe
  if (isset($id)) {
    # verificando qual página solicitou a requisição
    if (isset($_POST['pagina']) && $_POST['pagina'] == 'externo') {
      $resultado = confirmaUmAtendimentoExterno($db, $id);
    } elseif (isset($_POST['pagina']) && $_POST['pagina'] == 'remoto') {
      $resultado = confirmaUmAtendimentoRemoto($db, $id);
    }
    
    echo json_encode($resultado); exit;
  }
}