<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * responsável por solicitar o envio de email para o agenda, cliente e colaborador
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de um atendimento externo
 * @param - array com os dados de um endereço
 * @param - array com os dados de um contato
 * @param - array com os e-mails dos contatos em cópia
 */
function enviaEmailExterno($db, $externo, $endereco, $contato, $cc)
{
  require_once '../../../../../libs/PHPMailer/src/Exception.php';
  require_once '../../../../../libs/PHPMailer/src/PHPMailer.php';
  require_once '../../../../../libs/PHPMailer/src/SMTP.php';

  # chamando função que gera a mensagem de e-mail em formato HTML
  $msg = geraMensagemDeEmailDoAtendimentoExterno($db, $externo, $endereco, $contato);

  # chamando função que consulta o endereço de e-mail do colaborador
  $emailColaborador = consultaEmailDoColaborador($db, $externo['colaborador']);
  $emailSupervisor = $_SESSION['usuario']['email'];

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
    
    # adicionando todos os e-mail de contato do cliente
    for ($i = 0; $i < count($contato['emails']); $i++) {
      $email->addAddress($contato['emails'][$i]);
    }
    
    $email->addReplyTo('wellington.felix@avancoinfo.com.br', 'Respostas');
    $email->addCC('wellington.felix@avancoinfo.com.br');

    # verificando se existem e-mails em cópia para recebimento do agendamento remoto
    if (count($cc) > 0) {
      for ($i = 0; $i < count($cc); $i++)  {
        $email->addCC($cc[$i]);
      }
    }

    $email->addBCC($emailSupervisor);
    $email->addBCC($emailColaborador);

    # anexos
    #$email->addAttachment('/var/tmp/file.tar.gz');         
    #$email->addAttachment('/tmp/image.jpg', 'new.jpg');    

    # conteúdo
    $email->isHTML(true);                                  
    $email->Subject = 'Agendamento';
    $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/tag-1.jpg', 'tag', 'tag');

    # verificando qual supervisor está logado e importando sua foto correspondente
    switch ($externo['supervisor']) {
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
function solicitaGravacaoDeRegistroDeHoras($db, $externo)
{
  require_once DIRETORIO_FUNCTIONS . 'hours/insere_horas.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/consulta_horas.php';
  require_once DIRETORIO_FUNCTIONS . 'hours/deleta_horas.php';

  $issue = array(    
    'issue'          => 'AT-EXTERNO' . '-' . $externo['registro'],
    'tipo'           => 'in-loco',
    'status'         => '1',
    'cnpj'           => null,
    'conta_contrato' => null,
    'razao_social'   => null,
    'supervisor'     => $externo['supervisor'],
    'colaborador'    => $externo['colaborador'],
    'observacao'     => 'relatório pendente referente ao atendimento remoto de registro - ' . $externo['registro']
  );

  # chamando funções que retornam o cnpj, razão social e conta contrato de uma empresa
  $issue['cnpj']           = consultaCnpjDaEmpresa($db, $externo['id_cnpj']);
  $issue['razao_social']   = consultaRazaoSocialDaEmpresa($db, $externo['id_cnpj']);
  $issue['conta_contrato'] = consultaContratoDaEmpresa($db, $externo['id_cnpj']);
  
  # chamando função que insere um registro de horas na tabela de issues
  $resultado = insereRegistroDeIssues($db, $issue);

  return $resultado;
}

/**
 * responsável por gravar um atendimento externo
 * @param - array com os dados de um atendimento externo
 * @param - array com os dados de um endereço
 * @param - array com os dados de um contato
 * @param - array com os id's do contatos em cópia
 */
function recebeAtendimentoExterno($externo, $endereco, $contato, $copia)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/insercoes_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/delecoes_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';

  $db = abre_conexao();
  
  # chamando função que gera o número do registro
  $externo['registro'] = geraRegistro($db, 'av_agenda_atendimentos_externos');
  
  # chamando função que solicita a gravação de um registro de horas
  $resultado = solicitaGravacaoDeRegistroDeHoras($db, $externo);

  # verificando se o registro de horas foi gravado com sucesso
  if ($resultado) {
    # chamando função que retorna o id da issue do registro de horas gravado
    $externo['id_issue'] = consultaIdDaIssue($db, 'AT-EXTERNO-' . $externo['registro']);

    # chamando função que insere um registro de atendimento externo
    $resultado = insereAtendimentoExterno($db, $externo);
    
    # verificando se o registro de atendimento remoto foi gravado com sucesso
    if ($resultado) {
      $cc = array();

      # verificando se foram enviados os id's do contatos que receberam o e-mail em cópia
      if (count($cc) > 0) {
        for ($i = 0; $i < count($copia); $i++) {
          $cc = consultaEnderecosEmailsDeUmContato($db, $copia[$i], $cc);
        }
      } else {
        $cc['emails'] = array();
      }    

      # chamando função que realiza o envio dos e-mails
      $resultado = enviaEmailExterno($db, $externo, $endereco, $contato, $cc['emails']);

      # verificando se o e-mail foi enviado
      if ($resultado === true) {
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['exibe'] = true;
        $_SESSION['atividades']['mensagens'][] = 'Registro gerado com sucesso.';          
      } else {
        # e-mail não foi enviado
        $_SESSION['atividades']['tipo'] = 'danger';
        $_SESSION['atividades']['exibe'] = true;
        $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar o envio de E-mail. Registro de Horas e Registro de Atendimento Externo deletados. Informe ao Wellington Felix.';
        $_SESSION['atividades']['mensagens'][] = $resultado;

        # chamando função que deleta um registro de atendimento remoto
        deletaAtendimentoExterno($db, $externo['registro']);

        # chamando função que deleta um registro de issue
        deletaIssues($db, $externo['id_issue']);
      }
    } else {
      # registro de atendimento remoto não foi inserido
      $_SESSION['atividades']['tipo'] = 'danger';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Atendimento Externo. Registro de Horas deletado. Informe ao Wellington Felix.';

      # chamando função que deleta um registro de issue
      deletaIssues($db, $externo['id_issue']);
    }
  } else {
    # registro de horas não foi inserido
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Horas. Informe ao Wellington Felix.';
  }

  $_SESSION['registro'] = $externo['registro'];

  # redirecionando usuário para página de atendimento remoto
  header('location:' . BASE_URL . 'public/views/schedule/atendimento_externo.php'); exit;
}