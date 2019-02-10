<?php

/**
 * consulta a quantidade atual de moedas do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function consultaQuantidadeDeMoedas($db, $carteira)
{
  $query = "SELECT moedas FROM av_avancoins_carteiras WHERE (id = {$carteira['id_colaborador']});";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $moedas = $resultado->fetch_row();

    # recuperando a quantidade atual de moedas
    $carteira['moedas'] = (int)$moedas[0];

  }

  return $carteira['moedas'];

}

/**
 * verifica a quantidade de moedas utilizadas em compras na loja avanção pelos logs de compras
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function verificaQuantidadeDeMoedasUtilizadasNaLojaAvancao($db, $carteira)
{
  $query =
    "SELECT
      SUM(ap.valor)
    FROM av_avancoins_historico_compras AS ahc
    INNER JOIN av_avancoins_produtos AS ap
      ON ap.id = ahc.id_produto
    WHERE (ahc.id_colaborador = {$carteira['id_colaborador']})";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $moedas = $resultado->fetch_row();
    
    # somando a quantidade de moedas existentes com a quantidade retornada pela consulta
    $carteira['moedas'] += (int)$moedas[0];

  }

  return $carteira['moedas'];

}

/**
 * verifica a quantidade de moedas que o colaborador possui pelos logs de ações esporádicas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function verificaQuantidadeDeMoedasDasAcoesEsporadicas($db, $carteira)
{
  $query =
    "SELECT
      SUM(a.valor)	
    FROM
      (SELECT
        CASE
          WHEN (t.id = 3)
            THEN ((t.horario_acao / 30) * t.valor)
        ELSE (t.valor)
        END AS valor
      FROM
        (SELECT
          ae.id,
          TIME_TO_SEC(ael.horario_acao) / 60 AS horario_acao,
          ae.valor	
        FROM av_avancoins_acoes_esporadicas_logs AS ael
        INNER JOIN av_avancoins_acoes_esporadicas AS ae
          ON ae.id = ael.id_acao_esporadica
        WHERE (ael.id_colaborador = {$carteira['id_colaborador']})) AS t) AS a;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $moedas = $resultado->fetch_row();
    
    # somando a quantidade de moedas existentes com a quantidade retornada pela consulta
    $carteira['moedas'] += (int)$moedas[0];

  }

  return $carteira['moedas'];

}

/**
 * verifica a quantidade de moedas que o colaborador possui pelos logs de ações mensais
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function verificaQuantidadeDeMoedasDasAcoesMensais($db, $carteira)
{
  $query =
    "SELECT
    	SUM(am.valor)
    FROM av_avancoins_acoes_mensais_logs AS aml
    INNER JOIN av_avancoins_acoes_mensais AS am
    	ON am.id = aml.id_acao_mensal
    WHERE (aml.id_colaborador = {$carteira['id_colaborador']});";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $moedas = $resultado->fetch_row();

    # somando a quantidade de moedas existentes com a quantidade retornada pela consulta
    $carteira['moedas'] += (int)$moedas[0];


  }

  return $carteira['moedas'];

}

/**
 * verifica a quantidade de moedas que o colaborador possui pelos logs de ações diárias
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function verificaQuantidadeDeMoedasDasAcoesDiarias($db, $carteira)
{
  $query =
    "SELECT
    	SUM(ad.valor)
    FROM av_avancoins_acoes_diarias_logs AS adl
    INNER JOIN av_avancoins_acoes_diarias AS ad
    	ON ad.id = adl.id_acao_diaria
    WHERE (adl.id_colaborador = {$carteira['id_colaborador']});";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $moedas = $resultado->fetch_row();

    # recuperando quantidade de moedas
    $carteira['moedas'] = (int)$moedas[0];

  }

  return $carteira['moedas'];

}


/**
 * atualiza a quantidade de moedas na carteira de avancoins
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function atualizaQuantidadeDeMoedasNaCarteira($db, $carteira)
{
  # chamando função que verifica a quantidade de moedas que o colaborador possui pelos logs de ações diárias
  $carteira['moedas'] = verificaQuantidadeDeMoedasDasAcoesDiarias($db, $carteira);

  # chamando função que verifica a quantidade de moedas que o colaborador possui pelos logs de ações mensais
  $carteira['moedas'] = verificaQuantidadeDeMoedasDasAcoesMensais($db, $carteira);

  # chamando função que verifica a quantidade de moedas que o colaborador possui pelos logs de ações esporádicas
  $carteira['moedas'] = verificaQuantidadeDeMoedasDasAcoesEsporadicas($db, $carteira);

  # chamando função que verifica a quantidade de moedas utilizadas em compras na loja avanção pelos logs de compras
  $carteira['moedas'] = verificaQuantidadeDeMoedasUtilizadasNaLojaAvancao($db, $carteira);

  $carteira['horario_atual'] = date('H:i:s');

  $query =
    "UPDATE
      av_avancoins_carteiras
    SET
      moedas = {$carteira['moedas']},
      data_atualizacao = '{$carteira['data_atual']}',
      horario_atualizacao = '{$carteira['horario_atual']}'
    WHERE (id = {$carteira['id_colaborador']});";

  $db->query($query);

}
