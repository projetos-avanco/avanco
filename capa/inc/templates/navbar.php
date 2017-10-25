<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">
          <img alt="Novo Capa" src="#">
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
    </div>
  </nav>
</header>
