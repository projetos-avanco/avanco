<?php require '../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Tela de Login - CAPA</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">
</head>
<body>
  <h1>Tela de Login - CAPA</h1>

  <?php if (verificaUsuarioLogado()) : ?>
    <p>Olá,
      <?php echo $_SESSION['nome_usuario']; ?> |
      <a href="<?php echo BASE_URL; ?>public/home.php">Home Page</a> |
      <a href="<?php echo BASE_URL; ?>app/modules/logout/logout.php">Sair</a>
    </p>
  <?php else : ?>
    <p>Olá, visitante . <a href="<?php echo BASE_URL; ?>public/views/login/form-login.php">Login</a></p>
  <?php endif; ?>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
