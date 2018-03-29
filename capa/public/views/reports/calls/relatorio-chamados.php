<?php require '../../../../init.php'; ?>

<?php require ABS_PATH . 'app/requests/get/processa-datas.php'; ?>

<?php $clientes = $_SESSION['clientes']; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Relatórios - CAPA</title>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap.min.css">

   <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />
</head>
<body>
  <h1>Relatórios</h1>

  <form action="" method="get">
    <label for="data">Calendário: </label>
      <input type="date" name="datas[inicial]" id="datas" value="<?php echo formataDataParaExibir($datas['inicial']); ?>" min="1979-12-31">
      <input type="date" name="datas[final]" id="datas" value="<?php echo formataDataParaExibir($datas['final']); ?>" max="2099-12-31">

    <label for="cnpj">Cliente: </label>
      <select name="cnpj">
        <option value="0" selected>Selecione um Cliente</option>
        <?php echo $clientes; ?>
      </select>
    <input type="submit" value="Gerar Relatórios">
  </form>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php
  
  if ($_SESSION['relatorios']['exibir']['geral'] == true && ! $_SESSION['relatorios']['exibir']['especifico']) {

    exit(var_dump($_SESSION['relatorios']['chamados']['geral']));

  } else {

    exit(var_dump($_SESSION['relatorios']['chamados']['especifico']));

  }

?>
