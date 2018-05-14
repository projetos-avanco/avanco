<?php

# verificando se existe uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  require '../../../init.php';
  require DIRETORIO_MODULES . 'tickets/modulo_tickets.php';
  require DIRETORIO_HELPERS . 'diversas.php';

  $ticket = array(

    'ticket'      => '',
    'colaborador' => '',
    'agendado'    => '',
    'produto'     => '',
    'modulo'      => '',
    'assunto'     => '',
    'contato'     => '',
    'telefone'    => ''

  );

  # recuperando o número do ticket
  $ticket['ticket'] = $_POST['ticket']['ticket'];
  settype($ticket['ticket'], 'integer');

  # validando colaborador
  if (isset($_POST['ticket']['colaborador']) && is_numeric($_POST['ticket']['colaborador']) && ! empty($_POST['ticket']['colaborador'])) {

    $ticket['colaborador'] = $_POST['ticket']['colaborador'];
    settype($ticket['colaborador'], 'integer');

  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'O colaborador não foi enviado, não é um número ou o campo foi enviado vazio');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

  # validando agendamento
  if (isset($_POST['ticket']['data-agendada']) && ! empty($_POST['ticket']['data-agendada'])) {

    if (isset($_POST['ticket']['hora-agendada']) && ! empty($_POST['ticket']['hora-agendada'])) {

      $ticket['agendado'] = $_POST['ticket']['data-agendada'] . ' ' . $_POST['ticket']['hora-agendada'];

    } else {

      gravaMensagemNaSessao('danger', true, 'Ops', 'A hora agendada não foi enviada');

      redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

    }

  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'A data agendada não foi enviada');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

  # validando produto
  if (isset($_POST['ticket']['produto']) && is_numeric($_POST['ticket']['produto']) && ! empty($_POST['ticket']['produto'])) {

    $ticket['produto'] = $_POST['ticket']['produto'];
    settype($ticket['produto'], 'integer');

  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'O produto não foi enviado, não é um número ou o campo foi enviado vazio');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

  # validando módulo
  if (isset($_POST['ticket']['modulo']) && is_numeric($_POST['ticket']['modulo']) && ! empty($_POST['ticket']['modulo'])) {

    $ticket['modulo'] = $_POST['ticket']['modulo'];
    settype($ticket['modulo'], 'integer');

  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'O módulo não foi enviado, não é um número ou o campo foi enviado vazio');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

  # validando assunto
  if (isset($_POST['ticket']['assunto']) && is_string($_POST['ticket']['assunto']) && ! empty($_POST['ticket']['assunto'])) {

    $ticket['assunto'] = $_POST['ticket']['assunto'];

  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'O assunto não foi enviado, não é um texto ou o campo foi enviado vazio');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

  # validando contato
  if (isset($_POST['ticket']['contato']) && is_string($_POST['ticket']['contato']) && ! empty($_POST['ticket']['contato'])) {

    $ticket['contato'] = $_POST['ticket']['contato'];

  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'O contato não foi enviado, não é um texto ou o campo foi enviado vazio');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

  if (isset($_POST['ticket']['telefone']) && is_string($_POST['ticket']['telefone']) && $_POST['ticket']['telefone'] != '') {

    $ticket['telefone'] = $_POST['ticket']['telefone'];
    
  } else {

    gravaMensagemNaSessao('danger', true, 'Ops', 'O telefone não foi enviado, não é um texto ou o campo foi enviado vazio');

    redirecionaUsuarioParaEdicaoDeTickets($db, $_POST['ticket']['ticket']);

  }

  # chamando função responsável por alterar os dados de um ticket
  alteraTicket($ticket);
}