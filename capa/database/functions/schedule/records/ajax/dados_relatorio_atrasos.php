<?php

require '../../../../../init.php';
require DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $db = abre_conexao();

  # verificando se o usuário da requisição é um supervisor ou um colaborador
  if (isset($_POST['nivel']) && $_POST['nivel'] == '2') {
    $atrasos = array();

    # verificando se o filtro data inicial foi enviada e não está vazia
    if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $atrasos['data_inicial'] = $_POST['data_inicial'];
      }      
    }

    # verificando se o filtro data final foi enviada e não está vazia
    if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $atrasos['data_final'] = $_POST['data_final'];
      }      
    }

    # verificando se o id do colaborador foi enviado
    if (isset($_POST['colaborador'])) {
      # verificando se o id do colaborador é uma string numérica
      if (is_numeric($_POST['colaborador'])) {
        # verificando se o usuário deseja todos os colaboradores
        if ($_POST['colaborador'] === '0') {
          $atrasos['colaborador'] = '';
        } else {
          $atrasos['colaborador'] = (int) $_POST['colaborador'];
        }
      }
    }

    # verificando se o filtro motivo foi enviado
    if (isset($_POST['motivo'])) {
      # verificando se motivo é uma string numérica
      if (is_numeric($_POST['motivo'])) {
        # verificando se o usuário deseja todos os motivos
        if ($_POST['motivo'] === '0') {
          $atrasos['motivo'] = '';
        } else {
          $atrasos['motivo'] = $_POST['motivo'];
        }
      }      
    }

    $query = 
      "SELECT
        a.id,
        a.registro,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (a.motivo = 1)
            THEN 'Saiu Mais Cedo'
          WHEN (a.motivo = 2)
            THEN 'Chegou Mais Tarde'		
        END AS motivo,
        a.data,
        a.tempo_atraso,
        TIME_TO_SEC(a.tempo_atraso) AS tempo_segundos,
        a.observacao,
        DATE_FORMAT(a.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_atrasos AS a
      INNER JOIN lh_users AS s
        ON s.id = a.supervisor
      INNER JOIN lh_users AS c
        ON c.id = a.colaborador
      WHERE (colaborador LIKE '%{$atrasos['colaborador']}%' AND motivo LIKE '%{$atrasos['motivo']}%')	
        AND (a.data BETWEEN '{$atrasos['data_inicial']}' AND '{$atrasos['data_final']}')
      ORDER BY a.data DESC";
    
    $resultado = mysqli_query($db, $query);

    $dados = array();
    $total = 0;

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['observacao'] = ucwords($linha['observacao']);

      $linha['registrado']   = formataDataParaExibir($linha['registrado']);
      $linha['data'] = formataDataParaExibir($linha['data']);      
      
      $total += $linha['tempo_segundos'];

      $dados[] = array(
        'id'           => $linha['id'],
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'data'         => $linha['data'],
        'tempo_atraso' => $linha['tempo_atraso'],        
        'observacao'   => $linha['observacao'],
        'registrado'   => $linha['registrado'],
        'total_atraso' => $total
      );
    }

    echo json_encode($dados); exit;

  } elseif (isset($_POST['nivel']) && $_POST['nivel'] == '1') {
    $atrasos = array();

    # verificando se o id do chat do colaborador foi enviado
    if (isset($_POST['id']) && (!empty($_POST['id']))) {
      # verificando se o id é uma string numérica
      if (is_numeric($_POST['id'])) {
        $atrasos['id'] = (int) $_POST['id'];
      }
    }

    # verificando se o filtro data inicial foi enviada e não está vazia
    if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $atrasos['data_inicial'] = $_POST['data_inicial'];
      }      
    }

    # verificando se o filtro data final foi enviada e não está vazia
    if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $atrasos['data_final'] = $_POST['data_final'];
      }      
    }

    # verificando se o filtro motivo foi enviado
    if (isset($_POST['motivo'])) {
      # verificando se motivo é uma string numérica
      if (is_numeric($_POST['motivo'])) {
        # verificando se o usuário deseja todos os motivos
        if ($_POST['motivo'] === '0') {
          $atrasos['motivo'] = '';
        } else {
          $atrasos['motivo'] = $_POST['motivo'];
        }
      }      
    }
    
    $query = 
      "SELECT
        a.id,
        a.registro,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (a.motivo = 1)
            THEN 'Saiu Mais Cedo'
          WHEN (a.motivo = 2)
            THEN 'Chegou Mais Tarde'		
        END AS motivo,
        a.data,
        a.tempo_atraso,
        TIME_TO_SEC(a.tempo_atraso) AS tempo_segundos,
        a.observacao,
        DATE_FORMAT(a.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_atrasos AS a
      INNER JOIN lh_users AS s
        ON s.id = a.supervisor
      INNER JOIN lh_users AS c
        ON c.id = a.colaborador
      WHERE (colaborador = {$atrasos['id']}) 
        AND (motivo LIKE '%{$atrasos['motivo']}%')	
        AND (a.data BETWEEN '{$atrasos['data_inicial']}' AND '{$atrasos['data_final']}')
      ORDER BY a.data DESC";
    
    $resultado = mysqli_query($db, $query);

    $dados = array();
    $total = 0;

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['observacao'] = ucwords($linha['observacao']);

      $linha['registrado']   = formataDataParaExibir($linha['registrado']);
      $linha['data'] = formataDataParaExibir($linha['data']);      
      
      $total += $linha['tempo_segundos'];

      $dados[] = array(
        'id'           => $linha['id'],
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'data'         => $linha['data'],
        'tempo_atraso' => $linha['tempo_atraso'],        
        'observacao'   => $linha['observacao'],
        'registrado'   => $linha['registrado'],
        'total_atraso' => $total
      );
    }

    echo json_encode($dados); exit;

  }
}