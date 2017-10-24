<?php

/**
 * verifica a quantidade de artigos postados no infovarejo pelo colaborador do mês vigente
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeArtigosPostadosNoInfoVarejoNoMesVigente($objeto, $modelo)
{
  # recuperando ano e mês vigente
  $data = date('Y-m');

  $query =
  "SELECT
  	COUNT(id) AS artigos_postados_mes_vigente
  FROM av_info_varejo_avancao
  WHERE (codigo_jogador = {$modelo['pessoal']['id']})
  	AND (data BETWEEN '$data-01' AND '$data-31')";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['outros']['quantidade_mes_artigos_infovarejo'] = (int)$valor[0];

  return $modelo;
}

/**
 * verifica o total acumulado de artigos postados no infovarejo pelo colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeArtigosPostadosNoInfoVarejoAcumulado($objeto, $modelo)
{
  $query =
  "SELECT
  	COUNT(id) AS total_acumulado
  FROM av_info_varejo_avancao
  WHERE (codigo_jogador = {$modelo['pessoal']['id']})";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['outros']['quantidade_total_artigos_infovarejo'] = (int)$valor[0];

  return $modelo;
}

/**
 * verifica a quantidade e o nome dos documentos postados na base de conhecimento pelo colaborador do mês vigente
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoNoMesVigente($objeto, $modelo)
{
  # recuperando ano e mês vigente
  $data = date('Y-m');

  $query =
  "SELECT
  	COUNT(id) AS documentos_postados_mes_vigente
  FROM av_base_de_conhecimento_avancao
  WHERE (codigo_jogador = {$modelo['pessoal']['id']})
  	AND (data_conteudo_postado BETWEEN '$data-01' AND '$data-31')";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['outros']['quantidade_mes_documentos_bc'] = (int)$valor[0];

  return $modelo;
}

/**
 * verifica o total acumulado de documentos postados na base de conhecimento pelo colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoAcumulado($objeto, $modelo)
{
  $query =
  "SELECT
  	COUNT(id) AS total_acumulado
  FROM av_base_de_conhecimento_avancao
  WHERE (codigo_jogador = {$modelo['pessoal']['id']})";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $modelo['outros']['quantidade_total_documentos_bc'] = (int)$valor[0];

  return $modelo;
}

/**
 * consulta e retorna os dados de outros (artigos do infovarejo e base de conhecimento) postados pelo colaboradorem no mês vigente e o total acumulado
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function consultaDadosDeOutrosDoColaborador($objeto, $modelo)
{
  # chamando funções que verificam e retornam a quantidade (do mês vigente e o acumulado) de artigos postados no infovarejo
  $modelo = verificaQuantidadeDeArtigosPostadosNoInfoVarejoNoMesVigente($objeto, $modelo);
  $modelo = verificaQuantidadeDeArtigosPostadosNoInfoVarejoAcumulado($objeto, $modelo);

  # chamando funções que verificam e retornam a quantidade (do mês vigente e o acumulado) de documentos postados na base de conhecimento
  $modelo = verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoNoMesVigente($objeto, $modelo);
  $modelo = verificaQuantidadeDeDocumentosPostadosNaBaseConhecimentoAcumulado($objeto, $modelo);

  return $modelo;
}
