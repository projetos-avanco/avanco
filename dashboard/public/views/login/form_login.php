<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/style.css">
  </head>

  <body>
    <form action="<?php echo BASE_URL; ?>app/requests/processa_login.php" method="post">
      <fieldset>
        <legend>Dados de Login</legend>
        <label for="usuario">Usuário: </label>
          <input type="text" name="login[usuario]">
        <label for="senha">Senha: </label>
          <input type="password" name="login[senha]">

        <input type="submit" value="Entrar">
      </fieldset>
    </form>
  </body>
</html>
