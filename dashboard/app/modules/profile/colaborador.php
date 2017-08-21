<?php

require DIRETORIO_FUNCTIONS . 'profile/data/pessoal.php';
require DIRETORIO_FUNCTIONS . 'profile/data/atendimento.php';
require DIRETORIO_FUNCTIONS . 'profile/data/indices.php';
require DIRETORIO_FUNCTIONS . 'profile/data/outros.php';
require DIRETORIO_FUNCTIONS . 'profile/tables/dados.php';
require DIRETORIO_MODELS    . 'colaborador.php';

/**
 * consulta os dados do colaborador na base de dados do chat de acordo com um período ou data específica informada
 * @param - array com a data inicial e data final de um período ou específica
 */
function consultaDadosDoColaborador($datas)
{
  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # criando array com o modelo de colaborador
  $colaborador = defineArrayModeloDeColaborador();

  # verificando se o usuário logado é administrador (nível = 1 - usuário normal / nível = 2 - administrador)
  if ($_SESSION['usuario']['nivel'] == 2 AND isset($_POST['usuario'])) {

    # setando na sessão o colaborador selecionado pelo administrador
    $_SESSION['usuario']['usuario'] = $_POST['usuario'];

  }

  # setando o nome de usuário do colaborador no chat (usuário que será gerado no dashboard)
  $colaborador['pessoal']['usuario'] = $_SESSION['usuario']['usuario'];

  # chamando função que consulta e retorna os dados pessoais do colaborador
  $colaborador = consultaDadosPessoaisDoColaborador($conexao, $colaborador);

  # chamando funções que consultam e retornam os dados de atendimentos, índices e outros do colaborador
  $colaborador = consultaDadosDosAtendimentosDoColaborador($conexao, $colaborador, $datas);
  $colaborador = consultaDadosDosIndicesDoColaborador($conexao, $colaborador, $datas);
  $colaborador = consultaDadosDeOutrosDoColaborador($conexao, $colaborador);

  # recuperando período informado pelo usuário (data atual ou período)
  $colaborador['periodo']['data_1'] = $datas['data_1'];
  $colaborador['periodo']['data_2'] = $datas['data_2'];

  # eliminando posição usuário do array modelo de colaborador (essa posição não será gravada na tabela)
  unset($colaborador['pessoal']['usuario']);

  # chamando função que analise se os dados consultados do colaborador serão inseridos ou atualizados na tabela
  analisaDadosDoColaborador($conexao, $colaborador);
}
