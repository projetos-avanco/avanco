<?php

# verificando se foi enviado uma requisição via método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';

  require DIRETORIO_MODULES . 'screen/ticket.php';
  require DIRETORIO_MODELS  . 'screen/ticket.php';
  require DIRETORIO_HELPERS . 'diversas.php';
  require DIRETORIO_HELPERS . 'requisicoes.php';

  # chamando função que retorna o modelo de dados para o formulário da tela de novo ticket
  $dados = criaModeloParaFormularioNovoTicket();

  # chamando função que recupera os dados enviados pelo formulário da tela de novo ticket
  $dados = recuperaDadosDosArraysSuperGlobais($dados, 'ticket', 'POST');

  # retirando quebras de linhas do assunto
  $dados['assunto'] = preg_replace('/[\n|\r|\n\r|\r\n]{2,}/',' ', $dados['assunto']);

  $dados['contato'] = ucwords($dados['contato']);
  $dados['assunto'] = ucwords($dados['assunto']);

  # setando data e hora e execução
  $dados['data_hora'] = date('Y-m-d H:i:s');

  # chamando função que gera um código de ticket com 6 dígitos
  $dados['ticket'] = geraTicket();

  # recuperando o id do supervisor que está gerando o ticket
  $dados['supervisor'] = $_SESSION['usuario']['id'];

  # chamando função responsável por processar os dados do formulário da tela de novo ticket e grava-los no banco de dados
  processaDadosDoFormularioNovoTicket($dados);

}
