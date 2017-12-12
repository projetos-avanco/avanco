<?php

/*
 * consulta e retorna os dados do painel de colaboradores logados
 */
function retornaDadosParaPainelDeColaboradoresLogados()
{
  require DIRETORIO_MODELS    . 'panels/modelo_colaboradores_logados.php';
  require DIRETORIO_FUNCTIONS . 'panels/consultas_colaboradores_logados.php';

  $painel = criaModeloDeColaboradoresLogados();
  $paineis = array('suporte' => array(), 'externo' => array());
  $db = abre_conexao();

  # chamando função que consulta id, departamento, nome e sobrenome dos colaboradores
  $painel = consultaDadosDosColaboradores($painel, $db);

  # separando colaboradores do suporte e do externo
  for ($i = 0; $i < count($painel); $i++) {

    if
      ($painel[$i]['id'] == 36 OR
       $painel[$i]['id'] == 37 OR
       $painel[$i]['id'] == 38 OR
       $painel[$i]['id'] == 39 OR
       $painel[$i]['id'] == 40 OR
       $painel[$i]['id'] == 41) {

         $paineis['externo'][] = $painel[$i];

       } else {

         $paineis['suporte'][] = $painel[$i];

       }
  }

  unset($painel);

  fecha_conexao($db);

  return $paineis;
}
