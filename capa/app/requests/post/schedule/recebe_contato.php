<?php

# verificando se foi enviado uma requisição via método post
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
  # requisitando script de configurações
  require_once '../../../../init.php';

  $validacao = array(
    'flag'  => false,
    'erros' => array()
  );

  # verificando se o id da empresa foi enviado
  if (!empty($_POST['contato']['id'])) {
    $id = $_POST['contato']['id'];
  }else {
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O Código da Empresa não foi Informado';
  }

  # verificando se o nome do contato não foi enviado
  if (!empty($_POST['contato']['nome'])) {
    $nome = addslashes(mb_strtolower($_POST['contato']['nome'], 'utf-8'));
  } else {    
    $validacao['flag']    = true;
    $validacao['erros'][] = 'O Nome do Contato não foi Informado';
  }

  # verificando se pelo menos um telefone fixo foi enviado
  if (count($_POST['contato']['fixo']) >= 1 && (!empty($_POST['contato']['fixo'][0]))) {
    $_POST['contato']['fixo'] = array_values($_POST['contato']['fixo']);

    for ($i = 0; $i < count($_POST['contato']['fixo']); $i++) {
      # verificando se o(s) telefone(s) fixo(s) são(é) válido(s)
      if (strlen($_POST['contato']['fixo'][$i]) == 14) {
        $fixos[] = $_POST['contato']['fixo'][$i];
      } else {
        $validacao['flag']    = true;
        $validacao['erros'][] = 'Telefone(s) Fixo(s) Inválido(s).';
      }
    }
  } else {    
    $validacao['flag']    = true;
    $validacao['erros'][] = 'Nenhum Telefone Comercial foi Informado';
  }

  # verificando se pelo menos um telefone móvel foi enviado
  if (count($_POST['contato']['movel']) >= 1 && (!empty($_POST['contato']['movel'][0]))) {
    $_POST['contato']['movel'] = array_values($_POST['contato']['movel']);

    for ($i = 0; $i < count($_POST['contato']['movel']); $i++) {
      # verificando se o(s) telefone(s) móvel(eis) são(é) válido(s)
      if (strlen($_POST['contato']['movel'][$i]) == 15) {
        $moveis[] = $_POST['contato']['movel'][$i];
      } else {
        $validacao['flag']    = true;
        $validacao['erros'][] = 'Telefone(s) Movél(eis) Inválido(s).';
      }
    }
  } else {    
    $validacao['flag']    = true;
    $validacao['erros'][] = 'Nenhum Telefone Móvel foi Informado';
  }

  # verificando se pelo menos um endereço de e-mail foi enviado
  if (count($_POST['contato']['email']) >= 1 && (!empty($_POST['contato']['email'][0]))) {
    $_POST['contato']['email'] = array_values($_POST['contato']['email']);
    
    for ($i = 0; $i < count($_POST['contato']['email']); $i++) {
      $email = filter_var($_POST['contato']['email'][$i], FILTER_SANITIZE_EMAIL);

      # verificando se o(s) endereço(s) de e-mail(s) enviado(s) são(é) válido(s)
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emails[] = addslashes(mb_strtolower($email, 'utf-8'));
      } else {
        $validacao['flag']    = true;
        $validacao['erros'][] = 'Endereço(s) de E-mail(s) Inválido(s).';    
      }
    }      
  } else {    
    $validacao['flag']    = true;
    $validacao['erros'][] = 'Nenhum Endereço de E-mail foi Informado';
  }

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );  

  # verificando se houveram erros de validação
  if ($validacao['flag']) {
    # abrindo sessão para guardar os dados do contato
    $_SESSION['contatos'] = array(
      'nome'  => $_POST['contato']['nome'],
      'fixo'  => $_POST['contato']['fixo'],
      'movel' => $_POST['contato']['movel'],
      'email' => $_POST['contato']['email']
    );

    $_SESSION['atividades']['exibe'] = true;

    # repassando mensagens de erros para sessão
    for ($i = 0; $i < count($validacao['erros']); $i++) {
      $_SESSION['atividades']['mensagens'][] = $validacao['erros'][$i];
    }

    # redirecionando usuário para página de contato
    header('Location:' . BASE_URL . 'public/views/schedule/contato.php?id=' . $id); exit;
  } else {
    unset($_SESSION['contatos']);

    # requisitando script
    require_once DIRETORIO_MODULES . 'schedule/modulo_contato.php';
        
    # chamando função responsável por solicitar a inserção dos dados do contato
    recebeContato($id, $nome, $fixos, $moveis, $emails);
  }
}