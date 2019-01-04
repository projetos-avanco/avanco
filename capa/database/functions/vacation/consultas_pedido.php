<?php

/**
 * consulta os pedidos de um exercício de férias
 * @param - objeto com uma conexão aberta 
 * @param - inteiro com o id do exercício de férias
 */
function consultaPedidosDeFerias($db, $id)
{
  $query = 
    "SELECT	
      DATE_FORMAT(e.data_inicial, '%d/%m/%Y') AS data_inicial,
      DATE_FORMAT(e.data_final, '%d/%m/%Y') AS data_final,
      e.dias,
      e.registro,
      DATE_FORMAT(e.registrado, '%d/%m/%Y %H:%i:%s') AS registrado
    FROM av_agenda_pedidos_ferias AS e
    WHERE (e.id_exercicio = $id)
      AND (e.situacao = 1)";
  
  $resultado = mysqli_query($db, $query);

  $html = "<a href='#' class='list-group-item active text-center'></strong>Períodos</strong></a>";
  $contador = 0;

  while ($linha = mysqli_fetch_array($resultado)) {
    $contador++;

    $registro   = $linha['registro'];
    $registrado = $linha['registrado'];

    
    $html .= 
      "<a class='list-group-item text-center'>
        <strong>Período $contador</strong> - De <strong>{$linha['data_inicial']}</strong> até <strong>{$linha['data_final']}</strong> - <strong>{$linha['dias']}</strong> Dias
      </a>";    
  }

  $html .= 
    "<a class='list-group-item text-center'>
      Registro: <strong>$registro</strong>
    </a>";
  $html .=
    "<a class='list-group-item text-center'>
      Solicitado: <strong>$registrado</strong>
    </a>";

  return $html;
}