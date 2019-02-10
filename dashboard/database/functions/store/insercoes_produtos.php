<?php

/**
 * insere um ou mais logs de compra de produtos
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da compra
 */
function insereProduto($db, $compra)
{
  $quantidade = $compra['quantidade'];

  unset($compra['quantidade']);

  $colunas = null;
  $valores = null;

  # inserindo atividade esporádica
  foreach ($compra as $chave => $valor) {

    $colunas .= trim($chave, "'") . ', ';
    $valores .= "'$valor', ";

  }

  $colunas = rtrim($colunas, ', ');
  $valores = rtrim($valores, ', ');

  $query = '';
  $query = "INSERT INTO av_avancoins_historico_compras " . "($colunas)" . " VALUES " . "($valores);";

  # verificando se foi solicitado a compra de um produto que possui o campo quantidade
  if ($quantidade == 'null') {
    # verificando se a consulta pode ser executada
    $resultado = $db->query($query);

    return $resultado;
  } else {
    for ($i = 0; $i < $quantidade; $i++) {
      $resultado = $db->query($query);
    }

    return $resultado;
  }
}
