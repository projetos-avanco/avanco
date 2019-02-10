<?php require '../../../../dashboard/init.php'; ?>

<?php require DIRETORIO_MODULES  . 'store/produtos.php'; ?>
<?php require DIRETORIO_MODULES  . 'avancoins/avancoins.php'; ?>
<?php require DIRETORIO_REQUESTS . 'processa_perfil.php'; ?>


<?php if (verificaUsuarioLogado('loja.php')) : ?>

<?php

  # verificando se o usuário que está logado é do atendimento (se sim, será enviado o id do dele)
  if ($_SESSION['usuario']['nivel'] == 1) {

    # chamando função responsável por atualizar as ações diárias do colaborador no período atual
    atualizaAcoesDiarias($_SESSION['colaborador']['id']);

    # chamando função responsável por atualizar a quantidade de moedas na carteira do colaborador
    atualizaCarteira($_SESSION['colaborador']['id']);

    # chamando função responsável por retornar a quantidade atual de moedas do colaborador
    $avancoins = retornaQuantidadeDeMoedasDaCarteira($_SESSION['colaborador']['id']);

  } else { # verificando se o usuário que está logado é supervisor (se sim, será enviado o id do wellington felix para retorno 0 avancoins)

    $_SESSION['colaborador']['id'] = '35';

    # chamando função responsável por atualizar as ações diárias do colaborador no período atual
    atualizaAcoesDiarias('35');

    # chamando função responsável por atualizar a quantidade de moedas na carteira do colaborador
    atualizaCarteira('35');

    # chamando função responsável por retornar a quantidade atual de moedas do colaborador
    $avancoins = retornaQuantidadeDeMoedasDaCarteira('35');

  }

  # chamando função responsável por retornar os dados dos produtos disponíveis na loja avanção
  $produtos = retornaProdutosDaLojaAvancao();
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Loja Avanção</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>../capa/libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>../capa/libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>../capa/public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>../capa/public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/store/loja.css">

  <style>
    .panel-body {
      height: 467px;
    }

    .espaco {
      padding-bottom: 74px;
    }
  </style>
</head>

