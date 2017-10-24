<?php

require ABS_PATH . 'app/helpers/caracteres.php';

/**
 * cria o caminho da foto do colaborador de acordo com o seu time atual
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 */
function criaCaminhoDaFotoDoColaborador($objeto, $modelo)
{
  $query =
    "SELECT
    	av_dashboard_times.nome
    FROM av_dashboard_times
    INNER JOIN av_dashboard_colaborador_times
    	ON av_dashboard_colaborador_times.id_times = av_dashboard_times.id
    WHERE (id_colaborador = {$modelo['pessoal']['id']})
    	AND (data_saida IS NULL)";

  $resultado = mysqli_query($objeto, $query);

  $valor = mysqli_fetch_row($resultado);

  $time = $valor[0];

  # criando caminho da foto do colaborador de acordo com o seu time atual
  $modelo['pessoal']['caminho_foto'] =
    strtolower(BASE_URL . 'public/img/teams/' . $time . '/' . $modelo['pessoal']['nome'] . '_' . $modelo['pessoal']['sobrenome'] . '.png');

  # chamando função que retira os acentos e troca os espaços ( ) por traço (-)
  $modelo['pessoal']['caminho_foto'] = removeAcentos($modelo['pessoal']['caminho_foto']);

  return $modelo['pessoal']['caminho_foto'];
}

/**
 * consulta e retorna os dados pessoais do colaborador (id, nome e sobrenome cadastrados no chat)
 * @param - objeto com uma conexão aberta
 * @param - array com o modelo de colaborador
 */
function consultaDadosPessoaisDoColaborador($objeto, $modelo)
{
  $query =
    "SELECT
    	id,
    	name,
    	surname
    FROM lh_users
    WHERE username = '{$modelo['pessoal']['usuario']}'";

  $resultado = mysqli_query($objeto, $query);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $modelo['pessoal']['id']        = $registro['id'];
    $modelo['pessoal']['nome']      = $registro['name'];
    $modelo['pessoal']['sobrenome'] = $registro['surname'];

  }

  $modelo['pessoal']['caminho_foto'] = criaCaminhoDaFotoDoColaborador($objeto, $modelo);

  return $modelo;
}
