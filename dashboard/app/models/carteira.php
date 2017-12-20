<?php

/*
 * define um array modelo da carteira de avancoins
 */
function defineArrayModeloDeCarteiraAvancoins()
{
  $carteira = array(
    'id_colaborador' => 0,
    'moedas' => 0,
    'periodo' => array(
      'data_inicial' => '',
      'data_final' => ''
    )
  );

  return $carteira;

}
