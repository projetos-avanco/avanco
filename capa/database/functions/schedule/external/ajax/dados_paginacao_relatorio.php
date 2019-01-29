<?php

require '../../../../../init.php';
require DIRETORIO_HELPERS . 'datas.php';

# verificando se houve uma requisição via método post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $db = abre_conexao();

  # verificando se a requisição foi feita pela página de relatório do dia
  if (isset($_POST['data_inicial']) && $_POST['data_final'] && sizeof($_POST) == 2) {
    $gerencial = array();

    # verificando se o filtro data inicial foi enviada e não está vazia
    if (isset($_POST['data_inicial']) && (!empty($_POST['data_inicial']))) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $gerencial['data_inicial'] = $_POST['data_inicial'];
      }      
    }

    # verificando se o filtro data final foi enviada e não está vazia
    if (isset($_POST['data_final']) && (!empty($_POST['data_final']))) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $gerencial['data_final'] = $_POST['data_final'];
      }      
    }

    $query = 
      "SELECT
        e.id,
        e.id_contato,
        e.id_cnpj,
        e.id_issue,
        x.id AS id_pesquisa,
        e.registro,
        CASE
          WHEN (e.status = 1)
            THEN 'Confirmado'
          WHEN (e.status = 2)
            THEN 'À Confirmar'
          WHEN (e.status = 3)
            THEN 'Reservado'
          WHEN (e.status = 4)
            THEN 'Cancelado'
        END AS status,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(t.name, ' ', t.surname) AS colaborador,	
        CASE 
          WHEN (e.tipo = 1)
            THEN 'Suporte ao Cliente'
          WHEN (e.tipo = 2)
            THEN 'Projeto Mais Gestão'
          WHEN (e.tipo = 3)
            THEN 'Implantação'
          WHEN (e.tipo = 4)
            THEN 'Treinamento Avanço'
          WHEN (e.tipo = 5)
            THEN 'Instalação'
          WHEN (e.tipo = 6)
            THEN 'Atualização'
        END AS tipo,
        r.razao_social AS empresa,
        r.cnpj,
        c.nome AS contato,
        DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado,
        e.data_inicial,
        e.data_final,
        CASE
          WHEN (e.produto = 1)
            THEN 'Integral'
          WHEN (e.produto = 2)
            THEN 'Frente Avanço'
          WHEN (e.produto = 3)
            THEN 'Gestor'
          WHEN (e.produto = 4)
            THEN 'Novo ERP'
          WHEN (e.produto = 5)
            THEN 'Outros'
        END AS produto,
        e.observacao,
        CASE
          WHEN (e.faturado = false)
            THEN 'Não'
          WHEN (e.faturado = true)
            THEN 'Sim'
        END AS faturado,
        CASE
          WHEN (e.despesa = false)
            THEN 'Não'
          WHEN (e.despesa = true)
            THEN 'Sim'
        END AS despesa,
        CASE
          WHEN (i.status = 1)
            THEN 'Não'
          WHEN (i.status = 2)
            THEN 'Sim'
        END AS relatorio_entregue,
        CASE
          WHEN (x.status = 1)
            THEN 'Não'
          WHEN (x.status = 2)
            THEN 'Sim'
        END AS pesquisa_realizada
      FROM av_agenda_atendimentos_externos AS e       
      INNER JOIN av_agenda_cnpjs AS r
        ON r.id = e.id_cnpj
      INNER JOIN lh_users AS s
        ON s.id = e.supervisor
      INNER JOIN lh_users AS t
        ON t.id = e.colaborador
      INNER JOIN av_agenda_contatos AS c
        ON c.id = e.id_contato
      LEFT JOIN av_registro_horas_issues AS i
        ON i.id = e.id_issue
      LEFT JOIN av_agenda_pesquisas_externas AS x
        ON x.id = e.id
      WHERE (e.data_inicial BETWEEN '{$gerencial['data_inicial']}' AND '{$gerencial['data_final']}')";
    
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {        
      $linha['cnpj']     = substr($linha['cnpj'], 0, 2) . '.'. substr($linha['cnpj'], 2, 3) . '.' . substr($linha['cnpj'], 5, 3) . '/' . substr($linha['cnpj'], 8, 4) . '-' . substr($linha['cnpj'], 12, 2);
      $linha['contato'] = ucwords($linha['contato']);
      $linha['observacao'] = ucwords($linha['observacao']);

      $linha['registrado']   = formataDataParaExibir($linha['registrado']);
      $linha['data_inicial'] = formataDataParaExibir($linha['data_inicial']);
      $linha['data_final']   = formataDataParaExibir($linha['data_final']);
      
      $dados[] = array(
        'id'                 => $linha['id'],
        'id_contato'         => $linha['id_contato'],
        'id_cnpj'            => $linha['id_cnpj'],
        'id_issue'           => $linha['id_issue'],
        'issue'              => null,
        'id_pesquisa'        => $linha['id_pesquisa'],
        'registro'           => $linha['registro'],
        'status'             => $linha['status'],
        'supervisor'         => $linha['supervisor'],
        'colaborador'        => $linha['colaborador'],
        'tipo'               => $linha['tipo'],
        'empresa'            => $linha['empresa'],
        'cnpj'               => $linha['cnpj'],
        'contato'            => $linha['contato'],
        'registrado'         => $linha['registrado'],
        'periodo'            => $linha['data_inicial'] . ' até ' . $linha['data_final'],
        'produto'            => $linha['produto'],
        'observacao'         => $linha['observacao'],
        'faturado'           => $linha['faturado'],
        'despesas'           => $linha['despesa'],
        'relatorio_entregue' => $linha['relatorio_entregue'],
        'pesquisa_realizada' => $linha['pesquisa_realizada']
      );        
    }

    for ($i = 0; $i < count($dados); $i++) {
      $query = "SELECT issue FROM av_registro_horas_issues WHERE id = {$dados[$i]['id_issue']}";

      $resultado = mysqli_query($db, $query);

      $issue = mysqli_fetch_row($resultado);

      $dados[$i]['issue'] = $issue[0];
    }

    echo json_encode($dados);
    
  } elseif ((sizeof($_POST) == 6) || (isset($_POST['data_inicial']) && isset($_POST['data_final']) && isset($_POST['id']))) {# verificando se a requisição foi feita pelos filtros de pesquisa
    $filtros = array();
  
    # verificando se o filtro de empresa foi enviado e não está vazio
    if (isset($_POST['id']) && (!empty($_POST['id']))) {
      # verificando se o id da empresa é numérico
      if (is_numeric($_POST['id'])) {
        $filtros['id'] = (int) $_POST['id'];
      }
    } else {
      $filtros['id'] = '';
    }

    # verificando se o filtro de colaborador foi enviado e não está vazio
    if (isset($_POST['colaborador']) && (!empty($_POST['colaborador']))) {
      # verificando se o id colaborador é numérico
      if (is_numeric($_POST['colaborador'])) {
        $filtros['colaborador'] = (int) $_POST['colaborador'];
      }
    } else {
      $filtros['colaborador'] = '';
    }

    # verificando se o filtro de data inicial foi enviado
    if (isset($_POST['data_inicial'])) {
      # verificando se a data inicial é uma string
      if (is_string($_POST['data_inicial'])) {
        $filtros['data_inicial'] = $_POST['data_inicial'];
      }
    }

    # verificando se o filtro de data final foi enviado
    if (isset($_POST['data_final'])) {
      # verificando se a data final é uma string
      if (is_string($_POST['data_final'])) {
        $filtros['data_final'] = $_POST['data_final'];
      }
    }

    # verificando se o filtro tipo de atendimento foi enviado e não está vazio
    if (isset($_POST['tipo']) && (!empty($_POST['tipo']))) {
      # verificando se o tipo de atendimento é numérico
      if (is_numeric($_POST['tipo'])) {
        $filtros['tipo'] = (int) $_POST['tipo'];
      }
    } else {
      $filtros['tipo'] = '';
    }

    # verificando se o filtro produto foi enviado e não está vazio
    if (isset($_POST['produto']) && (!empty($_POST['produto']))) {
      # verificando se o produto é numérico
      if (is_numeric($_POST['produto'])) {
        $filtros['produto'] = (int) $_POST['produto'];
      }
    } else {
      $filtros['produto'] = '';
    }
    
    $query =
      "SELECT
        e.id,
        e.id_contato,
        e.id_cnpj,
        e.id_issue,
        x.id AS id_pesquisa,
        e.registro,
        CASE
          WHEN (e.status = 1)
            THEN 'Confirmado'
          WHEN (e.status = 2)
            THEN 'À Confirmar'
          WHEN (e.status = 3)
            THEN 'Reservado'
          WHEN (e.status = 4)
            THEN 'Cancelado'
        END AS status,
        CONCAT(s.name, ' ', s.surname) AS supervisor,
        CONCAT(t.name, ' ', t.surname) AS colaborador,	
        CASE 
          WHEN (e.tipo = 1)
            THEN 'Suporte ao Cliente'
          WHEN (e.tipo = 2)
            THEN 'Projeto Mais Gestão'
          WHEN (e.tipo = 3)
            THEN 'Implantação'
          WHEN (e.tipo = 4)
            THEN 'Treinamento Avanço'
          WHEN (e.tipo = 5)
            THEN 'Instalação'
          WHEN (e.tipo = 6)
            THEN 'Atualização'
        END AS tipo,
        r.razao_social AS empresa,
        r.cnpj,
        c.nome AS contato,
        DATE_FORMAT(e.registrado, '%Y-%m-%d') AS registrado,
        e.data_inicial,
        e.data_final,
        CASE
          WHEN (e.produto = 1)
            THEN 'Integral'
          WHEN (e.produto = 2)
            THEN 'Frente Avanço'
          WHEN (e.produto = 3)
            THEN 'Gestor'
          WHEN (e.produto = 4)
            THEN 'Novo ERP'
          WHEN (e.produto = 5)
            THEN 'Outros'
        END AS produto,
        e.observacao,
        CASE
          WHEN (e.faturado = false)
            THEN 'Não'
          WHEN (e.faturado = true)
            THEN 'Sim'
        END AS faturado,
        CASE
          WHEN (e.despesa = false)
            THEN 'Não'
          WHEN (e.despesa = true)
            THEN 'Sim'
        END AS despesa,
        CASE
          WHEN (i.status = 1)
            THEN 'Não'
          WHEN (i.status = 2)
            THEN 'Sim'
        END AS relatorio_entregue,
        CASE
          WHEN (x.status = 1)
            THEN 'Não'
          WHEN (x.status = 2)
            THEN 'Sim'
        END AS pesquisa_realizada
      FROM av_agenda_atendimentos_externos AS e       
      INNER JOIN av_agenda_cnpjs AS r
        ON r.id = e.id_cnpj
      INNER JOIN lh_users AS s
        ON s.id = e.supervisor
      INNER JOIN lh_users AS t
        ON t.id = e.colaborador
      INNER JOIN av_agenda_contatos AS c
        ON c.id = e.id_contato
      LEFT JOIN av_registro_horas_issues AS i
        ON i.id = e.id_issue
      LEFT JOIN av_agenda_pesquisas_externas AS x
        ON x.id = e.id
      WHERE 
        (r.id     LIKE '%{$filtros['id']}%'           AND
        t.id      LIKE '%{$filtros['colaborador']}%'  AND
        e.tipo    LIKE '%{$filtros['tipo']}%'         AND
        e.produto LIKE '%{$filtros['produto']}%'      AND
        e.data_inicial BETWEEN '{$filtros['data_inicial']}' AND '{$filtros['data_final']}')";
    
    $resultado = mysqli_query($db, $query);

    $dados = array();

    while ($linha = mysqli_fetch_array($resultado)) {        
      $linha['cnpj']     = substr($linha['cnpj'], 0, 2) . '.'. substr($linha['cnpj'], 2, 3) . '.' . substr($linha['cnpj'], 5, 3) . '/' . substr($linha['cnpj'], 8, 4) . '-' . substr($linha['cnpj'], 12, 2);
      $linha['contato'] = ucwords($linha['contato']);
      $linha['observacao'] = ucwords($linha['observacao']);

      $linha['registrado']   = formataDataParaExibir($linha['registrado']);
      $linha['data_inicial'] = formataDataParaExibir($linha['data_inicial']);
      $linha['data_final']   = formataDataParaExibir($linha['data_final']);
      
      $dados[] = array(
        'id'                 => $linha['id'],
        'id_contato'         => $linha['id_contato'],
        'id_cnpj'            => $linha['id_cnpj'],
        'id_issue'           => $linha['id_issue'],
        'issue'              => null,
        'id_pesquisa'        => $linha['id_pesquisa'],
        'registro'           => $linha['registro'],
        'status'             => $linha['status'],
        'supervisor'         => $linha['supervisor'],
        'colaborador'        => $linha['colaborador'],
        'tipo'               => $linha['tipo'],
        'empresa'            => $linha['empresa'],
        'cnpj'               => $linha['cnpj'],
        'contato'            => $linha['contato'],
        'registrado'         => $linha['registrado'],
        'periodo'            => $linha['data_inicial'] . ' até ' . $linha['data_final'],
        'produto'            => $linha['produto'],
        'observacao'         => $linha['observacao'],
        'faturado'           => $linha['faturado'],
        'despesas'           => $linha['despesa'],
        'relatorio_entregue' => $linha['relatorio_entregue'],
        'pesquisa_realizada' => $linha['pesquisa_realizada']
      );        
    }

    for ($i = 0; $i < count($dados); $i++) {
      $query = "SELECT issue FROM av_registro_horas_issues WHERE id = {$dados[$i]['id_issue']}";

      $resultado = mysqli_query($db, $query);

      $issue = mysqli_fetch_row($resultado);

      $dados[$i]['issue'] = $issue[0];
    }

    echo json_encode($dados);
  }
}