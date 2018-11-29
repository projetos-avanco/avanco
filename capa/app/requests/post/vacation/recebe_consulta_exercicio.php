<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_exercicio.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['id'])) {
    if (is_numeric($_POST['id'])) {
      $id = (int) $_POST['id'];

      retornaExerciciosDeFeriasLancados($id, $_POST['status']);
    }
  }
}