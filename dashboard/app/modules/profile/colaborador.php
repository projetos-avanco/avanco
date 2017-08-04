<?php

require ABS_PATH . 'database/functions/profile/data/pessoal.php';
require ABS_PATH . 'database/functions/profile/data/atendimento.php';
require ABS_PATH . 'database/functions/profile/data/indices.php';
require ABS_PATH . 'database/functions/profile/data/outros.php';

require ABS_PATH . 'database/functions/profile/tables/dados.php';

require ABS_PATH . 'app/models/colaborador.php';

require ABS_PATH . 'app/helpers/uri.php';

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

  # recuparando nome de usuário que requisitou a página
  $colaborador['pessoal']['usuario'] = retornaNomeDeUsuarioDoColaborador();

  # chamando função que consulta e retorna os dados pessoais do colaborador
  $colaborador = consultaDadosPessoaisDoColaborador($conexao, $colaborador);

  # chamando função que cria o caminho da foto do colaborador de acordo com o seu time atual
  $colaborador = criaCaminhoDaFotoDoColaborador($conexao, $colaborador);

  # chamando funções que consultam e retornam os dados de atendimentos, índices e outros do colaborador
  $colaborador = consultaDadosDosAtendimentosDoColaborador($conexao, $colaborador, $datas);
  $colaborador = consultaDadosDosIndicesDoColaborador($conexao, $colaborador, $datas);
  $colaborador = consultaDadosDeOutrosDoColaborador($conexao, $colaborador);

  # eliminando posição usuário do array modelo de colaborador (essa posição não será gravada na tabela)
  unset($colaborador['pessoal']['usuario']);

  # verificando se foi informado a query string ?usuario=nome-sobrenome (id = 0 - não foi informada a query string e os dados não serão inseridos na tabela)
  if ($colaborador['pessoal']['id'] == 0) {

    # mensagem de erro
    echo '<h3>Na URL, após o script colaborador.php, informe ?usuario=nome-sobrenome cadastrado no chat!</h3>';

  } else {

    # chamando função que analise se os dados consultados do colaborador serão inseridos ou atualizados na tabela
    analisaDadosDoColaborador($conexao, $colaborador);

  }

}
