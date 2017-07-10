<?php session_start(); ?>
<?php require '../init.php'; ?>
<?php require '../app/modules/login/check.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Home Page - CAPA</title>
</head>
<body>
  <h1>Home Page do Usuário</h1>

  <p>Bem vindo a sua Home Page, <?php echo $_SESSION['nome_usuario']; ?> | <a href="<?php echo BASE_URL; ?>app/modules/logout/logout.php">Sair</a></p>
</body>
</html>
