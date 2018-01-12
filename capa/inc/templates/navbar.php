<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo BASE_URL; ?>../capa/public/home.php">
        <img id="logo" src="<?php echo BASE_URL; ?>../capa/public/img/logo.png" alt="Novo Capa">
        <p id="novo-capa">
          Novo Capa
        </p>
      </a>
      <a href="#menu-toggle" title="Menu Lateral" id="menu-toggle">
        <i id="seta" class="fa fa-angle-double-right fa-2x" aria-hidden="true"></i>
      </a>
    </div>
    <ul class="nav navbar-nav navbar-right dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-user fa-2x navbar-brand espacouser entreicons" aria-hidden="true"></i>
        <i id="setauser" class="fa fa-caret-down fa-1x navbar-brand espacoseta entreicons" aria-hidden="true"></i>
      </a>
      <ul class="dropdown-menu">
        <li class="dropdown-header text-center">Acesso</li>
        <li class="divider"></li>
        <li>
          <a href="<?php echo BASE_URL;?>../capa/public/views/login/form_login.php">
            <i class="fa fa-sign-in" aria-hidden="true"></i> Logar
          </a>
        </li>
        <li>
          <a href="<?php echo BASE_URL;?>../capa/app/modules/logout/logout.php">
            <i class="fa fa-sign-out" aria-hidden="true"></i> Deslogar
          </a>
        </li>
      </ul>
    </ul>        
    <?php if (isset($_SESSION['usuario']) AND $_SESSION['usuario']['logado'] == true) : ?>
    <p id="saudacao" class="text-right">      
      <small>Bem vindo,
        <?php echo $_SESSION['usuario']['nome'] . ' ' . $_SESSION['usuario']['sobrenome']; ?>!
      </small>
    </p>
    <?php endif; ?>
  </div>
</nav>
