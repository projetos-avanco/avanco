<?php

require ABS_PATH . 'app/models/colaboradores.php';
require ABS_PATH . 'database/functions/contributors/online.php';
require ABS_PATH . 'database/functions/contributors/conhecimento.php';
require ABS_PATH . 'database/functions/contributors/fila.php';

/*
 * responsável por chamar outras funções que consultam informações na base de dados do chat
 */
function consultaChat()
{
  $cliente = array();

  # recuperando os dados do cliente que chamou no portal avanço
  $cliente = $_SESSION['cliente'];

  # chamando função que retorna uma conexão com a base de dados
  $conexao = abre_conexao();

  # chamando função que retorna um array modelo para receber os dados dos colaboradores
  $colaboradores = criaModeloDeColaboradores();

  # chamando a função até que tenha pelo menos um colaborador online
  while ($colaboradores == NULL OR $colaboradores[0]['id'] == '') {

    # chamando a função que retorna um array com os dados dos colaboradores online
    $colaboradores = verificaColaboradoresOnlineNoChat($colaboradores, $conexao);

  }

  $quantidade = 0;

  # recuperando a quantidade de colaboradores online
  $quantidade = count($colaboradores);

  # verificando se existe um ou mais colaboradores online
  if ($quantidade == 1) {

    # montando URL
    $url =   "index.php/por/chat/startchat/(leaveamessage)/true?prefill%5Busername%5D={$cliente['nome_usuario']}&value_items_admin[0]={$cliente['duvida']}&value_items_admin[1]={$cliente['nome']}&value_items_admin[2]={$cliente['conta_contrato']}&value_items_admin[3]={$cliente['razao_social']}&value_items_admin[4]={$cliente['cnpj']}&portalKey=1505758004&prefill%5Bphone%5D={$colaboradores[0]['departamento']}";

    # redirecionando cliente para o colaborador no chat
    header("Location: http://127.0.0.1/avanco-local/lhc_web/" . $url);

  } elseif ($quantidade > 1) {

    # pesquisar conhecimento dos colaboradores
    $colaboradores = verificaNivelDeConhecimentoDosColaboradoresOnline($colaboradores, $cliente, $quantidade, $conexao);

    # eliminando colaboradores que possuem menos de 20% de conhecimento sobre o módulo selecionado pelo cliente no portal avanço
    for ($i = 0; $i < $quantidade; $i++) {

      # verificando se o colaborador possue menos do que 20% de conhecimento
      if ($colaboradores[$i]['conhecimento'] < '20.0') {

        unset($colaboradores[$i]);

      }

    }

    # recuperando a quantidade de colaboradores que possuem no mínimo 20% de conhecimento
    $quantidade = count($colaboradores);

    # reordenando os valores do array começando por 0
    $colaboradores = array_values($colaboradores);

    # chamando função que verifica a quantidade de fila
    $colaboradores = verificaFilaDosColaboradoresOlineQuePossuemConhecimento($colaboradores, $quantidade, $conexao);

    # chamando função que ordena o array deixando o colaborador com menor fila na posição 0
    usort($colaboradores, "comparaChavesDosArraysInternos");

    exit(var_dump($colaboradores));
  }

}
