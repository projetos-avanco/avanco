<?php
  
  require_once '../../../../../init.php';

  # verificando se houve uma requisição via método post
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require_once DIRETORIO_HELPERS . 'diversas.php';
    require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';

    $atrasos = array(
      'id' => null,      
      'supervisor' => null,
      'colaborador' => null,
      'motivo' => null,
      'data' => null,
      'tempo_atraso' => null,
      'observacao' => null,
      'registrado' => null
    );

    $flag = false;

    $erros = array();

    if (!empty($_POST['atrasos']['id'])) {
      if (is_numeric($_POST['atrasos']['id'])) {
        $atrasos['id'] = (int)$_POST['atrasos']['id'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do id do registro está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O id do registro não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['atrasos']['supervisor'])) {
      if (is_numeric($_POST['atrasos']['supervisor'])) {
        $atrasos['supervisor'] = (int)$_POST['atrasos']['supervisor'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do supervisor está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['atrasos']['colaborador'])) {
      if (is_numeric($_POST['atrasos']['colaborador'])) {
        $atrasos['colaborador'] = (int)$_POST['atrasos']['colaborador'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do colaborador está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum colaborador foi selecionado.';
    }

    if (!empty($_POST['atrasos']['motivo'])) {
      if (is_string($_POST['atrasos']['motivo'])) {
        $atrasos['motivo'] = $_POST['atrasos']['motivo'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do motivo está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum motivo foi selecionado.';
    }

    if (!empty($_POST['atrasos']['data'])) {
      if (is_string($_POST['atrasos']['data'])) {
        $atrasos['data'] = $_POST['atrasos']['data'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da data está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma data foi informada.';
    }

    if (!empty($_POST['atrasos']['tempo'])) {
      if (is_string($_POST['atrasos']['tempo'])) {
        $atrasos['tempo_atraso'] = $_POST['atrasos']['tempo'] . ':00';
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados das horas defasadas está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma hora defasada foi informada.';
    }

    if (!empty($_POST['atrasos']['observacao'])) {
      if (is_string($_POST['atrasos']['observacao'])) {
        $atrasos['observacao'] = addslashes(mb_strtolower($_POST['atrasos']['observacao'], 'utf-8'));
        $atrasos['observacao'] = trim(str_replace("\r\n", ' ', $atrasos['observacao']));
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da observação está incorreto.';
      }
    } else {
      $atrasos['observacao'] = '';
    }

    $atrasos['registrado'] = date('Y-m-d H:i:s');

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

      header('location: ' . BASE_URL . 'public/views/schedule/edita_atrasos.php?id=' . $atrasos['id']); exit;
    } else {      
      solicitaAtualizacaoDeRegistro($atrasos, 'atrasos');
    }
  }