<?php session_start(); ?>
<?php require '../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Tela de Login - CAPA</title>
</head>
<body>
  <h1>Tela de Login - CAPA</h1>

  <?php if (verificaUsuarioLogado()) : ?>
    <p>Olá,
      <?php echo $_SESSION['nome_usuario']; ?> |
      <a href="home.php">Home Page</a> |
      <a href="<?php echo BASE_URL; ?>app/modules/logout/logout.php">Sair</a>
    </p>
  <?php else : ?>
    <p>Olá, visitante . <a href="login/form-login.php">Login</a></p>
  <?php endif; ?>
</body>
</html>
