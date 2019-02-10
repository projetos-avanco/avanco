<?php

require_once '../../../../../init.php';
require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';

# verificando se houve uma requisição via métodos post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # verificando se o id foi enviado e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = (int) $_POST['id'];
    }
  }

  # verificando se o tipo de registro foi enviado e não está vazio
  if (isset($_POST['registro']) && (!empty($_POST['registro']))) {
    # verificando se o tipo de registro é uma string
    if (is_string($_POST['registro'])) {
      $registro = $_POST['registro'];
    }
  }

  # verificando se existem as variáveis id e registro
  if (isset($id) && isset($registro)) {
    # verificando qual página solicitou a deleção e chamando função de deleção
    switch ($registro) {
      case 'folgas':
        solicitaDelecaoDeRegistroDeFolga($id);
          break;

      case 'faltas':
        solicitaDelecaoDeRegistroDeFalta($id);
          break;

      case 'atrasos':
        solicitaDelecaoDeRegistroDeAtraso($id);
          break;

      case 'extras':
        solicitaDelecaoDeRegistroDeExtra($id);
          break;
    }
  }  
}