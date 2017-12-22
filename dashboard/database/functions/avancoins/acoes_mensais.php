<?php

function consultaAcoesMensais($db, $carteira)
{
  $query =
    "SELECT
    	COUNT(id)
    FROM av_avancoins_acoes_mensais_logs
    WHERE (data_acao = '{$carteira['periodo_anterior']['data_final']}');";

  if ($resultado = $db->query($query)) {

    $quantidadeRegistros = $resultado->fetch_row();
    $quantidadeRegistros = $quantidadeRegistros[0];

  }

  if ($quantidadeRegistros == 0) {

    # CHAMA FUNÇÕES QUE VERIFICA AS 10 AÇÕES MENSAIS DO PERIODO ANTERIOR E INSERE NA TABELA DE LOGS MENSAIS
  }

}
