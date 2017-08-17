<?php

  require '../../../init.php';
  require DIRETORIO_MODULES . 'profile/administrador.php';

  retornaColaboradoresDoChat();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Seleção de Colaborador</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <form class="" action="<?php echo BASE_URL; ?>public/views/profile/colaborador.php" method="get">
      <div class="form-group text-center">
        <label for="usuario">Colaboradores</label>
        <select multiple class="form-control" name="usuario">
          <?php echo $_SESSION['colaboradores']['options']; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Gerar</button>
    </form>
  </div>

  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
