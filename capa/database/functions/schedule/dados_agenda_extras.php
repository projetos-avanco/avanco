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
          $colaboradores .= "e.colaborador = {$_GET['colaboradores'][$i]} OR ";
        }

        # retirando último OR da string
        $colaboradores = rtrim($colaboradores, ' OR ');

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
          e.observacao,
          DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
        FROM av_agenda_extras AS e
        INNER JOIN lh_users AS s
          ON s.id = e.supervisor
        INNER JOIN lh_users AS c
          ON c.id = e.colaborador
        WHERE ($colaboradores)
          AND (e.data BETWEEN '{$data['inicial']}' AND '{$data['final']}')
          ORDER BY e.id";
      }
    } else {
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
          e.observacao,
          DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado
        FROM av_agenda_extras AS e
        INNER JOIN lh_users AS s
          ON s.id = e.supervisor
        INNER JOIN lh_users AS c
          ON c.id = e.colaborador
        WHERE (e.data BETWEEN '{$data['inicial']}' AND '{$data['final']}')
          ORDER BY e.id";
    }

    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['observacao'] = ucwords($linha['observacao']);

      $dados[] = array(
        'id'           => $linha['id'],
        'registro'     => $linha['registro'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'motivo'       => $linha['motivo'],
        'data'         => formataDataParaExibir($linha['data']),
        'tempo_extra'  => $linha['tempo_extra'],        
        'observacao'   => $linha['observacao'],
        'registrado'   => formataDataParaExibir($linha['registrado']),
        'title'        => mb_strtoupper($linha['colaborador'] . ' - Extra', 'utf-8'),
        'start'        => $linha['data'],
        'end'          => $linha['data']
      );
    }

    echo json_encode($dados);
  }
}