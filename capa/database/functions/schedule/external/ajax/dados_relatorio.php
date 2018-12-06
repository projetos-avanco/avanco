<?php

require '../../../../../init.php';
require DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dados = array();

  $db = abre_conexao();

  # verificando se o id da issue foi enviado e não está vazio
  if (isset($_POST['id_issue']) && !empty($_POST['id_issue'])) {
    # verificando se o id da issue é uma string
    if (is_string($_POST['id_issue'])) {
      $issue = $_POST['id_issue'];

      # chamando função responsável por consultar os ddos da issue
      $dados = consultaDadosDoRegistroDeHoras($db, $dados, $issue);
    }
  }

  echo json_encode($dados);
}