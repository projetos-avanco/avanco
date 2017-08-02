<?php

/**
 * verifica a quantidade de artigos postados no infovarejo pelo colaborador do mês vigente
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeArtigosPostadosNoInfoVarejoNoMesVigente($conexao, $colaborador)
{
  # recuperando ano e mês vigente
  $data = date('Y-m');

  $query =
  "SELECT
  	COUNT(id) AS artigos_postados_mes_vigente
  FROM av_info_varejo_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})
  	AND (data BETWEEN '$data-01' AND '$data-31')";

  $resultado = mysqli_query($conexao, $query);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['outros']['infovarejo']['quantidade_mes_vigente'] = (int)$valor[0];

  return $colaborador;
}

/**
 * verifica o total acumulado de artigos postados no infovarejo pelo colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeArtigosPostadosNoInfoVarejoAcumulado($conexao, $colaborador)
{
  $query =
  "SELECT
  	COUNT(id) AS total_acumulado
  FROM av_info_varejo_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})";

  $resultado = mysqli_query($conexao, $query);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['outros']['infovarejo']['total_acumulado'] = (int)$valor[0];

  return $colaborador;
}

/**
 * verifica a quantidade e o nome dos documentos postados na base de conhecimento pelo colaborador do mês vigente
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoNoMesVigente($conexao, $colaborador)
{
  # recuperando ano e mês vigente
  $data = date('Y-m');

  $query =
  "SELECT
  	COUNT(id) AS documentos_postados_mes_vigente
  FROM av_base_de_conhecimento_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})
  	AND (data_conteudo_postado BETWEEN '$data-01' AND '$data-31')";

  $resultado = mysqli_query($conexao, $query);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['outros']['base_conhecimento']['quantidade_mes_vigente'] = (int)$valor[0];

  return $colaborador;
}

/**
 * verifica o total acumulado de documentos postados na base de conhecimento pelo colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoAcumulado($conexao, $colaborador)
{
  $query =
  "SELECT
  	COUNT(id) AS total_acumulado
  FROM av_base_de_conhecimento_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})";

  $resultado = mysqli_query($conexao, $query);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['outros']['base_conhecimento']['total_acumulado'] = (int)$valor[0];

  return $colaborador;
}

/**
 * retorna os dados de outros (artigos do infovarejo e base de conhecimento) postados pelo colaboradorem no mês vigente e o total acumulado
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function retornaDadosDeOutrosDoColaborador($conexao, $colaborador)
{
  # chamando funções que verificam e retornam a quantidade (do mês vigente e o acumulado) de artigos postados no infovarejo
  $colaborador = verificaQuantidadeDeArtigosPostadosNoInfoVarejoNoMesVigente($conexao, $colaborador);
  $colaborador = verificaQuantidadeDeArtigosPostadosNoInfoVarejoAcumulado($conexao, $colaborador);

  # chamando funções que verificam e retornam a quantidade (do mês vigente e o acumulado) de documentos postados na base de conhecimento
  $colaborador = verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoNoMesVigente($conexao, $colaborador);
  $colaborador = verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoAcumulado($conexao, $colaborador);

  return $colaborador;
}
