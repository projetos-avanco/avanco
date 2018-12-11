<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * responsável por solicitar o cancelamento do atendimento
 * @param - inteiro com o id do atendimento
 */
function solicitaCancelamentoDeAtendimento($id)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/atualizacoes_remoto.php';

  $db = abre_conexao();

  # chamando função que cancela um atendimento remoto
  cancelaUmAtendimentoRemoto($db, $id);

  header('location: ' . BASE_URL . 'public/views/schedule/gerencial_atendimento_remoto.php'); exit;
}

/**
 * responsável por solicitar o envio de email para o agenda, cliente e colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do atendimento remoto
 * @param - array com os dados de um contato
 * @param - array com os e-mails dos contatos em cópia
 */
function enviaEmailRemoto($db, $remoto, $contato, $cc)
{
  require_once '../../../../../libs/PHPMailer/src/Exception.php';
  require_once '../../../../../libs/PHPMailer/src/PHPMailer.php';
  require_once '../../../../../libs/PHPMailer/src/SMTP.php';

  # chamando função que gera a mensagem de e-mail em formato HTML
  $msg = geraMensagemDeEmailDoAtendimentoRemoto($db, $remoto, $contato);

  # chamando função que consulta o endereço de e-mail do colaborador
  $emailColaborador = consultaEmailDoColaborador($db, $remoto['colaborador']);
  $emailSupervisor = $_SESSION['usuario']['email'];

  $email = new PHPMailer(true);
  $email->CharSet = 'UTF-8';

  try {
    # configurações de servidor
    #$email->SMTPDebug  = 2;
    $email->isSMTP();
    $email->Host       = 'email-ssl.com.br';
    $email->SMTPAuth   = true;
    $email->Username   = 'agenda@avancoinfo.com.br';
    $email->Password   = '@g3nD@Av@nc0131_1188';
    $email->SMTPSecure = 'ssl';
    $email->Port       = 465;

    # destinatários
    $email->setFrom('agenda@avancoinfo.com.br', 'Avanço | Agendamento');

    # adicionando todos os e-mail de contato do cliente
    for ($i = 0; $i < count($contato['emails']); $i++) {
      $email->addAddress($contato['emails'][$i]);
    }

    $email->addReplyTo('agenda@avancoinfo.com.br', 'Respostas');

    # verificando se existem e-mails em cópia para recebimento do agendamento remoto
    if (count($cc) > 0) {
      for ($i = 0; $i < count($cc); $i++)  {
        $email->addCC($cc[$i]);
      }
    }

    $email->addBCC($emailSupervisor);
    $email->addBCC($emailColaborador);
    $email->addBCC('agenda@avancoinfo.com.br');

    # anexos
    #$email->addAttachment('/var/tmp/file.tar.gz');
    #$email->addAttachment('/tmp/image.jpg', 'new.jpg');

    # conteúdo
    $email->isHTML(true);
    $email->Subject = 'Avanço | Agendamento';
    $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/tag-1.jpg', 'tag', 'tag');

    # verificando qual supervisor está logado e importando sua foto correspondente
    switch ($remoto['supervisor']) {
      case 05:
        $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/photos/05.png', 'foto', 'foto');
          break;

      case 42:
        $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/photos/42.jpg', 'foto', 'foto');
          break;

      case 61:
        $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/photos/61.jpg', 'foto', 'foto');
          break;
    }

    $email->Body    = $msg;
    $email->AltBody = '';

    $email->send();

    $resultado = true;
  } catch (Exception $e) {
    $resultado = $email->ErrorInfo;
  }

  return $resultado;
}

/**
 * responsável por preparar os dados e solicitar a gravação de um registro de horas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de um atendimento remoto
 */
function solicitaGravacaoDeRegistroDeHoras($db, $remoto)
{
  require_once DIRETORIO_FUNCTIONS . 'hours/insere_horas.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/deleta_horas.php';

  $issue = array(
    'issue'          => 'AT-REMOTO' . '-' . $remoto['registro'],
    'tipo'           => 'remoto',
    'status'         => '1',
    'cnpj'           => null,
    'conta_contrato' => null,
    'razao_social'   => null,
    'supervisor'     => $remoto['supervisor'],
    'colaborador'    => $remoto['colaborador'],
    'observacao'     => 'relatório pendente referente ao atendimento remoto de registro - ' . $remoto['registro']
  );

  # chamando funções que retornam o cnpj, razão social e conta contrato de uma empresa
  $issue['cnpj']           = consultaCnpjDaEmpresa($db, $remoto['id_cnpj']);
  $issue['razao_social']   = consultaRazaoSocialDaEmpresa($db, $remoto['id_cnpj']);
  $issue['conta_contrato'] = consultaContratoDaEmpresa($db, $remoto['id_cnpj']);

  # chamando função que insere um registro de horas na tabela de issues
  $resultado = insereRegistroDeIssues($db, $issue);

  return $resultado;
}

/**
 * responsável por solicitar a gravação de um ticket
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de um atendimento remoto
 * @param - array com os dados de um contato
 */
