<?php require '../init.php'; ?>

<?php if (verificaUsuarioLogado()) : ?>
  
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

  <header>
    <p>
      Bem vindo a sua Home Page,
      <?php echo $_SESSION['usuario']['nome'] . ' ' . $_SESSION['usuario']['sobrenome']; ?> |
      <a href="<?php echo BASE_URL; ?>app/modules/logout/logout.php">
        Sair
      </a>
    </p>
  </header>

  <main>

  </main>

  <footer>

  </footer>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . FORM_LOGIN); ?>

<?php endif; ?>
