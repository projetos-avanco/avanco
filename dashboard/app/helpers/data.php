<?php

/**
 * formata a data para aaaa-mm-dd caso ela esteja no formato dd-mm-aaaa
 * @param - array com a data inicial e a data final
 */
function formataDataParaMysql($datas)
{
  $arr = array();

  # quebrando data onde possui /
  $arr['data1'] = explode('/', $datas['data1']);
  $arr['data2'] = explode('/', $datas['data2']);

  # verificando se a data foi quebrada, caso contrário a data não será formatada
  if (count($arr['data1']) == 1 && count($arr['data2']) == 1) {

    return $datas;

  } else {

    # formatando data para aaaa-mm-dd
    $datas['data1'] = "{$arr['data1'][2]}-{$arr['data1'][1]}-{$arr['data1'][0]}";
    $datas['data2'] = "{$arr['data2'][2]}-{$arr['data2'][1]}-{$arr['data2'][0]}";

    return $datas;

  }
}

/**
 * formata data para dd/mm/aaaa
 * @param - string com apenas uma data, seja inicial ou final
 */
function formataDataParaExibir($data)
{
  $arr = array();

  # quebrando data onde possui -
  $arr = explode('-', $datas);

  # formatando data para dd-mm-aaaa
  $datas = "{$arr[2]}/{$arr[1]}/{$arr[0]}";

  return $datas;

}

/**
 * formata data para dd/mm/aaaa de todas as posições de um array
 * @param - array com várias posições de datas
 */
function formataArrayComDatasParaExibir($datas)
{
  $arr = array();

  # contando quantas posições com datas existem no array
  $posicoes = count($datas);

  # formatando todas as posições do array para dd/mm/aaaa
  for ($i = 0; $i < $posicoes; $i++) {

    $arr = explode('-', $datas[$i]);

    $datas[$i] = "{$arr[2]}/{$arr[1]}/{$arr[0]}";

  }

  return $datas;
}
