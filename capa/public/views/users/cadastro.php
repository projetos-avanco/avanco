<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('cadastro.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro de Usuário</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">  

   <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Cadastro de Usuário</h2>

            <hr>
          </div>
        </div><!-- linha -->

        <br>

        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-warning text-center" role="alert">
              <strong>Atenção!</strong> O novo usuário deve ter sido cadastrado no chat.
            </div>
          </div>
        </div>

        <div class="form-inline">
          <div class="form-group">
            <label for="id">Usuário: </label>
            <input class="form-control" id="id" type="text" name="id" placeholder="ID do Usuário no Chat">
          </div>

          <button class="btn btn-primary" type="submit">Buscar</button>
        </div>

        <form action="<?php echo BASE_URL; ?>app/requests/post/recebe_conta.php" method="post" accept-charset="utf-8">
        
        <div class="row"> 
          <div class="col-sm-4">
            <div class="form-group">
              <label for="nome">Nome</label>
              <input class="form-control required" id="nome" type="text" name="form[nome]" value="<?php echo $usuario['nome']; ?>" readonly="true">
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="sobrenome">Sobrenome</label>
              <input class="form-control required" id="sobrenome" type="text" name="form[sobrenome]" value="<?php echo $usuario['sobrenome']; ?>" readonly="true">
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <label for="usuario">Usuário</label>
              <input class="form-control required" id="usuario" type="text" name="form[usuario]" value="<?php echo $usuario['usuario']; ?>" readonly="true">
            </div>
          </div>          
        </div><!-- linha -->

        <div class="row"> 
          <div class="col-sm-6">
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control required" id="email" type="text" name="form[email]" value="<?php echo $usuario['email']; ?>" readonly="true">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="ramal">Ramal</label>
              <input class="form-control required" id="ramal" type="text" name="form[ramal]" value="<?php echo $usuario['ramal']; ?>" placeholder="Ramal">
            </div>
          </div>          
        </div><!-- linha -->

        <div class="row">
          <div class="col-sm-2">
            <input class="form-control required" id="id" type="hidden" name="form[id]" value="<?php echo $usuario['id']; ?>">
          </div>

          <div class="col-sm-10 text-right">            
            <a class="btn btn-default" href="<?php echo BASE_URL; ?>public/views/users/conta.php">
              Limpar Tela
            </a>
            <button class="btn btn-primary" type="submit">
              Atualizar Dados
            </button>
          </div>
        </div><!-- linha -->

        </form>

        <br> 
        
        <div class="row">
          <div class="col-sm-12">
          <?php if (! empty($_SESSION['mensagens']['mensagem']) AND $_SESSION['mensagens']['exibe'] == true) : ?>

            <div class="alert alert-<?php echo $_SESSION['mensagens']['tipo']; ?>" role="alert">
              <?php echo $_SESSION['mensagens']['mensagem']; ?>
              <?php unset($_SESSION['mensagens']['mensagem'], $_SESSION['mensagens']['tipo']); ?>
            </div>

          <?php endif; ?>
          </div>
        </div>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->
  <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>  
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
