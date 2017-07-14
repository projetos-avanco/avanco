<?php require '../../../init.php'; ?>

<?php require ABS_PATH . 'app/modules/reports/processa-datas.php'; ?>

<?php $clientes = $_SESSION['clientes']; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Relatórios - CAPA</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">
</head>
<body>
  <h1>Relatórios</h1>

  <form action="" method="get">
    <label for="data">Calendário: </label>
      <input type="date" name="datas[inicial]" id="data" value="<?php echo formataDataParaExibir($data['inicial']); ?>" min="1979-12-31">
      <input type="date" name="datas[final]" id="data" value="<?php echo formataDataParaExibir($data['final']); ?>" max="2099-12-31">

    <label for="cliente">Cliente: </label>
      <select name="cliente">
        <option value="0" selected>Selecione um Cliente</option>
        <?php echo $clientes; ?>
      </select>
    <input type="submit" value="Gerar Relatórios">
  </form>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php exit(var_dump($_GET)); ?>
