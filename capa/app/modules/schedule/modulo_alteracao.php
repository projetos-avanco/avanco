<?php

/**
 * responsável por atualizar os dados de um atendimento externo e solicitar o envio do e-mail de alteração aos envolvidos
 * @param - array com os dados do atendimento externo que devem ser alterados
 * @param - array com os id's dos contatos que receberam o e-mail em cópia
 */
function recebeAlteracaoDeAtendimentoExterno($alterar, $copia)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_MODULES   . 'schedule/modulo_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/atualizacoes_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/consultas_externo.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/address/consultas_endereco.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';

  $db = abre_conexao();

  $id = $alterar['id'];

  $alteracoes = array(    
    'colaborador'  => false,
    'data_inicial' => false,
    'data_final'   => false,    
    'horario'      => false,
    'tarefa'       => false,
    'observacao'   => false,
    'faturado'     => false,
    'despesa'      => false,
    'valor_hora'   => false,
    'valor_pacote' => false
  );

  # chamando função que retorna os dados de um atendimento externo
  $externo = retornaDadosDoAtendimentoExterno($db, $id);

  if ($alterar['colaborador']  != $externo['colaborador'])  {$alteracoes['colaborador']  = true;}
  if ($alterar['data_inicial'] != $externo['data_inicial']) {$alteracoes['data_inicial'] = true;}
  if ($alterar['data_final']   != $externo['data_final'])   {$alteracoes['data_final']   = true;}
  if ($alterar['horario']      != $externo['horario'])      {$alteracoes['horario']      = true;}
  if ($alterar['tarefa']       != $externo['tarefa'])       {$alteracoes['tarefa']       = true;}
  if ($alterar['observacao']   != $externo['observacao'])   {$alteracoes['observacao']   = true;}
  if ($alterar['faturado']     != $externo['faturado'])     {$alteracoes['faturado']     = true;}
  if ($alterar['despesa']      != $externo['despesa'])      {$alteracoes['despesa']      = true;}
  if ($alterar['valor_hora']   != $externo['valor_hora'])   {$alteracoes['valor_hora']   = true;}
  if ($alterar['valor_pacote'] != $externo['valor_pacote']) {$alteracoes['valor_pacote'] = true;}

  # verificando se os dados do atendimento externo foram alterados na tabela
  if (alteraAtendimentoExterno($db, $alterar)) {
    # chamando função que retorna os dados de um atendimento externo
    $externo = retornaDadosDoAtendimentoExterno($db, $id);

    $externo['cobranca'] = $alterar['cobranca'];

    # chamando função que retorna o endereço do cliente
    $endereco = retornaEnderecoAjax($db, $externo['id_cnpj']);

    # chamando função que retorna os dados de um contato
    $contato = consultaDadosDeUmContato($db, $externo['id_contato']);

    # verificando se foram enviados os id's do contatos que receberam o e-mail em cópia
    if (count($copia) > 0) {
      for ($i = 0; $i < count($copia); $i++) {
        $cc = consultaEnderecosEmailsDeUmContato($db, $copia[$i], $cc);
      }
    } else {
      $cc['emails'] = array();
    }

    # verificando se será necessário enviar o e-mail de alteração aos envolvidos
    if ($alterar['status'] == '1' || $alterar['status'] == '2') {
      # chamando função que realiza o envio dos e-mails
      if ($resultado = enviaEmailExterno($db, $externo, $endereco, $contato, $cc['emails'], 'alteracao', $alteracoes)) {
        # e-mail foi enviado
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['exibe'] = true;
        $_SESSION['atividades']['mensagens'][] = 'Dados do atendimento externo alterados e E-mails enviados com sucesso.';
      } else {
        # e-mail não foi enviado
        $_SESSION['atividades']['tipo'] = 'danger';
        $_SESSION['atividades']['exibe'] = true;
        $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar o envio de E-mail. Informe ao Wellington Felix.';
        $_SESSION['atividades']['mensagens'][] = $resultado;
      }
    } else {
      # dados do atendimento externo alterados
      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Dados do atendimento externo alterados com sucesso.';
    }
  } else {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao alterar os dados do atendimento externo. Informe ao Wellington Felix.';
  }
  
  # redirecionando usuário para página de atendimento remoto
  header('location:' . BASE_URL . '/public/views/schedule/edita_atendimento_externo.php?id=' . $id); exit;
}

/**
 * responsável por atualizar os dados de um atendimento remoto, atualizar os dados do ticket e solicitar o envio do e-mail de alteração aos envolvidos
 * @param - array com os dados do atendimento remoto que devem ser alterados
 * @param - array com os id's dos contatos que receberam o e-mail em cópia
 */
