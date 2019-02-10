<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_exercicio.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # verificando se o id do exercício de férias existe e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id do exercício de férias é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = (int) $_POST['id'];
    }
  }

  # verificando se a variável com o id do exercício de férias existe
  if (isset($id)) {
    # chamando função responsável por deletar os pedidos e o exercício de férias referente ao id enviado
    solicitaDelecaoDoExercicioDeFerias($id);
  }
}