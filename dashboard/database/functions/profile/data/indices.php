<?php

/**
 * calcula o percentual avancino do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaPercentualAvancino($objeto, $modelo, $datas)
{
  $query =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE (c.user_id = {$modelo['pessoal']['id']})
  			AND (e.avaliacao_colaborador = 'Ótimo' OR e.avaliacao_colaborador = 'Bom')
  			AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))

  		/

  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE (c.user_id = {$modelo['pessoal']['id']})
  			AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))), 0) AS percentual_indice_avancino";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['indices']['percentual_avancino'] = $valor[0];

  return $modelo;
}

/**
 * calcula o percentual de eficiência do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaPercentualEficiencia($objeto, $modelo, $datas)
{
  $query =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE (c.user_id = {$modelo['pessoal']['id']})
  			AND (e.avaliacao_atendimento = 'Ótimo' OR e.avaliacao_atendimento = 'Bom')
  			AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))

  		/

  		(SELECT
  			COUNT(e.cod_pesquisa)
  		FROM av_questionario_externo AS e
  		INNER JOIN lh_chat AS c
  			ON c.id = e.id_chat
  		WHERE (c.user_id = {$modelo['pessoal']['id']})
  			AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))), 0) AS percentual_indice_eficiencia";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['indices']['percentual_eficiencia'] = $valor[0];

  return $modelo;
}

/**
 * calcula o percentual de questionários respondidos pelo colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaPercentualQuestionariosRespondidos($objeto, $modelo, $datas)
{
  $query =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(i.id_chat)
  		FROM av_questionario_interno AS i
  		INNER JOIN lh_chat AS c
  			ON c.id = i.id_chat
  		WHERE (c.user_id = {$modelo['pessoal']['id']})
  			AND (c.status = 2)
  			AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))

  		/

  		(SELECT
  			COUNT(c.id)
  		FROM lh_chat AS c
  		WHERE (c.user_id = {$modelo['pessoal']['id']})
  			AND (c.status = 2)
  			AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))), 0) AS percentual_questionario_respondido";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['indices']['percentual_questionario_respondido'] = $valor[0];

  return $modelo;
}

/**
 * consulta e retorna os dados dos índices (avancino, eficiência e questionários respondidos) do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function consultaDadosDosIndicesDoColaborador($objeto, $modelo, $datas)
{
  # chamando funções que calculam e retornam os índices
  $modelo = calculaPercentualAvancino($objeto, $modelo, $datas);
  $modelo = calculaPercentualEficiencia($objeto, $modelo, $datas);
  $modelo = calculaPercentualQuestionariosRespondidos($objeto, $modelo, $datas);

  return $modelo;
}
