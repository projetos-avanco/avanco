<?php

# verificando se foi enviado uma requisição via método POST pelo portal avanço
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';
  require DIRETORIO_MODULES . 'transfer/ticket.php';

  # chamando funções que retornam os modelos de colaboradores e cliente
  $colaboradores = criaModeloDeColaboradores();
  $cliente       = criaModeloDeCliente();

  # recuperando nome do usuário e número do ticket
  $cliente['nome_usuario'] = isset($_POST['cliente']['nome_usuario']) ? $_POST['cliente']['nome_usuario'] : NULL;
  $cliente['ticket']       = isset($_POST['cliente']['ticket'])       ? $_POST['cliente']['ticket']       : NULL;

  # verificando se o número do ticket não foi enviado
  if (! empty($cliente['ticket']) AND ! empty($cliente['nome_usuario'])) {

    # chamanfo função responsável por redirecionar o cliente para o colaborador agendado
    redirecionaParaColaboradorResponsavel($cliente, $colaboradores);

  } else {

    $msg = 'O nome do Usuário ou o Número do Ticket não foi enviado!';

    # retornando mensagem para o portal avanço
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;
  }

}
