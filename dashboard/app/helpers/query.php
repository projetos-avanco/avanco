<?php

/**
 * cria uma instrução (query) de INSERT ou UPDATE
 * @param - array com o modelo do colaborador
 * @param - inteiro com o número de registros do colaborador na tabela (0 - não foi inserido dados ou 1 - já foi inserido dados)
 */
function criaQueryDeColaborador($modelo, $registros)
{
  $colunas = null;
  $valores = null;

  # verificando qual query será criada (INSERT ou UPDATE)
  if ($registros == 0) {

    # separando em variáveis as colunas (chaves do array) e valores (valores do array) contidos no array modelo de colaborador
    foreach ($modelo as $chave) {

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

    # eliminando os percentuais de SLA (dados de SLA serão atualizados manualmente)
    unset($modelo['outros']['percentual_mes_sla']);
    unset($modelo['outros']['percentual_total_sla']);

    # separando em variáveis as colunas (chaves do array) e valores (valores do array) contidos no array modelo de colaborador
    foreach ($modelo as $chave) {

      foreach ($chave as $coluna => $valor) {

        $valores .= $coluna . ' = ' . "'$valor', ";

      }

    }

    # retirando a última vírgula
    $valores = rtrim($valores, ', ');

    # criando instrução (query) de UPDATE
    $query = "UPDATE av_dashboard_colaborador SET " . "$valores" . " WHERE " . " id = {$modelo['pessoal']['id']}";

  }

  return $query;
}
