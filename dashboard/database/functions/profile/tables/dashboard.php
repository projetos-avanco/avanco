<?php

/**
 * retorna os dados (nome, sobrenome e caminho da foto) do colaborador que serão exibidos no dashboard
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaDadosDoColaborador($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	nome,
      sobrenome,
      caminho_foto
    FROM av_dashboard_colaborador
    WHERE id = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $modelo['pessoal']['nome']                 = $registro['nome'];
    $modelo['pessoal']['sobrenome']            = $registro['sobrenome'];
    $modelo['pessoal']['caminho_foto_jogador'] = strtolower(removeAcentosReformulada($registro['caminho_foto']));

  }

  return $modelo;
}

/**
 * retorna o nome do atual do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaNomeDoTimeAtual($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	av_dashboard_times.nome
    FROM av_dashboard_times
    INNER JOIN av_dashboard_colaborador_times
    	ON av_dashboard_colaborador_times.id_times = av_dashboard_times.id
    WHERE (id_colaborador = $id)
    	AND (data_saida IS NULL)";

  $resultado = mysqli_query($objeto, $query);

  $time = mysqli_fetch_row($resultado);

  $modelo['pessoal']['time'] = $time[0];

  # retirando espaços do nome do time
  $modelo['pessoal']['time'] = str_replace(" ", "", $modelo['pessoal']['time']);

  return $modelo;
}

/**
 * retorna o caminho da foto da bandeira do time do colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaCaminhoDaFotoDaBandeiraDoTime($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	av_dashboard_times.nome
    FROM av_dashboard_times
    INNER JOIN av_dashboard_colaborador_times
    	ON av_dashboard_colaborador_times.id_times = av_dashboard_times.id
    WHERE (id_colaborador = $id)
    	AND (data_saida IS NULL)";

  $resultado = mysqli_query($objeto, $query);

  $bandeira = mysqli_fetch_row($resultado);

  $modelo['pessoal']['caminho_foto_bandeira'] = BASE_URL . 'public/img/flags/' . strtolower(removeAcentosReformulada($bandeira[0])) . '.png';

  return $modelo;
}

/**
 * retorna o período pesquisado pelo colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaPeriodo($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	data_1,
      data_2
    FROM av_dashboard_colaborador
    WHERE id = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registros = mysqli_fetch_assoc($resultado)) {

    $modelo['periodo']['data_1'] = $registros['data_1'];
    $modelo['periodo']['data_2'] = $registros['data_2'];

  }

  # chamando função que formata as datas (pesquisadas pelo colaborador) do período para dd/mm/aaaa
  $modelo['periodo']['data_1'] = formataDataParaExibir($modelo['periodo']['data_1']);
  $modelo['periodo']['data_2'] = formataDataParaExibir($modelo['periodo']['data_2']);

  return $modelo;
}

/**
 * retorna os indicadores de chat do colaborador que serão exibidos no dashboard
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaIndicadoresDoChat($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	atendimentos_demandados,
      atendimentos_realizados,
      percentual_perda,
      percentual_fila_ate_15_minutos,
      tma,
      percentual_avancino,
      percentual_eficiencia,
      percentual_questionario_respondido
    FROM av_dashboard_colaborador
    WHERE id = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $modelo['indicadores_chat']['atendimentos_demandados']            = $registro['atendimentos_demandados'];
    $modelo['indicadores_chat']['atendimentos_realizados']            = $registro['atendimentos_realizados'];
    $modelo['indicadores_chat']['percentual_perda']                   = $registro['percentual_perda'];
    $modelo['indicadores_chat']['percentual_fila_ate_15_minutos']     = $registro['percentual_fila_ate_15_minutos'];
    $modelo['indicadores_chat']['tma']                                = $registro['tma'];
    $modelo['indicadores_chat']['percentual_avancino']                = $registro['percentual_avancino'];
    $modelo['indicadores_chat']['percentual_eficiencia']              = $registro['percentual_eficiencia'];
    $modelo['indicadores_chat']['percentual_questionario_respondido'] = $registro['percentual_questionario_respondido'];

  }

  return $modelo;
}

/**
 * retorna os títulos conquistados pelo colaborador que serão exibidos no dashboard
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaTitulosConquistados($objeto, $modelo, $id)
{
  $query =
    "SELECT
      titulos.id,
      historico_titulos.data_premiacao
    FROM av_dashboard_titulos AS titulos
    INNER JOIN av_dashboard_colaborador_titulos AS historico_titulos
    	ON historico_titulos.id_titulos = titulos.id
    WHERE historico_titulos.id_colaborador = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registros = mysqli_fetch_assoc($resultado)) {

    $modelo['titulos_conquistados']['id'][]             = $registros['id'];    
    $modelo['titulos_conquistados']['data_premiacao'][] = $registros['data_premiacao'];

  }

  # chamando função que formata todas as datas dos títulos conquistados para dd/mm/aaaa
  $modelo['titulos_conquistados']['data_premiacao'] = formataArrayComDatasParaExibir($modelo['titulos_conquistados']['data_premiacao']);

  return $modelo;
}

/**
 * retorna a quantidade de artigos inseridos no infovarejo (mês vigente e total acumulado) do colaborador que serão exibidos no dashboard
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaDadosDoInfovarejo($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	quantidade_mes_artigos_infovarejo,
      quantidade_total_artigos_infovarejo
    FROM av_dashboard_colaborador
    WHERE id = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registros = mysqli_fetch_assoc($resultado)) {

    $modelo['informacoes_gerais']['infovarejo']['quantidade_mes_artigos_infovarejo']   = $registros['quantidade_mes_artigos_infovarejo'];
    $modelo['informacoes_gerais']['infovarejo']['quantidade_total_artigos_infovarejo'] = $registros['quantidade_total_artigos_infovarejo'];

  }

  return $modelo;
}

/**
 * retorna a quantidade de documentos inseridos na base de conhecimento (mês vigente e total acumulado) do colaborador que serão exibidos no dashboard
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaDadosDaBaseDeConhecimento($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	quantidade_mes_documentos_bc,
      quantidade_total_documentos_bc
    FROM av_dashboard_colaborador
    WHERE id = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registros = mysqli_fetch_assoc($resultado)) {

    $modelo['informacoes_gerais']['base_conhecimento']['quantidade_mes_documentos_bc']   = $registros['quantidade_mes_documentos_bc'];
    $modelo['informacoes_gerais']['base_conhecimento']['quantidade_total_documentos_bc'] = $registros['quantidade_total_documentos_bc'];

  }

  return $modelo;
}

/**
 * retorna os percentuais de SLA (mês vigente e total acumulado) do colaborador que serão exibidos no dashboard
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaDadosDeSLA($objeto, $modelo, $id)
{
  $query =
    "SELECT
    	percentual_mes_sla,
      percentual_total_sla
    FROM av_dashboard_colaborador
    WHERE id = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registros = mysqli_fetch_assoc($resultado)) {

    $modelo['informacoes_gerais']['sla']['percentual_mes_sla']   = $registros['percentual_mes_sla'];
    $modelo['informacoes_gerais']['sla']['percentual_total_sla'] = $registros['percentual_total_sla'];

  }

  return $modelo;
}

/**
 * retorna os dados que serão exibidos no dashboard
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function retornaDadosParaDashboard($objeto, $modelo, $id)
{
  # chamando função que retorna os dados do colaborador
  $modelo = retornaDadosDoColaborador($objeto, $modelo, $id);

  # chamando função que retorna o nome do time atual do colaborador
  $modelo = retornaNomeDoTimeAtual($objeto, $modelo, $id);

  # chamando função que retorna o caminho da foto da bandeira do time do colaborador
  $modelo = retornaCaminhoDaFotoDaBandeiraDoTime($objeto, $modelo, $id);

  # chamando função que retorna o período pesquisado pelo colaborador
  $modelo = retornaPeriodo($objeto, $modelo, $id);

  # chamando função que retorna os indicadores de chat do colaborador
  $modelo = retornaIndicadoresDoChat($objeto, $modelo, $id);

  # chamando função que retorna os títulos conquistados pelo colaborador
  $modelo = retornaTitulosConquistados($objeto, $modelo, $id);

  # chamando função que retorna a quantidade de artigos inseridos no infovarejo pelo colaborador
  $modelo = retornaDadosDoInfovarejo($objeto, $modelo, $id);

  # chamando função que retorna a quantidade de documentos inseridos na base de conhecimento pelo colaborador
  $modelo = retornaDadosDaBaseDeConhecimento($objeto, $modelo, $id);

  # chamando função que retorna os percentuais de SLA do colaborador
  $modelo = retornaDadosDeSLA($objeto, $modelo, $id);

  return $modelo;
}
