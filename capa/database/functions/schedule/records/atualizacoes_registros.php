<?php

/**
 * atualiza um registro de folga
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro
 */
function atualizaDadosDoRegistroDeFolga($db, $dados)
{
  $query = 
    "UPDATE 
      av_agenda_folgas
    SET 
      supervisor   =  {$dados['supervisor']},
      colaborador  =  {$dados['colaborador']},
      motivo       = '{$dados['motivo']}',      
      data_inicial = '{$dados['data_inicial']}',
      data_final   = '{$dados['data_final']}',      
      observacao   = '{$dados['observacao']}',
      registrado   = '{$dados['registrado']}'
    WHERE 
      id = {$dados['id']}";

  $resultado = mysqli_query($db, $query);

  return $resultado; 
}

/**
 * atualiza um registro de falta
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro
 */
function atualizaDadosDoRegistroDeFalta($db, $dados)
{
  # verificando se o motivo selecionado não necessita de arquivo em anexo
  if ($dados['motivo'] == '1') {
    $query = 
      "UPDATE 
        av_agenda_faltas
      SET 
        supervisor   =  {$dados['supervisor']},
        colaborador  =  {$dados['colaborador']},
        motivo       = '{$dados['motivo']}',
        atestado     = '',
        data_inicial = '{$dados['data_inicial']}',
        data_final   = '{$dados['data_final']}',      
        observacao   = '{$dados['observacao']}',
        registrado   = '{$dados['registrado']}'
      WHERE 
        id = {$dados['id']}";
  } elseif ($dados['motivo'] == '2' || $dados['motivo'] == '3' || $dados['motivo'] == '4') {
    # verificando se foi solicitado a alteração do arquivo
    if ($dados['alterar-atestado']) {
      $query = 
        "UPDATE 
          av_agenda_faltas
        SET 
          supervisor   =  {$dados['supervisor']},
          colaborador  =  {$dados['colaborador']},
          motivo       = '{$dados['motivo']}',
          atestado     = '{$dados['atestado']}',
          data_inicial = '{$dados['data_inicial']}',
          data_final   = '{$dados['data_final']}',      
          observacao   = '{$dados['observacao']}',
          registrado   = '{$dados['registrado']}'
        WHERE 
          id = {$dados['id']}";
    } else {
      $query = 
        "UPDATE 
          av_agenda_faltas
        SET 
          supervisor   =  {$dados['supervisor']},
          colaborador  =  {$dados['colaborador']},
          motivo       = '{$dados['motivo']}',          
          data_inicial = '{$dados['data_inicial']}',
          data_final   = '{$dados['data_final']}',      
          observacao   = '{$dados['observacao']}',
          registrado   = '{$dados['registrado']}'
        WHERE 
          id = {$dados['id']}";
    }
  }

  $resultado = mysqli_query($db, $query);

  return $resultado;  
}

/**
 * atualiza um registro de atraso
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro
 */
function atualizaDadosDoRegistroDeAtraso($db, $dados)
{
  $query = 
    "UPDATE 
      av_agenda_atrasos 
    SET 
      supervisor   =  {$dados['supervisor']},
      colaborador  =  {$dados['colaborador']},
      motivo       = '{$dados['motivo']}',
      data         = '{$dados['data']}',
      tempo_atraso = '{$dados['tempo_atraso']}',
      observacao   = '{$dados['observacao']}',
      registrado   = '{$dados['registrado']}'
    WHERE 
      id = {$dados['id']}";
  
  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * atualiza um registro de extra
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro
 */
function atualizaDadosDoRegistroDeExtra($db, $dados)
{
  $query = 
    "UPDATE 
      av_agenda_extras 
    SET 
      supervisor   =  {$dados['supervisor']},
      colaborador  =  {$dados['colaborador']},
      motivo       = '{$dados['motivo']}',
      data         = '{$dados['data']}',
      tempo_extra  = '{$dados['tempo_extra']}',
      observacao   = '{$dados['observacao']}',
      registrado   = '{$dados['registrado']}'
    WHERE 
      id = {$dados['id']}";
  
  $resultado = mysqli_query($db, $query);

  return $resultado;  
}