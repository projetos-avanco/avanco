<?php

/**
 * verifica o nível de conhecimento dos colaboradores
 * @param - array com os dados dos colaboradores online
 * @param - array com os dados do cliente que chamou pelo portal avanço
 * @param - inteiro com a quantidade de colaboradores online
 * @param - objeto com uma conexão aberta
 */
function verificaNivelDeConhecimentoDosColaboradoresOnline($colaboradores, $cliente, $quantidade, $db)
{
  $posicao = 0;

  # executando a query para todos os colaboradores do array
  while ($posicao < $quantidade) {

    $query =
      "SELECT
      	ROUND(100 * (
      		(SELECT
      			COUNT(conhecimento) AS conhecimento
      		FROM av_dashboard_colaborador_especialidades
      		WHERE (conhecimento = 1)
      			AND (id_modulo = {$cliente['modulo']})
      			AND (id_colaborador = {$colaboradores[$posicao]['id']}))

      			/

      		(SELECT
      			COUNT(nome) AS especialidade
      		FROM av_dashboard_especialidades
      		WHERE (id_modulo = {$cliente['modulo']}))), 2) AS nivel_de_conhecimento";

    # verificando se a query pode ser executada
    if ($resultado = $db->query($query)) {

      # recuperando o percentual de conhecimento
      while ($registro = $resultado->fetch_array(MYSQLI_ASSOC)) {

        $colaboradores[$posicao]['conhecimento'] = $registro['nivel_de_conhecimento'];

      }

    } else {

      # chamando função que grava um log
      gravaLog('erro na consulta de conhecimento dos colaboradores, no script conhecimento.php', 'error');

    }

    $posicao++;

  }

  return $colaboradores;
}
