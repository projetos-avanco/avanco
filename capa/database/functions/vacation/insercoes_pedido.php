<?php

/**
 * insere os pedidos de férias
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do pedido
 * @param - string com o tipo do período selecionado pelo usuário
 */
function inserePedidosDeFerias($db, $pedido, $tipo)
{
  # verificando qual é o tipo do período selecionado pelo usuário
  if ($tipo == '1') {
    $query = 
      "INSERT INTO 
        av_agenda_pedidos_ferias 
      VALUES (
         {$pedido['id']}, 
         {$pedido['id_exercicio']}, 
         {$pedido['registro']}, 
        '{$pedido['situacao']}', 
        '{$pedido['data_inicial']}', 
        '{$pedido['data_final']}', 
         {$pedido['dias']}, 
        '{$pedido['registrado']}')";
    
    $resultado = mysqli_query($db, $query);
  } elseif ($tipo == '2') {
    $query = 
      "INSERT INTO 
        av_agenda_pedidos_ferias 
      VALUES (
         {$pedido['id']}, 
         {$pedido['id_exercicio']}, 
         {$pedido['registro']}, 
        '{$pedido['situacao']}', 
        '{$pedido['periodo1']['data_inicial']}', 
        '{$pedido['periodo1']['data_final']}', 
         {$pedido['periodo1']['dias']}, 
        '{$pedido['registrado']}')";

    $resultado = mysqli_query($db, $query);

    # verificando se a primeira query foi executada com sucesso
    if ($resultado) {
      $query = 
      "INSERT INTO 
        av_agenda_pedidos_ferias 
      VALUES (
         {$pedido['id']}, 
         {$pedido['id_exercicio']}, 
         {$pedido['registro']}, 
        '{$pedido['situacao']}', 
        '{$pedido['periodo2']['data_inicial']}', 
        '{$pedido['periodo2']['data_final']}', 
         {$pedido['periodo2']['dias']}, 
        '{$pedido['registrado']}')";

      $resultado = mysqli_query($db, $query);      
    }
  } else {
    $query = 
      "INSERT INTO 
        av_agenda_pedidos_ferias 
      VALUES (
         {$pedido['id']}, 
         {$pedido['id_exercicio']}, 
         {$pedido['registro']}, 
        '{$pedido['situacao']}', 
        '{$pedido['periodo1']['data_inicial']}', 
        '{$pedido['periodo1']['data_final']}', 
         {$pedido['periodo1']['dias']}, 
        '{$pedido['registrado']}')";

    $resultado = mysqli_query($db, $query);

    # verificando se a primeira query foi executada com sucesso
    if ($resultado) {
      $query = 
      "INSERT INTO 
        av_agenda_pedidos_ferias 
      VALUES (
         {$pedido['id']}, 
         {$pedido['id_exercicio']}, 
         {$pedido['registro']}, 
        '{$pedido['situacao']}', 
        '{$pedido['periodo2']['data_inicial']}', 
        '{$pedido['periodo2']['data_final']}', 
         {$pedido['periodo2']['dias']}, 
        '{$pedido['registrado']}')";

      $resultado = mysqli_query($db, $query);

      if ($resultado) {
        $query = 
        "INSERT INTO 
          av_agenda_pedidos_ferias 
        VALUES (
           {$pedido['id']}, 
           {$pedido['id_exercicio']}, 
           {$pedido['registro']}, 
          '{$pedido['situacao']}', 
          '{$pedido['periodo3']['data_inicial']}', 
          '{$pedido['periodo3']['data_final']}', 
           {$pedido['periodo3']['dias']}, 
          '{$pedido['registrado']}')";

        $resultado = mysqli_query($db, $query);        
      }
    }    
  }

  return $resultado;
}