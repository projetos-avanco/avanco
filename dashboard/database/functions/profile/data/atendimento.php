<?php

/**
 * calcula os atendimentos demandados (finalizados) do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaAtendimentosDemandados($conexao, $colaborador, $datas)
{
  $sql =
  "SELECT
  	COUNT(id) AS atendimentos_demandados
  FROM lh_chat
  WHERE (user_id = {$colaborador['pessoal']['id']})
  	AND (status = 2)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['atendimento']['atendimentos_demandados'] = (int)$valor[0];

  return $colaborador;
}

/**
 * calcula os atendimentos realizados do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaAtendimentosRealizados($conexao, $colaborador, $datas)
{
  $sql =
  "SELECT
  	COUNT(id) AS atendimentos_realizados
  FROM lh_chat
  WHERE (user_id = {$colaborador['pessoal']['id']})
  	AND (status = 2)
  	AND (chat_duration > 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['atendimento']['atendimentos_realizados'] = (int)$valor[0];

  return $colaborador;
}

/**
 * calcula os atendimentos perdidos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaAtendimentosPerdidos($conexao, $colaborador, $datas)
{
  $sql =
  "SELECT
  	COUNT(id) AS atendimentos_perdidos
  FROM lh_chat
  WHERE (user_id = {$colaborador['pessoal']['id']})
  	AND (status = 2)
  	AND (chat_duration = 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}')";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['atendimento']['atendimentos_perdidos'] = (int)$valor[0];

  return $colaborador;
}

/**
 * calcula o percentual de perda do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaPercentualDePerda($conexao, $colaborador, $datas)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(id) AS atendimentos_perdidos
  		FROM lh_chat
  		WHERE (user_id = {$colaborador['pessoal']['id']})
  			AND (status = 2)
  			AND (chat_duration = 0)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))

  		/

  		(SELECT
  			COUNT(id) AS atendimentos_demandados
  		FROM lh_chat
  		WHERE (user_id = {$colaborador['pessoal']['id']})
  			AND (status = 2)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))), 0) AS percentual_perda";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['atendimento']['percentual_perda'] = $valor[0];

  return $colaborador;
}

/**
 * calcula o percentual de fila até 15 minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaPercentualDeFilaAte15Minutos($conexao, $colaborador, $datas)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(id) AS atendimentos_realizados_ate_15_minutos
  		FROM lh_chat
  		WHERE (user_id = {$colaborador['pessoal']['id']})
  			AND (status = 2)
  			AND (chat_duration <= 900)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))

  		/


  		(SELECT
  			COUNT(id) AS atendimentos_demandados
  		FROM lh_chat
  		WHERE (user_id = {$colaborador['pessoal']['id']})
  			AND (status = 2)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))), 0) AS percentual_atendimentos_15_minutos";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['atendimento']['percentual_fila_ate_15_minutos'] = $valor[0];

  return $colaborador;
}

/**
 * calcula tempo médio de atendimento (tma) em minutos do colaborador em um período específico ou em uma data específica
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function calculaTMA($conexao, $colaborador, $datas)
{
  $sql =
  "SELECT
  	ROUND((
  		(SELECT
  			(SUM(chat_duration) / 60) AS duracao_atendimentos
  		FROM lh_chat
  		WHERE (user_id = {$colaborador['pessoal']['id']})
  			AND (status = 2)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))

  		/

  		(SELECT
  			COUNT(id) AS atendimentos_realizados
  		FROM lh_chat
  		WHERE (user_id = {$colaborador['pessoal']['id']})
  			AND (status = 2)
  			AND (chat_duration > 0)
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['data1']}' AND '{$datas['data2']}'))), 0) AS tma";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['atendimento']['tma'] = $valor[0];

  return $colaborador;
}

/**
 * retorna os dados dos atendimentos do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function retornaDadosDosAtendimentosDoColaborador($conexao, $colaborador, $datas)
{
  # chamando funções que calculam e retornam as demandas
  $colaborador = calculaAtendimentosDemandados($conexao, $colaborador, $datas);
  $colaborador = calculaAtendimentosRealizados($conexao, $colaborador, $datas);
  $colaborador = calculaAtendimentosPerdidos($conexao, $colaborador, $datas);

  # chamando funções que calculam e retornam os percentuais
  $colaborador = calculaPercentualDePerda($conexao, $colaborador, $datas);
  $colaborador = calculaPercentualDeFilaAte15Minutos($conexao, $colaborador, $datas);

  # chamando função que calcula e retorna o tma
  $colaborador = calculaTMA($conexao, $colaborador, $datas);

  return $colaborador;
}
