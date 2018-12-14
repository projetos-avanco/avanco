<?php

require_once '../../../init.php';
require_once DIRETORIO_HELPERS . 'datas.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $data = array();

  if (isset($_GET['start']) && isset($_GET['end'])) {
    if ((!empty($_GET['start'])) && is_string($_GET['start'])) {
      $data['inicial'] = $_GET['start'];
    }

    if (!empty($_GET['end']) && is_string($_GET['end'])) {
      $data['final'] = $_GET['end'];
    }
    
    $db = abre_conexao();

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
      WHERE (f.data_inicial BETWEEN '{$data['inicial']}' AND '{$data['final']}')
      ORDER BY f.id";
        
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['arquivo'] = BASE_URL . 'public/files/attestation/' . $linha['arquivo'];

      $linha['observacao'] = ucwords($linha['observacao']);

      $dados[] = array(
        'id'           => $linha['id'],
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'atestado'     => $linha['atestado'],
        'arquivo'      => $linha['arquivo'],
        'data_inicial' => formataDataParaExibir($linha['data_inicial']),
        'data_final'   => formataDataParaExibir($linha['data_final']),
        'observacao'   => $linha['observacao'],
        'registrado'   => formataDataParaExibir($linha['registrado']),
        'title'        => mb_strtoupper($linha['motivo'], 'utf-8'),
        'start'        => $linha['data_inicial'],
        'end'          => $linha['data_final']
      );
    }

    echo json_encode($dados);
  }
}