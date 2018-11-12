<?php

/**
 * consulta o id de um atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o número do registro
 */
function consultaIdDoAtendimentoExterno($db, $registro)
{
  $query = "SELECT id FROM av_agenda_atendimentos_externos WHERE registro = $registro";

  $resultado = mysqli_query($db, $query);

  $id = mysqli_fetch_row($resultado);

  return (int)$id[0];
}