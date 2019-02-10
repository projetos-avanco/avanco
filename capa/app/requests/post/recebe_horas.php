<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require '../../../init.php';
  require DIRETORIO_MODULES . 'hours/horas.php';

  # reordenando os índices dos lançamentos
  $_POST['lancamentos'] = array_values($_POST['lancamentos']);

  $issues = array(
    'id'             => 0,
    'razao_social'   => '',
    'cnpj'           => '',
    'conta_contrato' => '',
    'tipo'           => '',
    'status'         => '2',
    'issue'          => '',
    'colaborador'    => '',
    'observacao'     => ''
  );

  $despesas = array(
    'total-despesas' => '',
    'deslocamento'   => '',
    'alimentacao'    => '',
    'hospedagem'      => ''
  );

  $lancamentos = array();

  $issues['razao_social']   = isset($_POST['issues']['razao-social'])   ? $_POST['issues']['razao-social']   : null;
  $issues['cnpj']           = isset($_POST['issues']['cnpj'])           ? $_POST['issues']['cnpj']           : null;
  $issues['conta_contrato'] = isset($_POST['issues']['conta-contrato']) ? $_POST['issues']['conta-contrato'] : null;
  $issues['tipo']           = isset($_POST['issues']['tipo'])           ? $_POST['issues']['tipo']           : null;
  $issues['issue']          = isset($_POST['issues']['issue'])          ? $_POST['issues']['issue']          : null;
  $issues['supervisor']     = isset($_POST['issues']['supervisor'])     ? $_POST['issues']['supervisor']     : null;
  $issues['colaborador']    = isset($_POST['issues']['colaborador'])    ? $_POST['issues']['colaborador']    : null;
  $issues['observacao']     = isset($_POST['issues']['observacao'])     ? $_POST['issues']['observacao']     : null;

  # retirando quebras de linhas
  $issues['observacao'] = preg_replace('/[\n|\r|\n\r|\r\n]{2,}/',' ', $issues['observacao']);
  
  # tratando apóstrofos e aspas
  $issues['observacao'] = addslashes($issues['observacao']);

  # tratando o tamanho do texto
  $issues['observacao'] = strtolower($issues['observacao']);

  $despesas['total-despesas'] = isset($_POST['despesas']['total-despesas']) ? $_POST['despesas']['total-despesas'] : null;
  $despesas['deslocamento']   = isset($_POST['despesas']['deslocamento'])   ? $_POST['despesas']['deslocamento']   : null;
  $despesas['alimentacao']    = isset($_POST['despesas']['alimentacao'])    ? $_POST['despesas']['alimentacao']    : null;
  $despesas['hospedagem']     = isset($_POST['despesas']['hospedagem'])     ? $_POST['despesas']['hospedagem']     : null;

  for ($i = 0; $i < count($_POST['lancamentos']) ; $i++) {

    $lancamentos[] = array(

      'data'              => $_POST['lancamentos'][$i]['data'],
      'produto'           => $_POST['lancamentos'][$i]['produto'],
      'horas_trabalhadas' => $_POST['lancamentos'][$i]['horas-trabalhadas'],
      'horas_faturadas'   => $_POST['lancamentos'][$i]['horas-faturadas'],
      'valor_horas'       => $_POST['lancamentos'][$i]['valor-horas'],
      'valor_total'       => $_POST['lancamentos'][$i]['valor-total']

    );

  }

  gravaRegistroDeHoras($issues, $despesas, $lancamentos);

}