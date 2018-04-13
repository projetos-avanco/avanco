<?php require '../../../../init.php'; ?>

<?php if (verificaUsuarioLogado('ranking_colaboradores.php')) : ?>

<?php require DIRETORIO_MODULES . 'reports/ranking/ranking.php'; ?>
<?php require DIRETORIO_REQUESTS . 'post/processa_ranking.php'; ?>

<?php 
  
  $relatorios = $_SESSION['relatorio']['ranking'];
  $datas      = $_SESSION['relatorio']['datas'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Ranking Colaboradores</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/reports/ranking/tabela_ranking.css"> 

   <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Ranking Colaboradores</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <form class="form-inline" method="post">
          <div class="row text-center">
            <div class="col-sm-4 col-sm-offset-4">
              <div class="panel panel-info">
                <div class="panel-heading"><b>Período</b></div>

                <br>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <input class="form-control" type="date" name="form[data1]" value="<?php echo $datas['data1']; ?>">
                      <input class="form-control" type="date" name="form[data2]" value="<?php echo $datas['data2']; ?>">                 
                    </div><!-- coluna interna -->                    
                  </div><!-- linha interna -->   

                  <br>

                  <div class="row">
                    <div class="col-sm-12">
                      <button class="btn btn-info btn-block" type="submit">Gerar</button>
                    </div>
                  </div>                                          
                </div>
              </div><!-- painel -->
            </div><!-- coluna -->            
          </div><!-- linha -->
        </form>

        <br>

        <div class="row">
          <div class="col-sm-12">
            <h3 class="text-center">Relatório</h3>

            <br>
            
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="text-left">Colaborador</th>                  
                  <th class="text-center">Demandados</th>              
                  <th class="text-center">Realizados</th>
                  <th class="text-center">Perdidos</th>
                  <th class="text-center">Perc. Perda</th>
                  <th class="text-center">Perc. Fila 15 Min</th>
                  <th class="text-center">TMA</th>
                  <th class="text-center">Perc. Avancino</th>
                  <th class="text-center">Perc. Eficiência</th>
                  <th class="text-center">Perc. Questionário</th>
                  <th class="text-right">Avancoins</th>
                </tr>
              </thead>

              <tbody>
              <?php foreach($relatorios as $relatorio) : ?>
                <tr>
                  <td><?php echo $relatorio['nome'] . ' ' . $relatorio['sobrenome']; ?></td>                  
                  <td class="text-center"><?php echo $relatorio['atendimentos_demandados']; ?></td>
                  <td class="text-center"><?php echo $relatorio['atendimentos_realizados']; ?></td>
                  <td class="text-center"><?php echo $relatorio['atendimentos_perdidos']; ?></td>
                  <td class="text-center"><?php echo $relatorio['percentual_perda'] . '%'; ?></td>
                  <td class="text-center"><?php echo $relatorio['percentual_fila'] . '%'; ?></td>
                  <td class="text-center"><?php echo $relatorio['tma']; ?></td>
                  <td class="text-center"><?php echo $relatorio['percentual_avancino'] . '%'; ?></td>
                  <td class="text-center"><?php echo $relatorio['percentual_eficiencia'] . '%'; ?></td>
                  <td class="text-center"><?php echo $relatorio['percentual_questionario'] .'%'; ?></td>
                  <td class="text-right"><?php echo $relatorio['moedas'] . ' '; ?>
                    <i class="fa fa-money" aria-hidden="true"></i>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
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
  <script src="<?php echo BASE_URL; ?>public/js/reports/ranking/paginacao.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
