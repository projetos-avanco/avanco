<?php

/**
 * deleta dados na tabela de despesas
 * @param - objeto com uma conexão aberta
 * @param - string com o id da issue
 */
function deletaDespesas($db, $id)
{
  $query = "DELETE FROM av_registro_horas_despesas WHERE (id_issue = $id);";

  $resultado = $db->query($query);

  return $resultado;

}

/**
 * deleta dados na tabela de lançamentos
 * @param - objeto com uma conexão aberta
 * @param - string com o id da issue
 */
function deletaLancamentos($db, $id)
{
  $query = "DELETE FROM av_registro_horas_lancamentos WHERE (id_issue = $id);";

  $resultado = $db->query($query);

  return $resultado;
  
}
