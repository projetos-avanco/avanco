<?php

$curva = true;

$contador = count($colaboradores);

if ($cliente['produto'] == '1') {
  switch ($cliente['modulo']) {
    # Materiais, TNFE, WMS
    case '1':
    case '6':
    case '7':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] == '23') {
            $colaborador = [];

            array_push($colaborador, $colaboradores[$i]);
            redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
        }
      }
    break;

    # Fiscal, Contábil
    case '2':
    case '4':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] == '66') {
            $colaborador = [];

            array_push($colaborador, $colaboradores[$i]);
            redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
        }
      }
    break;

    # Financeiro
    case '3':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] == '14') {
            $colaborador = [];

            array_push($colaborador, $colaboradores[$i]);
            redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
        }
      }
    break;

    # Cotação
    case '5':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] == '23') {
            $colaborador = [];

            array_push($colaborador, $colaboradores[$i]);
            redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
        }
      }
    break;
  }
} elseif ($cliente['produto'] == '2') {
  # Qualquer Módulo
  for ($i = 0; $i < $contador; $i++) {
    if ($colaboradores[$i]['id'] == '30') {
        $colaborador = [];

        array_push($colaborador, $colaboradores[$i]);
        redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
    }
  }
}
