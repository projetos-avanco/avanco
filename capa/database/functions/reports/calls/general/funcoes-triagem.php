<?php

/**
 * calcula o percentual de chamados com tempo de espera até 15 minutos de um departamento durante um período ou uma data especifíca
 * @param - conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 */
function calculaPercentualAte15Minutos($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	ROUND(100 * (
      (SELECT
  			COUNT(id)
  		FROM lh_chat
  		WHERE (wait_time <= 900)
  			AND ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))

  		/

  		(SELECT
  			COUNT(id)
  		FROM lh_chat
  		WHERE ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))), 1) AS percentual_ate_15_minutos";

  $resultado = mysqli_query($conexao, $sql);

  $resultado = mysqli_fetch_row($resultado);

  return $resultado[0];
}

/**
 * calcula o percentual de chamados com tempo de espera entre 15 e 30 minutos de um departamento durante um período ou uma data especifíca
 * @param - conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 */
function calculaPercentualEntre15E30Minutos($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(id)
  		FROM lh_chat
  		WHERE (wait_time BETWEEN 901 AND 1800)
  			AND ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))

  		/

  		(SELECT
  			COUNT(id)
  		FROM lh_chat
  		WHERE ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))), 1) AS percentual_entre_15_e_30_minutos";

  $resultado = mysqli_query($conexao, $sql);

  $resultado = mysqli_fetch_row($resultado);

  return $resultado[0];
}

/**
 * calcula o percentual de chamados com tempo de espera acima 30 minutos de um departamento durante um período ou uma data especifíca
 * @param - conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 */
function calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	ROUND(100 * (
  		(SELECT
  			COUNT(id)
  		FROM lh_chat
  		WHERE (wait_time > 1800)
  			AND ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))

  		/

  		(SELECT
  			COUNT(id)
  		FROM lh_chat
  		WHERE ({$departamento})
  			AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}'))), 1) AS percentual_acima_de_30_minutos";

  $resultado = mysqli_query($conexao, $sql);

  $resultado = mysqli_fetch_row($resultado);

  return $resultado[0];
}
