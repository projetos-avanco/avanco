<?php

require ABS_PATH . 'app/helpers/query.php';

/**
 * insere os dados do colaborador na base de dados
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo do colaborador
 */
function insereDadosDoColaborador($conexao, $colaborador)
{
  # instrução que verifica se existe ou não um registro do usuário na tabela
  $query =
    "SELECT
    	nome
    FROM av_dashboard_colaborador
    WHERE id = {$colaborador['pessoal']['id']}";

  $resultado = mysqli_query($conexao, $query);

  # verificando se os dados do usuário serão inseridos ou atualizados na tabela (se num_rows == 0 - insere, caso contrário - atualiza)
  if ($resultado->num_rows == 0) {

    # chamando função que retira do array modelo de colaborador as colunas e os valores e retorna a query de INSERT
    $query = criaQueryDeColaborador($colaborador, $resultado->num_rows);

  } else {

    # chamando função que retira do array modelo de colaborador as colunas e os valores e retorna a query de UPDATE
    $query = criaQueryDeColaborador($colaborador, $resultado->num_rows);

  }

  mysqli_query($conexao, $query);

  # fechando conexao com a base de dados
  fecha_conexao($conexao);
}
