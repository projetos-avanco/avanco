<?php

/*
 * define um array modelo da carteira de avancoins
 */
function defineArrayModeloDeCarteiraAvancoins()
{
  $carteira = array(
    'id_colaborador' => 0,
    'moedas' => 0,
    'periodo_atual' => array(
      'data_inicial' => '',
      'data_final' => ''
    ),
    'periodo_anterior' => array(
      'data_inicial' => '',
      'data_final' => ''
    ),
    'mes_atual' => date('n'),
    'data_atual' => date('Y-m-d'),
    'horario_atual' => ''
  );

  return $carteira;

}
