<?php

/*
 * confirma o envio dos dados do cliente
 */
function confirmaEnvioDosDadosDoCliente()
{
  # verificando se os dados do cliente foram enviados
  if (
    ! empty($_POST['cliente']['nome'])           AND
    ! empty($_POST['cliente']['nome_usuario'])   AND
    ! empty($_POST['cliente']['cnpj'])           AND
    ! empty($_POST['cliente']['conta_contrato']) AND
    ! empty($_POST['cliente']['razao_social'])
  ) {

      return true;
      
    }

  return false;

}

/*
 * confirma o envio dos dados da demanda
 */
function confirmaEnvioDosDadosDaDemanda()
{
  # verificando se os dados da demanda foram enviados
  if (! empty($_POST['cliente']['produto']) AND ! empty($_POST['cliente']['modulo']) AND ! empty($_POST['cliente']['duvida'])) {

    return true;

  }

  return false;

}

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
 * monta uma URL com os dados do cliente e com o código do departamento para qual o cliente será transferido e redireciona para o
 * departamento que realizará o atendimento
 * @param - array com os dados dos colaboradores que estão online
 * @param - array com os dados do cliente
 */
function redirecionaClienteParaDepartamento($colaboradores, $cliente)
{
  # chamando função que grava o nome do departamento que realizará o atendimento em uma sessão
  criaSessaoDeDepartamento($colaboradores[0]['departamento']);

  # montando URL
  $url =   "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['nome_usuario']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&portalKey=1505758004&prefill%5Bphone%5D={$colaboradores[0]['id_departamento']}";

  # redirecionando cliente para o colaborador no chat
  header('Location: http://192.168.0.47:9999/' . $url);
}
