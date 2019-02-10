<?php

/**
 * consulta se um contrato já existe na tabela de contratos e retorna o seu id
 * @param - objeto com uma conexão aberta
 * @param - string com a conta contrato
 */
function consultaContratoExistente($db, $contrato)
{
  $query = "SELECT id FROM av_agenda_contratos WHERE conta_contrato = $contrato";

  $resultado = mysqli_query($db, $query);

  $id = mysqli_fetch_row($resultado);
  $id = $id[0];

  # verificando se o id retornado é null
  if (is_null($id)) {$id = 0;}

  return $id;
}

/**
 * consulta se um cnpj já existe na tabela de cnpjs e retorna o seu id
 * @param - objeto com uma conexão aberta
 * @param - string com o cnpj
 */
function consultaCnpjExistente($db, $cnpj)
{
  $query = "SELECT id FROM av_agenda_cnpjs WHERE cnpj = '$cnpj'";

  $resultado = mysqli_query($db, $query);

  $id = mysqli_fetch_row($resultado);
  $id = $id[0];

  # verificando se o id retornado é null
  if (is_null($id)) {$id = 0;}

  return $id;
}