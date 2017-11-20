<?php

/**
 * separa os colaboradores do setor externo em outro array
 * @param - array com os dados de todos os colaboradores
 */
function separaColaboradoresExterno($painelSuporte)
{
  $painelExterno = array();

  for ($i = 0; $i < count($painelSuporte); $i++) {

    if ($painelSuporte[$i]['colaborador'] == 36 OR
        $painelSuporte[$i]['colaborador'] == 37 OR
        $painelSuporte[$i]['colaborador'] == 38 OR
        $painelSuporte[$i]['colaborador'] == 39 OR
        $painelSuporte[$i]['colaborador'] == 40 OR
        $painelSuporte[$i]['colaborador'] == 41) {

          array_push($painelExterno, $painelSuporte[$i]);

    }

  }

  return $painelExterno;

}
