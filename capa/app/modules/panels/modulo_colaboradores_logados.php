<?php

/*
 * consulta e retorna os dados do painel de colaboradores logados
 */
function retornaDadosParaPainelDeColaboradoresLogados()
{
  require DIRETORIO_MODELS    . 'panels/modelo_colaboradores_logados.php';
  require DIRETORIO_FUNCTIONS . 'panels/consultas_colaboradores_logados.php';

  $painel = criaModeloDeColaboradoresLogados();
  $db     = abre_conexao();

  $painel = consultaDadosDosColaboradores($painel, $db);

  fecha_conexao($db);

  return $painel;
}
