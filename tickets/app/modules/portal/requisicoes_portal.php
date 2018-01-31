<?php

/**
 * responsável por retornar os tickets referente ao código de conta contrato recebido
 * @param - string com o código de conta contrato
 */
function retornaTicketsValidados($conta_contrato)
{
  require '../../../init.php';
  require DIRETORIO_FUNCTIONS . 'portal/funcoes_portal.php';

  # abrindo uma conexão
  $db = abre_conexao();

  # chamando função que consulta os tickets referente ao código de conta contrato recebido
  consultaTicketsValidos($conta_contrato, $db);
}
