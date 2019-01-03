<?php

/**
 * solicita a gravação do pedido e o envio do e-mail de aprovação do pedido
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