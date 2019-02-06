<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * envia um e-mail de aprovação do pedido de férias
 * @param - string com o e-mail do colaborador
 * @param - array com os dados do pedido
 * @param - string com o tipo do período selecionado pelo usuário
 */
function enviaEmailDeAprovacaoDeFerias($emailColaborador, $pedido, $tipo)
{
  require_once '../../../../libs/PHPMailer/src/Exception.php';
  require_once '../../../../libs/PHPMailer/src/PHPMailer.php';
  require_once '../../../../libs/PHPMailer/src/SMTP.php';
  
  # chamando função que retorna a folha de estilo do bootstrap
  $style = retornaCssDoBootstrap();

  # verificando se o usuário logado é adilson badaró
  if ($_SESSION['usuario']['id'] == 5) {
    $supervisor = $_SESSION['usuario']['sobrenome'];
  } else {
    $supervisor = $_SESSION['usuario']['nome'] . ' ' . $_SESSION['usuario']['sobrenome'];
  }

  $emailSupervisor = $_SESSION['usuario']['email'];

  $msg = 
    "<!DOCTYPE html>
    <html lang='pt-br'>
      <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <title>Aprovação do Pedido de Férias</title>

        <style>
          $style

          #imagem {
            width: 372px;
            height 134px;
          }
          
          #texto {
            position: absolute;
            margin-top: -190px;
          }

          #observacao {
            color: red;
          }
        </style>
      </head>

      <body>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <h2>Aprovação do Pedido de Férias</h2>
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <p>
                  Suas férias foram aprovadas.
                </p>
              </div>
            </div>
          </div>
          
          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
              <h4>Dados do Pedido</h4>

              <br>";

              switch ($tipo) {
                case '1':
                  $pedido['periodo1']['data_inicial'] = formataDataParaExibir($pedido['periodo1']['data_inicial']);
                  $pedido['periodo1']['data_final']   = formataDataParaExibir($pedido['periodo1']['data_final']);

                  $msg .= "
                    <p><strong>1º - Período</strong> {$pedido['periodo1']['data_inicial']} até {$pedido['periodo1']['data_final']} - {$pedido['periodo1']['dias']} dias</p>
                  ";
                break;

                case '2':
                  $pedido['periodo1']['data_inicial'] = formataDataParaExibir($pedido['periodo1']['data_inicial']);                    
                  $pedido['periodo1']['data_final']   = formataDataParaExibir($pedido['periodo1']['data_final']);

                  $pedido['periodo2']['data_inicial'] = formataDataParaExibir($pedido['periodo2']['data_inicial']);
                  $pedido['periodo2']['data_final']   = formataDataParaExibir($pedido['periodo2']['data_final']);

                  $msg .= "
                    <p><strong>1º - Período</strong> {$pedido['periodo1']['data_inicial']} até {$pedido['periodo1']['data_final']} - {$pedido['periodo1']['dias']} dias</p>
                    <p><strong>2º - Período</strong> {$pedido['periodo2']['data_inicial']} até {$pedido['periodo2']['data_final']} - {$pedido['periodo2']['dias']} dias</p>
                  ";
                break;
                /*
                case '3':
                  $pedido['periodo1']['data_inicial'] = formataDataParaExibir($pedido['periodo1']['data_inicial']);                    
                  $pedido['periodo1']['data_final']   = formataDataParaExibir($pedido['periodo1']['data_final']);

                  $pedido['periodo2']['data_inicial'] = formataDataParaExibir($pedido['periodo2']['data_inicial']);
                  $pedido['periodo2']['data_final']   = formataDataParaExibir($pedido['periodo2']['data_final']);

                  $pedido['periodo3']['data_inicial'] = formataDataParaExibir($pedido['periodo3']['data_inicial']);
                  $pedido['periodo3']['data_final']   = formataDataParaExibir($pedido['periodo3']['data_final']);

                  $msg .= "
                    <p><strong>1º - Período</strong> {$pedido['periodo1']['data_inicial']} até {$pedido['periodo1']['data_final']} - {$pedido['periodo1']['dias']} dias</p>
                    <p><strong>2º - Período</strong> {$pedido['periodo2']['data_inicial']} até {$pedido['periodo2']['data_final']} - {$pedido['periodo2']['dias']} dias</p>
                    <p><strong>3º - Período</strong> {$pedido['periodo3']['data_inicial']} até {$pedido['periodo3']['data_final']} - {$pedido['periodo3']['dias']} dias</p>
                  ";
                break;
                */
                case '4':
                case '5':
                  $pedido['periodo1']['data_inicial'] = formataDataParaExibir($pedido['periodo1']['data_inicial']);                    
                  $pedido['periodo1']['data_final']   = formataDataParaExibir($pedido['periodo1']['data_final']);

                  $pedido['periodo2']['data_inicial'] = formataDataParaExibir($pedido['periodo2']['data_inicial']);
                  $pedido['periodo2']['data_final']   = formataDataParaExibir($pedido['periodo2']['data_final']);

                  $msg .= "
                    <p><strong>1º - Período</strong> {$pedido['periodo1']['data_inicial']} até {$pedido['periodo1']['data_final']} - {$pedido['periodo1']['dias']} dias</p>
                    <p><strong>2º - Período</strong> {$pedido['periodo2']['data_inicial']} até {$pedido['periodo2']['data_final']} - {$pedido['periodo2']['dias']} dias</p>
                  ";
                break;
              }
  $msg .=
              "</div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>            
                <p>Atte,</p>
                              
                <div style='text-size-adjust: none !important; -ms-text-size-adjust: none !important; -webkit-text-size-adjust: none !important;'>
                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; margin-bottom: 10px;'>
                    <a style='text-decoration:none' href='https://htmlsig.com/t/000001CHE435'>
                      <img src='cid:foto' alt='Avanço Informática' border='0' height='80' width='80'>
                    </a>
                  </p>
                    
                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; color: rgb(33, 33, 33); margin-bottom: 10px;'>
                    <span style='font-weight: bold; color: rgb(33, 33, 33); display: inline;'> $supervisor</span>
                    <span style='display: inline;'>/</span> <span style='color: rgb(33, 33, 33); display: inline;'>Atendimento</span>
                    <span style='display: inline;'><br></span>
                      <a href='mailto: iuri@avancoinfo.com.br' style='color: rgb(71, 124, 204); text-decoration: none; display: inline;'> $emailSupervisor</a>
                    <span style='color: #212121;'></span>
                  </p>

                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; margin-bottom: 10px;'>
                    <span style='font-weight: bold; color: rgb(33, 33, 33); display: inline;'>Avanço Informática</span>
                    <span style='display: inline;'><br></span>
                    <span style='color: rgb(33, 33, 33); display: inline;'>31 3025 1188</span>
                    <span style='color: #212121;'></span>
                    <span style='display: inline;'><br></span> <span style='color: rgb(33, 33, 33); display: inline;'>Avenida Brasil, 131, Santa Efigênia</span>
                    <span style='display: inline;'><br></span> <span style='color: rgb(33, 33, 33); display: inline;'>Belo Horizonte  -  Minas Gerais</span>
                    <span style='display: inline;'><br></span>
                    <a href='http://www.avancoinfo.com.br' style='color: rgb(71, 124, 204); text-decoration: none; display: inline;'>www.avancoinfo.com.br</a>
                  </p>

                  <p style='font-size: 0px; line-height: 0; font-family: Helvetica, Arial, sans-serif;'></p>

                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; margin-bottom: 10px;'>
                    <a href='http://avancoinfo.com.br/'>
                      <img src='cid:tag' alt='avancoinfo.com.br' border='0' height='35' width='300' data-pin-nopin='true'>
                    </a>
                  </p> 

                  <p style='font-family: Helvetica, Arial, sans-serif; color: #212121; font-size: 9px; line-height: 12px;'></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </body>
    </html>";

  $email = new PHPMailer(true);
  $email->CharSet = 'UTF-8';

  try {
    # configurações de servidor
    #$email->SMTPDebug  = 2;
    $email->isSMTP();
    $email->Host       = 'email-ssl.com.br';
    $email->SMTPAuth   = true;
    $email->Username   = 'loja.avancao@avancoinfo.com.br';
    $email->Password   = 'Avanco123';
    $email->SMTPSecure = 'ssl';
    $email->Port       = 465;

    # destinatários
    $email->setFrom($emailSupervisor, 'Avanço | Aprovação Férias');    
    $email->addAddress($emailColaborador);    
    $email->addReplyTo($emailSupervisor, 'Respostas');    
    #$email->addCC();
    $email->addAddress('wellington.felix@avancoinfo.com.br');

    # anexos
    #$email->addAttachment('/var/tmp/file.tar.gz');
    #$email->addAttachment('/tmp/image.jpg', 'new.jpg');

    # conteúdo
    $email->isHTML(true);
    $email->Subject = 'Avanço | Aprovação Férias';
    $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/tag-1.jpg', 'tag', 'tag');

    # verificando qual supervisor está logado e importando sua foto correspondente
    switch ($_SESSION['usuario']['id']) {
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
    #$resultado = $email->ErrorInfo;
    $resultado = false;
  }

  return $resultado;
}

