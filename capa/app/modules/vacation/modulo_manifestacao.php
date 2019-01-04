<?php

/**
 * responsável por retornar o exercício do ano vigente agendado do colaborador
 * @param - inteiro com o id do colaborador 
 */
function retornaExerciciosAgendadosDoColaborador($id)
{  
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_manifestacao.php';

  $db = abre_conexao();

  $tr = consultaExercicioAgendadoDoColaborador($db, $id);

  echo json_encode($tr); exit;
}