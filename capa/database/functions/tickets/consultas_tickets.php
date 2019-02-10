<?php 

/**
 * consulta os dados básicos dos tickets para página de consulta de tickets
 * @param - objeto com uma conexão aberta
 * @param - array modelo que irá receber os dados dos tickets
 */
function consultaDadosBasicosDosTickets($db, $tickets)
{
  require DIRETORIO_HELPERS . 'datas.php';

  $query =
    "SELECT
      DATE_FORMAT(t.data_hora, '%Y-%m-%d') AS data,	
      t.ticket,
      CONCAT(c.name, ' ', c.surname) AS colaborador,
      DATE_FORMAT(t.agendado, '%Y-%m-%d') AS data_agendada,
      DATE_FORMAT(t.agendado, '%H:%i:%s') AS hora_agendada,
      CASE
        WHEN (t.chat_id IS NULL)
          THEN (0)
        ELSE
          t.chat_id
      END AS chat_id,
      CASE
        WHEN (t.validade = 0)
          THEN ('Vencido')
        WHEN (t.validade = 1)
          THEN ('Válido')
      END AS validade,
      t.razao_social,
      t.cnpj,
      t.conta_contrato	
    FROM av_tickets AS t
    INNER JOIN lh_users AS c
      ON c.id = t.colaborador
    ORDER BY t.id DESC";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {
    
    # recuperando os dados
    while ($registro = $resultado->fetch_assoc()) {

      # chamando função que formata a data para exibir na página
      $registro['data']          = formataDataParaExibir($registro['data']);
      $registro['data_agendada'] = formataDataParaExibir($registro['data_agendada']);

      $tickets[] = array(
        
        'data'           => $registro['data'],
        'ticket'         => $registro['ticket'],
        'colaborador'    => $registro['colaborador'],
        'data_agendada'  => $registro['data_agendada'],
        'hora_agendada'  => $registro['hora_agendada'],
        'chat_id'        => $registro['chat_id'],
        'validade'       => $registro['validade'],
        'razao_social'   => $registro['razao_social'],
        'cnpj'           => $registro['cnpj'],
        'conta_contrato' => $registro['conta_contrato']

      );

    }

  }

  return $tickets;

}

/**
 * consulta todos os dados de um ticket
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo que receberá os dados
 * @param - string com o número do ticket
 */
function consultaDadosDaPaginaDeVisualizaoDeTickets($db, $dados, $ticket)
{
  require DIRETORIO_HELPERS . 'datas.php';

  $query =
    "SELECT
      DATE_FORMAT(t.data_hora, '%Y-%m-%d') AS data,
      t.ticket,
      DATE_FORMAT(t.agendado, '%Y-%m-%d') AS data_agendada,
      DATE_FORMAT(t.agendado, '%H:%i:%s') AS hora_agendada,
      t.historico_chat_id,
      CASE
        WHEN (t.validade = 0)
          THEN 'Vencido'
        WHEN (t.validade = 1)
          THEN 'Válido'
      END AS validade,
      t.contato,
      t.cnpj,
      t.conta_contrato,
      t.razao_social,
      t.telefone,
      t.supervisor AS id_supervisor,
      CONCAT(s.name, ' ', s.surname) AS supervisor,
      t.colaborador AS id_colaborador,
      CONCAT(c.name, ' ', c.surname) AS colaborador,
      p.id AS id_produto,      
      p.nome AS produto,
      m.id AS id_modulo,
      m.nome AS modulo,
      t.assunto
    FROM av_tickets AS t
    INNER JOIN lh_users AS s    	
      ON s.id = t.supervisor
    INNER JOIN lh_users AS c
      ON c.id = t.colaborador
    INNER JOIN av_dashboard_produtos AS p
      ON p.id = t.produto
    INNER JOIN av_dashboard_modulos AS m
      ON m.id = t.modulo
    WHERE (t.ticket = $ticket)
    ORDER BY data DESC";

  # verificando se a consulta pode ser executada
  if ($resultado = $db->query($query)) {

    while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

      $registro['data']          = formataDataParaExibir($registro['data']);
      $registro['data_agendada'] = formataDataParaExibir($registro['data_agendada']);

      $dados = array(

        'data'              => $registro['data'],
        'ticket'            => $registro['ticket'],
        'data_agendada'     => $registro['data_agendada'],
        'hora_agendada'     => $registro['hora_agendada'],
        'historico_chat_id' => $registro['historico_chat_id'],
        'validade'          => $registro['validade'],
        'contato'           => $registro['contato'],
        'cnpj'              => $registro['cnpj'],
        'conta_contrato'    => $registro['conta_contrato'],
        'razao_social'      => $registro['razao_social'],
        'telefone'          => $registro['telefone'],
        'id_supervisor'     => $registro['id_supervisor'],
        'supervisor'        => $registro['supervisor'],
        'id_colaborador'    => $registro['id_colaborador'],
        'colaborador'       => $registro['colaborador'],
        'id_produto'        => $registro['id_produto'],
        'produto'           => $registro['produto'],
        'id_modulo'         => $registro['id_modulo'],
        'modulo'            => $registro['modulo'],
        'assunto'           => $registro['assunto']

      );

    }

  }

  return $dados;

}