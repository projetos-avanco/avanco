<?php

/**
 * deleta um registro de atendimento remoto
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o número do registro do antedimento remoto
 */
function deletaAtendimentoRemoto($db, $registro)
{
  $query = "DELETE FROM av_agenda_atendimentos_remotos WHERE registro = $registro";

  mysqli_query($db, $query);
}