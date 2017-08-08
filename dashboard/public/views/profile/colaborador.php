<?php

  require '../../../init.php';

  require ABS_PATH . 'app/requests/processa-perfil.php';

?>

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

  <form action="" method="post">
    <label for="data">Calendário: </label>
      <input type="date" name="datas[data1]" id="datas" min="1979-12-31">
      <input type="date" name="datas[data2]" id="datas" max="2099-12-31">

    <input type="submit" value="Gerar">
  </form>

  <?php if ($_SESSION['colaborador']['id'] != 0 && $_SESSION['colaborador']['mensagem'] == 'sucesso') : ?>

    <?php

      require ABS_PATH . 'app/modules/profile/perfil.php';

      consultaDadosDoColaborador($_SESSION['colaborador']['id']);

    ?>

  <?php else : ?>

    <?php echo '<h2>Erro ao consultar os dados do colaborador!</h2>'; ?>

  <?php endif; ?>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
