<?php

/**
 * soma os valores das ações registradas nas tabelas de logs
 * @param - array com as ações registradas nas tabelas de logs
 */
function somaValoresDasAcoes($acoes)
{
  $soma = 0;

  settype($acoes['valor'], 'integer');

  # somando todos os valores do array
  foreach ($acoes as $acao) {

    $soma += $acao['valor'];

  }

  return $soma;

}

/**
 * gera um extrato com as ações diárias detalhadas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesDiariasDetalhado($db, $form)
{
  $query =
    "SELECT
  		DATE_FORMAT(adl.data_acao, '%d/%m/%Y') AS data_acao,
  		adl.horario_acao,
  		adl.id_chat,
  		ad.descricao,
  		ad.valor
  	FROM av_avancoins_acoes_diarias_logs AS adl
    INNER JOIN av_avancoins_acoes_diarias AS ad
  		ON ad.id = adl.id_acao_diaria
  	WHERE (adl.id_colaborador = {$form['colaborador']})
  		AND (adl.data_acao BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')
  	ORDER BY adl.data_acao, adl.horario_acao, adl.id_chat;";

  if ($resultado = $db->query($query)) {

    $acoesDiarias = array();

    while ($registro = $resultado->fetch_assoc()) {

      $acoesDiarias[] = array(

        'data_acao'    => $registro['data_acao'],
        'horario_acao' => $registro['horario_acao'],
        'id_chat'      => $registro['id_chat'],
        'descricao'    => $registro['descricao'],
        'valor'        => $registro['valor']

      );

    }

  }

  return $acoesDiarias;

}

/**
 * gera um extrato com as ações mensais detalhadas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesMensaisDetalhado($db, $form)
{
  $query =
    "SELECT
      DATE_FORMAT(aml.data_acao, '%d/%m/%Y') AS data_acao,
      aml.horario_acao,
      am.descricao,
      am.valor
  	FROM av_avancoins_acoes_mensais_logs AS aml
    INNER JOIN av_avancoins_acoes_mensais AS am
  		ON am.id = aml.id_acao_mensal
  	WHERE (aml.id_colaborador = {$form['colaborador']})
  		AND (aml.data_acao BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')
  	ORDER BY aml.data_acao;";

  if ($resultado = $db->query($query)) {

    $acoesMensais = array();

    while ($registro = $resultado->fetch_assoc()) {

      $acoesMensais[] = array(

        'data_acao'    => $registro['data_acao'],
        'horario_acao' => $registro['horario_acao'],
        'descricao'    => $registro['descricao'],
        'valor'        => $registro['valor']

      );

    }

  }

  return $acoesMensais;

}

/**
 * gera um extrato com as ações esporádicas detalhadas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do formulário de extrato avancoins
 */
function geraExtratoDeAcoesEsporadicasDetalhado($db, $form)
{
  $query =
    "SELECT
      DATE_FORMAT(ael.data_acao, '%d/%m/%Y') AS data_acao,
      ael.horario_acao,
      CONCAT(lu.name, ' ', lu.surname) AS supervisor,
      DATE_FORMAT(ael.data_registro, '%d/%m/%Y') AS data_registro,
      ael.observacao,
      ae.descricao,
      ae.valor
  	FROM av_avancoins_acoes_esporadicas_logs AS ael
    INNER JOIN av_avancoins_acoes_esporadicas AS ae
  		ON ae.id = ael.id_acao_esporadica
  	INNER JOIN lh_users AS lu
  		ON lu.id = ael.id_supervisor
  	WHERE (ael.id_colaborador = {$form['colaborador']})
  		AND (ael.data_acao BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')
  		OR  (ael.data_registro BETWEEN '{$form['data_inicial']}' AND '{$form['data_final']}')
  	ORDER BY ael.data_acao, ael.horario_acao, ael.data_registro;";

  if ($resultado = $db->query($query)) {

    $acoesEsporadicas = array();

    while ($registro = $resultado->fetch_assoc()) {

      $acoesEsporadicas[] = array(

        'data_acao'     => $registro['data_acao'],
        'horario_acao'  => $registro['horario_acao'],
        'supervisor'    => $registro['supervisor'],
        'data_registro' => $registro['data_registro'],
        'observacao'    => $registro['observacao'],
        'descricao'     => $registro['descricao'],
        'valor'         => $registro['valor']

      );

    }

  }

  return $acoesEsporadicas;

}
