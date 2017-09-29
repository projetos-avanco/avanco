<?php

require ABS_PATH . 'app/models/colaboradores.php';
require ABS_PATH . 'database/functions/contributors/online.php';
require ABS_PATH . 'database/functions/contributors/conhecimento.php';
require ABS_PATH . 'database/functions/contributors/fila.php';

/*
 * responsável por chamar outras funções que consultam informações na base de dados do chat e redirecionar o cliente
 */
function consultaChat()
{
  # chamando função que retorna uma conexão com a base de dados
  $conexao = abre_conexao();

  # recuperando os dados do cliente que chamou no portal avanço
  $cliente = $_SESSION['cliente'];

  $quantidade = 0;

  # chamando função que retorna um array modelo para receber os dados dos colaboradores
  $colaboradores = criaModeloDeColaboradores();

  # chamando função que aguarda até que um ou mais colaboradores fiquem online no chat
  $colaboradores = aguardaColaradoresOnline($colaboradores, $conexao);

  # recuperando a quantidade de colaboradores online
  $quantidade = count($colaboradores);

  # verificando se existe um ou mais colaboradores online
  if ($quantidade == 1) {

    # chamando função que monta uma URL com os dados do cliente e com código do departamento para o qual o cliente será transferido
    $url = montaURL($colaboradores, $cliente);

    # redirecionando cliente para o colaborador no chat
    header('Location: http://192.168.0.47:9999/' . $url);

    # verificando se existe um ou mais colaboradores online no chat
  } elseif ($quantidade > 1) {

    # pesquisar conhecimento dos colaboradores
    $colaboradores = verificaNivelDeConhecimentoDosColaboradoresOnline($colaboradores, $cliente, $quantidade, $conexao);

    # chamando função que grava os colaboradores em uma sessão
    criaSessaoColaboradores($colaboradores, $quantidade);

    # chamando função que elimina os colaboradores que possuem menos de 20% de conhecimento
    $colaboradores = eliminaColaboradoresSemConhecimento($colaboradores, $quantidade);

    # recuperando a quantidade de colaboradores que possuem no mínimo 20% de conhecimento
    $quantidade = count($colaboradores);

    # verificando se não existe nenhum colaborador online com no mínimo 20% de conhecimento
    if ($quantidade == 0) {

      # recuperando dados dos colaboradores que estão online
      $colaboradores = $_SESSION['colaboradores'];

      # recuperando a quantidade de colaboradores online e com no mínimo 20% de conhecimento
      $quantidade = count($colaboradores);

      # chamando função que verifica a quantidade de fila
      $colaboradores = verificaFilaDosColaboradores($colaboradores, $quantidade, $conexao);

      # chamando função que ordena o array deixando o colaborador com menor fila na posição 0
      usort($colaboradores, "comparaChavesDosArraysInternos");

      # chamando função que monta uma URL com os dados do cliente e com código do departamento para o qual o cliente será transferido
      $url = montaURL($colaboradores, $cliente);

      # redirecionando cliente para o colaborador no chat
      header('Location: http://192.168.0.47:9999/' . $url);

      # verificando se existe um ou mais colaboradores logados que possuem no mínimo 20% de conhecimento
    } elseif ($quantidade > 0) {

      # reordenando os valores do array começando por 0
      $colaboradores = array_values($colaboradores);

      # chamando função que verifica a quantidade de fila
      $colaboradores = verificaFilaDosColaboradores($colaboradores, $quantidade, $conexao);

      # chamando função que ordena o array deixando o colaborador com menor fila na posição 0
      usort($colaboradores, "comparaChavesDosArraysInternos");

      # chamando função que monta uma URL com os dados do cliente e com código do departamento para o qual o cliente será transferido
      $url = montaURL($colaboradores, $cliente);

      # redirecionando cliente para o colaborador no chat
      header('Location: http://192.168.0.47:9999/' . $url);

    }

    # eliminando arrays
    unset(
      $colaboradores,
      $cliente,
      $_SESSION['cliente'],
      $_SESSION['colaboradores']
    );

    # fechando conexão aberta
    fecha_conexao($conexao);
  }
}
