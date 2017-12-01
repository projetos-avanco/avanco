<?php

/**
 * responsável por processar os dados do formulário da tela de novo ticket e grava-los no banco de dados
 *
 */
function processaDadosDoFormularioNovoTicket($dados)
{
  require DIRETORIO_FUNCTIONS . 'screen/instrucoes.php';

  # abrindo uma conexão
  $db = abre_conexao();

  # chamando função que grava o novo ticket no banco de dados
  insereDadosDoFormularioNovoTicket($dados, $db);

  # redirecionando usuário para a tela principal
  header('Location: ' . BASE_URL . 'public/views/screen/novo_ticket.php');

  exit;
}
