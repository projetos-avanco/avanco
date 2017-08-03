<?php

/**
 * cria uma instrução (query) de INSERT ou UPDATE
 * @param - array com o modelo do colaborador
 * @param - inteiro com o número de registros do colaborador na tabela (0 - não foi inserido dados ou 1 - já foi inserido dados)
 */
function criaQueryDeColaborador($colaborador, $registro)
{
  $colunas = null;
  $valores = null;

  # verificando qual query será criada (INSERT ou UPDATE)
  if ($registro == 0) {

    # separando em variáveis as colunas (chaves do array) e valores (valores do array) contidos no array modelo de colaborador
    foreach ($colaborador as $chave) {

      foreach ($chave as $coluna => $valor) {

        $colunas .= $coluna . ', ';
        $valores .= "'$valor', ";

      }

    }

    # retirando a última vírgula
    $colunas = rtrim($colunas, ', ');
    $valores = rtrim($valores, ', ');

    # criando instrução (query) de INSERT
    $query = "INSERT INTO av_dashboard_colaborador " . "($colunas)" . " VALUES " . "($valores)";

  } else {

    # separando em variáveis as colunas (chaves do array) e valores (valores do array) contidos no array modelo de colaborador
    foreach ($colaborador as $chave) {

      foreach ($chave as $coluna => $valor) {

        $valores .= $coluna . ' = ' . "'$valor', ";

      }

    }

    # retirando a última vírgula
    $valores = rtrim($valores, ', ');

    # criando instrução (query) de UPDATE
    $query = "UPDATE av_dashboard_colaborador SET " . "$valores" . " WHERE " . " id = {$colaborador['pessoal']['id']}";

  }

  return $query;
}
