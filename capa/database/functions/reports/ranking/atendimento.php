<?php

/**
 * zera valores que são nulos
 * @param - string com o valor
 */
function zeraValorNulo($valor)
{
	# verificando se o valor é nulo
	if ($valor == null) {

		return '0';

	} else {

		return $valor;

	}

}

/**
 * calcula os atendimentos demandados (finalizados) do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador 
 */
function calculaAtendimentosDemandados($db, $ranking)
{
  $query =
    "SELECT
      COUNT(d.id) atendimentos_demandados
    FROM
      (SELECT
        c.id,
        c.chat_duration,
        TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
      FROM lh_chat AS c
      WHERE (c.user_id = {$ranking['pessoal']['id']})
        AND (c.status = 2)
        AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}')) AS d
    WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);

	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking['atendimento']['atendimentos_demandados'] = $valor;

  return $ranking;
}

/**
 * calcula os atendimentos realizados do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador 
 */
function calculaAtendimentosRealizados($db, $ranking)
{
  $query =
    "SELECT
    	COUNT(id) AS atendimentos_realizados
    FROM lh_chat
    WHERE (user_id = {$ranking['pessoal']['id']})
    	AND (status = 2)
    	AND (chat_duration > 0)
    	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}');";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);

	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking['atendimento']['atendimentos_realizados'] = $valor;

  return $ranking;
}

/**
 * calcula os atendimentos perdidos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador 
 */
function calculaAtendimentosPerdidos($db, $ranking)
{
  $query =
		"SELECT
			COUNT(d.id) AS atendimentos_perdidos
		FROM
			(SELECT
				c.id,
				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
			FROM lh_chat AS c
			WHERE (c.user_id = {$ranking['pessoal']['id']})
				AND (c.status = 2)
				AND (c.chat_duration = 0)
				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}')) AS d
		WHERE (d.time_diff >= '00:03:00');";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);

	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking['atendimento']['atendimentos_perdidos'] = $valor;

  return $ranking;
}

/**
 * calcula o percentual de perda do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function calculaPercentualDePerda($db, $ranking)
{
  $query =
    "SELECT
    	ROUND(100 * (
    		(SELECT
    			COUNT(d.id) AS atendimentos_perdidos
    		FROM
    			(SELECT
    				c.id,
    				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
    			FROM lh_chat AS c
    			WHERE (c.user_id = {$ranking['pessoal']['id']})
    				AND (c.status = 2)
    				AND (c.chat_duration = 0)
    				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}')) AS d
    		WHERE (d.time_diff >= '00:03:00'))

    		/

    		(SELECT
    			COUNT(d.id) atendimentos_demandados
    		FROM
    			(SELECT
    				c.id,
    				c.chat_duration,
    				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
    			FROM lh_chat AS c
    			WHERE (c.user_id = {$ranking['pessoal']['id']})
    				AND (c.status = 2)
    				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}')) AS d
    		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_perda;";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking['atendimento']['percentual_perda'] = $valor;

  return $ranking;
}

/**
 * calcula o percentual de fila até 15 minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function calculaPercentualDeFilaAte15Minutos($db, $ranking)
{
	$query =
		"SELECT
			ROUND(100 * (
				(SELECT
					COUNT(d.id)
				FROM
					(SELECT
						c.id,
						c.chat_duration,
						TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
					FROM lh_chat AS c
					WHERE (c.user_id = {$ranking['pessoal']['id']})
						AND (c.wait_time < 900)
						AND (c.status = 2)
						AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}')) AS d
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
					WHERE (c.user_id = {$ranking['pessoal']['id']})
						AND (c.status = 2)
						AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}')) AS d
				WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_atendimentos_15_minutos;";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking['atendimento']['percentual_fila_ate_15_minutos'] = $valor;

  return $ranking;
}

/**
 * calcula tempo médio de atendimento (tma) em minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function calculaTMA($db, $ranking)
{
  $query =
  "SELECT
  	ROUND((
  		(SELECT
  			(SUM(chat_duration) / 60) AS duracao_atendimentos
  		FROM lh_chat
  		WHERE (user_id = {$ranking['pessoal']['id']})
  			AND (status = 2)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}'))

  		/

  		(SELECT
  			COUNT(id) AS atendimentos_realizados
  		FROM lh_chat
  		WHERE (user_id = {$ranking['pessoal']['id']})
  			AND (status = 2)
  			AND (chat_duration > 0)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$ranking['periodo']['data_1']}' AND '{$ranking['periodo']['data_2']}'))), 0) AS tma";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking['atendimento']['tma'] = $valor;

  return $ranking;
}

/**
 * consulta e retorna os dados dos atendimentos do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function consultaDadosDosAtendimentosDoColaborador($db, $ranking)
{	
  # chamando funções que calculam e retornam as demandas
  $ranking = calculaAtendimentosDemandados($db, $ranking);
  $ranking = calculaAtendimentosRealizados($db, $ranking);
  $ranking = calculaAtendimentosPerdidos($db, $ranking);

  # chamando funções que calculam e retornam os percentuais
  $ranking = calculaPercentualDePerda($db, $ranking);
  $ranking = calculaPercentualDeFilaAte15Minutos($db, $ranking);

  # chamando função que calcula e retorna o tma
  $ranking = calculaTMA($db, $ranking);

  return $ranking;
}
