<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>



    <div class="container">
      <div class="row" style="padding-top: 80px;">

        <div class="col-md-4">
        </div>

          <div class="col-md-4">
            <div class="card">
              <div class="card-header text-center">
                <h5 >Login</h5>
              </div>
                <div class="card-body">
                  <form action="<?php echo BASE_URL; ?>app/requests/processa_login.php" method="post">
                    <div class="form-group">
                      <!--label for="usuario">Usuário</label-->
                      <input type="text" class="form-control" id="usuario" name="login[usuario]" aria-describedby="userHelp" placeholder="Digite o usuário">
                      <small id="userHelp" class="form-text text-muted">Seu usuário consiste em nome.sobrenome</small>
                    </div>
                    <div class="form-group">
                      <!--label for="senha">Senha</label-->
                      <input type="password" class="form-control" id="senha"  name="login[senha]" placeholder="Digite a senha" >
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        <text class=" text-muted">Lembrar Usuário</text>
                      </label>
                    </div>
                    <button type="submit" id="teste" class="btn btn-lg btn-success btn-block">Entrar</button>
                  </form>
                </div>
            </div>
          </div>

          <div class="col-md-4">
          <div>

        </div>
      </div>


      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/js/bootstrap.min.js"></script>

  </body>
</html>
