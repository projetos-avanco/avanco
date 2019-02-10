<?php

/**
 * responsável por receber e atualizar os dados de uma pesquisa
 * @param - array com os dados de uma pesquisa
 */
function recebePesquisaExterna($pesquisa)
{
  require_once DIRETORIO_FUNCTIONS . 'schedule/search/atualizacoes_pesquisa.php';
  require_once DIRETORIO_FUNCTIONS . 'schedule/external/atualizacoes_externo.php';

  $db = abre_conexao();

  # chamando função que atualiza uma pesquisa externa
  $resultado = atualizaPesquisaExterna($db, $pesquisa);

  # abrindo sessão de validação
  $_SESSION['atividades'] = array(
    'tipo'      => 'danger',
    'exibe'     => false,
    'mensagens' => array()
  );

  # verificando se o registro de pesquisa externa não foi atualizado
  if (!$resultado) {
    # atualização da pesquisa não foi realizada
    $_SESSION['atividades']['tipo'] = 'danger';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'] = 'Erro ao gravar a Pesquisa Externa. Informe ao Wellington Felix.';
  } else {    
    $_SESSION['atividades']['tipo'] = 'success';
    $_SESSION['atividades']['exibe'] = true;
    $_SESSION['atividades']['mensagens'] = 'Pesquisa Externa gravada com sucesso.';
  }

  # redirecionando usuário para página de pesquisa externa
  header('location:' . BASE_URL . 'public/views/schedule/pesquisa_externa.php?id=' . $pesquisa['id']); exit;
}