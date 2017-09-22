<?php require '../../init.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Formulário de Teste</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
  <form action="<?php echo BASE_URL; ?>app/requests/recebe_cliente.php" method="post">
    <label for="nome">Nome: </label>
      <input type="text" name="cliente[nome]">

    <label for="nome_usuario">Nome de Usuário: </label>
      <input type="text" name="cliente[nome_usuario]">

    <label for="cnpj">CNPJ: </label>
      <input type="text" name="cliente[cnpj]">

    <label for="conta_contrato">Conta Contrato: </label>
      <input type="text" name="cliente[conta_contrato]">

    <label for="razao_social">Razão Social: </label>
      <input type="text" name="cliente[razao_social]">

    <label for="produto">Produto: </label>
      <input type="text" name="cliente[produto]">

    <label for="modulo">Módulo: </label>
      <input type="text" name="cliente[modulo]">

    <label for="duvida">Dúvida: </label>
      <input type="text" name="cliente[duvida]">

    <input type="submit" name="Enviar">
  </form>
</body>
</html>
