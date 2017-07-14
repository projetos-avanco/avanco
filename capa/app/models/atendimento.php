<?php

/**
 * define um array modelo com os índices de resultados do atendimento
 */
function defineArrayDeResultadosDoAtendimento()
{
  $resultados = array(
    # departamento auge + integral + parceiros
    'aug_int_parc' => array(
      'geral' => array(
        'demanda_total' => 0,
        'atendidos'     => 0,
        'perdidos'      => 0,
        'taxa_de_perda' => 0,
        'tma'           => 0,
        'tme'           => 0
      ),
      'triagem' => array(
        'ate_15_minutos'        => 0,
        'entre_15_e_30_minutos' => 0,
        'acima_de_30_minutos'   => 0
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => 0,
        'entre_10_e_20_minutos' => 0,
        'acima_de_20_minutos'   => 0
      ),
      'indices' => array(
        'avancino' => 0,
        'geral'    => 0
      )
    ),

    # departamento auge
    'auge' => array(
      'geral' => array(
        'demanda_total' => 0,
        'atendidos'     => 0,
        'perdidos'      => 0,
        'taxa_de_perda' => 0,
        'tma'           => 0,
        'tme'           => 0
      ),
      'triagem' => array(
        'ate_15_minutos'        => 0,
        'entre_15_e_30_minutos' => 0,
        'acima_de_30_minutos'   => 0
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => 0,
        'entre_10_e_20_minutos' => 0,
        'acima_de_20_minutos'   => 0
      ),
      'indices' => array(
        'avancino' => 0,
        'geral'    => 0
      )
    ),

    # departamento integral
    'integral' => array(
      'geral' => array(
        'demanda_total' => 0,
        'atendidos'     => 0,
        'perdidos'      => 0,
        'taxa_de_perda' => 0,
        'tma'           => 0,
        'tme'           => 0
      ),
      'triagem' => array(
        'ate_15_minutos'        => 0,
        'entre_15_e_30_minutos' => 0,
        'acima_de_30_minutos'   => 0
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => 0,
        'entre_10_e_20_minutos' => 0,
        'acima_de_20_minutos'   => 0
      ),
      'indices' => array(
        'avancino' => 0,
        'geral'    => 0
      )
    ),

    # departamento novo erp
    'novo_erp' => array(
      'geral' => array(
        'demanda_total' => 0,
        'atendidos'     => 0,
        'perdidos'      => 0,
        'taxa_de_perda' => 0,
        'tma'           => 0,
        'tme'           => 0
      ),
      'triagem' => array(
        'ate_15_minutos'        => 0,
        'entre_15_e_30_minutos' => 0,
        'acima_de_30_minutos'   => 0
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => 0,
        'entre_10_e_20_minutos' => 0,
        'acima_de_20_minutos'   => 0
      ),
      'indices' => array(
        'avancino' => 0,
        'geral'    => 0
      )
    ),

    # departamento parceiros
    'parceiros' => array(
      'geral' => array(
        'demanda_total' => 0,
        'atendidos'     => 0,
        'perdidos'      => 0,
        'taxa_de_perda' => 0,
        'tma'           => 0,
        'tme'           => 0
      ),
      'triagem' => array(
        'ate_15_minutos'        => 0,
        'entre_15_e_30_minutos' => 0,
        'acima_de_30_minutos'   => 0
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => 0,
        'entre_10_e_20_minutos' => 0,
        'acima_de_20_minutos'   => 0
      ),
      'indices' => array(
        'avancino' => 0,
        'geral'    => 0
      )
    ),

    # departamento tecnologia
    'tecnologia' => array(
      'geral' => array(
        'demanda_total' => 0,
        'atendidos'     => 0,
        'perdidos'      => 0,
        'taxa_de_perda' => 0,
        'tma'           => 0,
        'tme'           => 0
      ),
      'triagem' => array(
        'ate_15_minutos'        => 0,
        'entre_15_e_30_minutos' => 0,
        'acima_de_30_minutos'   => 0
      ),
      'pos_triagem' => array(
        'ate_10_minutos'        => 0,
        'entre_10_e_20_minutos' => 0,
        'acima_de_20_minutos'   => 0
      ),
      'indices' => array(
        'avancino' => 0,
        'geral'    => 0
      )
    )
  );

  return $resultados;
}
