<?php

/*
 * responsável por chamar outras funções que consultam informações na base de dados do chat e redireciona o cliente
 */
function consultaChatNovoErp()
{
  # chamando função que retorna uma conexão com a base de dados
  $conexao = abre_conexao();

  # recuperando os dados do cliente que chamou no portal avanço
  $cliente = $_SESSION['cliente'];

  # indicando que o cliente utiliza o novo ERP
  $cliente['novo_erp'] = '1';

  $quantidade = 0;

  # chamando função que retorna um array modelo para receber os dados dos colaboradores
  $colaboradores = criaModeloDeColaboradores();

  # chamando função que verifica se existe pelo menos um colaborador online no chat
  $colaboradores = verificaColaboradoresOnlineNoChat($colaboradores, $conexao);

  # recuperando a quantidade de colaboradores online
  $quantidade = count($colaboradores);

  # verificando se existe um ou mais colaboradores online
  if ($quantidade == 1) {

    # chamando função que monta uma URL e redireciona o cliente para o departamento que realizará o atendimento
    redirecionaClienteParaDepartamento($colaboradores, $cliente);

    # verificando se existe um ou mais colaboradores online no chat
  } elseif ($quantidade > 1) {

    # chamando função que verifica a quantidade de fila
    $colaboradores = verificaFilaDosColaboradores($colaboradores, $quantidade, $conexao);

    # chamando função que ordena o array deixando o colaborador com menor fila na posição 0
    usort($colaboradores, "comparaChavesDosArraysInternos");

    # chamando função que monta uma URL e redireciona o cliente para o departamento que realizará o atendimento
    redirecionaClienteParaDepartamento($colaboradores, $cliente);

    # eliminando arrays
    unset($colaboradores, $cliente);

    # fechando conexão aberta
    $conexao->close();
  }

}
