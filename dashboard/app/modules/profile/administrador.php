<?php

require DIRETORIO_FUNCTIONS . 'profile/tables/opcoes.php';

/*
 * cria as opções com os nomes dos colaboradores cadastrados do chat
 */
function criaOpcoesComOsColaboradoresDoChat()
{
  # abrindo uma conexão com a base de dados
  $conexao = abre_conexao();

  # chamando função que consulta e cria uma sessão com os nomes, sobrenomes e usuários (query string) dos colaboradores cadastrados como usuários no sistema
  consultaColaboradoresDoChat($conexao);
}
