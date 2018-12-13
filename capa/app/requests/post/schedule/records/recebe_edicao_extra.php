<?php

  require_once '../../../../../init.php';

  # verificando se houve uma requisição via método post
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require_once DIRETORIO_HELPERS . 'diversas.php';
    require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';
    
    $extras = array(
      'id' => null,      
      'supervisor' => null,
      'colaborador' => null,
      'motivo' => null,
      'data' => null,
      'tempo_extra' => null,
      'observacao' => null,
      'registrado' => null
    );

    $flag = false;

    $erros = array();

    if (!empty($_POST['extras']['id'])) {
      if (is_numeric($_POST['extras']['id'])) {
        $extras['id'] = (int)$_POST['extras']['id'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do id do registro está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O id do registro não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['extras']['supervisor'])) {
      if (is_numeric($_POST['extras']['supervisor'])) {
        $extras['supervisor'] = (int)$_POST['extras']['supervisor'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do supervisor está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['extras']['colaborador'])) {
      if (is_numeric($_POST['extras']['colaborador'])) {
        $extras['colaborador'] = (int)$_POST['extras']['colaborador'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do colaborador está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum colaborador foi selecionado.';
    }

    if (!empty($_POST['extras']['motivo'])) {
      if (is_string($_POST['extras']['motivo'])) {
        $extras['motivo'] = $_POST['extras']['motivo'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do motivo está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum motivo foi selecionado.';
    }

    if (!empty($_POST['extras']['data'])) {
      if (is_string($_POST['extras']['data'])) {
        $extras['data'] = $_POST['extras']['data'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da data está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma data foi informada.';
    }

    if (!empty($_POST['extras']['tempo'])) {
      if (is_string($_POST['extras']['tempo'])) {
        $extras['tempo_extra'] = $_POST['extras']['tempo'] . ':00';
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados das horas extras está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma hora extra foi informada.';
    }

    if (!empty($_POST['extras']['observacao'])) {
      if (is_string($_POST['extras']['observacao'])) {
        $extras['observacao'] = addslashes(mb_strtolower($_POST['extras']['observacao'], 'utf-8'));
        $extras['observacao'] = trim(str_replace("\r\n", ' ', $extras['observacao']));
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da observação está incorreto.';
      }
    } else {
      $extras['observacao'] = '';
    }

    $extras['registrado'] = date('Y-m-d H:i:s');

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

      header('location: ' . BASE_URL . 'public/views/schedule/edita_extras.php?id=' . $extras['id']); exit;
    } else {
      solicitaAtualizacaoDeRegistro($extras, 'extras');
    }
  }
