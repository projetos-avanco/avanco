<?php require '../../../init.php'; ?>
<?php require DIRETORIO_HELPERS . 'verifica.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Formulario de Alteração de Senha</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/form_login.css">
   <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>../capa/public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>../capa/public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />
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
              <h5>Alteração</h5>
            </div>
            <div class="card-body"><!-- corpo do card -->
              <form action="<?php echo BASE_URL; ?>app/requests/processa_alteracao_senha.php" method="post"><!-- formulário -->
                <div class="form-group">
                  <input type="email" class="form-control" id="email" name="alteracao[usuario]" placeholder="Usuário">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="senha-atual" name="alteracao[senha-atual]" placeholder="Senha Atual">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="senha" name="alteracao[senha]" placeholder="Nova Senha">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="confirmacao"  name="alteracao[confirmacao]" placeholder="Repita a Nova Senha" >
                </div>

                <div class="form-group">
                  <div class="text-right">
                    <a href="<?php echo BASE_URL; ?>public/views/login/form_login.php" class="badge badge-light">Voltar</a>
                  </div>
                </div>

                <button type="submit" id="submetido" class="btn btn-success btn-block">Alterar</button>
              </form><!-- formulário -->
            </div><!-- corpo do card -->
          </div><!-- card -->
        </div><!-- coluna -->
      </div><!-- linha -->

      <?php if ($_SESSION['mensagens']['alteracao_senha']['tipo'] == 2) : ?>

        <div class="row justify-content-sm-center">
          <div class="col-sm-auto text-center">
            <div class="alert alert-danger" role="alert">

              <?php echo $_SESSION['mensagens']['alteracao_senha']['mensagem']; ?>

            </div>
          </div>
        </div>

      <?php elseif ($_SESSION['mensagens']['alteracao_senha']['tipo'] == 3) : ?>

        <div class="row justify-content-sm-center">
          <div class="col-sm-auto text-center">
            <div class="alert alert-danger" role="alert">

              <?php echo $_SESSION['mensagens']['alteracao_senha']['mensagem']; ?>

            </div>
          </div>
        </div>

      <?php elseif ($_SESSION['mensagens']['alteracao_senha']['tipo'] == 4) : ?>

        <div class="row justify-content-sm-center">
          <div class="col-sm-auto text-center">
            <div class="alert alert-danger" role="alert">

              <?php echo $_SESSION['mensagens']['alteracao_senha']['mensagem']; ?>

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
