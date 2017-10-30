<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Formulário de Requisição do Portal</title>
</head>

<body>
  <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_requisicao_portal.php" method="post">
    <label for="conta-contrato">Conta Contrato: </label>
      <input type="text" name="conta_contrato">

    <input type="submit" value="Enviar">
  </form>
</body>
</html>
