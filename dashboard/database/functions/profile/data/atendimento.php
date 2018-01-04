<?php

/**
 * calcula os atendimentos demandados (finalizados) do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaAtendimentosDemandados($objeto, $modelo, $datas)
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
      WHERE (c.user_id = {$modelo['pessoal']['id']})
        AND (c.status = 2)
        AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
    WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0);";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['atendimento']['atendimentos_demandados'] = (int)$valor[0];

  return $modelo;
}

/**
 * calcula os atendimentos realizados do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaAtendimentosRealizados($objeto, $modelo, $datas)
{
  $query =
    "SELECT
    	COUNT(id) AS atendimentos_realizados
    FROM lh_chat
    WHERE (user_id = {$modelo['pessoal']['id']})
    	AND (status = 2)
    	AND (chat_duration > 0)
    	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}');";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['atendimento']['atendimentos_realizados'] = (int)$valor[0];

  return $modelo;
}

/**
 * calcula os atendimentos perdidos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaAtendimentosPerdidos($objeto, $modelo, $datas)
{
  $query =
  "SELECT
  	COUNT(id) AS atendimentos_perdidos
  FROM lh_chat
  WHERE (user_id = {$modelo['pessoal']['id']})
  	AND (status = 2)
  	AND (chat_duration = 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['atendimento']['atendimentos_perdidos'] = (int)$valor[0];

  return $modelo;
}

/**
 * calcula o percentual de perda do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaPercentualDePerda($objeto, $modelo, $datas)
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
    			WHERE (c.user_id = {$modelo['pessoal']['id']})
    				AND (c.status = 2)
    				AND (c.chat_duration = 0)
    				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
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
    			WHERE (c.user_id = {$modelo['pessoal']['id']})
    				AND (c.status = 2)
    				AND (FROM_UNIXTIME(c.time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}')) AS d
    		WHERE NOT (d.time_diff < '00:03:00' AND d.chat_duration = 0))), 0) AS percentual_perda;";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['atendimento']['percentual_perda'] = $valor[0];

  return $modelo;
}

/**
 * calcula o percentual de fila até 15 minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaPercentualDeFilaAte15Minutos($objeto, $modelo, $datas)
{
  $query =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(id) AS atendimentos_realizados_ate_15_minutos
  		FROM lh_chat
  		WHERE (user_id = {$modelo['pessoal']['id']})
  			AND (status = 2)
  			AND (wait_time <= 900)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}'))

  		/


  		(SELECT
  			COUNT(id) AS atendimentos_demandados
  		FROM lh_chat
  		WHERE (user_id = {$modelo['pessoal']['id']})
  			AND (status = 2)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}'))), 0) AS percentual_atendimentos_15_minutos";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['atendimento']['percentual_fila_ate_15_minutos'] = $valor[0];

  return $modelo;
}

/**
 * calcula tempo médio de atendimento (tma) em minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaTMA($objeto, $modelo, $datas)
{
  $query =
  "SELECT
  	ROUND((
  		(SELECT
  			(SUM(chat_duration) / 60) AS duracao_atendimentos
  		FROM lh_chat
  		WHERE (user_id = {$modelo['pessoal']['id']})
  			AND (status = 2)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}'))

  		/

  		(SELECT
  			COUNT(id) AS atendimentos_realizados
  		FROM lh_chat
  		WHERE (user_id = {$modelo['pessoal']['id']})
  			AND (status = 2)
  			AND (chat_duration > 0)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data_1']}' AND '{$datas['data_2']}'))), 0) AS tma";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['atendimento']['tma'] = $valor[0];

  return $modelo;
}

/**
 * consulta e retorna os dados dos atendimentos do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function consultaDadosDosAtendimentosDoColaborador($objeto, $modelo, $datas)
{
  # chamando funções que calculam e retornam as demandas
  $modelo = calculaAtendimentosDemandados($objeto, $modelo, $datas);
  $modelo = calculaAtendimentosRealizados($objeto, $modelo, $datas);
  $modelo = calculaAtendimentosPerdidos($objeto, $modelo, $datas);

  # chamando funções que calculam e retornam os percentuais
  $modelo = calculaPercentualDePerda($objeto, $modelo, $datas);
  $modelo = calculaPercentualDeFilaAte15Minutos($objeto, $modelo, $datas);

  # chamando função que calcula e retorna o tma
  $modelo = calculaTMA($objeto, $modelo, $datas);

  return $modelo;
}
