<?php

/**
 * responsável por gerar o relatório de ranking dos colaboradores
 * @param - array com o período desejado
 */
function geraRelatorioDeRankingDosColaboradores($datas)
{
  require DIRETORIO_MODELS    . 'reports/ranking/modelo_ranking.php';
  require DIRETORIO_FUNCTIONS . 'reports/ranking/atendimento.php';
  require DIRETORIO_FUNCTIONS . 'reports/ranking/indices.php';
  require DIRETORIO_FUNCTIONS . 'reports/ranking/pessoal.php';

  $ranking = criaModeloDoRelatorioDeRanking();

  $db = abre_conexao();

  # chamando função que retorna os dados pessoais dos colaboradores
  $ranking = consultaDadosPessoaisDosColaboradores($db, $ranking);

  # inicializando variáveis dos totais de atendimento
  $totalDemandados       = 0;
  $totalRealizados       = 0;
  $totalPerdidos         = 0;
  $totalPercPerda        = 0;
  $totalPercFila         = 0;
  $totalTma              = 0;
  
  # inicializando variáveis dos totais dos índices 
  $totalPercAvancino     = 0;
  $totalPercEficiencia   = 0;
  $totalPercQuestionario = 0;
  $totalAvancoins        = 0;
  $totalQuestAvancino    = 0;
  $totalQuestEficiencia  = 0;
  $totalQuestExterno     = 0;
  $totalQuestInterno     = 0;

  # recuperando o total de colaboradores do atendimento, menos a última posição do array que são os totais
  $contador = count($ranking) -1;

  # consultando os resultados de todos os colaboradores recuperados
  for ($i = 0; $i < $contador; $i++) {
    
    # chamando funções que consultam e retornam os dados de atendimentos, índices e outros do colaborador
    $ranking = consultaDadosDosAtendimentosDoColaborador($db, $i, $ranking, $datas);
    $ranking = consultaDadosDosIndicesDoColaborador($db, $i, $ranking, $datas);

    # calculando os totais de atendimento
    $totalDemandados      += $ranking[$i]['atendimentos_demandados'];
    $totalRealizados      += $ranking[$i]['atendimentos_realizados'];
    $totalPerdidos        += $ranking[$i]['atendimentos_perdidos'];
    $totalPercFila        += $ranking[$i]['atendimentos_realizados_ate_15_minutos'];
    $totalTma             += $ranking[$i]['tempo_de_conversa'];

    # calculando os totais do índices 
    $totalQuestAvancino   += $ranking[$i]['quantidade_questionarios_avancino'];
    $totalQuestEficiencia += $ranking[$i]['quantidade_questionarios_eficiencia'];
    $totalQuestExterno    += $ranking[$i]['quantidade_questionarios_externos'];
    $totalQuestInterno    += $ranking[$i]['quantidade_questionarios_internos'];

    # calculando o total de avancoins
    $totalAvancoins  += $ranking[$i]['moedas'];

    # eliminando posições que não serão usadas no relatório
    unset(
      $ranking[$i]['atendimentos_realizados_ate_15_minutos'],
      $ranking[$i]['tempo_de_conversa'],
      $ranking[$i]['quantidade_questionarios_avancino'],
      $ranking[$i]['quantidade_questionarios_eficiencia'],
      $ranking[$i]['quantidade_questionarios_externos'],
      $ranking[$i]['quantidade_questionarios_internos']
    );

    # verificando se o for está no último colaborador
    if ($i == $contador -1) {

      # repassando os totais de atendimento para o array modelo
      $ranking[$contador]['total_demandados'] = $totalDemandados;
      $ranking[$contador]['total_realizados'] = $totalRealizados;
      $ranking[$contador]['total_perdidos']   = $totalPerdidos;
      $ranking[$contador]['total_perc_perda'] = round(($totalPerdidos / $totalDemandados) * 100, 0);
      $ranking[$contador]['total_perc_fila']  = round(($totalPercFila / $totalRealizados) * 100, 0);
      $ranking[$contador]['total_tma']        = round($totalTma / $totalRealizados, 0);

      # repassando os totais de índices para o array modelo
      $ranking[$contador]['total_perc_avancino'] = round(($totalQuestAvancino / $totalQuestExterno) * 100, 0);
      $ranking[$contador]['total_perc_eficiencia'] = round(($totalQuestEficiencia / $totalQuestExterno) * 100, 0);
      $ranking[$contador]['total_perc_questionario_interno'] = round(($totalQuestInterno / $totalDemandados) * 100, 0);

      # repassando o total de avancoins para o array modelo
      $ranking[$contador]['total_avancoins'] = $totalAvancoins;

      # verificando se houve algum resultado NAN (divisão por 0) e zerando o resultado
      if (is_nan($ranking[$contador]['total_perc_perda']))        
        $ranking[$contador]['total_perc_perda'] = 0;

      # verificando se houve algum resultado NAN (divisão por 0) e zerando o resultado
      if (is_nan($ranking[$contador]['total_perc_fila']))
        $ranking[$contador]['total_perc_fila'] = 0;

      # verificando se houve algum resultado NAN (divisão por 0) e zerando o resultado
      if (is_nan($ranking[$contador]['total_tma']))
        $ranking[$contador]['total_tma'] = 0;

      # verificando se houve algum resultado NAN (divisão por 0) e zerando o resultado
      if (is_nan($ranking[$contador]['total_perc_avancino']))
        $ranking[$contador]['total_perc_avancino'] = 0;

      # verificando se houve algum resultado NAN (divisão por 0) e zerando o resultado
      if (is_nan($ranking[$contador]['total_perc_eficiencia']))
        $ranking[$contador]['total_perc_eficiencia'] = 0;

      # verificando se houve algum resultado NAN (divisão por 0) e zerando o resultado
      if (is_nan($ranking[$contador]['total_perc_questionario_interno']))
        $ranking[$contador]['total_perc_questionario_interno'] = 0;

    }

  }

  # gravando relatorio na sessão
  $_SESSION['relatorio']['ranking'] = $ranking;
  $_SESSION['relatorio']['datas']   = $datas;

  fecha_conexao($db);

}