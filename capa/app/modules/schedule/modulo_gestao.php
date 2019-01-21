<?php

/**
 * responsável por solicitar a gravação de um atendimento de gestão de clientes
 * @param - array com os dados de um atendimento de gestão de clientes
 */
function recebeAtendimentoGestao($gestao)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/customers/insercoes_gestao_cliente.php';

  $db = abre_conexao();

  # chamando função que gera o número do registro
  $gestao['registro'] = geraRegistro($db, 'av_agenda_atendimentos_gestao_clientes');

  if (insereAtendimentoGestao($db, $gestao)) {
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Registro gerado com sucesso.';
  } else {
    # registro de atendimento remoto não foi inserido
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar a gravação do Registro de Atendimento de Gestão de Clientes. Registro de Horas deletado. Informe ao Wellington Felix.';
  }
  
  $_SESSION['registro'] = $gestao['registro'];

  # redirecionando usuário para página de atendimento de gestão de clientes
  header('location:' . BASE_URL . 'public/views/schedule/atendimento_clientes.php'); exit;
}