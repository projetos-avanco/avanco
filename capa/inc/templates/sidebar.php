<div id="wrapper">
  <div id="sidebar-wrapper"><!-- sidebar -->
    <ul class="nav sidebar-nav">
      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu1">
          <span class="nav-header-primary">
            <i class="fa fa-tags" aria-hidden="true"></i>  Tickets
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu1">
          <li><a href="<?php echo BASE_URL; ?>../tickets/public/views/screen/novo_ticket.php"><p>Novo<p></a></li>
          <li><a href="#"><p>Consultar<p></a></li>
        </ul>
      </li>
      <li class="bordermenu">
        <a href="<?php echo BASE_URL; ?>../dashboard/public/views/login/form_login.php"><i class="fa fa-address-card" aria-hidden="true"></i>   Dashboard</a>
      </li>
      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu2">
          <span class="nav-header-primary">
            <i class="fa fa-pie-chart" aria-hidden="true"></i>  Painéis
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu2">
          <li><a href="<?php echo BASE_URL; ?>../capa/public/views/panels/colaboradores_logados.php"><p>Logados<p></a></li>
        </ul>
      </li>
    </ul>
  </div><!-- sidebar -->

  <div id="page-content-wrapper"><!-- conteúdo da página -->
    <div class="container-fluid"><!-- container -->
      <?php if (isset($_SESSION['usuario']) AND $_SESSION['usuario']['logado'] == true) : ?>
      <div class="row">
        <div class="col-sm-12">
          <h5 class="text-right"><small>Bem vindo,
            <?php echo $_SESSION['usuario']['nome'] . ' ' . $_SESSION['usuario']['sobrenome']; ?>!</small></h5>
        </div>
      </div>
      <?php endif; ?>