function recebeAlteracaoDeAtendimentoRemoto($alterar, $copia)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_MODULES   . 'schedule/modulo_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/atualizacoes_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'avancoins/colaboradores.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/remote/consultas_remoto.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';
  require_once DIRETORIO_FUNCTIONS . 'tickets/altera_tickets.php';

  $db = abre_conexao();

  $id = $alterar['id'];

  $alteracoes = array(    
    'colaborador'  => false,
    'data'         => false,    
    'horario'      => false,
    'tarefa'       => false,
    'observacao'   => false,
    'faturado'     => false,    
    'valor_hora'   => false,
    'valor_pacote' => false
  );

  # chamando função que retorna os dados de um atendimento remoto
  $remoto = retornaDadosDoAtendimentoRemoto($db, $id);

  if ($alterar['colaborador']  != $remoto['colaborador'])  {$alteracoes['colaborador']  = true;}
  if ($alterar['data']         != $remoto['data'])         {$alteracoes['data']         = true;}  
  if ($alterar['horario']      != $remoto['horario'])      {$alteracoes['horario']      = true;}
  if ($alterar['tarefa']       != $remoto['tarefa'])       {$alteracoes['tarefa']       = true;}
  if ($alterar['observacao']   != $remoto['observacao'])   {$alteracoes['observacao']   = true;}
  if ($alterar['faturado']     != $remoto['faturado'])     {$alteracoes['faturado']     = true;}  
  if ($alterar['valor_hora']   != $remoto['valor_hora'])   {$alteracoes['valor_hora']   = true;}
  if ($alterar['valor_pacote'] != $remoto['valor_pacote']) {$alteracoes['valor_pacote'] = true;}

  $ticket = array(
    'colaborador' => $alterar['colaborador'],
    'agendado'    => $alterar['data'] . ' ' . $alterar['horario'],
    'produto'     => $alterar['produto'],
    'modulo'      => $alterar['modulo'],
    'assunto'     => $alterar['observacao'],      
    'ticket'      => $remoto['registro'],
  );

  # verificando se os dados do ticket foram alterados na tabela de tickets
  if (alteraDadosDoTicketPeloAtendimentoRemoto($db, $ticket)) {
    # verificando se os dados do atendimento remoto foram alterados na tabela de atendimentos remotos
    if (alteraAtendimentoRemoto($db, $alterar)) {

      # chamando função que retorna os dados de um atendimento remoto
      $remoto = retornaDadosDoAtendimentoRemoto($db, $id);

      $remoto['cobranca'] = $alterar['cobranca'];

      # chamando função que retorna os dados de um contato
      $contato = consultaDadosDeUmContato($db, $remoto['id_contato']);

      # verificando se foram enviados os id's do contatos que receberam o e-mail em cópia
      if (count($copia) > 0) {
        for ($i = 0; $i < count($copia); $i++) {
          $cc = consultaEnderecosEmailsDeUmContato($db, $copia[$i], $cc);
        }
      } else {
        $cc['emails'] = array();
      }

      # verificando se será necessário enviar o e-mail de alteração aos envolvidos
      if ($alterar['status'] == '1' || $alterar['status'] == '2') {
        # chamando função que realiza o envio dos e-mails
        if ($resultado = enviaEmailRemoto($db, $remoto, $contato, $cc['emails'], 'alteracao', $alteracoes)) {
          # e-mail foi enviado
          $_SESSION['atividades']['tipo'] = 'success';
          $_SESSION['atividades']['exibe'] = true;
          $_SESSION['atividades']['mensagens'][] = 'Dados do atendimento remoto alterados e E-mails enviados com sucesso.';
        } else {
          # e-mail não foi enviado
          $_SESSION['atividades']['tipo'] = 'danger';
          $_SESSION['atividades']['exibe'] = true;
          $_SESSION['atividades']['mensagens'][] = 'Erro ao solicitar o envio de E-mail. Informe ao Wellington Felix.';
          $_SESSION['atividades']['mensagens'][] = $resultado;
        }
      } else {
        # dados do atendimento externo alterados
        $_SESSION['atividades']['tipo'] = 'success';
        $_SESSION['atividades']['exibe'] = true;
        $_SESSION['atividades']['mensagens'][] = 'Dados do atendimento remoto alterados com sucesso.';
      }
    } else {
      $_SESSION['atividades']['tipo'] = 'danger';
      $_SESSION['atividades']['exibe'] = true;
      $_SESSION['atividades']['mensagens'][] = 'Erro ao alterar os dados do atendimento remoto. Informe ao Wellington Felix.';
    }
  } else {
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'][] = 'Erro ao alterar os dados do ticket. Informe ao Wellington Felix.';    
  }

  # redirecionando usuário para página de atendimento remoto
  header('location:' . BASE_URL . '/public/views/schedule/edita_atendimento_remoto.php?id=' . $id); exit;
}