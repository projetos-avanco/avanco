<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../../../libs/PHPMailer/src/Exception.php';
require_once '../../../libs/PHPMailer/src/PHPMailer.php';
require_once '../../../libs/PHPMailer/src/SMTP.php';

/**
 * envia email de confirmação de compra na loja avanção
 * @param - string com a descrição do produto
 * @param - string com o nome do colaborador
 * @param - array com os dados da compra
 */
function enviaEmailDeCompraNaLoja($produto, $colaborador, $compra)
{
  require DIRETORIO_HELPERS   . 'data.php';

  # chamando função que formata a data para o formato dd/mm/aaaa
  $compra['data_compra'] = formataDataParaExibir($compra['data_compra']);

  # verificando se foi solicitado a compra de um produto que possui o campo quantidade
  if ($compra['quantidade'] == 'null') {
    # escrevendo a mensagem para o corpo do e-mail
    $mensagem = htmlentities(
        "Foi solicitado a compra do produto $produto,
         na data {$compra['data_compra']},
         no horário {$compra['horario_compra']} pelo colaborador(a) $colaborador.");
  } else {
    # escrevendo a mensagem para o corpo do e-mail
    $mensagem = htmlentities(
        "Foi solicitado a compra do produto $produto, na quantidade de {$compra['quantidade']} unidades,
         na data {$compra['data_compra']},
         no horário {$compra['horario_compra']} pelo colaborador(a) $colaborador.");
  }

  $email = new PHPMailer(true);

  # chamando função que formata a data para o formato aaaa-mm-dd
  $compra['data_compra'] = formataUnicaDataParaMysql($compra['data_compra']);

  try {

    # configurações de servidor
    #$email->SMTPDebug  = 2;
    $email->isSMTP();
    $email->Host       = 'email.avancoinfo.com.br';
    $email->SMTPAuth   = true;
    $email->Username   = 'loja.avancao@avancoinfo.com.br';
    $email->Password   = '752TCGcSdb';
    $email->SMTPSecure = 'ssl';
    $email->Port       = 465;

    # destinatários
    $email->setFrom('loja.avancao@avancoinfo.com.br', 'Loja');
    $email->addAddress('badaro@avancoinfo.com.br', 'Adilson Badaro');
    $email->addAddress('bruno@avancoinfo.com.br', 'Bruno Cesar');
    #$email->addReplyTo('info@example.com', 'Information');
    #$email->addCC('wellington.felix@avancoinfo.com.br');
    #$email->addCC('lucas.aguiar@avancoinfo.com.br');
    $email->addCC("{$compra['email']}"); #email do colaborador
    #$email->addBCC('bcc@example.com');

    # anexos
    #$email->addAttachment('/var/tmp/file.tar.gz');
    #$email->addAttachment('/tmp/image.jpg', 'new.jpg');

    # conteúdo
    $email->isHTML(true);
    $email->Subject = 'Compra de Produto na Loja';
    $email->Body    = $mensagem;
    #$email->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $email->send();

    # confirmando o envio do e-mail
    $compra['envio_email'] = true;

  } catch (Exception $e) {

    # confirmando o não envio do e-mail
    $compra['envio_email'] = false;

  }

  return $compra;

}
