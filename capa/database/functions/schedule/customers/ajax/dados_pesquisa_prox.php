<?php

require '../../../../../init.php';
require DIRETORIO_FUNCTIONS . 'schedule/search/consultas_pesquisa.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dados = array();

  $db = abre_conexao();

  # verificando se o id da pesquisa externa foi enviado e não está vazio
  if (isset($_POST['id']) && !empty($_POST['id'])) {
    # verificando se o id da pesquisa externa é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = $_POST['id'];

      # chamando função responsável por consultar os dados da pesquisa externa
      $dados = consultaDadosDeUmaPesquisaExterna($db, $id);
    }
  }

  echo json_encode($dados);
}