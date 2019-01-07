<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_pedido.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # verificando se o id do exercício de férias existe e não está vazio
  if (isset($_POST['id']) && (!empty($_POST['id']))) {
    # verificando se o id do exercício de férias é uma string numérica
    if (is_numeric($_POST['id'])) {
      $id = (int) $_POST['id'];
    }
  }

  # verificando se o id do colaborador existe e não está vazio
  if (isset($_POST['colaborador']) && (!empty($_POST['colaborador']))) {
    # verificando se o id do colaborador é uma string numérica
    if (is_numeric($_POST['colaborador'])) {
      $colaborador = (int) $_POST['colaborador'];
    }
  }

  # verificando se a variável id existe
  if (isset($id) && isset($colaborador)) {
    # chamando função que aprova os pedidos de férias e envia um e-mail informando a aprovação
    recebeAprovacaoDePedidoDeFerias($id, $colaborador);
  }
}