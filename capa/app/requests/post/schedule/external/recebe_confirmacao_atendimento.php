<?php

require_once '../../../../../init.php';
require_once DIRETORIO_MODULES . 'schedule/modulo_externo.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $copia = array();

  # verificando se o índice cópia existe e não está vazio
  if (isset($_POST['copia']) && (!empty($_POST['copia']))) {
    # recuperando todos os ids em cópia
    for ($i = 0; $i < count($_POST['copia']); $i++) {
      array_push($copia, $_POST['copia'][$i]);
    }
  }

  var_dump($copia);
}