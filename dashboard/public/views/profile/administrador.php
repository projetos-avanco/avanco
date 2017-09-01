<?php

  require '../../../init.php';
  require DIRETORIO_MODULES . 'profile/administrador.php';

  #chamando função que cria as opções com os nomes dos colaboradores para o select dinamicamente
  criaOpcoesComOsColaboradoresDoChat();

  # recuperando opções
  $options = $_SESSION['colaboradores']['options'];

  # eliminando sessão de colaboradores
  unset($_SESSION['colaboradores']['options']);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Seleção de Colaborador</title>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize-7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

  <header>

  </header>

  <main>
    <div class="container">
      <div class="row justify-content-sm-center" style="margin: 25% 0 0 0;"><!-- linha -->
          <div class="col-sm-4 text-center"><!-- coluna -->
            <form class="" action="<?php echo BASE_URL; ?>public/views/profile/colaborador.php" method="post">
              <div class="form-group text-center">
                <label for="usuario"><h2>Colaboradores</h2></label>

                <select class="custom-select form-control" name="usuario">
                  <?php echo $options; ?>
                </select>
              </div>

              <button type="submit" class="btn btn-success btn-block">Visualizar</button>
            </form>
          </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap-4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
