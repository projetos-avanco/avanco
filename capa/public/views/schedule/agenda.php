<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('agenda.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Agenda Registros</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)"/>
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)"/>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/fullcalendar/lib/moment.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/fullcalendar/fullcalendar.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/fullcalendar/locale/pt-br.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div id="calendario">

            </div>
          </div>
        </div>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script>
    $(function() {
      $(document).ready(function(e) {
        e.preventDefault;

        $('#calendario').fullCalendar({          
          header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
          },          
          editable: true,
          eventLimit: true, 
          eventSources: [
            {
              url: '../../../database/functions/schedule/dados_agenda_externo.php',              
              color: '#FF7F50',
              textColor: '#FFFFFF'
            },
            {
              url: '../../../database/functions/schedule/dados_agenda_remoto.php',
              color: '#FFD700',
              textColor: '#FFFFFF'
            },
            {
              url: '../../../database/functions/schedule/dados_agenda_folgas.php',
              color: '#00FF00',
              textColor: '#FFFFFF'
            },
            {
              url: '../../../database/functions/schedule/dados_agenda_faltas.php',
              color: '#8A2BE2',
              textColor: '#FFFFFF'
            },
            {
              url: '../../../database/functions/schedule/dados_agenda_atrasos.php',
              color: '#FF00FF',
              textColor: '#FFFFFF'
            },
            {
              url: '../../../database/functions/schedule/dados_agenda_extras.php',
              color: '#00FFFF',
              textColor: '#FFFFFF'
            }
          ]
        });
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
