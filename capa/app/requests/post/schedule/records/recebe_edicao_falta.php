<?php
  require_once '../../../../../init.php';

  # verificando se houve uma requisição via método post
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once DIRETORIO_HELPERS . 'diversas.php';
    require_once DIRETORIO_MODULES . 'schedule/modulo_registros.php';

    $faltas = array(
      'id' => null,
      'registro' => null,
      'supervisor' => null,
      'colaborador' => null,
      'motivo' => null,
      'atestado' => null,
      'data_inicial' => null,
      'data_final' => null,
      'observacao' => null,
      'registrado' => null,
      'alterar-atestado' => false
    );

    $flag = false;

    $erros = array();

    if (!empty($_POST['faltas']['id'])) {
      if (is_numeric($_POST['faltas']['id'])) {
        $faltas['id'] = (int) $_POST['faltas']['id'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do id do registro está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O id do registro não foi enviado. Informe ao Wellington Felix.';
    }

    $faltas['registro'] = $_POST['faltas']['registro'];

    if (!empty($_POST['faltas']['supervisor'])) {
      if (is_numeric($_POST['faltas']['supervisor'])) {
        $faltas['supervisor'] = (int)$_POST['faltas']['supervisor'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do supervisor está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'O código do supervisor não foi enviado. Informe ao Wellington Felix.';
    }

    if (!empty($_POST['faltas']['colaborador'])) {
      if (is_numeric($_POST['faltas']['colaborador'])) {
        $faltas['colaborador'] = (int)$_POST['faltas']['colaborador'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do código do colaborador está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum colaborador foi selecionado.';
    }

    if (!empty($_POST['faltas']['motivo'])) {
      if (is_string($_POST['faltas']['motivo'])) {
        $faltas['motivo'] = $_POST['faltas']['motivo'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados do motivo está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhum motivo foi selecionado.';
    }

    # verificando se foi selecionado algum motivo que obriga o envio de algum arquivo em anexo
    if ($_POST['faltas']['motivo'] == '2' || $_POST['faltas']['motivo'] == '3' || $_POST['faltas']['motivo'] == '4') {
      # verificando se foi solicitado a alteração do arquivo em anexo
      if (isset($_POST['faltas']['alterar-atestado']) && $_POST['faltas']['alterar-atestado'] == '1') {
        # criando o path do arquivo
        $target = ABS_PATH . 'public/files/attestation/reg-' . $faltas['registro'] . '-' . strtolower($_FILES['atestado']['name']);

        # verificando se o arquivo em anexo é de extensão .png, .jpeg ou .pdf
        if ($_FILES['atestado']['type'] == 'image/jpeg' || $_FILES['atestado']['type'] == 'image/png' || $_FILES['atestado']['type'] == 'application/pdf') {
          # verificando se o tamanho do arquivo em anexo é menor ou igual a 1MB
          if ($_FILES['atestado']['size'] <= 1048576) {
            # verificando se o arquivo em anexo foi movido para o diretório files
            if (move_uploaded_file($_FILES['atestado']['tmp_name'], $target)) {
              $faltas['atestado'] = 'reg-' . $faltas['registro'] . '-' . strtolower($_FILES['atestado']['name']);
              $faltas['alterar-atestado'] = true;
            } else {
              $flag = true;
              $erros[] = 'Erro ao mover o arquivo em anexo para o diretório files/. Informe ao Wellington Felix';
            }
          } else {
            $flag = true;
            $erros[] = 'O arquivo em anexo deve ter o tamanho máximo de 1MB.';
          }
        } else {
          $flag = true;
          $erros[] = 'O arquivo em anexo não foi enviado ou tipo do arquivo é incorreto. O arquivo deve ser do tipo .png, .jpeg ou .pdf.';
        }
      } elseif (!isset($_POST['faltas']['alterar-atestado'])) {
        # criando o path do arquivo
        $target = ABS_PATH . 'public/files/attestation/reg-' . $faltas['registro'] . '-' . strtolower($_FILES['atestado']['name']);

        # verificando se o arquivo em anexo é de extensão .png, .jpeg ou .pdf
        if ($_FILES['atestado']['type'] == 'image/jpeg' || $_FILES['atestado']['type'] == 'image/png' || $_FILES['atestado']['type'] == 'application/pdf') {
          # verificando se o tamanho do arquivo em anexo é menor ou igual a 1MB
          if ($_FILES['atestado']['size'] <= 1048576) {
            # verificando se o arquivo em anexo foi movido para o diretório files
            if (move_uploaded_file($_FILES['atestado']['tmp_name'], $target)) {
              $faltas['atestado'] = 'reg-' . $faltas['registro'] . '-' . strtolower($_FILES['atestado']['name']);
              $faltas['alterar-atestado'] = true;              
            } else {
              $flag = true;
              $erros[] = 'Erro ao mover o arquivo em anexo para o diretório files/. Informe ao Wellington Felix';
            }
          } else {
            $flag = true;
            $erros[] = 'O arquivo em anexo deve ter o tamanho máximo de 1MB.';
          }
        } else {
          $flag = true;
          $erros[] = 'O arquivo em anexo não foi enviado ou tipo do arquivo é incorreto. O arquivo deve ser do tipo .png, .jpeg ou .pdf.';
        }
      }     
    }

    if (!empty($_POST['faltas']['data-inicial'])) {
      if (is_string($_POST['faltas']['data-inicial'])) {
        $faltas['data_inicial'] = $_POST['faltas']['data-inicial'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da data inicial está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma data inicial foi informada.';
    }

    if (!empty($_POST['faltas']['data-final'])) {
      if (is_string($_POST['faltas']['data-final'])) {
        $faltas['data_final'] = $_POST['faltas']['data-final'];
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da data final está incorreto.';
      }
    } else {
      $flag = true;
      $erros[] = 'Nenhuma data final foi informada.';
    }

    if (!empty($_POST['faltas']['observacao'])) {
      if (is_string($_POST['faltas']['observacao'])) {
        $faltas['observacao'] = addslashes(mb_strtolower($_POST['faltas']['observacao'], 'utf-8'));
        $faltas['observacao'] = trim(str_replace("\r\n", ' ', $faltas['observacao']));
      } else {
        $flag = true;
        $erros[] = 'O tipo de dados da observação está incorreto.';
      }
    } else {
      $faltas['observacao'] = '';
    }

    $faltas['registrado'] = date('Y-m-d H:i:s');

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

      header('location: ' . BASE_URL . 'public/views/schedule/edita_faltas.php?id=' . $faltas['id']); exit;
    } else {
      solicitaAtualizacaoDeRegistro($faltas, 'faltas');
    }
  }