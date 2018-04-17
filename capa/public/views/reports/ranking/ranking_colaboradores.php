<?php require '../../../../init.php'; ?>

<?php if (verificaUsuarioLogado('ranking_colaboradores.php')) : ?>

<?php require DIRETORIO_MODULES . 'reports/ranking/ranking.php'; ?>
<?php require DIRETORIO_REQUESTS . 'post/processa_ranking.php'; ?>

<?php 
  
  # recuperando dados da sessão
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
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="text-center" width="9%">Colaborador</th>                  
                  <th class="text-center" width="9%">Demandados</th>              
                  <th class="text-center" width="9%">Realizados</th>                  
                  <th class="text-center" width="9%">Perdidos</th>
                  <th class="text-center" width="9%">%Perda</th>
                  <th class="text-center" width="9%">%Fila 15 Min</th>
                  <th class="text-center" width="7%">TMA</th>
                  <th class="text-center" width="9%">%Avancino</th>
                  <th class="text-center" width="9%">%Eficiência</th>
                  <th class="text-center" width="11%">%Questionários</th>                  
                  <th class="text-center" width="9%">Avancoins</th>
                </tr>
              </thead>

              <tbody>
              <?php foreach ($relatorios as $chave => $valor) : ?>
                
                <?php if (isset($valor['nome']) AND (isset($valor['sobrenome']))) : ?>
                <tr>
                  <td><?php echo $valor['nome'] . ' ' . $valor['sobrenome']; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['atendimentos_demandados'])) : ?>
                  <td class="text-center"><?php echo $valor['atendimentos_demandados']; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['atendimentos_realizados'])) : ?>
                  <td class="text-center"><?php echo $valor['atendimentos_realizados']; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['atendimentos_perdidos'])) : ?>
                  <td class="text-center"><?php echo $valor['atendimentos_perdidos']; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['percentual_perda'])) : ?>
                  <td class="text-center"><?php echo $valor['percentual_perda'] . '%'; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['percentual_fila_ate_15_minutos'])) : ?>
                  <td class="text-center"><?php echo $valor['percentual_fila_ate_15_minutos'] . '%'; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['tma'])) : ?>
                  <td class="text-center"><?php echo $valor['tma']; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['percentual_avancino'])) : ?>
                  <td class="text-center"><?php echo $valor['percentual_avancino'] . '%'; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['percentual_eficiencia'])) : ?>
                  <td class="text-center"><?php echo $valor['percentual_eficiencia'] . '%'; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['percentual_questionario_respondido'])) : ?>
                  <td class="text-center"><?php echo $valor['percentual_questionario_respondido'] .'%'; ?></td>
                <?php endif; ?>

                <?php if (isset($valor['moedas'])) : ?>
                  <td class="text-right"><?php echo $valor['moedas'] . ' '; ?>
                    <i class="fa fa-money" aria-hidden="true"></i>
                  </td>
                </tr>
                <?php endif; ?>                

                <?php 
                  if (isset($valor['total_demandados']))
                    $totalDemandados = $valor['total_demandados'];

                  if (isset($valor['total_realizados']))
                    $totalRealizados = $valor['total_realizados'];

                  if (isset($valor['total_perdidos']))
                    $totalPerdidos = $valor['total_perdidos'];

                  if (isset($valor['total_perc_perda']))
                    $totalPercPerda = $valor['total_perc_perda'];

                  if (isset($valor['total_perc_fila']))
                    $totalPercFila = $valor['total_perc_fila'];
                  
                  if (isset($valor['total_tma']))
                    $totalTma = $valor['total_tma'];
                  
                  if (isset($valor['total_perc_avancino']))
                    $totalPercAvancino = $valor['total_perc_avancino'];

                  if (isset($valor['total_perc_eficiencia']))
                    $totalPercEficiencia = $valor['total_perc_eficiencia'];

                  if (isset($valor['total_perc_questionario_interno']))
                    $totalPercQuestInterno = $valor['total_perc_questionario_interno'];
                  
                  if (isset($valor['total_avancoins']))
                    $totalAvancoins = $valor['total_avancoins'];

                ?>

              <?php endforeach; ?>                               
              </tbody>
            </table>

            <br><br><br>

            <table class="table">
              <tbody>
                <tr>
                  <td class="text-left"   width="9%"><b>Totais</b></td>
                  <td class="text-center" width="9%"><?php echo $totalDemandados; ?></td>
                  <td class="text-center" width="9%"><?php echo $totalRealizados; ?></td>
                  <td class="text-center" width="9%"><?php echo $totalPerdidos; ?></td>
                  <td class="text-center" width="9%"><?php echo $totalPercPerda; ?>%</td>
                  <td class="text-center" width="9%"><?php echo $totalPercFila; ?>%</td>
                  <td class="text-center" width="7%"><?php echo $totalTma; ?></td>
                  <td class="text-center" width="9%"><?php echo $totalPercAvancino; ?>%</td>
                  <td class="text-center" width="9%"><?php echo $totalPercEficiencia; ?>%</td>
                  <td class="text-center" width="11%"><?php echo $totalPercQuestInterno; ?>%</td>
                  <td class="text-right"  width="9%">
                    <?php echo $totalAvancoins; ?>
                    <i class="fa fa-money" aria-hidden="true"></i>
                  </td>
                </tr>
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
