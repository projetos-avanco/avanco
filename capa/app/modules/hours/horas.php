<?php

/**
 * responsável por gravar os registros de horas na base de dados
 */
function gravaRegistroDeHoras($issues, $despesas, $lancamentos)
{
  require DIRETORIO_HELPERS   . 'diversas.php';
  require DIRETORIO_FUNCTIONS . 'hours/insere_horas.php';
  require DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';

  $db = abre_conexao();

  # chamando função que verifica se já existe um registro com o número da issue informado
  $duplicidade = verificaDuplicidadeDeIssue($db, $issues['issue']);

  # verificando se já existe um registro de issue na tabela de issues
  if ($duplicidade) {

    # chamando função que grava mensagens na sessão
    gravaMensagemNaSessao('danger', true, 'Ops', 'Já existe uma issue de número ' . $issues['issue'] . ' registrada no sistema.');

    # redirecionando usuário para página de registro de horas
    header('Location: ' . BASE_URL . 'public/views/hours/registro_horas.php');

    fecha_conexao($db);

    exit;

  }

  $retorno = insereRegistroDeIssues($db, $issues);

  $issues['id'] = consultaIdDaIssue($db, $issues['issue']);

  if ($retorno) {

    $retorno = insereRegistroDeLancamentos($db, $lancamentos, $issues['id']);

    if ($retorno) {

      if ($issues['tipo'] == 'in-loco' AND $despesas['total-despesas'] > 0) {

        $retorno = insereRegistroDeDespesas($db, $despesas, $issues['id']);

        if ($retorno) {

          # registrou despesa
          $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> Registro gravado com sucesso.</p>';
          $_SESSION['mensagens']['tipo']     = 'success';
          $_SESSION['mensagens']['exibe']    = true;

        } else {

          # erro ao insetir a despesa
          $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> A despesa não foi gravada! Houve erro de SQL.</p>';
          $_SESSION['mensagens']['tipo']     = 'danger';
          $_SESSION['mensagens']['exibe']    = true;
        }

      } else {

        # todos os registros foram gravados com sucesso
        $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> Registro gravado com sucesso.</p>';
        $_SESSION['mensagens']['tipo']     = 'success';
        $_SESSION['mensagens']['exibe']    = true;

      }

    } else {

      # erro ao inserir algum registro de lançamento
      $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Algum lançamento não foi gravado! Houve erro de SQL.</p>';
      $_SESSION['mensagens']['tipo']     = 'danger';
      $_SESSION['mensagens']['exibe']    = true;
    }

  } else {

    # erro ao inserir o registro de issue
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> A issue não foi gravada! Houve erro de SQL.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  header('Location: ' . BASE_URL . 'public/views/hours/registro_horas.php');

}

/**
 * responsável por recuperar todas as issues gravadas no registro de horas
 */
function recuperaTodasAsIssuesDoRegistroDeHoras()
{
  require DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';

  $issues = array();

  $db = abre_conexao();

  # chamando função que consulta todos as issues gravadas no registro de horas
  $issues = consultaTodasAsIssuesDoRegistroDeHoras($db, $issues);

  fecha_conexao($db);

  return $issues;

}

/**
 * responsával por recuperar os dados de uma única issue
 * @param - string com o número da issue
 * @param - array modelo para os dados das issues
 */
function recuperaDadosDoRegistroDeHoras($issue, $dados)
{
  require DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';

  $db = abre_conexao();

  # chamando função que consulta os dados de uma única issue
  $dados = consultaDadosDoRegistroDeHoras($db, $dados, $issue);

  fecha_conexao($db);

  return $dados;

}

/**
 * responsável por alterar os dados nas tabelas
 * @param - array com os dados da tabela de issues
 * @param - array com os dados da tabela de despesas
 * @param - array com os dados da tabela de lançamentos
 */
function alteraDadosDoRegistroDeHoras($issues, $despesas, $lancamentos)
{
  require DIRETORIO_HELPERS   . 'diversas.php';
  require DIRETORIO_FUNCTIONS . 'hours/insere_horas.php';
  require DIRETORIO_FUNCTIONS . 'hours/altera_horas.php';
  require DIRETORIO_FUNCTIONS . 'hours/deleta_horas.php';

  unset($_SESSION['mensagens']);

  $db = abre_conexao();

  # chamando função que edita os dados da tabela de issues
  $resultado = editaDadosDaTabelaDeIssues($db, $issues);

  # verificando se o tipo da issue foi alterado para in-loco ou alterado para remoto (in-loco possui despesas remoto não possui despesas)
  if ($resultado && $issues['tipo'] == 'in-loco') {

    # chamando função que edita os dados da tabela de despesas
    $resultado = editaDadosDaTabelaDeDespesas($db, $issues['id'], $despesas);

    if (! $resultado) {

      # gravando mensagem de erro
      gravaMensagemNaSessao('danger', true, 'Ops', 'Erro ao editar os dados na tabela de despesas');

      redirecionaUsuarioParaEdicaoDeLancamentos($db, $issues['issue']);

    }

  } elseif ($resultado && $issues['tipo'] == 'remoto') {

    # deletar despesas
    $resultado = deletaDespesas($db, $issues['id']);

    # verificando se houve erro ao deletar as despesas
    if (! $resultado) {

      # gravando mensagem de erro
      gravaMensagemNaSessao('danger', true, 'Ops', 'Erro ao deletar os dados na tabela de despesas');

      redirecionaUsuarioParaEdicaoDeLancamentos($db, $issues['issue']);

    }

  } else {

    # gravando mensagem de erro
    gravaMensagemNaSessao('danger', true, 'Ops', 'Erro ao alterar os dados na tabela de issues');

    redirecionaUsuarioParaEdicaoDeLancamentos($db, $issues['issue']);

  }

  # chamando função que edita os dados da tabela de lançamentos
  $resultado = editaDadosDaTabelaDeLancamentos($db, $issues['id'], $lancamentos);

  if ($resultado) {

    # gravando mensagem de sucesso
    gravaMensagemNaSessao('success', true, 'Tudo Certo', 'Os dados foram alterados com sucesso');

    redirecionaUsuarioParaEdicaoDeLancamentos($db, $issues['issue']);

  } else {

    # gravando mensagem de erro
    gravaMensagemNaSessao('danger', true, 'Ops', 'Erro ao editar os dados da tabela de lançamentos');
    
    redirecionaUsuarioParaEdicaoDeLancamentos($db, $issues['issue']);

  }

}

/**
 * responsável por deletar os dados da issue nas tabelas de issues, despesas e lançamentos
 * @param - string com o id da issue
 */
function deletaDadosDoRegistroDeHoras($id)
{
  require DIRETORIO_FUNCTIONS . 'hours/deleta_horas.php';

  $db = abre_conexao();

  # chamando função que deleta os dados da tabela de lançamentos
  $resultado = deletaLancamentos($db, $id);

  # verificando se os dados da tabela de lançamentos foram deletados
  if ($resultado) {

    # chamando função que deleta os dados da tabela de despesas
    $resultado = deletaDespesas($db, $id);

    # verificando se os dados da tabela de despesas foram deletados
    if ($resultado) {

      # chamando função que deleta os dados da tabela de issues
      $resultado = deletaIssues($db, $id);

      # verificando se os dados da tabela de issues foram deletados
      if ($resultado) {

        fecha_conexao($db);

        # redirecionando usuário para página de consulta de lançamentos
        header('Location: ' . BASE_URL . 'public/views/hours/consulta_lancamentos.php');

      } else {

        echo 
          '<h2>Os dados da tabela de issue não foram deletados!</h2>
          <p>
            <a href='.BASE_URL.'public/views/hours/consulta_lancamentos.php>Voltar</a>
          </p>';
          exit;

      }

    } else {

      echo 
        '<h2>Os dados da tabela de despesas não foram deletados!</h2>
        <p>
          <a href='.BASE_URL.'public/views/hours/consulta_lancamentos.php>Voltar</a>
        </p>';
        exit;

    }

  } else {

    echo 
      '<h2>Os dados da tabela de lançamentos não foram deletados!</h2>
      <p>
        <a href='.BASE_URL.'public/views/hours/consulta_lancamentos.php>Voltar</a>
      </p>';
      exit;

  }

}