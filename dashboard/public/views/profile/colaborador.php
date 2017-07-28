<?php require '../../../init.php'; ?>

<?php require ABS_PATH . 'app/requests/get/processa-perfil.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Perfil do Colaborador</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">
</head>
<body>
  <h1>Dashboard do Colaborador</h1>

  <form action="#" method="get">
    <label for="data">Calendário: </label>
      <input type="date" name="datas[inicial]" id="datas" min="1979-12-31">
      <input type="date" name="datas[final]" id="datas" max="2099-12-31">

    <input type="submit" value="Gerar">
  </form>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php exit(var_dump($_SESSION)); ?>
