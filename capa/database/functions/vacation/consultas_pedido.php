<?php

/**
 * consulta o registro de um pedido de férias
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function consultaRegistroDeUmPedidoDeFerias($db, $id)
{
  $query = "SELECT registro FROM av_agenda_pedidos_ferias WHERE id_exercicio = $id LIMIT 1";

  $resultado = mysqli_query($db, $query);

  $registro = mysqli_fetch_row($resultado);
  $registro = $registro[0];

  return $registro;
}

/**
 * consulta a situação dos pedidos de férias
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function consultaSituacaoDosPedidosDeFerias($db, $id)
{
  $query = "SELECT situacao FROM av_agenda_pedidos_ferias WHERE id_exercicio = $id LIMIT 1";

  $resultado = mysqli_query($db, $query);

  $situacao = mysqli_fetch_row($resultado);
  $situacao = $situacao[0]  ;

  return $situacao;
}

/**
 * consulta os pedidos de um exercício de férias sem enviar html
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do exercício de férias
 */
function consultaPedidosDeFeriasParaAprovacao($db, $id)
{
  $query = 
    "SELECT	
      e.data_inicial,
      e.data_final,
      e.dias
    FROM av_agenda_pedidos_ferias AS e
    WHERE (e.id_exercicio = $id)
      AND (e.situacao = 1)";
  
  $resultado = mysqli_query($db, $query);

  $pedido = array();

  $quantidade = $resultado->num_rows;

  if ($quantidade == 1) {
    while ($linha = mysqli_fetch_array($resultado)) {
      $pedido['data_inicial'] = $linha['data_inicial'];
      $pedido['data_final']   = $linha['data_final'];
      $pedido['dias']         = $linha['dias'];
    }    
  } elseif ($quantidade > 1) {
    $contador = 1;

    while ($linha = mysqli_fetch_array($resultado)) {
      $pedido['periodo' . $contador]['data_inicial'] = $linha['data_inicial'];
      $pedido['periodo' . $contador]['data_final']   = $linha['data_final'];
      $pedido['periodo' . $contador]['dias']         = $linha['dias'];

      $contador++;
    }
  }

  return $pedido;
}

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

  $html = 
    "<div class='list-group'>
      <a href='#' class='list-group-item active text-center'>
        Períodos
      </a>";

  $contador = 0;

  while ($linha = mysqli_fetch_array($resultado)) {
    $contador++;

    $registro   = $linha['registro'];
    $registrado = $linha['registrado'];

    
    $html .= 
      "<a class='list-group-item text-center'>
        <strong>$contador º Período</strong> - De {$linha['data_inicial']} até {$linha['data_final']} - {$linha['dias']} Dias
      </a>";    
  }

  $html .= 
    "<a class='list-group-item text-center'>
      <strong>Registro</strong>: $registro
    </a>";

  $html .=
    "<a class='list-group-item text-center'>
      <strong>Solicitado</strong>: Dia $registrado Horas
    </a>";

  $html .= 
    "<br>
    <div class='row'>
      <div class='col-sm-3 col-sm-offset-3'>
        <div class='form-group'>
          <button class='btn btn-block btn-warning btn-sm' id='btn-alterar' type='button'>
            <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
            Alterar
          </button>
        </div>
      </div>

      <div class='col-sm-3'>
        <div class='form-group'>
          <button class='btn btn-block btn-success btn-sm' id='btn-aprovar' type='button'>
            <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
            Aprovar
          </button>
        </div>
      </div>
    </div>";

  $html .= "</div>";

  return $html;
}