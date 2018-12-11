<?php

require '../../../../../init.php';
require DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $db = abre_conexao();

  # verificando se o usuário da requisição é um supervisor ou um colaborador
  if (isset($_POST['nivel']) && $_POST['nivel'] == '2') {
    $extras = array();

    # verificando se o filtro data inicial foi enviada e não está vazia
    if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $extras['data_inicial'] = $_POST['data_inicial'];
      }      
    }

    # verificando se o filtro data final foi enviada e não está vazia
    if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $extras['data_final'] = $_POST['data_final'];
      }      
    }

    # verificando se o id do colaborador foi enviado
    if (isset($_POST['colaborador'])) {
      # verificando se o id do colaborador é uma string numérica
      if (is_numeric($_POST['colaborador'])) {
        # verificando se o usuário deseja todos os colaboradores
        if ($_POST['colaborador'] === '0') {
          $extras['colaborador'] = '';
        } else {
          $extras['colaborador'] = (int) $_POST['colaborador'];
        }
      }
    }

    # verificando se o filtro motivo foi enviado
    if (isset($_POST['motivo'])) {
      # verificando se motivo é uma string numérica
      if (is_numeric($_POST['motivo'])) {
        # verificando se o usuário deseja todos os motivos
        if ($_POST['motivo'] === '0') {
          $extras['motivo'] = '';
        } else {
          $extras['motivo'] = $_POST['motivo'];
        }
      }      
    }

    $query = 
      "SELECT
        e.id,
        e.registro,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        CASE
          WHEN (e.motivo = 1)
            THEN 'Saiu Mais Tarde'		
        END AS motivo,
        e.data,
        e.tempo_extra,
        TIME_TO_SEC(e.tempo_extra) AS tempo_segundos,
        e.observacao,
        DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_extras AS e
      INNER JOIN lh_users AS s
        ON s.id = e.supervisor
      INNER JOIN lh_users AS c
        ON c.id = e.colaborador
      WHERE (colaborador LIKE '%{$extras['colaborador']}%' AND motivo LIKE '%{$extras['motivo']}%')	
        AND (e.data BETWEEN '{$extras['data_inicial']}' AND '{$extras['data_final']}')
      ORDER BY e.data DESC";
    
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
        'tempo_extra'  => $linha['tempo_extra'],        
        'observacao'   => $linha['observacao'],
        'registrado'   => $linha['registrado'],
        'total_extra'  => $total
      );
    }
    
    echo json_encode($dados); exit;

  } elseif (isset($_POST['nivel']) && $_POST['nivel'] == '1') {

  }
}