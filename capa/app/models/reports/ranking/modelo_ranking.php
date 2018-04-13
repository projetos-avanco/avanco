<?php

/*
 * cria um array modelo para receber os dados do relatório de ranking dos colaboradores
 */
function criaModeloDoRelatorioDeRanking()
{
  $ranking = array(

    'pessoal' => array(
      'id' => '',
      'nome' => '',
      'sobrenome' => '',
      'moedas' => ''
    ),

    'atendimento' => array(
      'atendimentos_demandados' => '',
      'atendimentos_realizados' => '',
      'atendimentos_perdidos' => '',
      'percentual_perda' => '',
      'percentual_fila_ate_15_minutos' => '',
      'tma' => ''
    ),

    'indices' => array(
      'percentual_avancino' => '',
      'percentual_eficiencia' => '',
      'percentual_questionario_respondido' => ''
    ),

    'periodo' => array(
      'data_1' => '',
      'data_2' => ''
    )

  );

  return $ranking;

}