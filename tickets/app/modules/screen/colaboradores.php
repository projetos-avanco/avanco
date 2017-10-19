<?php

require '../../../init.php';

require ABS_PATH . 'database/functions/screen/instrucoes.php';

/*
 * responsável por criar as opções com os dados dos colaboradores
 */
function criaOpcoesDeColaboradores()
{
  $db     = abre_conexao();
  $options = '';

  # chamando função que consulta e retorna as opções dos colaboradores existentes no chat
  $options = consultaColaboradores($option, $db);

  # ecoando as opções para o formulário de novo ticket
  echo $options;
}
