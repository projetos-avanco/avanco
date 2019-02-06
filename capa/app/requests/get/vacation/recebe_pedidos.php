<?php

require_once '../../../../init.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_manifestacao.php';

# verificando se houve uma requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  # verificando se o id do exercício foi enviado
  if (isset($_GET['id']) && (!empty($_GET['id']))) {
    # verificando se o id do exercício é uma string numérica
    if (is_numeric($_GET['id'])) {
      $id = (int) $_GET['id'];

      # chamando função responsável por retornar todos os exercícios de férias
      retornaPedidosDeFeriasDeUmExercicio($id);
    }
  }  
}