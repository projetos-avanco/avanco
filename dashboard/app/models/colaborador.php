<?php

/*
 * define um array com modelo de colaborador
 */
function defineArrayComModeloDeColaborador()
{
  $colaborador = array(
    'pessoal' => array(
      'id' => 0,
      'nome' => '',
      'sobrenome' => '',
      'caminho_foto' => '',
      'usuario' => ''
    ),

    'atendimento' => array(
      'atendimentos_demandados' => 0,
      'atendimentos_realizados' => 0,
      'atendimentos_perdidos' => 0,
      'percentual_perda' => '',
      'percentual_fila_ate_15_minutos' => '',
      'tma' => ''
    ),

    'indices' => array(
      'percentual_avancino' => '',
      'percentual_eficiencia' => '',
      'percentual_questionario_respondido' => ''
    ),

    'outros' => array(
      'quantidade_mes_artigos_infovarejo' => 0,
      'quantidade_total_artigos_infovarejo' => 0,
      'quantidade_mes_documentos_bc' => 0,
      'quantidade_total_documentos_bc' => 0,
      'percentual_mes_sla' => '0',
      'percentual_total_sla' => '0'
    )
  );

  return $colaborador;
}
