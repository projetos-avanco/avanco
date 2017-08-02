<?php

require ABS_PATH . 'database/functions/profile/data/pessoal.php';
require ABS_PATH . 'database/functions/profile/data/atendimento.php';
require ABS_PATH . 'database/functions/profile/data/indices.php';
require ABS_PATH . 'database/functions/profile/data/outros.php';

require ABS_PATH . 'database/functions/profile/tables/insere-dados.php';

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
  $colaborador = defineArrayComModeloDeColaborador();

  # recuparando nome de usuário que requisitou a página
  $colaborador['pessoal']['usuario'] = retornaNomeDeUsuarioDoColaborador();

  # chamando funções que consultam dados do colaborador e preenchem o array modelo
  $colaborador = retornaDadosPessoaisDoColaborador($conexao, $colaborador);
  $colaborador = retornaDadosDosAtendimentosDoColaborador($conexao, $colaborador, $datas);
  $colaborador = retornaDadosDosIndicesDoColaborador($conexao, $colaborador, $datas);
  $colaborador = retornaDadosDeOutrosDoColaborador($conexao, $colaborador);

  # eliminando posição usuário do array modelo de colaborador (essa posição não será gravada na tabela av_dashboard_colaborador)
  unset($colaborador['pessoal']['usuario']);
exit(var_dump($colaborador));
  # chamando função que insere os dados consultados do colaborador na tabela av_dashboard_colaborador
  insereDadosDoColaborador($conexao, $colaborador);
}
