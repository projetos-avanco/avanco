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
/* function eliminaColaboradoresSemConhecimento($array, $quantidade)
{
  # eliminando colaboradores que possuem menos de 20% de conhecimento
  for ($i = 0; $i < $quantidade; $i++) {

    # verificando se o colaborador possue menos do que 20% de conhecimento
    if ($array[$i]['conhecimento'] < '20.0') {

      unset($array[$i]);

    }

  }

  return $array;
} */

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
    if ($array[$i]['conhecimento'] == 0) {

      unset($array[$i]);

    }

  }

  return $array;
}

/**
 * redireciona o cliente diretamente para o departamento de tecnologia
 * @param - array com os dados do cliente
 */
function redirecionaClienteParaDepartamentoTecnologia($cliente)
{

  # montando URL
  $url =
    "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['razao_social']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome_usuario']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&value_items_admin[5]=0&nome_departamento=Tecnologia&codigo_ticket=0&novo_erp={$cliente['novo_erp']}&prefill%5Bphone%5D=2&value_items_admin[6]={$cliente['telefone']}&value_items_admin[7]=0";

  # redirecionando cliente para o colaborador no chat teste
  echo json_encode(['url' => 'http://192.168.0.47:9999/' . $url], JSON_UNESCAPED_UNICODE);

  # redirecionando cliente para o colaborador no chat produção
  #echo json_encode(['url' => 'https://chat.avancoinfo.net/' . $url], JSON_UNESCAPED_UNICODE);

  exit;
}

/**
 * monta uma URL com os dados do cliente e com o código do departamento para qual o cliente será transferido e redireciona para o
 * departamento que realizará o atendimento
 * @param - array com os dados dos colaboradores que estão online
 * @param - array com os dados do cliente
 */
function redirecionaClienteParaDepartamento($colaboradores, $cliente, $curva = null)
{

  if (! isset($cliente['ticket'])) {

    if ($curva) {

      # montando URL para atendimentos sem agendamento da curva abc
      $url =
        "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['razao_social']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome_usuario']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&value_items_admin[5]={$cliente['produto']}&nome_departamento={$colaboradores[0]['departamento']}&codigo_ticket=0&novo_erp={$cliente['novo_erp']}&prefill%5Bphone%5D={$colaboradores[0]['id_departamento']}&value_items_admin[6]={$cliente['telefone']}&value_items_admin[7]=1";

    } else {

      # verificando se o cliente possui prioridade no atendimento (rede uniao)
      if (
        $cliente['conta_contrato'] === '0000027'||
        $cliente['conta_contrato'] === '0000637'||
        $cliente['conta_contrato'] === '0000193'||
        $cliente['conta_contrato'] === '0000701'||
        $cliente['conta_contrato'] === '0000108'||
        $cliente['conta_contrato'] === '0000204'||
        $cliente['conta_contrato'] === '0000075'||
        $cliente['conta_contrato'] === '0000111'||
        $cliente['conta_contrato'] === '0000429'||
        $cliente['conta_contrato'] === '0000013'||
        $cliente['conta_contrato'] === '0000043'||
        $cliente['conta_contrato'] === '0000070'||
        $cliente['conta_contrato'] === '0000090'||
        $cliente['conta_contrato'] === '0000146'||
        $cliente['conta_contrato'] === '0000435'||
        $cliente['conta_contrato'] === '0000163'||
        $cliente['conta_contrato'] === '0000207') {

          # montando URL para atendimentos sem agendamento com prioridade
          $url =
          "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['razao_social']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome_usuario']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&value_items_admin[5]={$cliente['produto']}&nome_departamento={$colaboradores[0]['departamento']}&codigo_ticket=0&novo_erp={$cliente['novo_erp']}&prefill%5Bphone%5D={$colaboradores[0]['id_departamento']}&value_items_admin[6]={$cliente['telefone']}&value_items_admin[7]=2";
          
      } else {

        # montando URL para atendimentos sem agendamento e sem prioridade
        $url =
        "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['razao_social']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome_usuario']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&value_items_admin[5]={$cliente['produto']}&nome_departamento={$colaboradores[0]['departamento']}&codigo_ticket=0&novo_erp={$cliente['novo_erp']}&prefill%5Bphone%5D={$colaboradores[0]['id_departamento']}&value_items_admin[6]={$cliente['telefone']}&value_items_admin[7]=0";

      }

    }

  } else {

    # montando URL para atendimentos com agendamento
    $url =
      "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['razao_social']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&value_items_admin[5]={$cliente['produto']}&nome_departamento={$colaboradores[0]['departamento']}&codigo_ticket={$cliente['ticket']}&novo_erp={$cliente['novo_erp']}&prefill%5Bphone%5D={$colaboradores[0]['id_departamento']}&value_items_admin[6]={$cliente['telefone']}&value_items_admin[7]=0";

  }

  # redirecionando cliente para o colaborador no chat teste
  echo json_encode(['url' => 'http://192.168.0.47:9999/' . $url], JSON_UNESCAPED_UNICODE);

  # redirecionando cliente para o colaborador no chat produção
  #echo json_encode(['url' => 'https://chat.avancoinfo.net/' . $url], JSON_UNESCAPED_UNICODE);

  exit;
}
