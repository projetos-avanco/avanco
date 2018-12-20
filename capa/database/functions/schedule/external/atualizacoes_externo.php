<?php

/**
 * confirma o status de um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento externo
 */
function confirmaUmAtendimentoExterno($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_externos SET status = '2' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * cancela o status de um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento externo
 */
function cancelaUmAtendimentoExterno($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_externos SET status = '3' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}