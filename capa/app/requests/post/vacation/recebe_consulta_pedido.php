<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_pedido.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
  # verificando se o id do exercício existe e não está vazio
  if (isset($_POST['exercicio']) && (!empty($_POST['exercicio'])))   {
    # verificando se o id do exercicio é uma string numérica
    if (is_numeric($_POST['exercicio'])) {
      $id = (int) $_POST['exercicio'];
    }
  }

  # verificando se o id do exercício existe
  if (isset($id)) {
    # chamando função que retorna os pedidos do exercício de férias
    retornaPedidosDeFerias($id);
  }
}