<?php

require ABS_PATH . 'database/functions/profile/tables/indicadores-chat.php';

function consultaDadosDasTabelasDoColaborador($id)
{
  $conexao = abre_conexao();

  consultaIndicadoresDoChat($conexao, $id);
}
