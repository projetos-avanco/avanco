<?php

/**
 * confirma o status de um atendimento remoto
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento remoto
 */
function confirmaUmAtendimentoRemoto($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_remotos SET status = '1' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * cancela o status de um atendimento remoto
 * @param - objeto com uma conexão aberta
 * @param - string com o id do atendimento remoto
 */
function cancelaUmAtendimentoRemoto($db, $id)
{
  $query = "UPDATE av_agenda_atendimentos_remotos SET status = '4' WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}