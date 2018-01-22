<?php

header('Content-Type: text/html; charset=UTF-8');

/**
 * responsável por verificar se o prazo de agendamento do ticket já passou
 * @param - array com o número do ticket
 * @param - array com o modelo de dados de colaboradores
 */
function verificaPrazoDoAgendamentoDoTicket($cliente, $colaboradores)
{
  require DIRETORIO_FUNCTIONS . 'tickets/funcoes_tickets.php';

  # chamando função que retorna uma conexão com a base de dados
  $db = abre_conexao();
  
  $agendado = consultaPrazoDoAgendamentoDoTicket($cliente['ticket'], $db);
  
  # verificando se a data agendada do ticket já passou
  if ($agendado['data_atual'] > $agendado['data_agendada']) {
    
    # chamando função que invalida um ticket
    invalidaTicketForaDoPrazo($cliente['ticket'], $db);

    $msg = 'Ticket com o Prazo de Agendamento Vencido!';

    #retornando mensagem para o portal avanço
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);

    exit;

  # verificando se o cliente está chamando na data agendada
  } else if ($agendado['data_atual'] == $agendado['data_agendada']) {

    # verificando se existe uma diferença maior que 30 minutos no horário que o cliente chamou
    if ($agendado['diferenca'] > '00:30:00') {

      # chamando função que invalida um ticket
      invalidaTicketForaDoPrazo($cliente['ticket'], $db);

      $msg = 'Ticket com o Prazo de Agendamento Vencido!';

      #retornando mensagem para o portal avanço
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);

      exit;
    
    # verificando se existe uma diferença menor que 30 minutos no horário que o cliente chamou
    } else {

      # chamando função responsável por redirecionar o cliente para o colaborador agendado
      redirecionaParaColaboradorResponsavel($cliente, $colaboradores);

    }
  
  # verificando se o cliente está chamando antes da data agendada
  } else {

      # chamando função responsável por redirecionar o cliente para o colaborador agendado
      redirecionaParaColaboradorResponsavel($cliente, $colaboradores);

  }

}

/**
 * responsável por verificar se o colaborador está online e redirecionar o cliente para ele
 * @param - array com o número do ticket
 */
function redirecionaParaColaboradorResponsavel($cliente, $colaboradores)
{
  # chamando função que retorna uma conexão com a base de dados
  $db = abre_conexao();

  # chamando função que consulta os dados de agendamento do cliente
  $cliente = consultaDadosDoTicket($cliente, $db);

  # indicando que o cliente não utiliza o novo ERP
  $cliente['novo_erp'] = '0';

  # recuperando id do colaborador responsável pelo agendamento
  $colaboradores[0]['id'] = $cliente['colaborador'];

  unset($cliente['colaborador']);

  # criando sessão com o código do ticket enviado pelo portal avanço
  $_SESSION['agendamento']['ticket'] = $cliente['ticket'];

  # chamando função que verifica se o colaborador responsável pelo agendamento está online
  $colaboradores = verificaColaboradorAgendadoOnlineNoChat($colaboradores, $db);

  # chamando função que redireciona o cliente para o colaborador responsável pelo agendamento
  redirecionaClienteParaDepartamento($colaboradores, $cliente);

  $db->close();
}
