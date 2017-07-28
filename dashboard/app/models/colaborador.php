<?php

/*
 * define um array com o modelo de colaborador
 */
function defineArrayComModeloDeColaborador()
{
  $colaborador = array(
    'informacoes_pessoais' => array(
      'id' => 0,
      'nome' => '',
      'sobrenome' => ''
    ),

    'informacoes_atendimento' => array(
      'atendimentos_demandados' => 0,
      'atendimentos_realizados' => 0,
      'atendimentos_perdidos' => 0,
      'percentual_perda' => '',
      'percentual_atendimento_15_minutos' => '',
      'tma' => ''
    ),

    'indicadores' => array(
      'percentual_avancino' => '',
      'percentual_eficiencia' => '',
      'percentual_questionario_respondido' => ''
    ),

    'outros' => array(
      'quantidade_artigos_infovarejo' => 0,
      'quantidade_documentos_bc' => 0,
      'percentual_sla' => ''
    )
  );

  return $colaborador;
}
