<?php

/*
 * define um array com o modelo de colaborador
 */
function defineArrayComModeloDeColaborador()
{
  $colaborador = array(
    'pessoal' => array(
      'id' => 0,
      'nome' => '',
      'sobrenome' => '',
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
      'infovarejo' => array(
        'quantidade_mes_vigente' => 0,
        'total_acumulado' => 0
      ),
      'base_conhecimento' => array(
        'quantidade_mes_vigente' => 0,
        'total_acumulado' => 0
      ),
      'percentual_sla' => array(
        'mes_vigente' => '0',
        'total_acumulado' => '0'
      )
    )
  );

  return $colaborador;
}
