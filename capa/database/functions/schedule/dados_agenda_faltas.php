<?php

require_once '../../../init.php';
require_once DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $data = array();

  $db = abre_conexao();

  # verificando se a data inicial e final existem
  if (isset($_GET['start']) && isset($_GET['end'])) {
    # verificando se a data inicial não está vazia e é uma string
    if ((!empty($_GET['start'])) && is_string($_GET['start'])) {
      $data['inicial'] = $_GET['start'];
    }

    # verificando se a data final não está vazia e é uma string
    if (!empty($_GET['end']) && is_string($_GET['end'])) {
      $data['final'] = $_GET['end'];
    }

    # verificando se existe o parâmetro colaboradores e se ele não está vazio
    if (isset($_GET['colaboradores']) && (!empty($_GET['colaboradores']))) {
      # verificando se o parâmetro colaboradores é uma array
      if (is_array($_GET['colaboradores'])) {
        $colaboradores = '';

        # montando string com os id'(s) dos colaboradore(s)
        for ($i = 0; $i < count($_GET['colaboradores']); $i++) {
          $colaboradores .= "f.colaborador = {$_GET['colaboradores'][$i]} OR ";
        }

        # retirando último OR da string
        $colaboradores = rtrim($colaboradores, ' OR ');

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
          WHERE ($colaboradores)
            AND (f.data_inicial BETWEEN '{$data['inicial']}' AND '{$data['final']}' OR f.data_final BETWEEN '{$data['inicial']}' AND '{$data['final']}')
            ORDER BY f.id";
      }
    } else {
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
        WHERE (f.data_inicial BETWEEN '{$data['inicial']}' AND '{$data['final']}' OR f.data_final BETWEEN '{$data['inicial']}' AND '{$data['final']}')
          ORDER BY f.id";
    }    
        
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['arquivo'] = BASE_URL . 'public/files/attestation/' . $linha['arquivo'];

      $linha['observacao'] = ucwords($linha['observacao']);

      $dados[] = array(
        'id'           => $linha['id'],
        'registrado'   => formataDataParaExibir($linha['registrado']),
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'atestado'     => $linha['atestado'],
        'arquivo'      => $linha['arquivo'],
        'periodo'      => formataDataParaExibir($linha['data_inicial']) . ' até ' . formataDataParaExibir($linha['data_final']),        
        'observacao'   => $linha['observacao'],        
        'title'        => mb_strtoupper($linha['colaborador'] . ' - Falta', 'utf-8'),
        'start'        => $linha['data_inicial'] . 'T08:00:00',
        'end'          => $linha['data_final'] . 'T23:59:59'
      );
    }

    echo json_encode($dados);
  }
}