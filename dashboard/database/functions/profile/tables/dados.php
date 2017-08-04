<?php

require ABS_PATH . 'app/helpers/query.php';

/**
 * analisa se os dados do colaborador serão inseridos ou atualizados na tabela
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function analisaDadosDoColaborador($objeto, $modelo)
{
  # instrução que verifica se existe ou não um registro do usuário na tabela (0 - insere || 1 - atualiza)
  $query =
    "SELECT
    	nome
    FROM av_dashboard_colaborador
    WHERE id = {$modelo['pessoal']['id']}";

  $resultado = mysqli_query($objeto, $query);

  # verificando se os dados do usuário serão inseridos ou atualizados na tabela
  if ($resultado->num_rows == 0) {

    # chamando função que retira do array modelo de colaborador as colunas e os valores e retorna a query de INSERT
    $query = criaQueryDeColaborador($modelo, $resultado->num_rows);

  } else {

    # chamando função que retira do array modelo de colaborador as colunas e os valores e retorna a query de UPDATE
    $query = criaQueryDeColaborador($modelo, $resultado->num_rows);
    
  }

  mysqli_query($objeto, $query);

  # fechando conexao com a base de dados
  fecha_conexao($objeto);
}
