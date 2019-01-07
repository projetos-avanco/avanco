<?php

/**
 * deleta os pedidos de um exercício de férias
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function deletaPedidos($db, $id)
{
  $query = "DELETE FROM av_agenda_pedidos_ferias WHERE (id_exercicio = $id) AND (situacao = '1')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}