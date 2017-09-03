<?php

function recuperaConhecimentoDoColaborador($conexao, $id)
{
  $query =
    "SELECT
      	p.nome AS produto,
        m.nome AS modulo,
        e.nome AS especialidade,
        h.conhecimento
    FROM av_dashboard_colaborador_especialidades AS h
    INNER JOIN av_dashboard_especialidades AS e
    	ON e.id = h.id_especialidade
    INNER JOIN av_dashboard_modulos AS m
    	ON m.id = h.id_modulo
    INNER JOIN av_dashboard_produtos AS p
    	ON p.id = m.id_produto
    WHERE (h.id_colaborador = $id)";

  $resultado = mysqli_query($conexao, $query);

  $conhecimento = array();

  $conhecimento = mysqli_fetch_all($resultado);


}
