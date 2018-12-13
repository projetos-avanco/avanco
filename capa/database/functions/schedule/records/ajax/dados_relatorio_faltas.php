<?php

require '../../../../../init.php';
require DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $db = abre_conexao();
  
  # verificando se o usuário da requisição é um supervisor ou um colaborador
  if (isset($_POST['nivel']) && $_POST['nivel'] == '2') {
    $faltas = array();

    # verificando se o filtro data inicial foi enviada e não está vazia
    if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $faltas['data_inicial'] = $_POST['data_inicial'];
      }      
    }

    # verificando se o filtro data final foi enviada e não está vazia
    if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $faltas['data_final'] = $_POST['data_final'];
      }      
    }

    # verificando se o id do colaborador foi enviado
    if (isset($_POST['colaborador'])) {
      # verificando se o id do colaborador é uma string numérica
      if (is_numeric($_POST['colaborador'])) {
        # verificando se o usuário deseja todos os colaboradores
        if ($_POST['colaborador'] === '0') {
          $faltas['colaborador'] = '';
        } else {
          $faltas['colaborador'] = (int) $_POST['colaborador'];
        }
      }
    }

    # verificando se o filtro motivo foi enviado
    if (isset($_POST['motivo'])) {
      # verificando se motivo é uma string numérica
      if (is_numeric($_POST['motivo'])) {
        # verificando se o usuário deseja todos os motivos
        if ($_POST['motivo'] === '0') {
          $faltas['motivo'] = '';
        } else {
          $faltas['motivo'] = $_POST['motivo'];
        }
      }      
    }

    $query = 
      "SELECT
        f.id,
        f.registro,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (f.motivo = 1)
            THEN 'Descontar o Dia'
          WHEN (f.motivo = 2)
            THEN 'Atestado Médico'
          WHEN (f.motivo = 3)
            THEN 'Atestado de Óbito'
          WHEN (f.motivo = 4)
            THEN 'Atestado de Acompanhamento'
        END AS motivo,
        CASE
          WHEN (f.atestado != '')
            THEN 'Sim'
          ELSE 'Não'
        END AS atestado,
        f.atestado AS arquivo,
        f.data_inicial,
        f.data_final,
        f.observacao,
        DATE_FORMAT(f.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_faltas AS f
      INNER JOIN lh_users AS s
        ON s.id = f.supervisor
      INNER JOIN lh_users AS c
        ON c.id = f.colaborador
      WHERE (colaborador LIKE '%{$faltas['colaborador']}%' AND motivo LIKE '%{$faltas['motivo']}%')	
        AND (f.data_inicial BETWEEN '{$faltas['data_inicial']}' AND '{$faltas['data_final']}')";
    
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['observacao'] = ucwords($linha['observacao']);

      $linha['registrado']   = formataDataParaExibir($linha['registrado']);
      $linha['data_inicial'] = formataDataParaExibir($linha['data_inicial']);
      $linha['data_final']   = formataDataParaExibir($linha['data_final']);

      $linha['arquivo'] = BASE_URL . 'public/files/attestation/' . $linha['arquivo'];
            
      $dados[] = array(
        'id'           => $linha['id'],
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'atestado'     => $linha['atestado'],
        'arquivo'      => $linha['arquivo'],
        'periodo'      => $linha['data_inicial'] . ' até ' . $linha['data_final'],          
        'observacao'   => $linha['observacao'],
        'registrado'   => $linha['registrado']          
      );        
    }

    echo json_encode($dados); exit;
        
  } elseif (isset($_POST['nivel']) && $_POST['nivel'] == '1') {
    $faltas = array();

    # verificando se o id do chat do colaborador foi enviado
    if (isset($_POST['id']) && (!empty($_POST['id']))) {
      # verificando se o id é uma string numérica
      if (is_numeric($_POST['id'])) {
        $faltas['id'] = (int) $_POST['id'];
      }
    }

    # verificando se o filtro data inicial foi enviada e não está vazia
    if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $faltas['data_inicial'] = $_POST['data_inicial'];
      }      
    }

    # verificando se o filtro data final foi enviada e não está vazia
    if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $faltas['data_final'] = $_POST['data_final'];
      }      
    }

    # verificando se o filtro motivo foi enviado
    if (isset($_POST['motivo'])) {
      # verificando se motivo é uma string numérica
      if (is_numeric($_POST['motivo'])) {
        # verificando se o usuário deseja todos os motivos
        if ($_POST['motivo'] === '0') {
          $faltas['motivo'] = '';
        } else {
          $faltas['motivo'] = $_POST['motivo'];
        }
      }      
    }
    
    $query = 
      "SELECT
        f.id,
        f.registro,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (f.motivo = 1)
            THEN 'Descontar o Dia'
          WHEN (f.motivo = 2)
            THEN 'Atestado Médico'
          WHEN (f.motivo = 3)
            THEN 'Atestado de Óbito'
          WHEN (f.motivo = 4)
            THEN 'Atestado de Acompanhamento'
        END AS motivo,
        CASE
          WHEN (f.atestado != '')
            THEN 'Sim'
          ELSE 'Não'
        END AS atestado,
        f.atestado AS arquivo,
        f.data_inicial,
        f.data_final,
        f.observacao,
        DATE_FORMAT(f.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_faltas AS f
      INNER JOIN lh_users AS s
        ON s.id = f.supervisor
      INNER JOIN lh_users AS c
        ON c.id = f.colaborador
      WHERE (colaborador = {$faltas['id']}) 
        AND (motivo LIKE '%{$faltas['motivo']}%')	
        AND (f.data_inicial BETWEEN '{$faltas['data_inicial']}' AND '{$faltas['data_final']}')";
    
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['observacao'] = ucwords($linha['observacao']);

      $linha['registrado']   = formataDataParaExibir($linha['registrado']);
      $linha['data_inicial'] = formataDataParaExibir($linha['data_inicial']);
      $linha['data_final']   = formataDataParaExibir($linha['data_final']);
      
      $linha['arquivo'] = BASE_URL . 'public/files/attestation/' . $linha['arquivo'];

      $dados[] = array(
        'id'           => $linha['id'],
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'atestado'     => $linha['atestado'],
        'arquivo'      => $linha['arquivo'],
        'periodo'      => $linha['data_inicial'] . ' até ' . $linha['data_final'],          
        'observacao'   => $linha['observacao'],
        'registrado'   => $linha['registrado']          
      );        
    }

    echo json_encode($dados); exit;

  }
}