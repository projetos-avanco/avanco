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
					COUNT(d.id_chat)
				FROM
					(SELECT
						e.id_chat,							
						c.chat_duration,
						TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
					FROM lh_chat AS c
					INNER JOIN av_questionario_externo AS e
						ON e.id_chat = c.id
					WHERE (c.user_id = {$modelo['pessoal']['id']})
						AND (e.avaliacao_colaborador = 'Otimo' OR e.avaliacao_colaborador = 'Bom')
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))

					/

				(SELECT 
					COUNT(d.id_chat)
				FROM
					(SELECT
						e.id_chat,						
						c.chat_duration,
						TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
					FROM lh_chat AS c
					INNER JOIN av_questionario_externo AS e
						ON e.id_chat = c.id
					WHERE (c.user_id = {$modelo['pessoal']['id']})
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_indice_avancino;";

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
					COUNT(d.id_chat)
				FROM
					(SELECT
						e.id_chat,						
						c.chat_duration,
						TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
					FROM lh_chat AS c
					INNER JOIN av_questionario_externo AS e
						ON e.id_chat = c.id
					WHERE (c.user_id = {$modelo['pessoal']['id']})
						AND (e.avaliacao_atendimento = 'Otimo' OR e.avaliacao_atendimento = 'Bom')
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))

					/

				(SELECT
					COUNT(d.id_chat)
				FROM
					(SELECT
						e.id_chat,						
						c.chat_duration,
						TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
					FROM lh_chat AS c
					INNER JOIN av_questionario_externo AS e
						ON e.id_chat = c.id
					WHERE (c.user_id = {$modelo['pessoal']['id']})
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_indice_eficiencia;";

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
					COUNT(d.id_chat)
				FROM 
					(SELECT
						i.id_chat,
						c.chat_duration,
						TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
					FROM av_questionario_interno AS i
					INNER JOIN lh_chat AS c
						ON c.id = i.id_chat
					WHERE (c.user_id = {$modelo['pessoal']['id']})
						AND (c.status = 2)
						AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))

					/

				(SELECT
					COUNT(d.id)
				FROM
					(SELECT
						c.id,
						c.chat_duration,
						TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
					FROM lh_chat AS c
					WHERE (c.user_id = {$modelo['pessoal']['id']})
						AND (c.status = 2)
						AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_questionario_respondido;";

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
