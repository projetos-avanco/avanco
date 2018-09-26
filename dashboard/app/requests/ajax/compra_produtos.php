<?php

# verificando se foi enviada uma requisição via método GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  require '../../../init.php';

  require DIRETORIO_MODELS    . 'store/produtos.php';
  require DIRETORIO_FUNCTIONS . 'store/consultas_produtos.php';
  require DIRETORIO_FUNCTIONS . 'store/insercoes_produtos.php';
  require DIRETORIO_HELPERS   . 'store/email.php';

  # chamando função que cria um modelo para receber os dados da compra
  $compra = criaArrayModeloDeCompra();

  # setando data e horário atual
  $compra['data_compra']    = date('Y-m-d');
  $compra['horario_compra'] = date('H:i:s');

  # recuperando id do colaborador, id do produto e email
  $compra['id_colaborador'] = isset($_GET['idcolaborador']) ? $_GET['idcolaborador'] : null;
  $compra['id_produto']     = isset($_GET['idproduto'])     ? $_GET['idproduto']     : null;
  $compra['email']          = isset($_GET['email'])         ? $_GET['email']         : null;
  $compra['quantidade']     = isset($_GET['quantidade'])    ? $_GET['quantidade']    : null;
  
  # verificando se o id do colaborador e o id da compra foram enviados
  if (! empty($compra['id_colaborador']) AND ! empty($compra['id_produto']) AND ! empty($compra['email'])) {

    $db = abre_conexao();

    # chamando função que consulta se a quantidade de moedas que o colaborador possui pode realizar a compra do produto
    $resposta = consultaQuantidadeDeMoedasParaCompra($db, $compra['id_produto'], $compra['id_colaborador'], $compra['quantidade']);

    # verificando se a compra pode ser realizada
    if ($resposta) {

      # chamando funções que consultam o nome do produto e o nome do colaborador
      $produto     = consultaNomeDoProduto($db, $compra['id_produto']);
      $colaborador = consultaNomeDoColaborador($db, $compra['id_colaborador']);

      # chamando função que envia o email de confirmação de compra
      $compra = enviaEmailDeCompraNaLoja($produto, $colaborador, $compra);

      # eliminando o índice email
      unset($compra['email']);

      # gravando registro da compra
      $resultado = insereProduto($db, $compra);

      # verificando se o registro de compra foi gravado com sucesso
      if ($resultado) {

        echo json_encode("A compra do produto $produto foi realizada com sucesso! A cobrança será registrada no seu extrato.");

      } else {

        echo json_encode('A compra não foi realizada, informe ao Wellington Felix!');

      }

      fecha_conexao($db);

    } else {

      echo json_encode('Você não possui a quantidade de moedas necessárias para comprar esse produto!');

    }

  }

}