function solicitaGravacaoDeTicket($db, $remoto, $contato)
{
  require_once DIRETORIO_FUNCTIONS . 'tickets/instrucoes_tickets.php';
  require_once ABS_PATH . '../tickets/database/functions/screen/instrucoes.php';

  $ticket = array(
    'data_hora'         => $remoto['registrado'],
    'ticket'            => $remoto['registro'],
    'agendado'          => $remoto['data'] . ' ' . $remoto['horario'],
    'validade'          => true,
    'contato'           => $contato['nome'],
    'cnpj'              => null,
    'conta_contrato'    => null,
    'razao_social'      => null,
    'telefone'          => $contato['fixos'][0],
    'supervisor'        => $remoto['supervisor'],
    'colaborador'       => $remoto['colaborador'],
    'produto'           => $remoto['produto'],
    'modulo'            => $remoto['modulo'],
    'assunto'           => $remoto['observacao'],
    'historico_chat_id' => ''
  );

  # chamando funções que retornam o cnpj, razão social e conta contrato de uma empresa
  $ticket['cnpj']           = consultaCnpjDaEmpresa($db, $remoto['id_cnpj']);
  $ticket['razao_social']   = consultaRazaoSocialDaEmpresa($db, $remoto['id_cnpj']);
  $ticket['conta_contrato'] = consultaContratoDaEmpresa($db, $remoto['id_cnpj']);

  # chamando função que insere um registro na tabela de tickets
  insereDadosDoFormularioNovoTicket($ticket, $db);

  # verificando se o registro de ticket foi inserido com sucesso
  if (isset($_SESSION['mensagens']) && $_SESSION['mensagens']['tipo'] === 'success') {
    $resultado = true;
  } else {
    $resultado = false;
  }

  return $resultado;
}

/**
 * responsável por gravar um atendimento remoto
 * @param - array com os dados de um atendimento remoto
 * @param - array com os dados de um contato
 * @param - array com os id's do contatos em cópia
 */
function recebeAtendimentoRemoto($remoto, $contato, $copia)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/insercoes_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/delecoes_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';

  $db = abre_conexao();

  # chamando função que gera o número do registro
  $remoto['registro'] = geraRegistro($db, 'av_tickets');

  # chamando função que solicita a gravação de um ticket
  $resultado = solicitaGravacaoDeTicket($db, $remoto, $contato);

  # verificando se o ticket foi gravado com sucesso
  if ($resultado) {
    # chamando função que solicita a gravação de um registro de horas
    $resultado = solicitaGravacaoDeRegistroDeHoras($db, $remoto);

    # verificando se o registro de horas foi gravado com sucesso
    if ($resultado) {
      # chamando função que retorna o id da issue do registro de horas gravado
      $remoto['id_issue'] = consultaIdDaIssue($db, 'AT-REMOTO-' . $remoto['registro']);

      # chamando função que insere um registro de atendimento remoto
      $resultado = insereAtendimentoRemoto($db, $remoto);

      # verificando se o registro de atendimento remoto foi gravado com sucesso
      if ($resultado) {
        $cc = array();

        # verificando se foram enviados os id's do contatos que receberam o e-mail em cópia
        if (count($copia) > 0) {
          for ($i = 0; $i < count($copia); $i++) {
            $cc = consultaEnderecosEmailsDeUmContato($db, $copia[$i], $cc);
          }
        } else {
          $cc['emails'] = array();
        }

        # chamando função que realiza o envio dos e-mails
        $resultado = enviaEmailRemoto($db, $remoto, $contato, $cc['emails']);

        # verificando se o e-mail foi enviado
        if ($resultado === true) {
          $_SESSION['atividades']['tipo'] = 'success';
          $_SESSION['atividades']['exibe'] = true;
          $_SESSION['atividades']['mensagens'][] = 'Ticket gerado com sucesso.';
        } else {
          # e-mail não foi enviado
          $_SESSION['atividades']['tipo'] = 'danger';
          $_SESSION['atividades']['exibe'] = true;
          $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar o envio de E-mail. Ticket, Registro de Horas e Registro de Atendimento Remoto deletados. Informe ao Wellington Felix.';
          $_SESSION['atividades']['mensagens'][] = $resultado;

          # chamando função que deleta um registro de atendimento remoto
          deletaAtendimentoRemoto($db, $remoto['registro']);

          # chamando função que deleta um registro de ticket na tabela de tickets
          deletaTicketNoBancoDeDados($db, $remoto['registro']);

          # chamando função que deleta um registro de issue
          deletaIssues($db, $remoto['id_issue']);
        }
      } else {
        # registro de atendimento remoto não foi inserido
        $_SESSION['atividades']['tipo'] = 'danger';
        $_SESSION['atividades']['exibe'] = true;
        $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Atendimento Remoto. Ticket e Registro de Horas deletados. Informe ao Wellington Felix.';

        # chamando função que deleta um registro de ticket na tabela de tickets
        deletaTicketNoBancoDeDados($db, $remoto['registro']);

        # chamando função que deleta um registro de issue
        deletaIssues($db, $remoto['id_issue']);
      }
    } else {
      # registro de horas não foi inserido
      $_SESSION['atividades']['tipo'] = 'danger';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Horas. Ticket deletado. Informe ao Wellington Felix.';

      # chamando função que deleta um registro de ticket na tabela de tickets
      deletaTicketNoBancoDeDados($db, $remoto['registro']);
    }
  } else {
    # ticket não foi inserido
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Ticket. Informe ao Wellington Felix.';
  }

  # redirecionando usuário para página de atendimento remoto
  header('location:' . BASE_URL . 'public/views/schedule/atendimento_remoto.php'); exit;
}