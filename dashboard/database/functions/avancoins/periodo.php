<?php

/**
 * verifica e retorna o período que deve ser consultado
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da carteira de avancoins
 */
function verificaPeriodoAtivo($db, $carteira)
{
  # recuperando mês atual
  $mes = date('n');

  $mes = '1';# RETIRAR

  # consulta que retorna o id do período ativo na tabela períodos
  $query = "SELECT id FROM av_avancoins_periodos WHERE (ativo = 1);";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    # recuperando mês ativo na tabela de períodos
    $ativo = $resultado->fetch_row();
    $ativo = $ativo[0];

    # verificando se o mês atual é igual ao mês ativo na tabela de períodos
    if ($mes == $ativo) {

      # consulta que retorna a data inicial e a data final do período ativo na tabela de períodos
      $query = "SELECT data_inicial, data_final FROM av_avancoins_periodos WHERE (ativo = 1);";

      # verificando se a consulta pode ser executada
      if ($resultado = $db->query($query)) {

        # recuperando data inicial e data final do mês ativo na tabela de períodos
        while ($registro = $resultado->fetch_assoc()) {

          $carteira['periodo']['data_inicial'] = $registro['data_inicial'];
          $carteira['periodo']['data_final'] = $registro['data_final'];

        }

      }

    } else {

      # consulta que desativa o mês passado
      $query = "UPDATE av_avancoins_periodos SET ativo = 0 WHERE (ativo = 1);";

      # verificando se a consulta pode ser executada
      if ($db->query($query)) {

        # setando tipo do dado como inteiro
        settype($mes, 'integer');

        # consulta que ativa o mês atual
        $query = "UPDATE av_avancoins_periodos SET ativo = 1 WHERE (id = $mes);";

      }

      # verificando se a consulta pode ser executada
      if ($db->query($query)) {

        # consulta que retorna a data inicial e a data final do período ativo na tabela de períodos
        $query = "SELECT data_inicial, data_final FROM av_avancoins_periodos WHERE (ativo = 1);";

        # verificando se a consulta pode ser executada
        if ($resultado = $db->query($query)) {

          # recuperando data inicial e data final do mês ativo na tabela de períodos
          while ($registro = $resultado->fetch_assoc()) {

            $carteira['periodo']['data_inicial'] = $registro['data_inicial'];
            $carteira['periodo']['data_final'] = $registro['data_final'];

          }

        }

      }

    }

  }

  return $carteira;

}
