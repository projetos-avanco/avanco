<?php

require DIRETORIO_FUNCTIONS . 'profile/tables/selecao.php';

/*
 * retorna os colaboradores cadastrados como usuários no sistema
 */
function retornaColaboradoresDoChat()
{
  # abrindo uma conexão com a base de dados
  $conexao = abre_conexao();

  # chamando função que consulta e cria uma sessão com os nomes, sobrenomes e usuários (query string) dos colaboradores cadastrados como usuários no sistema
  consultaColaboradoresDoChat($conexao);
}
