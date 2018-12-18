<?php require '../../../init.php'; ?>
<?php require_once DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('confirma_atendimento_externo.php')) : ?>

<?php
  require_once DIRETORIO_FUNCTIONS . 'schedule/contact/consultas_contato.php';

  # verificando se houve uma requisição via método post
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $db = abre_conexao();

    # verificando se o id do cnpj existe e não está vazio
    if (isset($_GET['id-cnpj']) && (!empty($_GET['id-cnpj']))) {
      # verificando se o id do cnpj é uma string numérica
      if (is_numeric($_GET['id-cnpj'])) {
        $cnpj = (int) $_GET['id-cnpj'];        
      }
    }

    # verificando se o id do contato existe e não está vazio
    if (isset($_GET['id-contato']) && (!empty($_GET['id-contato']))) {
      # verificando se o id do contato é uma string numérica
      if (is_numeric($_GET['id-contato'])) {
        $contato = (int) $_GET['id-contato'];
      }
    }

    $dados = consultaDadosDosContatosDeUmCnpj($db, $cnpj, $contato);    
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Confirmação Atendimento Externo</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/schedule/tabelas.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
    .erro {
      border: 2px solid red;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Confirmação Atendimento Externo</h2>
            <hr>
          </div>
        </div>

        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/external/recebe_confirmacao_atendimento.php" method="post">

          <div class="row">          
            <div class="col-sm-6 col-sm-offset-3">

              <div class="panel panel-info"><!-- panel -->
                <div class="panel-heading">
                  <strong>Complementar</strong>
                </div>

                <div class="panel-body"><!-- panel-body -->                    
                  <div class="text-left">
                    <ul class="list-group" id="contatos-copia"><!-- tabela contatos -->
                      <li class="list-group-item list-group-item-info">
                        <div class="text-center">
                          <strong>enviar e-mail em cópia para</strong>
                        </div>
                      </li>
                      <?php foreach ($dados as $dado) : ?>
                        <li class="list-group-item">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="copia[]" value="<?php echo $dado['id']; ?>"><?php echo $dado['nome']; ?>
                            </label>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul><!-- tabela contatos -->
                  </div>
                </div><!-- panel-body -->                
              </div><!-- panel -->

              <div class="row">
                <div class="col-sm-3 col-sm-offset-6">
                  <button class="btn btn-block btn-default btn-sm" id="btn-voltar" type="button">
                    <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                    Voltar
                  </button>
                </div>

                <div class="col-sm-3">
                  <button class="btn btn-block btn-success btn-sm" type="submit" name="submit" value="submit">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    Confirmar
                  </button>
                </div>
              </div>

            </div>
          </div>

          
          
        </form>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>

  <script>
    $(function() {
      $(document).ready(function() {        
        
      });

      $(document).on('click', '#btn-voltar', function(e) {
        e.preventDefault;

        var url = window.location.href;
        var tmp = url.split('/');

        url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/gerencial_atendimento_externo.php';
        
        window.open(url, '_self');
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
