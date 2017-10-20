<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Formulário de Login</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/login/login.css">
</head>

<body>

  <header>

  </header>

  <main>
    <div class="container">
      <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_login.php" method="post">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
              <div class="panel-heading text-center">
                <h3 class="panel-title">Login</h3>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="sr-only" for="email">Email</label>
                  <input class="form-control" type="text" name="form[email]" placeholder="Email">
                </div>

                <div class="form-group">
                  <label class="sr-only" for="senha">Senha</label>
                  <input class="form-control" type="text" name="form[senha]" placeholder="Senha">
                </div>

                <br>

                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Lembre-me
                  </label>
                </div>

                <br>

                <button class="btn btn-block btn-success" type="submit">Enviar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>

  <footer>

  </footer>

  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
</body>
</html>
