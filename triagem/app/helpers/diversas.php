<?php

/**
 * compara chaves dos arrays multidimensionais para a função usort()
 * @param - arrays internos com a quantidade de fila
 *
 */
function comparaChavesDosArraysInternos($a, $b)
{
  if ($a['fila'] == $b['fila']) {

    return 0;

  }

  return ($a['fila'] < $b['fila']) ? -1 : 1;
}
