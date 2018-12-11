<?php

require '../../../../../init.php';
require DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $db = abre_conexao();
  
  # verificando se o usuário da requisição é um supervisor ou um colaborador
  if (isset($_POST['nivel']) && $_POST['nivel'] == '2') {
    $folgas = array();

    # verificando se o filtro data inicial foi enviada e não está vazia
    if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $folgas['data_inicial'] = $_POST['data_inicial'];
      }      
    }

    # verificando se o filtro data final foi enviada e não está vazia
    if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $folgas['data_final'] = $_POST['data_final'];
      }      
    }

    # verificando se o id do colaborador foi enviado
    if (isset($_POST['colaborador'])) {
      # verificando se o id do colaborador é uma string numérica
      if (is_numeric($_POST['colaborador'])) {
        # verificando se o usuário deseja todos os colaboradores
        if ($_POST['colaborador'] === '0') {
          $folgas['colaborador'] = '';
        } else {
          $folgas['colaborador'] = (int) $_POST['colaborador'];
        }
      }
    }

    # verificando se o filtro motivo foi enviado
    if (isset($_POST['motivo'])) {
      # verificando se motivo é uma string numérica
      if (is_numeric($_POST['motivo'])) {
        # verificando se o usuário deseja todos os motivos
        if ($_POST['motivo'] === '0') {
          $folgas['motivo'] = '';
        } else {
          $folgas['motivo'] = $_POST['motivo'];
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
            THEN 'Abater Nas Horas'
          WHEN (f.motivo = 2)
            THEN 'Abater Nas Férias'
          WHEN (f.motivo = 3)
            THEN 'Premiação Avanção'
        END AS motivo,
        f.data_inicial,
        f.data_final,
        f.observacao,
        DATE_FORMAT(f.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_folgas AS f
      INNER JOIN lh_users AS s
        ON s.id = f.supervisor
      INNER JOIN lh_users AS c
        ON c.id = f.colaborador
      WHERE (colaborador LIKE '%{$folgas['colaborador']}%' AND motivo LIKE '%{$folgas['motivo']}%')	
        AND (f.data_inicial BETWEEN '{$folgas['data_inicial']}' AND '{$folgas['data_final']}')";
    
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['observacao'] = ucwords($linha['observacao']);

      $linha['registrado']   = formataDataParaExibir($linha['registrado']);
      $linha['data_inicial'] = formataDataParaExibir($linha['data_inicial']);
      $linha['data_final']   = formataDataParaExibir($linha['data_final']);
      
      $dados[] = array(
        'id'           => $linha['id'],
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'periodo'      => $linha['data_inicial'] . ' até ' . $linha['data_final'],          
        'observacao'   => $linha['observacao'],
        'registrado'   => $linha['registrado']          
      );        
    }

    echo json_encode($dados); exit;

  } elseif (isset($_POST['nivel']) && $_POST['nivel'] == '1') {

  }
}