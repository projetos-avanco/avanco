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
        e.id AS id_exercicio,
        p.id AS id_pedido,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(c.name, ' ', c.surname) AS colaborador,
        p.registro,
        CASE
          WHEN (p.situacao = '1')
            THEN 'Aguardando Aprovação'
          WHEN (p.situacao = '2')
            THEN 'Aprovada'
        END AS situacao,
        p.data_inicial,
        p.data_final,
        p.dias,
        p.registrado
      FROM av_agenda_exercicios_ferias AS e
      INNER JOIN av_agenda_pedidos_ferias AS p
        ON p.id_exercicio = e.id
      INNER JOIN lh_users AS s
        ON s.id = e.supervisor
      INNER JOIN lh_users AS c
        ON c.id = e.colaborador
      WHERE (e.status = true)
        AND (p.data_inicial BETWEEN '{$data['inicial']}' AND '{$data['final']}')
      ORDER BY p.id";

    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $dados[] = array(
        'id_exercicio' => $linha['id_exercicio'],
        'id_pedido'    => $linha['id_pedido'],
        'supervisor'   => $linha['supervisor'],
        'colaborador'  => $linha['colaborador'],
        'registro'     => $linha['registro'],                      
        'status'       => $linha['situacao'],        
        'periodo'      => formataDataParaExibir($linha['data_inicial']) . ' até ' . formataDataParaExibir($linha['data_final']),
        'dias'         => $linha['dias'],        
        'registrado'   => formataDataParaExibir($linha['registrado']),        
        'title'        => mb_strtoupper($linha['colaborador'] . ' - Férias - ' . $linha['situacao'], 'utf-8'),
        'start'        => $linha['data_inicial'] . 'T08:00:00',
        'end'          => $linha['data_final'] . 'T23:59:59'
      );
    }

    echo json_encode($dados);
  }
}