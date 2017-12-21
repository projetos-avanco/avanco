<?php

/**
 * responsável por gravar uma nova atividade esporádica na tabela de ações esporádicas
 * @param - array com os dados do formulário de nova atividade
 */
function gravaNovaAtividadeEsporadica($form)
{
  require DIRETORIO_FUNCTIONS . 'avancoins/atividades.php';

  # abrindo conexão com a base de dados
  $db = abre_conexao();

  # chamando função que insere uma nova atividade na tabela de ações esporádicas
  $resultado = insereNovaAtividadeEsporadica($db, $form);

  # verificando se a consulta foi executada
  if ($resultado == true) {

    # gerando mensagem de sucesso
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> A atividade foi cadastrada com sucesso.</p>';
    $_SESSION['mensagens']['tipo']     = 'success';
    $_SESSION['mensagens']['exibe']    = true;

  } else {

    # gerando mensagem de erro
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> A atividade não foi cadastrada! Houve erro de SQL.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  fecha_conexao($db);

  # redirecionando usuário para página de nova atividade
  header ('Location: ' . BASE_URL . '../capa/public/views/avancoins/nova_atividade.php');

}
