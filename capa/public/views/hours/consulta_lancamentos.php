<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('consulta_lancamentos.php')) : ?>

<?php 

  require DIRETORIO_MODULES  . 'hours/horas.php';

  $issues = array();

  # chamando função que recupera todas as issues gravadas no registro de horas
  $issues = recuperaTodasAsIssuesDoRegistroDeHoras();
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta de Issues</title>

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
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/hours/tabela_consulta_lancamentos_horas.css">

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
            <h2>Consulta de Issues</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <div class="row">
          <div class="col-sm-12">
            <table class="table"><!-- painel do suporte -->
              <thead>
                <tr>
                  <th class="hidden" width="10%">Id</th>
                  <th class="text-center" width="10%">Supervisor</th>
                  <th class="text-center" width="10%">Issue</th>
                  <th class="text-center" width="25%">Razão Social</th>       
                  <th class="text-center" width="10%">CNPJ</th>
                  <th class="text-center" width="10%">Conta</th>                  
                  <th class="text-center" width="25%"></th>                
                </tr>
              </thead>

              <tbody>
              <?php foreach ($issues as $issue) : ?>
              <tr>
                <td class="hidden"><?php echo $issue['id']; ?></td>
                <td class="text-center"><?php echo $issue['supervisor']; ?></td>
                <td class="text-center"><?php echo $issue['issue']; ?></td>
                <td class="text-left"><?php echo $issue['razao_social']; ?></td>     
                <td class="text-center"><?php echo $issue['cnpj']; ?></td>
                <td class="text-center"><?php echo $issue['conta_contrato']; ?></td>                
                <td class="text-right">
                  <a class="btn btn-success btn-sm" href="<?php echo BASE_URL; ?>public/views/hours/visualiza_lancamentos.php?issue=<?php echo $issue['issue']; ?>">
                    <i class="fa fa-eye" aria-hidden="true"></i> Visualizar
                  </a>

                  <a class="btn btn-warning btn-sm" href="<?php echo BASE_URL; ?>public/views/hours/edita_lancamentos.php?issue=<?php echo $issue['issue']; ?>">
                    <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                  </a>

                  <a class="btn btn-danger btn-sm" href="<?php echo $issue['issue']; ?>">
                    <i class="fa fa-trash" aria-hidden="true"></i> Excluir
                  </a>
                </td>                
              </tr>
              <?php endforeach; ?>
              </tbody>
            </table><!-- painel do suporte -->
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
  <script src="<?php echo BASE_URL; ?>public/js/hours/paginacao_consulta_lancamentos_horas.js"></script>
  <!--<script src="<?php echo BASE_URL; ?>public/js/tickets/exclusao_ticket.js"></script>-->
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
