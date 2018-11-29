<?php

/**
 * deleta um exercício de férias
 * @param - objeto com uma conexão aberta
 * @param - id do exercício de férias
 */
function deletaExercicioDeFerias($db, $id)
{
  $query = "DELETE FROM av_agenda_exercicios_ferias WHERE id = $id";

  mysqli_query($db, $query);
}