<body>

  <div class="container">

    <div class="row">
      <br>
      <div class="col-sm-12">
        <h1>Loja Avanção</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="text-right">
          <p id="avancoins">
            <img src="<?php echo BASE_URL; ?>public/img/others/avancoins.png" alt="Moeda Avancoins" width="5%" height="5%">

            <?php foreach ($avancoins as $avancoin) : ?>
              <img class="avancoins" src="<?php echo $avancoin; ?>" alt="Avancoins">
            <?php endforeach; ?>
          </p>
        </div>
      </div>
    </div>

    <div class="row"><!-- primeira seção de produtos -->
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[23]['imagem']; ?>" alt="<?php echo $produtos[23]['descricao']; ?>">
                <h4><?php echo $produtos[23]['descricao']; ?></h4>
              </p>
              <p class="preco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Açai 300ml">
                <?php echo $produtos[23]['valor']; ?>
              </p>

              <div class="row">
                <div class="col-sm-4 col-sm-offset-8">
                  <div class="form-group">
                    <label for="">Quantidade</label>
                    <input class="form-control" id="quant-udemy" type="number" value="1" min="1">
                  </div>
                </div>
              </div>

              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[23]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[13]['imagem']; ?>" alt="<?php echo $produtos[13]['descricao']; ?>">
                <h4><?php echo $produtos[13]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Açai 300ml">
                <?php echo $produtos[13]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[13]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!--
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[20]['imagem']; ?>" alt="<?php echo $produtos[20]['descricao']; ?>">
                <h4><?php echo $produtos[20]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Açai 300ml">
                <?php echo $produtos[20]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[20]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
      -->

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[12]['imagem']; ?>" alt="<?php echo $produtos[12]['descricao']; ?>">
                <h4><?php echo $produtos[12]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Açai 500ml">
                <?php echo $produtos[12]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[12]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- primeira seção de produtos -->

    <div class="row"><!-- segunda seção de produtos -->
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[11]['imagem']; ?>" alt="<?php echo $produtos[11]['descricao']; ?>">
                <h4><?php echo $produtos[11]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Manicure e Pedicure">
                <?php echo $produtos[11]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[11]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[14]['imagem']; ?>" alt="<?php echo $produtos[14]['descricao']; ?>">
                <h4><?php echo $produtos[14]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Vale Presente R$50,00 Livraria Cultura">
                <?php echo $produtos[14]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[14]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[10]['imagem']; ?>" alt="<?php echo $produtos[10]['descricao']; ?>">
                <h4><?php echo $produtos[10]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Ventilador de Mesa">
                <?php echo $produtos[10]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[10]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- segunda seção de produtos -->

    <div class="row"><!-- terceira seção de produtos -->
      <!--
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[15]['imagem']; ?>" alt="<?php echo $produtos[15]['descricao']; ?>">
                <h4><?php echo $produtos[15]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Vale Presente R$50,00 Lojas Americanas">
                <?php echo $produtos[15]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[15]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[9]['imagem']; ?>" alt="<?php echo $produtos[9]['descricao']; ?>">
                <h4><?php echo $produtos[9]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="PenDrive 64GB">
                <?php echo $produtos[9]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[9]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    -->
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[21]['imagem']; ?>" alt="<?php echo $produtos[21]['descricao']; ?>">
                <h4><?php echo $produtos[21]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Ventilador de Mesa">
                <?php echo $produtos[21]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[21]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[8]['imagem']; ?>" alt="<?php echo $produtos[8]['descricao']; ?>">
                <h4><?php echo $produtos[8]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Par de Ingressos para o Cinema">
                <?php echo $produtos[8]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[8]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[7]['imagem']; ?>" alt="<?php echo $produtos[7]['descricao']; ?>">
                <h4><?php echo $produtos[7]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Rodízio de Pizza com Acompanhante">
                <?php echo $produtos[7]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[7]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- terceira seção de produtos -->

    <div class="row"><!-- quarta seção de produtos -->
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[6]['imagem']; ?>" alt="<?php echo $produtos[6]['descricao']; ?>">
                <h4><?php echo $produtos[6]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Garrafa de Cachaça Vale Verde">
                <?php echo $produtos[6]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[6]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[5]['imagem']; ?>" alt="<?php echo $produtos[5]['descricao']; ?>">
                <h4><?php echo $produtos[5]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="1 Dia de Folga">
                <?php echo $produtos[5]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[5]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[16]['imagem']; ?>" alt="<?php echo $produtos[16]['descricao']; ?>">
                <h4><?php echo $produtos[16]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Massagem Relaxante">
                <?php echo $produtos[16]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[16]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- quarta seção de produtos -->

    <div class="row"><!-- quinta seção de produtos -->
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[4]['imagem']; ?>" alt="<?php echo $produtos[4]['descricao']; ?>">
                <h4><?php echo $produtos[4]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Garrafa de Jack Daniels">
                <?php echo $produtos[4]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[4]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[3]['imagem']; ?>" alt="<?php echo $produtos[3]['descricao']; ?>">
                <h4><?php echo $produtos[3]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Garrafa de Absolut">
                <?php echo $produtos[3]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[3]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[2]['imagem']; ?>" alt="<?php echo $produtos[2]['descricao']; ?>">
                <h4><?php echo $produtos[2]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Rodízio Baby Beef com Acompanhante">
                <?php echo $produtos[2]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[2]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- quinta seção de produtos -->

    <div class="row"><!-- sexta seção de produtos -->
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[19]['imagem']; ?>" alt="<?php echo $produtos[19]['descricao']; ?>">
                <h4><?php echo $produtos[19]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Rodízio Baby Beef com Acompanhante">
                <?php echo $produtos[19]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[19]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[1]['imagem']; ?>" alt="<?php echo $produtos[1]['descricao']; ?>">
                <h4><?php echo $produtos[1]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Home Theater">
                <?php echo $produtos[1]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[1]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p class="descricao">
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[0]['imagem']; ?>" alt="<?php echo $produtos[0]['descricao']; ?>">
                <h4><?php echo $produtos[0]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="1 Semana de Folga">
                <?php echo $produtos[0]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[0]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- sexta seção de produtos -->

    <div class="row"><!-- sétima seção de produtos -->
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[17]['imagem']; ?>" alt="<?php echo $produtos[17]['descricao']; ?>">
                <h4><?php echo $produtos[17]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Smarthphone Moto G5 Plus">
                <?php echo $produtos[17]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[17]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">
              <p>
                <img class="img-thumbnail" src="<?php echo BASE_URL; ?><?php echo $produtos[18]['imagem']; ?>" alt="<?php echo $produtos[18]['descricao']; ?>">
                <h4><?php echo $produtos[18]['descricao']; ?></h4>
              </p>
              <p class="preco espaco">
                <img src="<?php echo BASE_URL; ?>public/img/store/others/avancoins.png" alt="Smarthphone Asus Zenfone 3">
                <?php echo $produtos[18]['valor']; ?>
              </p>
              <p class="comprar">
                <button class="btn btn-info btn-lg btn-block" type="button" value="<?php echo $produtos[18]['id']; ?>">Comprar</button>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- sétima seção de produtos -->

    <div class="row">
      <div class="col-sm-6">
        <input id="colaborador" type="hidden" value="<?php echo $_SESSION['colaborador']['id']; ?>"><!-- id do colaborador -->
      </div>

      <div class="col-sm-6">
        <input id="email" type="hidden" value="<?php echo $_SESSION['usuario']['email']; ?>"><!-- e-mail do colaborador -->
      </div>
    </div>

  </div><!-- container -->
  <script src="<?php echo BASE_URL; ?>../capa/libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>../capa/libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/store/compra.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
