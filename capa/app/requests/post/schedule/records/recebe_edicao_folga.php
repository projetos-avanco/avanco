<?php

  require_once '../../../../../init.php';

  # verificando se houve uma requisição via método post
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require_once DIRETORIO_HELPERS . 'diversas.php';
    require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';

    $db = abre_conexao();

    $folgas = array(
      'id' => null,      
      'supervisor' => null,
      'colaborador' => null,
      'motivo' => null,
      'data_inicial' => null,
      'data_final' => null,
      'observacao' => null,
      'registrado' => null
    );

    $flag = false;

    $erros = array();

    if (!empty($_POST['folgas']['id'])) {
      if (is_numeric($_POST['folgas']['id'])) {
        $folgas['id'] = (int) $_POST['folgas']['id'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do id do registro está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O id do registro não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['folgas']['supervisor'])) {
      if (is_numeric($_POST['folgas']['supervisor'])) {
        $folgas['supervisor'] = (int)$_POST['folgas']['supervisor'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do supervisor está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['folgas']['colaborador'])) {
      if (is_numeric($_POST['folgas']['colaborador'])) {
        $folgas['colaborador'] = (int)$_POST['folgas']['colaborador'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do colaborador está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum colaborador foi selecionado.';
    }

    if (!empty($_POST['folgas']['motivo'])) {
      if (is_string($_POST['folgas']['motivo'])) {
        $folgas['motivo'] = $_POST['folgas']['motivo'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do motivo está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum motivo foi selecionado.';
    }

    if (!empty($_POST['folgas']['data-inicial'])) {
      if (is_string($_POST['folgas']['data-inicial'])) {
        $folgas['data_inicial'] = $_POST['folgas']['data-inicial'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da data inicial está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma data inicial foi informada.';
    }

    if (!empty($_POST['folgas']['data-final'])) {
      if (is_string($_POST['folgas']['data-final'])) {
        $folgas['data_final'] = $_POST['folgas']['data-final'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da data final está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma data final foi informada.';
    }

    if (!empty($_POST['folgas']['observacao'])) {
      if (is_string($_POST['folgas']['observacao'])) {
        $folgas['observacao'] = addslashes(mb_strtolower($_POST['folgas']['observacao'], 'utf-8'));
        $folgas['observacao'] = trim(str_replace("\r\n", ' ', $folgas['observacao']));
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da observação está incorreto.';
      }
    } else {
      $folgas['observacao'] = '';
    }

    $folgas['registrado'] = date('Y-m-d H:i:s');

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

      header('location: ' . BASE_URL . 'public/views/schedule/edita_folgas.php?id=' . $folgas['id']); exit;
    } else {
      solicitaAtualizacaoDeRegistro($folgas, 'folgas');
    }
  }