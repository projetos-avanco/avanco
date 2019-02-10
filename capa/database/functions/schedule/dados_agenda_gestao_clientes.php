<?php

require_once '../../../init.php';
require_once DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método get
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['evento'] == 'true') {  
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
          $colaboradores .= "a.colaborador = {$_GET['colaboradores'][$i]} OR ";
        }

        # retirando último OR da string
        $colaboradores = rtrim($colaboradores, ' OR ');

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
                  THEN 'Visita de Relacionamento'
                WHEN (a.tipo = 2)
                  THEN 'Ligação para o Dono'
                WHEN (a.tipo = 3)
                  THEN 'Envio de E-mail'
              END AS tipo,
              c.nome AS contato,
              e.endereco AS email,
              f.fixo,
              m.movel,
              CONCAT(n.logradouro, ' ', n.numero, ' ', n.complemento, ' ', n.referencia, ' ', b.distrito, ' ', n.cep, ' ', d.localidade, ' ', t.uf) AS endereco,
              a.data_inicial,
              a.data_final,
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
                  THEN 'Confirmado'
                WHEN (a.status = 2)
                  THEN 'À Confirmar'
                WHEN (a.status = 3)
                  THEN 'Reservado'                
              END AS status,
              DATE_FORMAT(a.registrado, '%Y-%m-%d') AS registrado
          FROM av_agenda_atendimentos_gestao_clientes AS a
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
          INNER JOIN av_agenda_enderecos AS n
            ON n.id_cnpj = r.id
          INNER JOIN av_agenda_bairros AS b
            ON b.id = n.id_bairro
          INNER JOIN av_agenda_cidades AS d
            ON d.id = b.id_cidade
          INNER JOIN av_agenda_estados AS t
            ON t.id = d.id_estado
          WHERE ($colaboradores)
            AND NOT (a.status = 4)
            AND (a.data_inicial BETWEEN '{$data['inicial']}' AND '{$data['final']}')
          GROUP BY a.registro
          ORDER BY a.id";
      }
    } else {
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
                THEN 'Visita de Relacionamento'
              WHEN (a.tipo = 2)
                THEN 'Ligação para o Dono'
              WHEN (a.tipo = 3)
                THEN 'Envio de E-mail'
            END AS tipo,
            c.nome AS contato,
            e.endereco AS email,
            f.fixo,
            m.movel,
            CONCAT(n.logradouro, ' ', n.numero, ' ', n.complemento, ' ', n.referencia, ' ', b.distrito, ' ', n.cep, ' ', d.localidade, ' ', t.uf) AS endereco,
            a.data_inicial,
            a.data_final,
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
                THEN 'Confirmado'
              WHEN (a.status = 2)
                THEN 'À Confirmar'
              WHEN (a.status = 3)
                THEN 'Reservado'              
            END AS status,
            DATE_FORMAT(a.registrado, '%Y-%m-%d') AS registrado
        FROM av_agenda_atendimentos_gestao_clientes AS a
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
        INNER JOIN av_agenda_enderecos AS n
          ON n.id_cnpj = r.id
        INNER JOIN av_agenda_bairros AS b
          ON b.id = n.id_bairro
        INNER JOIN av_agenda_cidades AS d
          ON d.id = b.id_cidade
        INNER JOIN av_agenda_estados AS t
          ON t.id = d.id_estado
        WHERE NOT (a.status = 4)
          AND (a.data_inicial BETWEEN '{$data['inicial']}' AND '{$data['final']}')
        GROUP BY a.registro
        ORDER BY a.id";
    }

    $resultado = mysqli_query($db, $query);

      $dados = array();

      while ($linha = mysqli_fetch_array($resultado)) {
        $linha['cnpj']     = substr($linha['cnpj'], 0, 2) . '.'. substr($linha['cnpj'], 2, 3) . '.' . substr($linha['cnpj'], 5, 3) . '/' . substr($linha['cnpj'], 8, 4) . '-' . substr($linha['cnpj'], 12, 2);
        $linha['empresa']    = strtoupper($linha['empresa']);

        $linha['contato']    = ucwords($linha['contato']);
        $linha['endereco']   = ucwords($linha['endereco']);
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
          'endereco'   => $linha['endereco'],
          'periodo'    => formataDataParaExibir($linha['data_inicial']) . ' até ' . formataDataParaExibir($linha['data_final']) . ' às ' . $linha['horario'],
          'produto'    => $linha['produto'],
          'observacao' => $linha['observacao'],
          'registrado' => formataDataParaExibir($linha['registrado']),
          'status'     => $linha['status'],
          'title'      => mb_strtoupper($linha['colaborador'] . ' - Gestão Clientes', 'utf-8'),
          'start'      => $linha['data_inicial'] . 'T' . $linha['horario'],
          'end'        => $linha['data_final'] . 'T23:59:59'
        );
      } 

    echo json_encode($dados);
  }
} else {
  $dados = array();

  echo json_encode($dados);
}