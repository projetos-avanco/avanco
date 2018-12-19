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
        DISTINCT
          a.id,
          a.registro,
          r.cnpj,
          r.razao_social AS empresa,
          CONCAT(s.name, ' ', s.surname) AS supervisor,
          CONCAT(o.name, ' ', o.surname) AS colaborador,
          CASE 
            WHEN (a.tipo = 1)
              THEN 'Suporte ao Cliente'
            WHEN (a.tipo = 2)
              THEN 'Projeto Mais Gestão'
            WHEN (a.tipo = 3)
              THEN 'Implantação'
            WHEN (a.tipo = 4)
              THEN 'Treinamento Avanço'
            WHEN (a.tipo = 5)
              THEN 'Instalação'
            WHEN (a.tipo = 6)
              THEN 'Atualização'
          END AS tipo,
          c.nome AS contato,
          e.endereco AS email,
          f.fixo,
          m.movel,          
          a.data,
          a.horario,          
          CASE
            WHEN (a.produto = 1)
              THEN 'Integral'
            WHEN (a.produto = 2)
              THEN 'Frente Avanço'
            WHEN (a.produto = 3)
              THEN 'Gestor'
            WHEN (a.produto = 4)
              THEN 'Novo ERP'
            WHEN (a.produto = 5)
              THEN 'Outros'
          END AS produto,
          a.observacao,
          CASE
            WHEN (a.status = 1)
              THEN 'Pendente'
            WHEN (a.status = 2)
              THEN 'Confirmada'
            WHEN (a.status = 3)
              THEN 'Cancelada'
          END AS status,
          DATE_FORMAT(a.registrado, '%Y-%m-%d') AS registrado
      FROM av_agenda_atendimentos_remotos AS a
      INNER JOIN lh_users AS s
        ON s.id = a.supervisor
      INNER JOIN lh_users AS o
        ON o.id = a.colaborador
      INNER JOIN av_agenda_cnpjs AS r
        ON r.id = a.id_cnpj
      INNER JOIN av_agenda_contatos AS c
        ON c.id = a.id_contato
      INNER JOIN av_agenda_emails AS e
        ON e.id_contato = c.id
      INNER JOIN av_agenda_telefones_fixos AS f
        ON f.id_contato = c.id
      INNER JOIN av_agenda_telefones_moveis AS m
        ON m.id_contato = c.id      
      WHERE (a.data BETWEEN '{$data['inicial']}' AND '{$data['final']}')
        GROUP BY a.registro
        ORDER BY a.id";
        
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {
      $linha['cnpj']     = substr($linha['cnpj'], 0, 2) . '.'. substr($linha['cnpj'], 2, 3) . '.' . substr($linha['cnpj'], 5, 3) . '/' . substr($linha['cnpj'], 8, 4) . '-' . substr($linha['cnpj'], 12, 2);

      $linha['empresa']    = strtoupper($linha['empresa']);
      $linha['contato']    = ucwords($linha['contato']);      
      $linha['observacao'] = ucwords($linha['observacao']);

      $dados[] = array(
        'id'         => $linha['id'],
        'registro'   => $linha['registro'],
        'cnpj'       => $linha['cnpj'],
        'empresa'    => $linha['empresa'],
        'supervisor' => $linha['supervisor'],
        'colaborador'=> $linha['colaborador'],
        'tipo'       => $linha['tipo'],
        'contato'    => $linha['contato'],
        'email'      => $linha['email'],
        'fixo'       => $linha['fixo'],
        'movel'      => $linha['movel'],        
        'data'       => formataDataParaExibir($linha['data']) . ' às ' . $linha['horario'],
        'produto'    => $linha['produto'],
        'observacao' => $linha['observacao'],
        'registrado' => formataDataParaExibir($linha['registrado']),
        'status'     => $linha['status'],        
        'title'      => strtoupper('Atendimento Remoto'),
        'start'      => $linha['data'],
        'end'        => $linha['data']
      );
    }

    echo json_encode($dados);
  }
}