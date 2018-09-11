<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $remoto = array();

  if (! empty($_POST['remoto']['id-cnpj']) && is_numeric($_POST['remoto']['id-cnpj'])) {
    $remoto['id_cnpj'] = $_POST['remoto']['id-cnpj'];
  }

  if (! empty($_POST['remoto']['tipo']) && is_numeric($_POST['remoto']['tipo'])) {
    $remoto['tipo'] = $_POST['remoto']['tipo'];
  }

  if (! empty($_POST['remoto']['supervisor']) && is_numeric($_POST['remoto']['supervisor'])) {
    $remoto['supervisor'] = $_POST['remoto']['supervisor'];
  }

  if (! empty($_POST['remoto']['colaborador']) && is_numeric($_POST['remoto']['colaborador'])) {
    $remoto['colaborador'] = $_POST['remoto']['colaborador'];
  }

  if (! empty($_POST['remoto']['data']) && is_string($_POST['remoto']['data'])) {
    $remoto['data'] = $_POST['remoto']['data'];
  }

  if (! empty($_POST['remoto']['horario']) && is_string($_POST['remoto']['horario'])) {
    $remoto['horario'] = $_POST['remoto']['horario'];
  }

  if (! empty($_POST['remoto']['produto']) && is_numeric($_POST['remoto']['produto'])) {
    $remoto['produto'] = $_POST['remoto']['produto'];
  }

  if (! empty($_POST['remoto']['modulo']) && is_numeric($_POST['remoto']['modulo'])) {
    $remoto['modulo'] = $_POST['remoto']['modulo'];
  }

  if (! empty($_POST['remoto']['observacao']) && is_string($_POST['remoto']['observacao'])) {
    $remoto['observacao'] = $_POST['remoto']['observacao'];
  } else {
    $remoto['observacao'] = '';
  }

  if (! empty($_POST['remoto']['faturado']) && $_POST['remoto']['faturado'] == '1') {
    $remoto['faturado'] = 1;
  } else {
    $remoto['faturado'] = 0;
  }

  $remoto['valor_hora'] = 0.0;
  $remoto['valor_pacote'] = 0.0;

  if ($remoto['faturado']) {
    if (! empty($_POST['remoto']['cobranca']) && ! empty($_POST['remoto']['valor'])) {
      if ($_POST['remoto']['cobranca'] == '1') {
        $remoto['valor_hora'] = $_POST['remoto']['valor'];

        settype($remoto['valor_hora'], 'float');
      } else {
        $remoto['valor_pacote'] = $_POST['remoto']['valor'];

        settype($remoto['valor_pacote'], 'float');
      }
    }
  }

  exit(var_dump($remoto));
}
