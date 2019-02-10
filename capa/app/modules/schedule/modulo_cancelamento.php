<?php

/**
 * responsável por solicitar o envio do e-mail de cancelamento de atendimento externo
 * @param - inteiro com o id do atendimento externo
 * @param - inteiro com o id do cnpj
 * @param - inteiro com o id do contato
 * @param - array com os ids dos contatos em cópia
 */
function solicitaEnvioDeEmailDeCancelamentoExterno($id, $idCnpj, $idContato, $copia)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_MODULES   . 'schedule/modulo_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/atualizacoes_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/consultas_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/delecoes_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/address/consultas_endereco.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/deleta_horas.php';

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  $cc = array();

  $db = abre_conexao();

  # verificando se o atendimento externo foi cancelado com sucesso
  if (cancelaUmAtendimentoExterno($db, $id)) {
    # chamando função que retorna os dados de um atendimento externo
    $externo = retornaDadosDoAtendimentoExterno($db, $id);

    # verificando se o atendimento externo é faturado e o tipo de cobrança
    if ($externo['faturado']) {
      if ($externo['valor_hora'] > 0 && $externo['valor_pacote'] == 0) {
        $externo['cobranca'] = '1';
      } elseif ($externo['valor_pacote'] > 0 && $externo['valor_hora'] == 0) {
        $externo['cobranca'] = '2';
      } elseif ($externo['valor_hora'] == 0 && $externo['valor_pacote'] == 0) {
        $externo['cobranca'] = '3';
      }
    }

    # chamando função que retorna o endereço do cliente
    $endereco = retornaEnderecoAjax($db, $externo['id_cnpj']);

    # chamando função que retorna os dados de um contato
    $contato = consultaDadosDeUmContato($db, $externo['id_contato']);

    # verificando se foram enviados os id's do contatos que receberam o e-mail em cópia
    if (count($copia) > 0) {
      for ($i = 0; $i < count($copia); $i++) {
        $cc = consultaEnderecosEmailsDeUmContato($db, $copia[$i], $cc);
      }
    } else {
      $cc['emails'] = array();
    }

    # chamando função que deleta um registro de issue
    deletaIssues($db, $externo['id_issue']);

    # chamando função que deleta um registro de pesquisa externa
    deletaPesquisaExterna($db, consultaIdDoAtendimentoExterno($db, $externo['registro']));

    # chamando função que realiza o envio dos e-mails
    if ($resultado = enviaEmailExterno($db, $externo, $endereco, $contato, $cc['emails'], 'cancelamento')) {
      # e-mail foi enviado
      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Visita cancelada e E-mails enviados com sucesso.';
    } else {
      # e-mail não foi enviado
      $_SESSION['atividades']['tipo'] = 'danger';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar o envio de E-mail. Informe ao Wellington Felix.';
      $_SESSION['atividades']['mensagens'][] = $resultado;
    }
  } else {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao cancelar a visita. Informe ao Wellington Felix.';    
  }

  # redirecionando usuário para página de atendimento remoto
  header('location:' . BASE_URL . 'public/views/schedule/cancela_atendimento_externo.php?id=' . $id . '&id-cnpj=' . $idCnpj . '&id-contato=' . $idContato); exit;
}

/**
 * responsável por solicitar o envio do e-mail de confirmação de atendimento remoto
 * @param - inteiro com o id do atendimento remoto
 * @param - inteiro com o id do cnpj
 * @param - inteiro com o id do contato
 * @param - array com os ids dos contatos em cópia
 */
function solicitaEnvioDeEmailDeCancelamentoRemoto($id, $idCnpj, $idContato, $copia)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_MODULES   . 'schedule/modulo_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/atualizacoes_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/consultas_remoto.php';  
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'avancoins/colaboradores.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/deleta_horas.php';
  require_once DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  $cc = array();

  $db = abre_conexao();

  # verificando se o atendimento externo foi confirmado com sucesso
  if (cancelaUmAtendimentoRemoto($db, $id)) {
    # chamando função que retorna os dados de um atendimento externo
    $remoto = retornaDadosDoAtendimentoRemoto($db, $id);

    # verificando se o atendimento externo é fatura e o tipo de cobrança
    if ($remoto['faturado']) {
      if ($remoto['valor_hora'] > 0 && $remoto['valor_pacote'] == 0) {
        $remoto['cobranca'] = '1';
      } elseif ($remoto['valor_pacote'] > 0 && $remoto['valor_hora'] == 0) {
        $remoto['cobranca'] = '2';
      } elseif ($remoto['valor_hora'] == 0 && $remoto['valor_pacote'] == 0) {
        $remoto['cobranca'] = '3';
      }
    }

    # chamando função que retorna os dados de um contato
    $contato = consultaDadosDeUmContato($db, $remoto['id_contato']);

    # verificando se foram enviados os id's do contatos que receberam o e-mail em cópia
    if (count($copia) > 0) {
      for ($i = 0; $i < count($copia); $i++) {
        $cc = consultaEnderecosEmailsDeUmContato($db, $copia[$i], $cc);
      }
    } else {
      $cc['emails'] = array();
    }

    # chamando função que deleta um registro de issue
    deletaIssues($db, $remoto['id_issue']);

    # chamando função que deleta um registro de ticket na tabela de tickets
    deletaTicketNoBancoDeDados($db, $remoto['registro']);
    
    # chamando função que realiza o envio dos e-mails
    if ($resultado = enviaEmailRemoto($db, $remoto, $contato, $cc['emails'], 'cancelamento')) {
      # e-mail foi enviado
      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Agendamento cancelado e E-mails enviados com sucesso.';
    } else {
      # e-mail não foi enviado
      $_SESSION['atividades']['tipo'] = 'danger';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar o envio de E-mail. Informe ao Wellington Felix.';
      $_SESSION['atividades']['mensagens'][] = $resultado;
    }
  } else {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao cancelar o agendamento. Informe ao Wellington Felix.';    
  }

  # redirecionando usuário para página de atendimento remoto
  header('location:' . BASE_URL . 'public/views/schedule/cancela_atendimento_remoto.php?id=' . $id . '&id-cnpj=' . $idCnpj . '&id-contato=' . $idContato); exit;
}