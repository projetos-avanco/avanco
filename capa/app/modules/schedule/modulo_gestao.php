<?php

/**
 * responsável por preparar os dados e solicitar a gravação de um registro de horas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de um atendimento de gestão de clientes
 */
function solicitaGravacaoDeRegistroDeHoras($db, $gestao)
{
  require_once DIRETORIO_FUNCTIONS . 'hours/insere_horas.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/deleta_horas.php';

  $issue = array(    
    'issue'          => 'AT-GESTÃO-CLIENTES' . '-' . $gestao['registro'],
    'tipo'           => 'in-loco',
    'status'         => '1',
    'cnpj'           => null,
    'conta_contrato' => null,
    'razao_social'   => null,
    'supervisor'     => $gestao['supervisor'],
    'colaborador'    => $gestao['colaborador'],
    'observacao'     => $gestao['observacao'] . ' Relatório pendente referente a visita de relacionamento de registro - ' . $gestao['registro'] . '.'
  );

  # chamando funções que retornam o cnpj, razão social e conta contrato de uma empresa
  $issue['cnpj']           = consultaCnpjDaEmpresa($db, $gestao['id_cnpj']);
  $issue['razao_social']   = consultaRazaoSocialDaEmpresa($db, $gestao['id_cnpj']);
  $issue['conta_contrato'] = consultaContratoDaEmpresa($db, $gestao['id_cnpj']);
  
  # chamando função que insere um registro de horas na tabela de issues
  $resultado = insereRegistroDeIssues($db, $issue);

  return $resultado;
}

/**
 * responsável por solicitar a gravação de um atendimento de gestão de clientes e o envio de e-mails aos envolvidos
 * @param - array com os dados de um atendimento de gestão de clientes
 */
function recebeAtendimentoGestaoVisitaRelacionamento($gestao, $endereco, $contato, $copia)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';  
  require_once DIRETORIO_FUNCTIONS . 'schedule/customers/insercoes_gestao_cliente.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';

  $db = abre_conexao();

  # chamando função que gera o número do registro
  $gestao['registro'] = geraRegistro($db, 'av_agenda_atendimentos_gestao_clientes');

  # verificando se o registro de horas foi gravado com sucesso
  if (solicitaGravacaoDeRegistroDeHoras($db, $gestao)) {
    # chamando função que retorna o id da issue do registro de horas gravado
    $gestao['id_issue'] = consultaIdDaIssue($db, 'AT-GESTÃO-CLIENTES-' . $gestao['registro']);

    # verificando se o atendimento de gestão de clientes foi inserido
    if (insereAtendimentoGestaoVisitaRelacionamento($db, $gestao)) {
      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Registro gerado com sucesso.';
    } else {
      # registro de atendimento remoto não foi inserido
      $_SESSION['atividades']['tipo'] = 'danger';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Atendimento de Gestão de Clientes. Relatório de Horas deletado. Informe ao Wellington Felix.';

      # chamando função que deleta um registro de issue
      deletaIssues($db, $gestao['id_issue']);
    }
  } else {
    # registro de horas não foi inserido
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Horas. Informe ao Wellington Felix.';
  }

  $_SESSION['registro'] = $gestao['registro'];

  # redirecionando usuário para página de atendimento de gestão de clientes
  header('location:' . BASE_URL . 'public/views/schedule/atendimento_gestao_clientes.php'); exit;
}

/**
 * responsável por solicitar a gravação de um atendimento de gestão de clientes
 * @param - array com os dados de um atendimento de gestão de clientes
 */
function recebeAtendimentoGestao($gestao)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/customers/insercoes_gestao_cliente.php';

  $db = abre_conexao();

  # chamando função que gera o número do registro
  $gestao['registro'] = geraRegistro($db, 'av_agenda_atendimentos_gestao_clientes');

  # verificando se o atendimento de gestão de cliente foi inserido
  if (insereAtendimentoGestao($db, $gestao)) {
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Registro gerado com sucesso.';
  } else {
    # registro de atendimento remoto não foi inserido
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Atendimento de Gestão de Clientes. Informe ao Wellington Felix.';
  }
  
  $_SESSION['registro'] = $gestao['registro'];

  # redirecionando usuário para página de atendimento de gestão de clientes
  header('location:' . BASE_URL . 'public/views/schedule/atendimento_gestao_clientes.php'); exit;
}