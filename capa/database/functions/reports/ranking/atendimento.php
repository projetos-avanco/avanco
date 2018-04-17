<?php

/**
 * zera valores que são nulos
 * @param - string com o valor
 */
function zeraValorNulo($valor)
{
	# verificando se o valor é nulo
	if ($valor == null) {

		return 0;

	} else {

		return $valor;

	}

}

/**
 * calcula os atendimentos demandados (finalizados) do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaAtendimentosDemandados($db, $indice, $ranking, $datas)
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
      WHERE (c.user_id = {$ranking[$indice]['id']})
        AND (c.status = 2)
        AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
    WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);

	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['atendimentos_demandados'] = (int)$valor;

  return $ranking;
}

/**
 * calcula os atendimentos realizados do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaAtendimentosRealizados($db, $indice, $ranking, $datas)
{
  $query =
    "SELECT
    	COUNT(id) AS atendimentos_realizados
    FROM lh_chat
    WHERE (user_id = {$ranking[$indice]['id']})
    	AND (status = 2)
    	AND (chat_duration > 0)
    	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}');";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);

	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['atendimentos_realizados'] = (int)$valor;

  return $ranking;
}

/**
 * calcula os atendimentos perdidos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaAtendimentosPerdidos($db, $indice, $ranking, $datas)
{
  $query =
		"SELECT
			COUNT(d.id) AS atendimentos_perdidos
		FROM
			(SELECT
				c.id,
				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
			FROM lh_chat AS c
			WHERE (c.user_id = {$ranking[$indice]['id']})
				AND (c.status = 2)
				AND (c.chat_duration = 0)
				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
		WHERE (d.time_diff >= '00:03:00');";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);

	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['atendimentos_perdidos'] = (int)$valor;

  return $ranking;
}

/**
 * consulta a quantidade de atendimentos realizados até 15 minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaAtendimentosRealizadosAte15Minutos($db, $indice, $ranking, $datas)
{
	$query =
		"SELECT
			COUNT(d.id)
		FROM
			(SELECT
				c.id,
				c.chat_duration,
				TIMEDIFF(FROM_UNIXTIME(c.user_closed_ts, '%H:%i:%s'), FROM_UNIXTIME(c.time, '%H:%i:%s')) AS time_diff
			FROM lh_chat AS c
			WHERE (c.user_id = {$ranking[$indice]['id']})
				AND (c.wait_time < 900)
				AND (c.status = 2)
				AND (c.chat_duration > 0)
				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['atendimentos_realizados_ate_15_minutos'] = (int)$valor;

  return $ranking;
}

/**
 * calcula o tempo de conversa dos atendimentos realizados do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaTempoDeConversa($db, $indice, $ranking, $datas)
{
  $query =
		"SELECT	
			ROUND((SUM(chat_duration) / 60), 0) tempo_conversa
		FROM lh_chat
		WHERE (user_id = {$ranking[$indice]['id']})
			AND (status = 2)
			AND (chat_duration > 0)
			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}');";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);

	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['tempo_de_conversa'] = (int)$valor;

  return $ranking;
}

/**
 * calcula o percentual de perda do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaPercentualDePerda($db, $indice, $ranking, $datas)
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
    			WHERE (c.user_id = {$ranking[$indice]['id']})
    				AND (c.status = 2)
    				AND (c.chat_duration = 0)
    				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
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
    			WHERE (c.user_id = {$ranking[$indice]['id']})
    				AND (c.status = 2)
    				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')) AS d
    		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_perda;";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['percentual_perda'] = (float)$valor;

  return $ranking;
}

/**
 * calcula o percentual de fila até 15 minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaPercentualDeFilaAte15Minutos($db, $indice, $ranking, $datas)
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
					WHERE (c.user_id = {$ranking[$indice]['id']})
						AND (c.wait_time < 900)
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
				WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_atendimentos_15_minutos;";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['percentual_fila_ate_15_minutos'] = (float)$valor;

  return $ranking;
}

/**
 * calcula tempo médio de atendimento (tma) em minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function calculaTMA($db, $indice, $ranking, $datas)
{
  $query =
  "SELECT
  	ROUND((
  		(SELECT
  			(SUM(chat_duration) / 60) AS duracao_atendimentos
  		FROM lh_chat
  		WHERE (user_id = {$ranking[$indice]['id']})
  			AND (status = 2)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))

  		/

  		(SELECT
  			COUNT(id) AS atendimentos_realizados
  		FROM lh_chat
  		WHERE (user_id = {$ranking[$indice]['id']})
  			AND (status = 2)
  			AND (chat_duration > 0)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))), 0) AS tma";

  $resultado = mysqli_query($db, $query);

  $valor = mysqli_fetch_row($resultado);
	
	# verificando se o resultado é nulo, se for ele será zerado
	$valor = zeraValorNulo($valor[0]);

  $ranking[$indice]['tma'] = (int)$valor;

  return $ranking;
}

/**
 * consulta e retorna os dados dos atendimentos do colaborador
 * @param - objeto com uma conexão aberta
 * @param - inteiro com a posição do array que está sendo executada
 * @param - array com o modelo do colaborador
 * @param - array com o período desejado
 */
function consultaDadosDosAtendimentosDoColaborador($db, $indice, $ranking, $datas)
{	
	# chamando funções que calculam e retornam as demandas
	$ranking = calculaAtendimentosDemandados($db, $indice, $ranking, $datas);
	$ranking = calculaAtendimentosRealizados($db, $indice, $ranking, $datas);
	$ranking = calculaAtendimentosPerdidos($db, $indice, $ranking, $datas);
	$ranking = calculaAtendimentosRealizadosAte15Minutos($db, $indice, $ranking, $datas);
	$ranking = calculaTempoDeConversa($db, $indice, $ranking, $datas);

	# chamando funções que calculam e retornam os percentuais
	$ranking = calculaPercentualDePerda($db, $indice, $ranking, $datas);
	$ranking = calculaPercentualDeFilaAte15Minutos($db, $indice, $ranking, $datas);

	# chamando função que calcula e retorna o tma
	$ranking = calculaTMA($db, $indice, $ranking, $datas);
	
  return $ranking;
}
