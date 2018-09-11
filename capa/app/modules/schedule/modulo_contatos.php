<?php

/**
 *
 *
 */
function retornaContatos($idCnpj)
{
  require DIRETORIO_FUNCTIONS . 'schedule/funcoes_contatos.php';

  $db = abre_conexao();

  consultaContatos($db, $idCnpj);
}
