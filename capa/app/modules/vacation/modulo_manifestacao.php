<?php

/**
 * responsável por consultar e retornar o exercício do ano vigente agendado do colaborador
 * @param - inteiro com o id do colaborador 
 */
function retornaExerciciosAgendadosDoColaborador($id)
{  
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_manifestacao.php';

  $db = abre_conexao();

  $tr = consultaExercicioAgendadoDoColaborador($db, $id);

  echo json_encode($tr); exit;
}

/**
 * responsável por consultar e retornar todos os exercícios de férias informando se existe pedidos de férias aguardando aprovação
 */
function retornaTodosOsExerciciosDeFerias()
{
  require_once DIRETORIO_HELPERS   . 'datas.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_manifestacao.php';

  $db = abre_conexao();

  # chamando função que consulta todos exercícios de férias
  $dados = consultaTodosOsExerciciosDeFerias($db);

  echo json_encode($dados);
}

/**
 * responsável por consultar e retornar os pedidos de férias de um exercício
 * @param - inteiro com o id do exercício de férias
 */
function retornaPedidosDeFeriasDeUmExercicio($id)
{
  require_once DIRETORIO_HELPERS   . 'datas.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_manifestacao.php';

  $db = abre_conexao();

  # chamando função que consulta os pedidos de um exercício de férias
  $pedidos = consultaPedidosDeFeriasDeUmExercicio($db, $id);

  echo json_encode($pedidos);
}