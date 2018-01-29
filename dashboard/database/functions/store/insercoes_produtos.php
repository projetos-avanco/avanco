<?php 

/**
 * insere um log de compra de produto
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da compra
 */
function insereProduto($db, $compra)
{
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

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    return $resultado;

  }

}