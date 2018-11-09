<?php

/**
 * deleta um registro de atendimento externo
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o número do registro do antedimento externo
 */
function deletaAtendimentoExterno($db, $registro)
{
  $query = "DELETE FROM av_agenda_atendimentos_externos WHERE registro = $registro";

  mysqli_query($db, $query);
}