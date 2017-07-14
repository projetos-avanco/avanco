<?php

require ABS_PATH . 'app/models/departamentos.php';
require ABS_PATH . 'app/models/atendimento.php';

/**
 * gera o relatório geral do atendimento
 * @param - conexão aberta
 * @param - array com a data inicial e data final
 */
function geraRelatorioGeralDoAtendimento($conexao, $datas)
{
  $departamentos = defineArrayDeDepartamentos();

  $resultados = defineArrayDeResultadosDoAtendimento();

  $resultados['aug_int_parc']['geral']['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamentos['aug_int_parc']);
  $resultados['aug_int_parc']['geral']['atendidos'] = retornaAtendidos($conexao, $datas, $departamentos['aug_int_parc']);
  #$resultados['aug_int_parc']['geral']['perdidos'] = retornaPerdidos($conexao, $datas, $departamentos['aug_int_parc']);
  #$resultados['aug_int_parc']['geral']['taxa_de_perda'] = retornaTaxaDePerda($conexao, $datas, $departamentos['aug_int_parc']);

  exit(var_dump($resultados['aug_int_parc']));
}

/**
 * retorna a quantidade de demanda total de chamados de um departamento durante um período ou uma data especifíca
 * @param - conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 */
function retornaDemandaTotal($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	COUNT(id) AS demanda_total
  FROM lh_chat
  WHERE (status = 1 OR status = 2)
  	AND ({$departamento})
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')";

  $resultado = mysqli_query($conexao, $sql);

  $resultado = mysqli_fetch_row($resultado);

  return $resultado[0];
}

/**
 * retorna a quantidade de chamados atendidos de um departamento durante um período ou uma data especifíca
 * @param - conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 */
function retornaAtendidos($conexao, $datas, $departamento)
{
  $sql =
  "SELECT
  	COUNT(id) AS atendidos
  FROM lh_chat
  WHERE (status = 1 OR status = 2)
  	AND ({$departamento})
  	AND (chat_duration > 0)
  	AND (FROM_UNIXTIME(time, '%Y-%m-%d') BETWEEN '{$datas['inicial']}' AND '{$datas['final']}')";

    $resultado = mysqli_query($conexao, $sql);

    $resultado = mysqli_fetch_row($resultado);

    return $resultado[0];
}

/**
 * retorna a quantidade de chamados perdidos de um departamento durante um período ou uma data especifíca
 * @param - conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 */
function retornaPerdidos()
{

}

/**
 * retorna a taxa de perda de chamados de um departamento durante um período ou uma data especifíca
 * @param - conexão aberta
 * @param - array com a data inicial e a data final
 * @param - array com o departamento especifíco
 */
function calculaTaxaDePerda()
{

}
