<?php

/**
 * retorna os dados pessoais do colaborador (id, nome e sobrenome cadastrados no chat)
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 */
function retornaDadosPessoaisDoColaborador($conexao, $colaborador)
{
  $query =
    "SELECT
    	id,
    	name,
    	surname
    FROM lh_users
    WHERE username = '{$colaborador['pessoal']['usuario']}'";

  $resultado = mysqli_query($conexao, $query);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $colaborador['pessoal']['id']        = $registro['id'];
    $colaborador['pessoal']['nome']      = $registro['name'];
    $colaborador['pessoal']['sobrenome'] = $registro['surname'];

  }

  return $colaborador;
}

/**
 * cria o caminho da foto do colaborador de acordo com o seu time atual
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 */
function criaCaminhoDaFotoDoColaborador($conexao, $colaborador)
{
  $query =
    "SELECT
    	av_dashboard_times.nome
    FROM av_dashboard_times
    INNER JOIN av_dashboard_colaborador_times
    	ON av_dashboard_colaborador_times.id_times = av_dashboard_times.id
    WHERE (id_colaborador = {$colaborador['pessoal']['id']})
    	AND (data_saida IS NULL)";

  $resultado = mysqli_query($conexao, $query);

  $valor = mysqli_fetch_row($resultado);

  $time = $valor[0];

  # criando caminho da foto do colaborador de acordo com o seu time atual
  $colaborador['pessoal']['caminho_foto'] =
    strtolower('img/teams/' . $time . '/' . $colaborador['pessoal']['nome'] . '_' . $colaborador['pessoal']['sobrenome'] . '.png');

  return $colaborador;
}
