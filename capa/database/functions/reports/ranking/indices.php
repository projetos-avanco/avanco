<?php

/**
 * consulta a quantidade de questionários respondidos como satisfeito ou muito satisfeito do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function consultaQuantidadeQuestionariosAvancino($db, $indice, $ranking, $datas)
{
	$query =
		"SELECT
			COUNT(d.id_chat)
		FROM
			(SELECT
				e.id_chat,							
				c.chat_duration,
				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
			FROM lh_chat AS c
			INNER JOIN av_questionario_externo AS e
				ON e.id_chat = c.id
			WHERE (c.user_id = {$ranking[$indice]['id']})
				AND (e.avaliacao_colaborador = 'Otimo' OR e.avaliacao_colaborador = 'Bom')
				AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($db, $query);

	$valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

	$ranking[$indice]['quantidade_questionarios_avancino'] = (float)$valor;

  return $ranking;
}

/**
 * consulta a quantidade de questionários respondidos como satisfeito ou muito satisfeito do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function consultaQuantidadeQuestionariosEficiencia($db, $indice, $ranking, $datas)
{
	$query =
		"SELECT
			COUNT(d.id_chat)
		FROM
			(SELECT
				e.id_chat,						
				c.chat_duration,
				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
			FROM lh_chat AS c
			INNER JOIN av_questionario_externo AS e
				ON e.id_chat = c.id
			WHERE (c.user_id = {$ranking[$indice]['id']})
				AND (e.avaliacao_atendimento = 'Otimo' OR e.avaliacao_atendimento = 'Bom')
				AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($db, $query);

	$valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

	$ranking[$indice]['quantidade_questionarios_eficiencia'] = (float)$valor;

  return $ranking;
}

/**
 * consulta a quantidade de questionários respondidos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function consultaTotalDeQuestionariosExternos($db, $indice, $ranking, $datas)
{
	$query =
		"SELECT 
			COUNT(d.id_chat)
		FROM
			(SELECT
				e.id_chat,						
				c.chat_duration,
				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
			FROM lh_chat AS c
			INNER JOIN av_questionario_externo AS e
				ON e.id_chat = c.id
			WHERE (c.user_id = {$ranking[$indice]['id']})
				AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($db, $query);

	$valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

	$ranking[$indice]['quantidade_questionarios_externos'] = (float)$valor;

  return $ranking;
}

/**
 * consulta a quantidade de questionários internos respondidos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function consultaTotalDeQuestionariosInternos($db, $indice, $ranking, $datas)
{
	$query =
		"SELECT
			COUNT(d.id_chat)
		FROM 
			(SELECT
				i.id_chat,
				c.chat_duration,
				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
			FROM av_questionario_interno AS i
			INNER JOIN lh_chat AS c
				ON c.id = i.id_chat
			WHERE (c.user_id = {$ranking[$indice]['id']})
				AND (c.status = 2)
				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($db, $query);

	$valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

	$ranking[$indice]['quantidade_questionarios_internos'] = (float)$valor;

  return $ranking;
}

/**
 * calcula o percentual avancino do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaPercentualAvancino($db, $indice, $ranking, $datas)
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
					WHERE (c.user_id = {$ranking[$indice]['id']})
						AND (e.avaliacao_colaborador = 'Otimo' OR e.avaliacao_colaborador = 'Bom')
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
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
					WHERE (c.user_id = {$ranking[$indice]['id']})
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_indice_avancino;";

  $resultado = mysqli_query($db, $query);

	$valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

	$ranking[$indice]['percentual_avancino'] = (float)$valor;

  return $ranking;
}

/**
 * calcula o percentual de eficiência do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaPercentualEficiencia($db, $indice, $ranking, $datas)
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
					WHERE (c.user_id = {$ranking[$indice]['id']})
						AND (e.avaliacao_atendimento = 'Otimo' OR e.avaliacao_atendimento = 'Bom')
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
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
					WHERE (c.user_id = {$ranking[$indice]['id']})
						AND (DATE_FORMAT(e.data_pesquisa, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_indice_eficiencia;";

  $resultado = mysqli_query($db, $query);

	$valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

	$ranking[$indice]['percentual_eficiencia'] = (float)$valor;

  return $ranking;
}

/**
 * calcula o percentual de questionários respondidos pelo colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaPercentualQuestionariosRespondidos($db, $indice, $ranking, $datas)
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
					WHERE (c.user_id = {$ranking[$indice]['id']})
						AND (c.status = 2)
						AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
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
					WHERE (c.user_id = {$ranking[$indice]['id']})
						AND (c.status = 2)
						AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
					WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_questionario_respondido;";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['percentual_questionario_respondido'] = (float)$valor;

  return $ranking;
}

/**
 * consulta e retorna os dados dos índices (avancino, eficiência e questionários respondidos) do colaborador
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function consultaDadosDosIndicesDoColaborador($db, $indice, $ranking, $datas)
{	
	# chamando funções que calculam e retornam os índices
	$ranking = calculaPercentualAvancino($db, $indice, $ranking, $datas);
	$ranking = calculaPercentualEficiencia($db, $indice, $ranking, $datas);
	$ranking = calculaPercentualQuestionariosRespondidos($db, $indice, $ranking, $datas);
	
	# chamando funções que calculam e retornam os totais de questionários
	$ranking = consultaQuantidadeQuestionariosAvancino($db, $indice, $ranking, $datas);
	$ranking = consultaQuantidadeQuestionariosEficiencia($db, $indice, $ranking, $datas);
	$ranking = consultaTotalDeQuestionariosExternos($db, $indice, $ranking, $datas);
	$ranking = consultaTotalDeQuestionariosInternos($db, $indice, $ranking, $datas);

  return $ranking;
}
