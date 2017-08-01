<?php

/**
 * verifica a quantidade e o nome dos artigos postados no infovarejo pelo colaborador do mês vigente
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeArtigosInfoVarejoMesVigente($conexao, $colaborador)
{
  #$data = date('Y-m');
  $data = '2016-11';
  $sql =
  "SELECT
    data_conteudo_postado AS data,
  	conteudo_postado_info_varejo AS artigo
  FROM av_info_varejo_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})
  	AND (data BETWEEN '$data-01' AND '$data-31')
      ORDER BY data DESC";

  $resultado = mysqli_query($conexao, $sql);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $colaborador['outros']['infovarejo']['artigos']['data'][] = $registro['data'];
    $colaborador['outros']['infovarejo']['artigos']['nome'][] = $registro['artigo'];

  }

  $colaborador['outros']['infovarejo']['quantidade_mes_vigente'] = (int)$resultado->num_rows;

  return $colaborador;
}

/**
 * verifica o total acumulado de artigos postados no infovarejo pelo colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeArtigosInfoVarejoAcumulado($conexao, $colaborador)
{
  $sql =
  "SELECT
  	COUNT(id) AS total_acumulado
  FROM av_info_varejo_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['outros']['infovarejo']['total_acumulado'] = (int)$valor[0];

  return $colaborador;
}

/**
 * verifica a quantidade e o nome dos documentos postados na base de conhecimento pelo colaborador do mês vigente
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeDocumentosBaseConhecimentoMesVigente($conexao, $colaborador)
{
  $data = date('Y-m');

  $sql =
  "SELECT
  	data_conteudo_postado AS data,
  	conteudo_postado_base_de_conhecimento AS documento
  FROM av_base_de_conhecimento_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})
  	AND (data_conteudo_postado BETWEEN '$data-01' AND '$data-31')
      ORDER BY data DESC";

  $resultado = mysqli_query($conexao, $sql);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $colaborador['outros']['base_conhecimento']['documentos']['data'][] = $registro['data'];
    $colaborador['outros']['base_conhecimento']['documentos']['nome'][] = $registro['documento'];

  }

  $colaborador['outros']['base_conhecimento']['quantidade_mes_vigente'] = (int)$resultado->num_rows;

  return $colaborador;
}

/**
 * verifica o total acumulado de documentos postados na base de conhecimento pelo colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function verificaQuantidadeDeDocumentosBaseConhecimentoAcumulado($conexao, $colaborador)
{
  $sql =
  "SELECT
  	COUNT(id) AS total_acumulado
  FROM av_base_de_conhecimento_avancao
  WHERE (codigo_jogador = {$colaborador['pessoal']['id']})";

  $resultado = mysqli_query($conexao, $sql);

  $valor = mysqli_fetch_row($resultado);

  $colaborador['outros']['base_conhecimento']['total_acumulado'] = (int)$valor[0];

  return $colaborador;
}

/**
 * retorna a quantidade de (artigos do infovarejo e base de conhecimento) postados pelo colaboradorem no mês vigente e o total acumulado
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 * @param - array com a data inicial e data final de um período ou específica
 */
function retornaDadosDeOutrosDoColaborador($conexao, $colaborador, $datas)
{
  # infovarejo
  $colaborador = verificaQuantidadeDeArtigosInfoVarejoMesVigente($conexao, $colaborador);
  $colaborador = verificaQuantidadeDeArtigosInfoVarejoAcumulado($conexao, $colaborador);

  # base de conhecimento
  $colaborador = verificaQuantidadeDeDocumentosBaseConhecimentoMesVigente($conexao, $colaborador);
  $colaborador = verificaQuantidadeDeDocumentosBaseConhecimentoAcumulado($conexao, $colaborador);

  # enviando os nomes de artigos, documentos e datas de postagem para a sessão
  session_start();
  $_SESSION['infovarejo']['artigos']           = $colaborador['outros']['infovarejo']['artigos'];
  $_SESSION['base_conhecimento']['documentos'] = $colaborador['outros']['base_conhecimento']['documentos'];

  return $colaborador;
}
