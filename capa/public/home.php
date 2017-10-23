<?php require '../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CAPA - Home Page</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
</head>

<body>

  <?php require BASE_URL . "inc/templates/template_nav_bar.php"  ?>

  <main class="container">
    <h2>CAPA - Home Page<small> Versão 2.0</small></h2>

    <p class="text-right">
      <a href="<?php echo BASE_URL; ?>app/modules/logout/logout.php">Deslogar</a>
    </p>

    <ul>
      <li>
        <a href="<?php echo BASE_URL; ?>../tickets/public/views/screen/novo_ticket.php">Novo Ticket</a>
      </li>
    </ul>
  </main>

  <footer>

  </footer>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
</body>
</html>
