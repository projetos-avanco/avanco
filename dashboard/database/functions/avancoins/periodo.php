<?php

/**
 * verifica e retorna o período do mês atual
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function verificaPeriodoAtivo($db, $carteira)
{
  $carteira['mes_atual'] = '10';# RETIRAR

  # consulta que retorna o id do período ativo na tabela períodos
  $query = "SELECT id FROM av_avancoins_periodos WHERE (ativo = 1);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando mês ativo na tabela de períodos
    $ativo = $resultado->fetch_row();
    $ativo = $ativo[0];

    # verificando se o mês atual é igual ao mês ativo na tabela de períodos
    if ($carteira['mes_atual'] == $ativo) {

      # consulta que retorna a data inicial e a data final do período ativo na tabela de períodos
      $query = "SELECT data_inicial, data_final FROM av_avancoins_periodos WHERE (ativo = 1);";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        # recuperando data inicial e data final do mês ativo na tabela de períodos
        while ($registro = $resultado->fetch_assoc()) {

          $carteira['periodo_atual']['data_inicial'] = $registro['data_inicial'];
          $carteira['periodo_atual']['data_final']    = $registro['data_final'];

        }

      }

    } else {

      # consulta que desativa o mês passado
      $query = "UPDATE av_avancoins_periodos SET ativo = 0 WHERE (ativo = 1);";

      # verificando se a consulta pode ser executada
      if ($db->query($query)) {

        # consulta que ativa o mês atual
        $query = "UPDATE av_avancoins_periodos SET ativo = 1 WHERE (id = {$carteira['mes_atual']});";

      }

      # verificando se a consulta pode ser executada
      if ($db->query($query)) {

        # consulta que retorna a data inicial e a data final do período ativo na tabela de períodos
        $query = "SELECT data_inicial, data_final FROM av_avancoins_periodos WHERE (ativo = 1);";

        # verificando se a consulta pode ser executada
        if ($resultado = $db->query($query)) {

          # recuperando data inicial e data final do mês ativo na tabela de períodos
          while ($registro = $resultado->fetch_assoc()) {

            $carteira['periodo_atual']['data_inicial'] = $registro['data_inicial'];
            $carteira['periodo_atual']['data_final']    = $registro['data_final'];

          }

        }

      }

    }

  }

  return $carteira;

}

/**
 * verifica e retorna o período do mês anterior
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function verificaPeriodoAnterior($db, $carteira)
{
  settype($carteira['mes_atual'], 'integer');

  # recuperando id do mês anterior
  $mesAnterior =  $carteira['mes_atual'] - 1;

  # verificando se o id está no mês de janeiro (se estiver no mês de janeiro, o período anterior será o mês de dezembro)
  if ($mesAnterior == 0) {

    # recuperando ano anterior
    $anoAnterior = date('Y') -1;

    $carteira['periodo_anterior']['data_inicial'] = $anoAnterior . '-12' . '-01';
    $carteira['periodo_anterior']['data_final']    = $anoAnterior . '-12' . '-31';

  }

  $query =
    "SELECT
    	data_inicial,
      data_final
    FROM av_avancoins_periodos
    WHERE (id = $mesAnterior);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando data inicial e data final do mês anterior
    while ($registro = $resultado->fetch_assoc()) {

      $carteira['periodo_anterior']['data_inicial'] = $registro['data_inicial'];
      $carteira['periodo_anterior']['data_final']    = $registro['data_final'];

    }

  }

  return $carteira;

}
