<?php

/**
 * consulta os dados do registro de folgas
 * @param - objeto com uma conexção aberta
 * @param - inteiro com o id da folga
 */
function consultaDadosDoRegistroDeFolga($db, $id)
{
  $query = 
    "SELECT
      f.id,
      f.registro,
      f.colaborador AS id_colaborador,      
      CONCAT(u.name, ' ', u.surname) AS nome_colaborador,
      f.motivo,      
      f.data_inicial,
      f.data_final,      
      f.observacao
    FROM av_agenda_folgas AS f
    INNER JOIN lh_users AS u
      ON u.id = f.colaborador
    WHERE f.id = $id";

  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {    
    $linha['observacao'] = ucwords($linha['observacao']);

    $dados['id']               = $linha['id'];
    $dados['registro']         = $linha['registro'];
    $dados['id_colaborador']   = $linha['id_colaborador'];
    $dados['nome_colaborador'] = $linha['nome_colaborador'];
    $dados['motivo']           = $linha['motivo'];    
    $dados['data_inicial']     = $linha['data_inicial'];
    $dados['data_final']       = $linha['data_final'];
    $dados['observacao']       = $linha['observacao'];
  }

  return $dados; 
}

/**
 * consulta os dados do registro de faltas
 * @param - objeto com uma conexção aberta
 * @param - inteiro com o id da falta
 */
function consultaDadosDoRegistroDeFalta($db, $id)
{
  $query = 
    "SELECT
      f.id,
      f.registro,
      f.colaborador AS id_colaborador,      
      CONCAT(u.name, ' ', u.surname) AS nome_colaborador,
      f.motivo,
      f.atestado,
      f.data_inicial,
      f.data_final,      
      f.observacao
    FROM av_agenda_faltas AS f
    INNER JOIN lh_users AS u
      ON u.id = f.colaborador
    WHERE f.id = $id";

  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {    
    $linha['observacao'] = ucwords($linha['observacao']);

    $dados['id']               = $linha['id'];
    $dados['registro']         = $linha['registro'];
    $dados['id_colaborador']   = $linha['id_colaborador'];
    $dados['nome_colaborador'] = $linha['nome_colaborador'];
    $dados['motivo']           = $linha['motivo'];
    $dados['atestado']         = $linha['atestado'];    
    $dados['data_inicial']     = $linha['data_inicial'];
    $dados['data_final']       = $linha['data_final'];
    $dados['observacao']       = $linha['observacao'];
  }

  return $dados;   
}

/**
 * consulta os dados do registro de atrasos
 * @param - objeto com uma conexção aberta
 * @param - inteiro com o id da atraso
 */
function consultaDadosDoRegistroDeAtraso($db, $id)
{
  $query = 
    "SELECT
      a.id,
      a.registro,
      a.colaborador AS id_colaborador,      
      CONCAT(u.name, ' ', u.surname) AS nome_colaborador,
      a.motivo,
      a.data,
      a.tempo_atraso,
      a.observacao
    FROM av_agenda_atrasos AS a
    INNER JOIN lh_users AS u
      ON u.id = a.colaborador
    WHERE a.id = $id";

  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {    
    $linha['observacao'] = ucwords($linha['observacao']);

    $dados['id']               = $linha['id'];
    $dados['registro']         = $linha['registro'];
    $dados['id_colaborador']   = $linha['id_colaborador'];
    $dados['nome_colaborador'] = $linha['nome_colaborador'];
    $dados['motivo']           = $linha['motivo'];
    $dados['data']             = $linha['data'];
    $dados['tempo_atraso']     = $linha['tempo_atraso'];
    $dados['observacao']       = $linha['observacao'];
  }

  return $dados;
}

/**
 * consulta os dados do registro de extra
 * @param - objeto com uma conexção aberta
 * @param - inteiro com o id da extra
 */
function consultaDadosDoRegistroDeExtra($db, $id)
{
  $query = 
    "SELECT
      e.id,
      e.registro,
      e.colaborador AS id_colaborador,      
      CONCAT(u.name, ' ', u.surname) AS nome_colaborador,
      e.motivo,
      e.data,
      e.tempo_extra,
      e.observacao
    FROM av_agenda_extras AS e
    INNER JOIN lh_users AS u
      ON u.id = e.colaborador
    WHERE e.id = $id";

  $resultado = mysqli_query($db, $query);

  $dados = array();

  while ($linha = mysqli_fetch_array($resultado)) {    
    $linha['observacao'] = ucwords($linha['observacao']);

    $dados['id']               = $linha['id'];
    $dados['registro']         = $linha['registro'];
    $dados['id_colaborador']   = $linha['id_colaborador'];
    $dados['nome_colaborador'] = $linha['nome_colaborador'];
    $dados['motivo']           = $linha['motivo'];
    $dados['data']             = $linha['data'];
    $dados['tempo_extra']      = $linha['tempo_extra'];
    $dados['observacao']       = $linha['observacao'];
  }

  return $dados;  
}