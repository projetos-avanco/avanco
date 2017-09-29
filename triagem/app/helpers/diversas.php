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

/**
 * elimina do array os colaboradores que possuem menos de 20% de conhecimento sobre o módulo selecionado pelo cliente no portal avanço
 * @param - $array com os colaboradores que estão online
 * @param - inteiro com a quantidade de colaboradores no array
 */
function eliminaColaboradoresSemConhecimento($array, $quantidade)
{
  # eliminando colaboradores que possuem menos de 20% de conhecimento
  for ($i = 0; $i < $quantidade; $i++) {

    # verificando se o colaborador possue menos do que 20% de conhecimento
    if ($array[$i]['conhecimento'] < '20.0') {

      unset($array[$i]);

    }

  }

  return $array;
}
