<?php

/**
 * deleta uma pesquisa externa
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id da pesquisa externa
 */
function deletaPesquisaExterna($db, $id)
{
  $query = "DELETE FROM av_agenda_pesquisas_externas WHERE id = $id";

  mysqli_query($db, $query);
}

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