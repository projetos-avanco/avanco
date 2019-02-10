<?php

/**
 * altera a situação de um pedido para férias aprovadas
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function alteraSituacaoDosPedidosParaAprovado($db, $id)
{
  $query = "UPDATE av_agenda_pedidos_ferias SET situacao = '2' WHERE id_exercicio = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}