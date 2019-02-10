<?php

/**
 * altera o status de um exercício de férias para agendado
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function alteraStatusDoExercicioParaAgendado($db, $id)
{
  $query = "UPDATE av_agenda_exercicios_ferias SET status = 1 WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}