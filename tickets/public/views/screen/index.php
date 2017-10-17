<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <title>CAPA - Novo Ticket</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap-3.3.7.min.css">

  <style media="screen">
    .panel-body {
      padding: 24px;
    }
  </style>
</head>

<body>

  <div class="container">

    <h2>Novo Ticket</h2>

    <form action="#" method="post">

      <hr>

      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div class="input-group h2">
            <input class="form-control" id="pesquisa" type="text" name="dados[pesquisa]" placeholder="CNPJ ou Razão Social">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </span>
          </div>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-sm-5">
          <div class="form-group">
            <label for="razao-social">Razão Social</label>
            <input class="form-control" id="razao-social" type="text" name="form[razao-social]" value="" placeholder="Razão Social">
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input class="form-control" id="cnpj" type="text" name="form[cnpj]" value="" placeholder="CNPJ">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label for="conta-contrato">Conta Contrato</label>
            <input class="form-control" id="conta-contrato" type="text" name="form[conta-contrato]" value="" placeholder="Conta Contrato">
          </div>
        </div>

        <div class="col-sm-2">
          <label for="cliente">Cliente</label>
          <input class="form-control" id="cliente" type="text" name="form[cliente]" placeholder="Nome do Cliente">
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-sm-3">
          <label for="colaborador">Colaborador</label>
          <select class="form-control" id="colaborador" name="form[colaborador]">
            <option value="0">Selecione um Colaborador</option>
          </select>
        </div>

        <div class="col-sm-4">
          <label for="produto">Produto</label>
          <select class="form-control" id="produto" name="form[produto]">
            <option value="0">Selecione um Produto</option>
            <option value="1">Integral</option>
            <option value="2">Frente de Loja</option>
            <option value="3">Gestor</option>
            <option value="4">Novo ERP</option>
          </select>
        </div>

        <div class="col-sm-4">
          <label for="modulo">Módulo</label>
          <select class="form-control" id="modulo" name="form[modulo]">
            <option value="0">Selecione um Módulo</option>
          </select>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-sm-4">
          <label for="assunto">Assunto</label>
          <textarea class="form-control" id="assunto" name="form[assunto]" rows="5" cols="30"></textarea>
        </div>

        <div class="col-sm-4 col-sm-offset-4">
          <div class="panel panel-primary">
            <div class="panel-heading text-center"><strong>Número do Ticket</strong></div>
            <div class="panel-body text-center">
              <h2><strong>157789</strong></h2>
            </div>
          </div>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-sm-12">
          <button class="btn btn-primary" type="submit"><strong>Gerar</strong></button>
        </div>
      </div>
    </form>
  </div>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery-3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap-3.3.7.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/screen/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/screen/modulos.js"></script>
</body>
</html>
