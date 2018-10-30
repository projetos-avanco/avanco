<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * responsável por solicitar o envio de email para o agenda, cliente e colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do atendimento remoto
 * @param - array com os dados de um contato
 */
function enviaEmail($db, $remoto, $contato)
{
  require_once '../../../../../libs/PHPMailer/src/Exception.php';
  require_once '../../../../../libs/PHPMailer/src/PHPMailer.php';
  require_once '../../../../../libs/PHPMailer/src/SMTP.php';

  # chamando função que gera a mensagem de e-mail em formato HTML
  $msg = geraMensagemDeEmailDoAtendimentoRemoto($db, $remoto, $contato);
  
  $email = new PHPMailer(true);

  try {
    # configurações de servidor 
    #$email->SMTPDebug  = 2;                                 
    $email->isSMTP();                                      
    $email->Host       = 'email-ssl.com.br';  
    $email->SMTPAuth   = true;                               
    $email->Username   = 'wellington.felix@avancoinfo.com.br';                 
    $email->Password   = 'Avanco123';                           
    $email->SMTPSecure = 'tls';                            
    $email->Port       = 587;                                    

    # destinatários 
    $email->setFrom('wellington.felix@avancoinfo.com.br', 'Agenda');
    
    for ($i = 0; $i < sizeof($contato['emails']); $i++) {
      $email->addAddress($contato['emails'][$i]);
    }
    
    $email->addReplyTo('wellington.felix@avancoinfo.com.br', 'Respostas');
    $email->addCC('wellington.felix@avancoinfo.com.br');
    #$email->addBCC($_SESSION['usuario']['email']);

    # anexos
    #$email->addAttachment('/var/tmp/file.tar.gz');         
    #$email->addAttachment('/tmp/image.jpg', 'new.jpg');    

    # conteúdo
    $email->isHTML(true);                                  
    $email->Subject = 'Agendamento';
    $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/tag-1.jpg', 'tag', 'tag');

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
    $email->AltBody = 'Este é o corpo em texto sem formatação para clientes de email não HTML';

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
 */
function recebeAtendimentoRemoto($remoto, $contato)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';  
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/insercoes_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/consultas_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/delecoes_remoto.php';

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
        # chamando função que realiza o envio dos e-mails
        $resultado = enviaEmail($db, $remoto, $contato);

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