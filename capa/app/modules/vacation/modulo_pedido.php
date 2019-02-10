<?php

/**
 * reponsável por retornar os pedidos de férias de um exercício
 * @param - inteiro com o id do exercício de férias
 */
function retornaPedidosDeFerias($id)
{
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_pedido.php';

  $db = abre_conexao();

  # chamando função que retorna a situação dos pedidos
  $situacao = consultaSituacaoDosPedidosDeFerias($db, $id);

  # verificando se a situação dos pedidos estão aguardando manisfestação de adilson badaró
  if ($situacao == '1') {
    # chamando função que retorna uma lista com os pedidos
    $pedidos = consultaPedidosDeFerias($db, $id);
  } else {
    $pedidos =
      "<div class='list-group'>
        <a href='#' class='list-group-item active text-center'>Períodos</a>
        <a class='list-group-item text-center'>
          <strong>Não existe pedido de férias aguardando manifestação para esse exercício!</strong>
        </a>
      </div>";
  }

  echo $pedidos;
}

/**
 * reponsável por solicitação a aprovação dos pedidos de e o envio do e-mail de aprovação do pedido
 * @param - inteiro com o id do exercicio de férias
 * @param - inteiro om o id do colaborador
 */
function recebeAprovacaoDePedidoDeFerias($id, $colaborador)
{
  require_once DIRETORIO_HELPERS   . 'diversas.php';
  require_once DIRETORIO_HELPERS   . 'datas.php';
  require_once DIRETORIO_HELPERS   . 'vacation/envia_email.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/consultas_agenda.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/consultas_pedido.php';  
  require_once DIRETORIO_FUNCTIONS . 'vacation/atualizacoes_pedido.php';  

  $db = abre_conexao();

  # chamando função que consulta os pedidos de férias para aprovação
  $pedido = consultaPedidosDeFeriasParaAprovacao($db, $id);

  # verificando se a situação dos pedidos foram alteradas para aprovado  
  if (alteraSituacaoDosPedidosParaAprovado($db, $id)) {
    $tipo = (string) count($pedido);

    # veficando se o pedido é do tipo 1 ou 6
    if ($tipo == '1') {
      # movendo valores para outros índices
      $pedido['data_inicial'] = $pedido['periodo1']['data_inicial'];
      $pedido['data_final']   = $pedido['periodo1']['data_final'];
      $pedido['dias']         = $pedido['periodo1']['dias'];

      # retirando índice periodo1
      unset($pedido['periodo1']);
    }

    # chamando função que consulta o e-mail de um colaborador
    $email = consultaEmailDoColaborador($db, $colaborador);

    # verificando se o e-mail de aprovação do pedido de férias foi enviado aos envolvidos
    if (enviaEmailDeAprovacaoDeFerias($email, $pedido, $tipo)) {
      echo json_encode(true); exit;
    } else {
      echo json_encode(false); exit;
    }
  }  
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
  require_once DIRETORIO_FUNCTIONS . 'vacation/atualizacoes_pedido.php';
  require_once DIRETORIO_FUNCTIONS . 'vacation/delecoes_pedido.php';
  
  $db = abre_conexao();

  $pedido['registro'] = (int) consultaRegistroDeUmPedidoDeFerias($db, $pedido['id_exercicio']);# PAREI AQUI

  # verificando se os pedidos foram deletados com sucesso
  if (deletaTodosOsPedidos($db, $pedido['id_exercicio'], $pedido['registro'])) {
    # verificando se o pedido de férias foi inserido na tabela com sucesso
    if (inserePedidosDeFerias($db, $pedido, $tipo)) {
      # verificando se a situação dos pedidos foram alteradas para aprovado
      if (alteraSituacaoDosPedidosParaAprovado($db, $pedido['id_exercicio'])) {
        # chamando função que consulta o e-mail de um colaborador
        $email = consultaEmailDoColaborador($db, $pedido['id_colaborador']);

        # verificando se o e-mail de aprovação do pedido de férias foi enviado aos envolvidos
        if (enviaEmailDeAprovacaoDeFerias($email, $pedido, $tipo)) {        
          echo json_encode(1); exit;          
        } else {
          echo json_encode(2);
        }
      } else {
        echo json_encode(3);
      }
    } else {
      echo json_encode(4);
    }
  } else {
    echo json_encode(5);
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