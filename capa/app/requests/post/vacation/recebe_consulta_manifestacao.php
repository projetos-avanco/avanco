<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_manifestacao.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # verificando se o id do colaborador existe e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id do colaborador é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = (int) $_POST['id'];
    }
  }

  # chamando função que retorna o exercício do ano vigente
  retornaExerciciosAgendadosDoColaborador($id);
}