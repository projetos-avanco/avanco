<?php

/**
 * deleta os pedidos de férias de um exercício
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function deletaPedidosDeFerias($db, $id)
{
  $query = "DELETE FROM av_agenda_pedidos_ferias WHERE id_exercicio = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * deleta um exercício de férias
 * @param - objeto com uma conexão aberta
 * @param - id do exercício de férias
 */
function deletaExercicioDeFerias($db, $id)
{
  $query = "DELETE FROM av_agenda_exercicios_ferias WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}