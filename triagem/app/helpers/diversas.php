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
 * @param - array com os colaboradores que estão online
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

/**
 * monta uma URL com os dados do cliente e com o código do departamento para qual o cliente será transferido
 * @param - array com os dados dos colaboradores que estão online
 * @param - array com os dados do cliente
 */
function montaURL($colaboradores, $cliente)
{
  $url = '';

  # montando URL
  $url =   "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['nome_usuario']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&portalKey=1505758004&prefill%5Bphone%5D={$colaboradores[0]['departamento']}";

  return $url;
}

/**
 * aguarda até que um ou mais colaboradores fiquem online no chat
 * @param - array com os dados dos colaboradores
 * @param - objeto com uma conexão aberta
 */
function aguardaColaradoresOnline($colaboradores, $db)
{
  # chamando a função até que tenha pelo menos um colaborador online
  while ($colaboradores == NULL OR $colaboradores[0]['id'] == '') {

    # chamando a função que retorna um array com os dados dos colaboradores online
    $colaboradores = verificaColaboradoresOnlineNoChat($colaboradores, $db);

  }

  return $colaboradores;
}
