<?php

/**
 * reponsável por retornar os pedidos de férias de um exercício
 * @param - inteiro com o id do exercício de férias
 */
function retornaPedidosDeFerias($id)
{
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_pedido.php';

  $db = abre_conexao();

  $pedidos = consultaPedidosDeFerias($db, $id);

  echo $pedidos;
}

/**
 * responsável por solicitar a alteração do pedido e o envio do e-mail de aprovação do pedido
 * @param - array com os dados do pedido
 * @param - string com o tipo do periodo selecionado pelo usuário
 */
function recebeAlteracaoDePedidoDeFerias($pedido, $tipo)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_HELPERS   . 'datas.php';
  require_once DIRETORIO_HELPERS   . 'vacation/envia_email.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_pedido.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/insercoes_pedido.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/delecoes_pedido.php';
  
  $db = abre_conexao();

  $pedido['registro'] = consultaRegistroDeUmPedidoDeFerias($db, $pedido['id_exercicio']);# PAREI AQUI

  # verificando se os pedidos foram deletados com sucesso
  if (deletaPedidos($db, $pedido['id_exercicio'])) {
    # verificando se o pedido de férias foi inserido na tabela com sucesso
    if (inserePedidosDeFerias($db, $pedido, $tipo)) {
      # verificando se a situação dos pedidos foram alteradas para aprovado
      if (alteraSituacaoDosPedidosParaAprovado($db, $pedido['id_exercicio'])) {
        # chamando função que consulta o e-mail de um colaborador
        $email = consultaEmailDoColaborador($db, $pedido['id_colaborador']);

        # verificando se o e-mail de aprovação do pedido de férias foi enviado aos envolvidos
        if (enviaEmailDeAprovacaoDeFerias($email, $pedido, $tipo)) {        
          echo json_encode(true); exit;          
        } else {
          echo json_encode(false);
        }
      } else {
        echo json_encode(false);
      }
    } else {
      echo json_encode(false);
    }
  } else {
    echo json_encode(false);
  }
}

/**
 * reponsável por solicitar a gravação do pedido e o envio do e-mail de solicitação de aprovação do pedido
 * @param - array com os dados do pedido
 * @param - string com o tipo do periodo selecionado pelo usuário
 */
function recebePedidoDeFerias($pedido, $tipo)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_HELPERS   . 'datas.php';
  require_once DIRETORIO_HELPERS   . 'vacation/envia_email.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/insercoes_pedido.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/atualizacoes_exercicio.php';

  $db = abre_conexao();
  
  $dados = array(
    'registro' => null,
    'resultado' => false
  );

  # chamando função que gera o número do registro
  $pedido['registro'] = geraRegistro($db, 'av_agenda_pedidos_ferias');

  # verificando se o pedido de férias foi inserido na tabela com sucesso
  if (inserePedidosDeFerias($db, $pedido, $tipo)) {
    # verificando se o status do exercício de férias foi alterado para agendado
    if (alteraStatusDoExercicioParaAgendado($db, $pedido['id_exercicio'])) {
      # verificando se o e-mail de solicitação de aprovação do pedido de férias para adilson badaró foi enviado
      if (enviaEmailDeSolicitacaoDaAprovacaoDoPedidoDeFerias($pedido, $tipo)) {
        $dados['resultado'] = true;
        $dados['registro'] = $pedido['registro'];

        echo json_encode($dados); exit;
      } else {
        echo json_encode($dados);
      }
    } else {
      echo json_encode($dados);
    }
  } else {
    echo json_encode($dados);
  }  
}