<?php

$contador = count($colaboradores);

if ($cliente['produto'] == '1') {
  switch ($cliente['modulo']) {
    # Materiais, TNFE, WMS
    case '1':
    case '6':
    case '7':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] != '23' && $colaboradores[$i]['id'] != '30') {
          unset($colaboradores[$i]);
        }
      }

      $quantidade = count($colaboradores);

      $colaboradores = array_values($colaboradores);
      $colaboradores = verificaFilaDosColaboradores($colaboradores, $quantidade, $conexao);

      if (count($colaboradores) == 0) {
        echo json_encode(NULL);
        exit;
      } elseif (count($colaboradores) == 1) {
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      } else {
        usort($colaboradores, "comparaChavesDosArraysInternos");
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      }
        break;

    # Fiscal, Contábil
    case '2':
    case '4':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] != '66') {
          unset($colaboradores[$i]);
        }
      }

      $quantidade = count($colaboradores);
      $colaboradores = array_values($colaboradores);

      if (count($colaboradores) == 0) {
        echo json_encode(NULL);
        exit;
      } elseif (count($colaboradores) == 1) {
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      } else {
        usort($colaboradores, "comparaChavesDosArraysInternos");
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      }
        break;

    # Financeiro
    case '3':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] != '14') {
          unset($colaboradores[$i]);
        }
      }

      $quantidade = count($colaboradores);
      $colaboradores = array_values($colaboradores);

      if (count($colaboradores) == 0) {
        echo json_encode(NULL);
        exit;
      } elseif (count($colaboradores) == 1) {
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      } else {
        usort($colaboradores, "comparaChavesDosArraysInternos");
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      }
        break;

    # Cotação
    case '5':
      for ($i = 0; $i < $contador; $i++) {
        if ($colaboradores[$i]['id'] != '23') {
          unset($colaboradores[$i]);
        }
      }

      $quantidade = count($colaboradores);
      $colaboradores = array_values($colaboradores);

      if (count($colaboradores) == 0) {
        echo json_encode(NULL);
        exit;
      } elseif (count($colaboradores) == 1) {
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      } else {
        usort($colaboradores, "comparaChavesDosArraysInternos");
        redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
      }
        break;
  }
} elseif ($cliente['produto'] == '2') {
  # Qualquer Módulo
  for ($i = 0; $i < $contador; $i++) {
    if ($colaboradores[$i]['id'] != '30') {
      unset($colaboradores[$i]);
    }
  }

  $quantidade = count($colaboradores);
  $colaboradores = array_values($colaboradores);

  if (count($colaboradores) == 0) {
    echo json_encode(NULL);
    exit;
  } elseif (count($colaboradores) == 1) {
    redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
  } else {
    usort($colaboradores, "comparaChavesDosArraysInternos");
    redirecionaClienteParaDepartamento($colaboradores, $cliente, true);
  }
}
