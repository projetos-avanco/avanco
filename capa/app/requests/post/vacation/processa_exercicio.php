<?php

require_once '../../../../init.php';
require_once DIRETORIO_HELPERS . 'datas.php';
require_once DIRETORIO_HELPERS . 'diversas.php';
require_once DIRETORIO_MODULES . 'vacation/modulo_exercicio.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $exercicio = array(
    'id' => 0,
    'regime' => null,
    'supervisor' => null,
    'colaborador' => null,
    'status' => 0,
    'exercicio_inicial' => null,
    'exercicio_final' => null,
    'vencimento' => null,
    'registrado' => null
  );

  $flag = false;

  $erros = array();

  if (!empty($_POST['exercicio']['regime'])) {
    if (is_numeric($_POST['exercicio']['regime'])) {
      $exercicio['regime'] = (int)$_POST['exercicio']['regime'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código de regime está incorreto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O código de regime não foi enviado. Informe ao Wellington Felix.';
  }

  if (!empty($_POST['exercicio']['supervisor'])) {
    if (is_numeric($_POST['exercicio']['supervisor'])) {
      $exercicio['supervisor'] = (int)$_POST['exercicio']['supervisor'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código do supervisor está incorreto.';
    }
  } else {
    $flag = true;
    $erros[] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
  }

  if (!empty($_POST['exercicio']['colaborador'])) {
    if (is_numeric($_POST['exercicio']['colaborador'])) {
      $exercicio['colaborador'] = (int)$_POST['exercicio']['colaborador'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do código do colaborador está incorreto.';
    }
  } else {
    $flag = true;
    $erros[] = 'Nenhum colaborador foi selecionado.';
  }

  if (!empty($_POST['exercicio']['inicial'])) {
    if (is_string($_POST['exercicio']['inicial'])) {
      $exercicio['exercicio_inicial'] = $_POST['exercicio']['inicial'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do exercício inicial está incorreto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data do exercício inicial não foi enviada.';
  }

  if (!empty($_POST['exercicio']['final'])) {
    if (is_string($_POST['exercicio']['final'])) {
      $exercicio['exercicio_final'] = $_POST['exercicio']['final'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do exercício final está incorreto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data do exercício final não foi enviada.';
  }

  if (!empty($_POST['exercicio']['vencimento'])) {
    if (is_string($_POST['exercicio']['vencimento'])) {
      $exercicio['vencimento'] = $_POST['exercicio']['vencimento'];
    } else {
      $flag = true;
      $erros[] = 'O tipo de dados do vencimento está incorreto.';
    }
  } else {
    $flag = true;
    $erros[] = 'A data do vencimento não foi enviada.';
  }

  $exercicio['registrado'] = date('Y-m-d H:i:s');

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  if ($flag) {
    $_SESSION['atividades']['exibe'] = true;

    # repassando mensagens de erros para sessão
    for ($i = 0; $i < count($erros); $i++) {
      $_SESSION['atividades']['mensagens'][] = $erros[$i];
    }

    header('location: ' . BASE_URL . 'public/views/vacation/exercicio_ferias.php'); exit;
  } else {
    # chamando função responsável por solicitar a gravação do exercício de férias
    recebeExercicioDeFerias($exercicio);
  }
}