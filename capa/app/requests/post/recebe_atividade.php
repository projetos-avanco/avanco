<?php

  require '../../../init.php';

  # verificando se existe uma requisição via método POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['atividades'] = array();

    if (empty($_POST['colaborador']) || empty($_POST['atividade'])) {
      $_SESSION['mensagens']['mensagem'] = 'Você se esqueceu de selecionar o colaborador ou a atividade';
      $_SESSION['mensagens']['tipo']     = 'warning';
      $_SESSION['mensagens']['exibe']    = true;

      header('Location: ' . BASE_URL . 'public/views/schedule/tela_inicial.php');
      die;
    }

    # verificando se o id do colaborador e o id da atividade foram enviados
    if (isset($_POST['colaborador']) && (isset($_POST['atividade']) && $_POST['atividade'] > 0)) {
      $_SESSION['mensagens']['mensagem'] = '';
      $_SESSION['mensagens']['tipo']     = '';
      $_SESSION['mensagens']['exibe']    = false;

      # gravando id do colaborador na sessão
      $_SESSION['atividades']['colaborador'] = $_POST['colaborador'];
      
      # verificando qual atividade o usuário deseja realizar
      switch ($_POST['atividade']) {
        case '1':
          echo 'Atendimento Externo';
          break;

        case '2':
          echo 'Atendimento Remoto';
          break;

        case '3':
          echo 'Registro de Folgas';
          break;

        case '4':
          echo 'Registro de Faltas';
          break;

        case '5':
          echo 'Registros de Atrasos';
          break;

        case '6':
          echo 'Registros de Extras';
          break;

        case '7':
          echo 'Registros de Férias';
          break;
      }
    }
  }
