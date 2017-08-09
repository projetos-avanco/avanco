<?php

/*
 * define um array modelo de dashboard
 */
function defineArrayModeloDeDashboard()
{
  $dashboard = array(
    'pessoal' => array(
      'nome'         => '',
      'sobrenome'    => '',
      'caminho_foto' => ''
    ),

    'indicadores_chat' => array(
      'atendimentos_demandados'            => '',
      'atendimentos_realizados'            => '',
      'percentual_perda'                   => '',
      'percentual_fila_ate_15_minutos'     => '',
      'tma'                                => '',
      'percentual_avancino'                => '',
      'percentual_eficiencia'              => '',
      'percentual_questionario_respondido' => '',
    ),

    'titulos_conquistados' => array(
      'nome'           => array(),
      'data_premiacao' => array()
    ),

    'informacoes_gerais' => array(
      'infovarejo' => array(
        'quantidade_mes_artigos_infovarejo'   => '',
        'quantidade_total_artigos_infovarejo' => ''
      ),
      'base_conhecimento' => array(
        'quantidade_mes_documentos_bc'   => '',
        'quantidade_total_documentos_bc' => ''
      ),
      'sla' => array(
        'percentual_mes_sla'   => '',
        'percentual_total_sla' => ''
      )
    ),
  );

  return $dashboard;
}
