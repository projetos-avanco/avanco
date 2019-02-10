<?php

/**
 * deleta um registro de folga
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da folga
 */
function deletaRegistroDeFolga($db, $id)
{
  $query = "DELETE FROM av_agenda_folgas WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * deleta um registro de falta
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da falta
 */
function deletaRegistroDeFalta($db, $id)
{
  $query = "DELETE FROM av_agenda_faltas WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * deleta um registro de atraso
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da atraso
 */
function deletaRegistroDeAtraso($db, $id)
{
  $query = "DELETE FROM av_agenda_atrasos WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * deleta um registro de extra
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da extra
 */
function deletaRegistroDeExtra($db, $id)
{
  $query = "DELETE FROM av_agenda_extras WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}