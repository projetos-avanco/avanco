<?php

require_once '../../../../../init.php';
require_once DIRETORIO_MODULES . 'schedule/modulo_externo.php';

# verificando se houve uma requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  # verificando se existe o id e se ele não está vazio
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    # verificando se o id é uma string númerica
    if (is_numeric($_GET['id'])) {
      $id = (int) $_GET['id'];

      # chamando função responsável por realizar o cancelamento do atendimento
      solicitaCancelamentoDeAtendimento($id);
    }
  }
}