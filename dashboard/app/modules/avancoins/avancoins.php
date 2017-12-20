<?php

require DIRETORIO_MODELS    . 'carteira.php';
require DIRETORIO_FUNCTIONS . 'avancoins/periodo.php';
require DIRETORIO_FUNCTIONS . 'avancoins/acoes_diarias.php';

# chamando função que abre uma conexão com a base de dados
$db = abre_conexao();

# chamando função que cria uma array modelo de carteira de avancoins
$carteira = defineArrayModeloDeCarteiraAvancoins();

# recuperando id do colaborador
$carteira['id_colaborador'] = $_SESSION['colaborador']['id'];

# chamando função que retorna o período que deve ser consultado
$carteira = verificaPeriodoAtivo($db, $carteira);

$carteira['periodo']['data_inicial'] = '2017-12-01'; # RETIRAR
$carteira['periodo']['data_final']   = '2017-12-12'; # RETIRAR

# chamando função que consulta todas as ações diárias do colaborador no período atual
$acoes = consultaAcoesDiarias($db, $carteira);

# chamando função que retorna os logs de ações diárias no período atual
$logs = retornaLogsDeAcoesDiarias($db, $carteira);

# verificando se não existe nenhum log de ações diárias no período atual
if (count($logs) == 0) {

  # chamando função que insere todas as ações diárias no período atual na tabela do logs de ações diárias
  insereAcoesDiarias($db, $acoes);

} else {

  # chamando função que remove as ações existentes
  $acoes = removeAcoesDiariasRepetidas($db, $acoes, $logs);

  # chamando função que insere todas as ações diárias no período atual na tabela do logs de ações diárias
  insereAcoesDiarias($db, $acoes);

}

unset ($acoes, $logs);

fecha_conexao($db);
