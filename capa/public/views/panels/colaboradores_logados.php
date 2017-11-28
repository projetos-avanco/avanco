<?php require '../../../init.php'; ?>
<?php require DIRETORIO_MODULES . 'panels/modulo_colaboradores_logados.php'; ?>
<?php require DIRETORIO_HELPERS . 'paineis.php'; ?>

<?php

  # chamando funçao que recupera os dados para o painel de colaboradores logados
  $painelSuporte = retornaDadosParaPainelDeColaboradoresLogados();

  # chamando função que separa os colaboradores do setor externo
  $painelExterno = separaColaboradoresExterno($painelSuporte);

  unset($painelSuporte[3], $painelSuporte[4], $painelSuporte[5], $painelSuporte[6], $painelSuporte[16], $painelSuporte[24]);
?>

<?php if (verificaUsuarioLogado('colaboradores_logados.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CAPA - Colaboradores Logados</title>

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

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/panels/tabela_logados.css">
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Painel Logados</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <div class="row">
          <div class="col-sm-12">
            <h3 class="text-center">Suporte</h3>

            <br>

            <table class="table"><!-- painel do suporte -->
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Colaborador</th>
                  <th class="text-center">Em Atendimento</th>
                  <th class="text-center">Em Espera</th>
                  <th class="text-center">Logado</th>
                  <th class="text-center">Oculto</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($painelSuporte as $suporte) : ?>
                <tr>
                  <td class="text-center"><b><?php echo $suporte['colaborador']; ?></b></td>
                  <td class="text-center"><?php echo $suporte['nome'] . ' ' . $suporte['sobrenome']; ?></td>
                  <td class="text-center"><?php echo $suporte['atendimento']; ?></td>
                  <td class="text-center"><?php echo $suporte['espera']; ?></td>
                  <td class="text-center"><?php echo $suporte['logado']; ?></td>
                  <td class="text-center"><?php echo $suporte['oculto']; ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do suporte -->

            <br>

            <h3 class="text-center">Externo</h3>

            <br>

            <table class="table"><!-- painel do externo -->
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Colaborador</th>
                  <th class="text-center">Em Atendimento</th>
                  <th class="text-center">Em Espera</th>
                  <th class="text-center">Logado</th>
                  <th class="text-center">Oculto</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($painelExterno as $externo) : ?>
                <tr>
                  <td class="text-center"><b><?php echo $externo['colaborador']; ?></b></td>
                  <td class="text-center"><?php echo $externo['nome'] . ' ' . $externo['sobrenome']; ?></td>
                  <td class="text-center"><?php echo $externo['atendimento']; ?></td>
                  <td class="text-center"><?php echo $externo['espera']; ?></td>
                  <td class="text-center"><?php echo $externo['logado']; ?></td>
                  <td class="text-center"><?php echo $externo['oculto']; ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do externo -->
          </div>
        </div>
      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/panels/destaca_tabela_colaboradores_logados.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/panels/atualizacao_automatica.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/panels/paginacao_tabela.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