/**
 * envia um e-mail de confirmação de inserção de exercício de férias
 * @param - string com o e-mail do colaborador
 * @param - string com a data do exercício inicial
 * @param - string com a data do exercício final
 * @param - string com a data do vencimento do exercício
 */
function enviaEmailDeConfirmacaoDeExercicioDeFerias($emailColaborador, $inicial, $final, $vencimento)
{
  require_once '../../../../libs/PHPMailer/src/Exception.php';
  require_once '../../../../libs/PHPMailer/src/PHPMailer.php';
  require_once '../../../../libs/PHPMailer/src/SMTP.php';
  
  # chamando função que retorna a folha de estilo do bootstrap
  $style = retornaCssDoBootstrap();

  # verificando se o usuário logado é adilson badaró
  if ($_SESSION['usuario']['id'] == 5) {
    $supervisor = $_SESSION['usuario']['sobrenome'];
  } else {
    $supervisor = $_SESSION['usuario']['nome'] . ' ' . $_SESSION['usuario']['sobrenome'];
  }

  $emailSupervisor = $_SESSION['usuario']['email'];

  $msg = 
    "<!DOCTYPE html>
    <html lang='pt-br'>
      <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <title>Exercício de Férias</title>

        <style>
          $style

          #imagem {
            width: 372px;
            height 134px;
          }
          
          #texto {
            position: absolute;
            margin-top: -190px;
          }

          #observacao {
            color: red;
          }
        </style>
      </head>

      <body>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <h2>Exercício de Férias</h2>
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <p>
                  Foi registrado um novo exercício de férias em seu nome.
                </p>
              </div>
            </div>
          </div>
          
          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <h4>Dados do Exercício</h4>

                <p><strong>Exercício Inicial</strong> em $inicial<p>
                <p><strong>Exercício Final</strong> em $final</p>
                <p><strong>Data Limite</strong> em $vencimento</p>
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <p>
                  Acesse o <strong>Portal Avanção</strong> nas opções <strong>Menu -> Férias -> Pedidos</strong> e faça o agendamento dos dias.
                </p>                
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <p id='observacao'>
                  <strong>Lembrando que, o período permitido para agendamento dos dias será apartir da data do Exerício Final até 30 dias antes da Data Limite.</strong>
                </p>
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>            
                <p>Atte,</p>
                              
                <div style='text-size-adjust: none !important; -ms-text-size-adjust: none !important; -webkit-text-size-adjust: none !important;'>
                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; margin-bottom: 10px;'>
                    <a style='text-decoration:none' href='https://htmlsig.com/t/000001CHE435'>
                      <img src='cid:foto' alt='Avanço Informática' border='0' height='80' width='80'>
                    </a>
                  </p>
                    
                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; color: rgb(33, 33, 33); margin-bottom: 10px;'>
                    <span style='font-weight: bold; color: rgb(33, 33, 33); display: inline;'> $supervisor</span>
                    <span style='display: inline;'>/</span> <span style='color: rgb(33, 33, 33); display: inline;'>Atendimento</span>
                    <span style='display: inline;'><br></span>
                      <a href='mailto: iuri@avancoinfo.com.br' style='color: rgb(71, 124, 204); text-decoration: none; display: inline;'> $emailSupervisor</a>
                    <span style='color: #212121;'></span>
                  </p>

                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; margin-bottom: 10px;'>
                    <span style='font-weight: bold; color: rgb(33, 33, 33); display: inline;'>Avanço Informática</span>
                    <span style='display: inline;'><br></span>
                    <span style='color: rgb(33, 33, 33); display: inline;'>31 3025 1188</span>
                    <span style='color: #212121;'></span>
                    <span style='display: inline;'><br></span> <span style='color: rgb(33, 33, 33); display: inline;'>Avenida Brasil, 131, Santa Efigênia</span>
                    <span style='display: inline;'><br></span> <span style='color: rgb(33, 33, 33); display: inline;'>Belo Horizonte  -  Minas Gerais</span>
                    <span style='display: inline;'><br></span>
                    <a href='http://www.avancoinfo.com.br' style='color: rgb(71, 124, 204); text-decoration: none; display: inline;'>www.avancoinfo.com.br</a>
                  </p>

                  <p style='font-size: 0px; line-height: 0; font-family: Helvetica, Arial, sans-serif;'></p>

                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; margin-bottom: 10px;'>
                    <a href='http://avancoinfo.com.br/'>
                      <img src='cid:tag' alt='avancoinfo.com.br' border='0' height='35' width='300' data-pin-nopin='true'>
                    </a>
                  </p> 

                  <p style='font-family: Helvetica, Arial, sans-serif; color: #212121; font-size: 9px; line-height: 12px;'></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </body>
    </html>";

  $email = new PHPMailer(true);
  $email->CharSet = 'UTF-8';

  try {
    # configurações de servidor
    #$email->SMTPDebug  = 2;
    $email->isSMTP();
    $email->Host       = 'email-ssl.com.br';
    $email->SMTPAuth   = true;
    $email->Username   = 'loja.avancao@avancoinfo.com.br';
    $email->Password   = 'Avanco123';
    $email->SMTPSecure = 'ssl';
    $email->Port       = 465;

    # destinatários
    $email->setFrom($emailSupervisor, 'Avanço | Exercídio Férias');    
    $email->addAddress($emailColaborador);
    $email->addReplyTo($emailSupervisor, 'Respostas');
    #$email->addCC();    
    $email->addAddress('wellington.felix@avancoinfo.com.br');    

    # anexos
    #$email->addAttachment('/var/tmp/file.tar.gz');
    #$email->addAttachment('/tmp/image.jpg', 'new.jpg');

    # conteúdo
    $email->isHTML(true);
    $email->Subject = 'Avanço | Exercício Férias';
    $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/tag-1.jpg', 'tag', 'tag');

    # verificando qual supervisor está logado e importando sua foto correspondente
    switch ($_SESSION['usuario']['id']) {
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
 * envia um e-mail solicitando aprovação do pedido de férias para adilson badaró
 * @param - array com os dados do pedido
 * @param - string com o tipo do período selecionado pelo usuário
 */
function enviaEmailDeSolicitacaoDaAprovacaoDoPedidoDeFerias($pedido, $tipo)
{
  require_once '../../../../libs/PHPMailer/src/Exception.php';
  require_once '../../../../libs/PHPMailer/src/PHPMailer.php';
  require_once '../../../../libs/PHPMailer/src/SMTP.php';
  
  # chamando função que retorna a folha de estilo do bootstrap
  $style = retornaCssDoBootstrap();

  $nome = $_SESSION['usuario']['nome'] . ' ' . $_SESSION['usuario']['sobrenome'];

  $emailColaborador = $_SESSION['usuario']['email'];

  $msg = 
    "<!DOCTYPE html>
    <html lang='pt-br'>
      <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8'>
        <title>Exercício de Férias</title>

        <style>
          $style

          #imagem {
            width: 372px;
            height 134px;
          }
          
          #texto {
            position: absolute;
            margin-top: -190px;
          }

          #observacao {
            color: red;
          }
        </style>
      </head>

      <body>
        <div class='container-fluid'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <h2>Pedido de Férias</h2>
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <p>
                  Foi registrado um novo pedido de férias pelo colaborador(a) <strong>$nome</strong> que aguarda a sua aprovação.
                </p>
              </div>
            </div>
          </div>
          
          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <h4>Dados do Pedido</h4>

                <br>";

                switch ($tipo) {
                  case '1':
                    $pedido['data_inicial'] = formataDataParaExibir($pedido['data_inicial']);
                    $pedido['data_final']   = formataDataParaExibir($pedido['data_final']);

                    $msg .= "
                      <p><strong>1º - Período</strong> {$pedido['data_inicial']} até {$pedido['data_final']} - {$pedido['dias']} dias</p>
                    ";
                  break;

                  case '2':
                    $pedido['periodo1']['data_inicial'] = formataDataParaExibir($pedido['periodo1']['data_inicial']);                    
                    $pedido['periodo1']['data_final']   = formataDataParaExibir($pedido['periodo1']['data_final']);

                    $pedido['periodo2']['data_inicial'] = formataDataParaExibir($pedido['periodo2']['data_inicial']);
                    $pedido['periodo2']['data_final']   = formataDataParaExibir($pedido['periodo2']['data_final']);

                    $msg .= "
                      <p><strong>1º - Período</strong> {$pedido['periodo1']['data_inicial']} até {$pedido['periodo1']['data_final']} - {$pedido['periodo1']['dias']} dias</p>
                      <p><strong>2º - Período</strong> {$pedido['periodo2']['data_inicial']} até {$pedido['periodo2']['data_final']} - {$pedido['periodo2']['dias']} dias</p>
                    ";
                  break;
                  /*
                  case '3':
                    $pedido['periodo1']['data_inicial'] = formataDataParaExibir($pedido['periodo1']['data_inicial']);                    
                    $pedido['periodo1']['data_final']   = formataDataParaExibir($pedido['periodo1']['data_final']);

                    $pedido['periodo2']['data_inicial'] = formataDataParaExibir($pedido['periodo2']['data_inicial']);
                    $pedido['periodo2']['data_final']   = formataDataParaExibir($pedido['periodo2']['data_final']);

                    $pedido['periodo3']['data_inicial'] = formataDataParaExibir($pedido['periodo3']['data_inicial']);
                    $pedido['periodo3']['data_final']   = formataDataParaExibir($pedido['periodo3']['data_final']);

                    $msg .= "
                      <p><strong>1º - Período</strong> {$pedido['periodo1']['data_inicial']} até {$pedido['periodo1']['data_final']} - {$pedido['periodo1']['dias']} dias</p>
                      <p><strong>2º - Período</strong> {$pedido['periodo2']['data_inicial']} até {$pedido['periodo2']['data_final']} - {$pedido['periodo2']['dias']} dias</p>
                      <p><strong>3º - Período</strong> {$pedido['periodo3']['data_inicial']} até {$pedido['periodo3']['data_final']} - {$pedido['periodo3']['dias']} dias</p>
                    ";
                  break;
                  */
                  case '4':
                  case '5':
                    $pedido['periodo1']['data_inicial'] = formataDataParaExibir($pedido['periodo1']['data_inicial']);                    
                    $pedido['periodo1']['data_final']   = formataDataParaExibir($pedido['periodo1']['data_final']);

                    $pedido['periodo2']['data_inicial'] = formataDataParaExibir($pedido['periodo2']['data_inicial']);
                    $pedido['periodo2']['data_final']   = formataDataParaExibir($pedido['periodo2']['data_final']);

                    $msg .= "
                      <p><strong>1º - Período</strong> {$pedido['periodo1']['data_inicial']} até {$pedido['periodo1']['data_final']} - {$pedido['periodo1']['dias']} dias</p>
                      <p><strong>2º - Período</strong> {$pedido['periodo2']['data_inicial']} até {$pedido['periodo2']['data_final']} - {$pedido['periodo2']['dias']} dias</p>
                    ";
                  break;
                }
  
  $msg .= "                
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <p>
                  Acesse o <strong>Portal Avanção</strong> nas opções <strong>Menu -> Férias -> Manifestação</strong> e faça a aprovação do pedido.
                </p>                
              </div>
            </div>
          </div>

          <br>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='text-left'>
                <div style='text-size-adjust: none !important; -ms-text-size-adjust: none !important; -webkit-text-size-adjust: none !important;'>
                  <p style='font-size: 0px; line-height: 0; font-family: Helvetica, Arial, sans-serif;'></p>

                  <p style='font-family: Helvetica, Arial, sans-serif; font-size: 10px; line-height: 12px; margin-bottom: 10px;'>
                    <a href='http://avancoinfo.com.br/'>
                      <img src='cid:tag' alt='avancoinfo.com.br' border='0' height='35' width='300' data-pin-nopin='true'>
                    </a>
                  </p> 

                  <p style='font-family: Helvetica, Arial, sans-serif; color: #212121; font-size: 9px; line-height: 12px;'></p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </body>
    </html>";

  $email = new PHPMailer(true);
  $email->CharSet = 'UTF-8';

  try {
    # configurações de servidor
    #$email->SMTPDebug  = 2;
    $email->isSMTP();
    $email->Host       = 'email-ssl.com.br';
    $email->SMTPAuth   = true;
    $email->Username   = 'loja.avancao@avancoinfo.com.br';
    $email->Password   = 'Avanco123';
    $email->SMTPSecure = 'ssl';
    $email->Port       = 465;

    # destinatários
    $email->setFrom($emailColaborador, 'Avanço | Pedido Férias');    
    $email->addAddress('badaro@avancoinfo.com.br');    
    $email->addReplyTo($emailColaborador, 'Respostas');
    #$email->addCC();
    $email->addAddress('wellington.felix@avancoinfo.com.br');

    # anexos
    #$email->addAttachment('/var/tmp/file.tar.gz');
    #$email->addAttachment('/tmp/image.jpg', 'new.jpg');

    # conteúdo
    $email->isHTML(true);
    $email->Subject = 'Avanço | Pedido Férias';
    $email->AddEmbeddedImage('/var/www/html/avanco/capa/public/img/tag-1.jpg', 'tag', 'tag');

    $email->Body    = $msg;
    $email->AltBody = '';

    $email->send();

    $resultado = true;
  } catch (Exception $e) {
    $resultado = $email->ErrorInfo;
  }

  return $resultado;  
}