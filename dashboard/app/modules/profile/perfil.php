<?php

require DIRETORIO_FUNCTIONS . 'profile/tables/dashboard.php';
require DIRETORIO_FUNCTIONS . 'profile/tables/documentos.php';
require DIRETORIO_MODELS    . 'dashboard.php';
require DIRETORIO_MODELS    . 'documentos.php';

/**
 * consulta e cria a sessão com os dados que serão exibidos no dashboard
 * @param - string com o id do colaborador que requisitou a página
 */
function geraDadosParaDashboard($id)
{
  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # criando array com o modelo de dashboard
  $dashboard = defineArrayModeloDeDashboard();

  # criando array com o modelo de documentos
  $documentos = defineArrayModeloDeDocumentos();

  # chamando função que retorna os dados para o dashboard
  $dashboard = retornaDadosParaDashboard($conexao, $dashboard, $id);

  # chamando função que retorna todos os documentos inseridos pelo colaborador na base de conhecimento
  $documentos = retornaDocumentosInseridosNaBaseDeConhecimento($conexao, $documentos, $id);

  # eliminando posição id do colaborador (essa posição não será exibida no dashboard)
  unset($dashboard['colaborador']['id']);

  # fechando conexão com a base de dados (depois passar esse código para a última função que consulta o banco de dados)
  fecha_conexao($conexao);

  # criando sessão com os dados para o dashboard
  $_SESSION['navegador'] = array(
    'dashboard'  => $dashboard,
    'documentos' => $documentos
  );
}
