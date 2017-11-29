<?php require '../../../init.php'; ?>
<?php require DIRETORIO_HELPERS . 'verifica.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Formulario de Login</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/form_login.css">
</head>

<body>

  <header>

  </header>

  <main>
    <div class="container"><!-- container -->
      <div class="row justify-content-sm-center"><!-- linha -->
        <div class="col-sm-auto text-center"><!-- coluna -->
          <div class="card"><!-- card -->
            <div class="card-header">
              <h5>Login</h5>
            </div>
            <div class="card-body"><!-- corpo do card -->
              <form action="<?php echo BASE_URL; ?>app/requests/processa_login.php" method="post"><!-- formulário -->
                <div class="form-group">
                  <input type="text" class="form-control" id="usuario" name="login[usuario]" placeholder="Usuário">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="senha"  name="login[senha]" placeholder="Senha" >
                </div>
                <div class="form-check text-left">
                  <label for="check" class="form-check-label">
                    <input type="checkbox" id="marcado" class="form-check-input">
                    Lembre-me
                  </label>
                </div>
                <div class="form-group text-right">
                  <a href="<?php echo BASE_URL; ?>public/views/login/form_alteracao_senha.php" class="badge badge-light">Alterar Senha</a>
                </div>
                <button type="submit" id="submetido" class="btn btn-success btn-block">Entrar</button>
              </form><!-- formulário -->
            </div><!-- corpo do card -->
          </div><!-- card -->
        </div><!-- coluna -->
      </div><!-- linha -->

      <?php if ($_SESSION['mensagens']['alteracao_senha']['tipo'] == 1) : ?>

        <div class="row justify-content-sm-center">
          <div class="col-sm-auto text-center">
            <div class="alert alert-success" role="alert">

              <?php echo $_SESSION['mensagens']['alteracao_senha']['mensagem']; ?>

            </div>
          </div>
        </div>

      <?php elseif ($_SESSION['mensagens']['alteracao_senha']['tipo'] == 2) : ?>

        <div class="row justify-content-sm-center">
          <div class="col-sm-auto text-center">
            <div class="alert alert-danger" role="alert">

              <?php echo $_SESSION['mensagens']['alteracao_senha']['mensagem']; ?>

            </div>
          </div>
        </div>

      <?php elseif ($_SESSION['usuario']['tipo'] == 4) : ?>

        <div class="row justify-content-sm-center">
          <div class="col-sm-auto text-center">
            <div class="alert alert-danger" role="alert">

              <?php echo $_SESSION['usuario']['mensagem']; ?>

            </div>
          </div>
        </div>

      <?php endif; ?>

    </div><!-- container -->
  </main>

  <footer>

  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/login/lembre_me.js"></script>
</body>
</html>
