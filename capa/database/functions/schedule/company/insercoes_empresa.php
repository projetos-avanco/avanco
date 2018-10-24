<?php

/**
 * insere os dados de uma empresa na tabela de cnpjs
 * @param - objeto com uma conexão aberta
 * @param - array com o dados da tabela de cnpj
 * 
 */
function insereDadosNaTabelaCnpj($db, $cnpjs, $contratos)
{
  $query = 
    "INSERT INTO av_agenda_cnpjs 
      VALUES (
         {$cnpjs['id']},
         {$contratos['id']},
        '{$cnpjs['cnpj']}',
        '{$cnpjs['razao_social']}'
      )";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * insere os dados de uma empresa na tabela de contratos
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da tabela de contratos
 */
function insereDadosNaTabelaContratos($db, $contratos)
{
  $query = "INSERT INTO av_agenda_contratos VALUES ({$contratos['id']}, '{$contratos['conta_contrato']}')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}