<?php

/**
 * responsável por consultar e retornar os exercícios de férias lançados de um colaborador para tela de pedidos
 * @param - inteiro com o id do colaborador
 */
function retornaExerciciosDeFeriasLancadosDoColaborador($id)
{
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_exercicio.php';

  $db = abre_conexao();

  $resultado = consultaExerciciosDeFeriasLancadosDoColaborador($db, $id);  
}

/**
 * responsável por consultar e retornar os exercícios de férias lançados de um colaborador
 * @param - inteiro com o id do colaborador
 * @param - string com o status para consulta
 */
function retornaExerciciosDeFeriasLancados($id, $status)
{
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_exercicio.php';

  $db = abre_conexao();

  $resultado = consultaExerciciosDeFeriasLancados($db, $id, $status);  
}

/**
 * responsável por consultar e retornar a data de admissão de um colaborador
 * @param - inteiro com o id do colaborador
 */
function retornaDataDeAdmissao($id)
{
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_exercicio.php';

  $db = abre_conexao();

  $admissao = consultaDataDeAdmissao($db, $id);

  echo json_encode($admissao);

  exit;
}

/**
 * responsável por solicitar a gravação do exercício de férias
 * @param - array com os dados do exercício de férias 
 */
function recebeExercicioDeFerias($exercicio)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_exercicio.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/insercoes_exercicio.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/delecoes_exercicio.php';
  require_once DIRETORIO_HELPERS   . 'vacation/envia_email.php';

  $db = abre_conexao();

  $resultado = insereExercicioDeFerias($db, $exercicio);

  $_SESSION['atividades']['exibe'] = true;

  if (!$resultado) {
    $_SESSION['atividades']['mensagens'][] = 'Erro ao gravar o exercício de férias. Informe ao Wellington Felix';
  } else {
    $email = consultaEmailDoColaborador($db, $exercicio['colaborador']);

    $exercicio['exercicio_inicial'] = formataDataParaExibir($exercicio['exercicio_inicial']);
    $exercicio['exercicio_final'] = formataDataParaExibir($exercicio['exercicio_final']);
    $exercicio['vencimento'] = formataDataParaExibir($exercicio['vencimento']);

    if (enviaEmailDeConfirmacaoDeExercicioDeFerias($email, $exercicio['exercicio_inicial'], $exercicio['exercicio_final'], $exercicio['vencimento'])) {
      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['mensagens'][] = 'Exercício de férias gravado com sucesso.';
    } else {
      $id = consultaUltimoExercicioDeFerias($db);

      deletaExercicioDeFerias($db,$id);

      $_SESSION['atividades']['mensagens'][] = 'Erro ao enviar o e-mail de confirmação do exercício. Exercício deletado. Informe ao Wellington Felix';
    }
  }

  header('location: '. BASE_URL . 'public/views/vacation/exercicio_ferias.php'); exit;
}