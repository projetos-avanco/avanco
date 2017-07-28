<?php

require ABS_PATH . 'database/functions/profile/informacoes-pessoais.php';
require ABS_PATH . 'database/functions/profile/informacoes-atendimento.php';
require ABS_PATH . 'app/models/colaborador.php';
require ABS_PATH . 'app/helpers/uri.php';

function atualizaDadosDoColaborador($datas)
{
  $colaborador = defineArrayComModeloDeColaborador();

  $usuario = retornaNomeDeUsuarioDoColaborador($colaborador);

  $conexao = abre_conexao();

  $colaborador = retornaInformacoesPessoaisDoColaborador($conexao, $colaborador, $usuario);
  $colaborador = retornaInformacoesDosAtendimentosDoColaborador($conexao, $colaborador, $datas);

}
