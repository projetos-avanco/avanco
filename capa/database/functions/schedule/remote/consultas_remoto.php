<?php

/**
 * consulta o cnpj de uma empresa
 * @param - objeto com uma conexão aberta
 * @param - string com o id do cnpj da empresa
 */
function consultaCnpjDaEmpresa($db, $id)
{
  $query = "SELECT cnpj FROM av_agenda_cnpjs WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  $cnpj = mysqli_fetch_row($resultado);
  
  return $cnpj[0];
}

/**
 * consulta o nome da razão social de uma empresa
 * @param - objeto com uma conexão aberta
 * @param - string com o id do cnpj da empresa
 */
function consultaRazaoSocialDaEmpresa($db, $id)
{
  $query = "SELECT razao_social FROM av_agenda_cnpjs WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  $razaoSocial = mysqli_fetch_row($resultado);
  
  return mb_strtoupper($razaoSocial[0]);
}

/**
 * consulta a conta contrato de uma empresa
 * @param - objeto com uma conexão aberta
 * @param - string com o id do cnpj da empresa
 */
function consultaContratoDaEmpresa($db, $id)
{
  $query =
    "SELECT
      t.conta_contrato
    FROM av_agenda_cnpjs AS c
    INNER JOIN av_agenda_contratos AS t
      ON t.id = c.id_contrato
    WHERE c.id = $id";
  
  $resultado = mysqli_query($db, $query);

  $contrato = mysqli_fetch_row($resultado);
  
  return $contrato[0];
}

/**
 * consulta o endereço do e-mail do colaborador
 * @param - objeto com uma conexão aberta
 * @param - string com o id do colaborador
 */
function consultaEmailDoColaborador($db, $id)
{
  $query = "SELECT email FROM lh_users WHERE id = $id";

  $resultado = mysqli_query($db, $query);

  $email = mysqli_fetch_row($resultado);

  return $email[0];
}