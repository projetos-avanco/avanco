<?php

/**
 * consulta id, nome e sobrenome dos colaboradores do atendimento
 * @param - objeto com uma conexão ativa
 */
function consultaDadosPessoaisDosColaboradores($db, $ranking)
{
  $query = 
    "SELECT
      u.id,
      u.name AS nome,
      u.surname AS sobrenome,
      c.moedas
    FROM lh_users AS u
    INNER JOIN av_avancoins_carteiras AS c
      ON c.id = u.id
    WHERE NOT(u.id = 1  OR
              u.id = 2  OR
              u.id = 3  OR
              u.id = 4  OR
              u.id = 5  OR
              u.id = 6  OR
              u.id = 36 OR
              u.id = 37 OR
              u.id = 38 OR
              u.id = 39 OR
              u.id = 40 OR
              u.id = 41 OR
              u.id = 42 OR
              u.id = 44 OR
              u.id = 61)
      AND (u.disabled = 0)
    ORDER BY u.name;";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    $contador = 0;

    # recuperando dados
    while ($registro = $resultado->fetch_assoc()) {

      settype($registro['moedas'], 'integer');

      $ranking[] = array(

        # dados pessoais
        'id' => $registro['id'],
        'nome' => $registro['nome'],
        'sobrenome' => $registro['sobrenome'],
        'moedas' => $registro['moedas'],

        # dados de atendimento
        'atendimentos_demandados' => 0,
        'atendimentos_realizados' => 0,
        'atendimentos_realizados_ate_15_minutos' => 0,          
        'atendimentos_perdidos' => 0,
        'tempo_de_conversa' => 0,
        'tma' => 0,
        'percentual_perda' => 0.0,
        'percentual_fila_ate_15_minutos' => 0.0,

        # dados de índices
        'quantidade_questionarios_avancino' => 0,
        'quantidade_questionarios_eficiencia' => 0,
        'quantidade_questionarios_internos' => 0,
        'quantidade_questionarios_externos' => 0,
        'percentual_avancino' => 0.0,
        'percentual_eficiencia' => 0.0,
        'percentual_questionario_respondido' => 0.0
        
      );

      $contador++;

      # verificando se o while está no último registro
      if ($contador == $resultado->num_rows) {

        # adicionando uma nova posição depois do último registro
        $ranking[$contador++] = array(

          # dados totais
          'total_demandados' => 0,
          'total_realizados' => 0,
          'total_perdidos' => 0,
          'total_perc_perda' => 0.0,
          'total_perc_fila' => 0.0,
          'total_tma' => 0,
          'total_perc_avancino' => 0.0,
          'total_perc_eficiencia' => 0.0,
          'total_perc_questionario_interno' => 0.0,
          'total_avancoins' => 0

        );

      }

    }

  }

  return $ranking;

}