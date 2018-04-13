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
  
  # recebendo o período que será pesquisado
  $ranking['periodo']['data_1'] = $datas['data1'];
  $ranking['periodo']['data_2'] = $datas['data2'];

  # chamando função que retorna os dados pessoais dos colaboradores
  $dados = consultaDadosPessoaisDosColaboradores($db);

  # consultando os dados de cada colaborador e montando o relatório
  for ($i = 0; $i < count($dados); $i++) {

    $ranking['pessoal']['id']        = $dados[$i]['id'];
    $ranking['pessoal']['nome']      = $dados[$i]['nome'];
    $ranking['pessoal']['sobrenome'] = $dados[$i]['sobrenome'];
    $ranking['pessoal']['moedas']    = $dados[$i]['moedas'];

    # chamando funções que consultam e retornam os dados de atendimentos, índices e outros do colaborador
    $ranking = consultaDadosDosAtendimentosDoColaborador($db, $ranking);
    $ranking = consultaDadosDosIndicesDoColaborador($db, $ranking);

    $relatorio[$i] = array(

      'id'                      => $ranking['pessoal']['id'],
      'nome'                    => $ranking['pessoal']['nome'],
      'sobrenome'               => $ranking['pessoal']['sobrenome'],
      'moedas'                  => $ranking['pessoal']['moedas'],
      'atendimentos_demandados' => $ranking['atendimento']['atendimentos_demandados'],
      'atendimentos_realizados' => $ranking['atendimento']['atendimentos_realizados'],
      'atendimentos_perdidos'   => $ranking['atendimento']['atendimentos_perdidos'],
      'percentual_perda'        => $ranking['atendimento']['percentual_perda'],
      'percentual_fila'         => $ranking['atendimento']['percentual_fila_ate_15_minutos'],
      'tma'                     => $ranking['atendimento']['tma'],
      'percentual_avancino'     => $ranking['indices']['percentual_avancino'],
      'percentual_eficiencia'   => $ranking['indices']['percentual_eficiencia'],
      'percentual_questionario' => $ranking['indices']['percentual_questionario_respondido'],

    );

  }

  # gravando relatorio na sessão
  $_SESSION['relatorio']['ranking'] = $relatorio;
  $_SESSION['relatorio']['datas']   = $datas;

  fecha_conexao($db);
  
}