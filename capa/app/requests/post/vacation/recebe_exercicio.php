<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_exercicio.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
  # verificando se existe o índice id e se ele é uma string
  if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = (int) $_POST['id'];

    # chamando função que consulta e retorna a data de admissão, regime e contrato do colaborador
    retornaDadosContratuais($id);
  }  
}