<?php

/**
 * insere um registro de folgas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro de folgas
 */
function insereRegistroDeFolgas($db, $folgas)
{
  $query =
    "INSERT INTO
      av_agenda_folgas
        VALUES (
           {$folgas['id']},
           {$folgas['registro']},
           {$folgas['supervisor']},
           {$folgas['colaborador']},
          '{$folgas['motivo']}',
          '{$folgas['data_inicial']}',
          '{$folgas['data_final']}',
          '{$folgas['observacao']}',
          '{$folgas['registrado']}')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * insere um registro de faltas
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro de faltas
 */
function insereRegistroDeFaltas($db, $faltas)
{
  $query =
    "INSERT INTO
      av_agenda_faltas
        VALUES (
           {$faltas['id']},
           {$faltas['registro']},
           {$faltas['supervisor']},
           {$faltas['colaborador']},
          '{$faltas['motivo']}',
          '{$faltas['atestado']}',
          '{$faltas['data_inicial']}',
          '{$faltas['data_final']}',
          '{$faltas['observacao']}',
          '{$faltas['registrado']}')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * insere um registro de atrasos
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro de atrasos
 */
function insereRegistroDeAtrasos($db, $atrasos)
{
  $query =
    "INSERT INTO
      av_agenda_atrasos
        VALUES (
           {$atrasos['id']},
           {$atrasos['registro']},
           {$atrasos['supervisor']},
           {$atrasos['colaborador']},
          '{$atrasos['motivo']}',
          '{$atrasos['data']}',
          '{$atrasos['tempo_atraso']}',
          '{$atrasos['observacao']}',
          '{$atrasos['registrado']}')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}

/**
 * insere um registro de extras
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do registro de extras
 */
function insereRegistroDeExtras($db, $extras)
{
  $query =
    "INSERT INTO
      av_agenda_extras
        VALUES (
           {$extras['id']},
           {$extras['registro']},
           {$extras['supervisor']},
           {$extras['colaborador']},
          '{$extras['motivo']}',
          '{$extras['data']}',
          '{$extras['tempo_extra']}',
          '{$extras['observacao']}',
          '{$extras['registrado']}')";

  $resultado = mysqli_query($db, $query);

  return $resultado;
}
