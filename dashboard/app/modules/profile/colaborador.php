<?php

require ABS_PATH . 'database/functions/profile/data/pessoal.php';
require ABS_PATH . 'database/functions/profile/data/chamados.php';
require ABS_PATH . 'database/functions/profile/data/indices.php';
require ABS_PATH . 'database/functions/profile/data/outros.php';

require ABS_PATH . 'database/functions/profile/tables/insere-dados.php';

require ABS_PATH . 'app/models/colaborador.php';

require ABS_PATH . 'app/helpers/uri.php';

function atualizaDadosDoColaborador($datas)
{
  # criando array com o modelo de colaborador
  $colaborador = defineArrayComModeloDeColaborador();

  # recuparando nome de usuário que requisitou a página
  $usuario = retornaNomeDeUsuarioDoColaborador($colaborador);

  # abrindo conexão com a base de dados
  $conexao = abre_conexao();

  # preenchendo o array modelo de colaborador
  $colaborador = retornaDadosPessoaisDoColaborador($conexao, $colaborador, $usuario);
  $colaborador = retornaDadosDosChamadosDoColaborador($conexao, $colaborador, $datas);
  $colaborador = retornaDadosDosIndicesDoColaborador($conexao, $colaborador, $datas);
  $colaborador = retornaDadosDeOutrosDoColaborador($conexao, $colaborador, $datas);

  insereDadosDoColaborador($conexao, $colaborador);
}
