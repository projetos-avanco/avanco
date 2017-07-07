<?php session_start(); ?>
<?php require '../../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Login CAPA</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">
</head>
<body>
  <h1>Formulário de Login</h1>

  <form action="<?php echo BASE_URL; ?>app/modules/login/login.php" method="post">
    <label for="usuario">Usuário: </label>
      <input type="text" name="login[usuario]" id="usuario">

    <label for="senha">Senha: </label>
      <input type="password" name="login[senha]" id="senha">

    <input type="submit" value="Entrar">
  </form>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
