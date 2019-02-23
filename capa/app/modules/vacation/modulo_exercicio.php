<?php

/**
 * responsável por solicitar a deleção dos pedidos de férias e do exercício de férias
 * @param - inteiro com o id do exercício de férias
 */
function solicitaDelecaoDoExercicioDeFerias($id)
{
  require_once DIRETORIO_FUNCTIONS . 'vacation/delecoes_exercicio.php';

  $db = abre_conexao();

  # verificando se os pedidos de férias do exercício foram deletados
  if (deletaPedidosDeFerias($db, $id)) {
    # verificando se o exercício de férias foi deletado
    if (deletaExercicioDeFerias($db, $id)) {
      echo json_encode('1'); exit;
    }
  }  
}

/**
 * responsável por consultar e retornar os exercícios de férias lançados de um colaborador para tela de pedidos
 * @param - inteiro com o id do colaborador
 */
function retornaExerciciosDeFeriasLancadosDoColaborador($id)
{
  require_once DIRETORIO_HELPERS   . 'datas.php';
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
  require_once DIRETORIO_HELPERS   . 'datas.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_exercicio.php';

  $db = abre_conexao();

  $resultado = consultaExerciciosDeFeriasLancados($db, $id, $status);  
}

/**
 * responsável por consultar e retornar a data de admissão, regime e contrato de um colaborador
 * @param - inteiro com o id do colaborador
 */
function retornaDadosContratuais($id)
{
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_exercicio.php';

  $db = abre_conexao();

  $dados = consultaDadosContratuais($db, $id);

  echo json_encode($dados);

  exit;
}

/**
 * responsável por solicitar a gravação do exercício de férias
 * @param - array com os dados do exercício de férias 
 */
function recebeExercicioDeFerias($exercicio)
{
  require_once DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_exercicio.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/insercoes_exercicio.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/delecoes_exercicio.php';
  require_once DIRETORIO_HELPERS   . 'vacation/envia_email.php';

  $db = abre_conexao();

  $_SESSION['atividades']['exibe'] = true;

  $dados = consultaDadosDoUsuarioDoPortalAvancao($db, $exercicio['colaborador']);

  # verificando se já existe um exercício de férias gravado para o colaborador no ano vigente
  if (consultaExercicioDeFeriasRegistrado($db, $exercicio, $dados) > 0) {    
    $_SESSION['atividades']['mensagens'][] = 'Já existe um exercício de férias gravado para o colaborador no ano vigente.';
  } else {
    # verificando se o exercício de férias não foi gravado com sucesso
    if (!insereExercicioDeFerias($db, $exercicio)) {
      $_SESSION['atividades']['mensagens'][] = 'Erro ao gravar o exercício de férias. Informe ao Wellington Felix';
    } else {
      $email = consultaEmailDoColaborador($db, $exercicio['colaborador']);

      $exercicio['exercicio_inicial'] = formataDataParaExibir($exercicio['exercicio_inicial']);
      $exercicio['exercicio_final'] = formataDataParaExibir($exercicio['exercicio_final']);
      $exercicio['vencimento'] = formataDataParaExibir($exercicio['vencimento']);

      if (enviaEmailDeConfirmacaoDeExercicioDeFerias($email, $exercicio['exercicio_inicial'], $exercicio['exercicio_final'], $exercicio['vencimento'], $exercicio['regime'])) {
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['mensagens'][] = 'Exercício de férias gravado com sucesso.';
      } else {
        $id = consultaUltimoExercicioDeFerias($db);

        deletaExercicioDeFerias($db,$id);

        $_SESSION['atividades']['mensagens'][] = 'Erro ao enviar o e-mail de confirmação do exercício. Exercício deletado. Informe ao Wellington Felix';
      }
    }
  }

  header('location: '. BASE_URL . 'public/views/vacation/exercicio_ferias.php'); exit;
}