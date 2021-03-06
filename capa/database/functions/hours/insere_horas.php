<?php

/**
 * insere um registro de horas na tabela de issues
 */
function insereRegistroDeIssues($db, $issues)
{
  $query =
    "INSERT INTO av_registro_horas_issues
     VALUES (0,
            '{$issues['issue']}',
            '{$issues['tipo']}',
            '{$issues['status']}',
            '{$issues['cnpj']}',
            '{$issues['conta_contrato']}',
            '{$issues['razao_social']}',
             {$issues['supervisor']},
             {$issues['colaborador']},
            '{$issues['observacao']}');";

  if ($resultado = $db->query($query)) {

    return true;

  } else {

    return false;

  }

}

/**
 * insere um registro de horas na tabela de lançamentos
 */
function insereRegistroDeLancamentos($db, $lancamentos, $id)
{
  $retorno = array();

  for ($i = 0; $i < count($lancamentos); $i++) {

    $query = "";
    $query = 
      "INSERT INTO av_registro_horas_lancamentos 
        VALUES (0,
               $id,
               '{$lancamentos[$i]['data']}',
                {$lancamentos[$i]['produto']},
               '{$lancamentos[$i]['horas_trabalhadas']}',
               '{$lancamentos[$i]['horas_faturadas']}',
                {$lancamentos[$i]['valor_horas']},
                {$lancamentos[$i]['valor_total']});";

    if ($resultado = $db->query($query)) {

      $retorno[$i]['posicao']  = $i;
      $retorno[$i]['data']     = $lancamentos[$i]['data'];
      $retorno[$i]['execucao'] = true;

    } else {

      $retorno[$i]['posicao']  = $i;
      $retorno[$i]['data']     = $lancamentos[$i]['data'];
      $retorno[$i]['execucao'] = false;

      return false;

    }

  }

  return true;

}

/**
 * insere um registro de horas na tabela de despesas
 */
function insereRegistroDeDespesas($db, $despesas, $id)
{
  $query =
    "INSERT INTO av_registro_horas_despesas
      VALUES (0,
             $id,
             {$despesas['deslocamento']},
             {$despesas['alimentacao']},
             {$despesas['hospedagem']},
             {$despesas['total-despesas']});";

  if ($resultado = $db->query($query)) {

    return true;

  } else {

    return false;

  }

}
