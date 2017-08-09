<?php

function consultaIndicadoresDoChat($objeto, $id)
{
  $query =
    "SELECT
      *
    FROM av_dashboard_colaborador
    WHERE id = $id";

  $resultado = mysqli_query($objeto, $query);

  while ($registro = mysqli_fetch_assoc($resultado)) {

    $colaborador['indicadores_do_chat'] = $registro;

  }

  exit(var_dump($colaborador));
}
