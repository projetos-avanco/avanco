<div id="wrapper">
  <div id="sidebar-wrapper"><!-- sidebar -->
    <ul class="nav sidebar-nav">
      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu1">
          <span class="nav-header-primary">
            <i class="fa fa-user" aria-hidden="true"></i> Usuário
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu1">
        <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/users/cadastro.php">
              <p>Cadastro Usuário<p>
            </a>
          </li>
        <?php endif; ?>

          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/users/conta.php">
              <p>Minha Conta<p>
            </a>
          </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu2">
          <span class="nav-header-primary">
            <i class="fa fa-id-card-o" aria-hidden="true"></i> Dashboard
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu2">
        <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 1) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../dashboard/public/views/profile/colaborador.php" target="_blank">
              <p>Colaborador<p>
            </a>
          </li>
        <?php elseif(isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../dashboard/public/views/profile/administrador.php" target="_blank">
              <p>Administrador<p>
            </a>
          </li>
        <?php endif; ?>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu3">
          <span class="nav-header-primary">
            <i class="fa fa-money" aria-hidden="true"></i> Avancoins
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu3">
        <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 1) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/avancoins/extrato.php">
              <p>Extrato<p>
            </a>
          </li>
        <?php elseif(isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/avancoins/nova_atividade.php">
              <p>Atividade<p>
            </a>
          </li>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/avancoins/extrato.php">
              <p>Extrato<p>
            </a>
          </li>
        <?php endif; ?>
        <li>
          <a href="<?php echo BASE_URL; ?>../dashboard/public/views/store/loja.php" target="_blank">
            <p>Loja<p>
          </a>
        </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu4">
          <span class="nav-header-primary">
            <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Agendamento
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu4">
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/agenda.php">
              <p>Agenda<p>
            </a>
          </li>

        <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/atendimento_externo.php">
              <p>Externo<p>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/atendimento_gestao_clientes.php">
              <p>Gestão<p>
            </a>
          </li>
          
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/atendimento_remoto.php">
              <p>Remoto<p>
            </a>
          </li>
        <?php endif; ?>
        </ul>
      </li>

    <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu9">
          <span class="nav-header-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Registros
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu9">
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/folgas.php">
              <p>Folgas<p>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/faltas.php">
              <p>Faltas<p>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/atrasos.php">
              <p>Atrasos<p>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/extras.php">
              <p>Extras<p>
            </a>
          </li>
        </ul>
      </li>
    <?php endif; ?>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu10">
          <span class="nav-header-primary">
            <i class="fa fa-plane" aria-hidden="true"></i> Férias
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu10">
        <?php if ($_SESSION['usuario']['nivel'] == '2') : ?>
          <?php if ($_SESSION['usuario']['id'] == '5') : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/vacation/exercicio_ferias.php">
              <p>Exercício<p>
            </a>
          </li>

          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/vacation/exercicio_ferias_lancados.php">
              <p>Lançados<p>
            </a>
          </li>
          <?php endif; ?>

          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/vacation/exercicio_ferias_pedidos.php">
              <p>Pedidos<p>
            </a>
          </li>

          <?php if ($_SESSION['usuario']['id'] == '5') : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/vacation/exercicio_ferias_manifestacao.php">
              <p>Manifestação<p>
            </a>
          </li>
          <?php endif; ?>
        <?php elseif ($_SESSION['usuario']['nivel'] == '1') : ?>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/vacation/exercicio_ferias_pedidos.php">
              <p>Pedidos<p>
            </a>
          </li>          
        <?php endif; ?>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu5">
          <span class="nav-header-primary">
            <i class="fa fa-tags" aria-hidden="true"></i> Tickets
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu5">
          <li>
            <a href="<?php echo BASE_URL; ?>../tickets/public/views/screen/novo_ticket.php">
              <p>Novo<p>
            </a>
          </li>
          <li>
          <?php if ($_SESSION['usuario']['nivel'] == 1) : ?>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/tickets/consulta_tickets_clb.php">
              <p>Consultar<p>
            </a>
          <?php elseif ($_SESSION['usuario']['nivel'] == 2) : ?>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/tickets/consulta_tickets_adm.php">
              <p>Consultar<p>
            </a>
          <?php endif; ?>
          </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu6">
          <span class="nav-header-primary">
            <i class="fa fa-clock-o" aria-hidden="true"></i> Horas
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu6">
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/hours/registro_horas.php">
              <p>Novo<p>
            </a>
          </li>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/hours/consulta_lancamentos.php">
              <p>Consultar<p>
            </a>
          </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu7">
          <span class="nav-header-primary">
            <i class="fa fa-television" aria-hidden="true"></i> Painéis
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        <ul class="nav collapse"  id="submenu7">
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/panels/metas_capitaes_selecao.php">
              <p>Metas<p>
            </a>
          </li>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/panels/colaboradores_logados.php">
              <p>Logados<p>
            </a>
          </li>
          <li>
            <a href="<?php echo BASE_URL; ?>../capa/public/views/panels/ramais.php">
              <p>Ramais<p>
            </a>
          </li>
        </ul>
      </li>

      <li class="bordermenu">
        <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu8">
          <span class="nav-header-primary">
            <i class="fa fa-bar-chart" aria-hidden="true"></i> Relatórios
            <span class="pull-right">
                <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
            </span>
          </span>
        </a>
        
        <ul class="nav collapse"  id="submenu8">
          <li class="bordermenu">
            <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu11">
            <span class="nav-header-primary">
              Registros
              <span class="pull-right">
                  <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
              </span>
            </span>

            <ul class="nav collapse" id="submenu11">
              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/relatorio_folgas.php">
                  <p>Folgas<p>
                </a>
              </li>

              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/relatorio_faltas.php">
                  <p>Faltas<p>
                </a>
              </li>

              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/relatorio_atrasos.php">
                  <p>Atrasos<p>
                </a>
              </li>

              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/relatorio_extras.php">
                  <p>Extras<p>
                </a>
              </li>
            </ul>
          </li>

        <?php if (isset($_SESSION['usuario']['nivel']) AND $_SESSION['usuario']['nivel'] == 2) : ?>
          <li class="bordermenu">
            <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu12">
            <span class="nav-header-primary">
              Agendamento
              <span class="pull-right">
                  <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
              </span>
            </span>

            <ul class="nav collapse" id="submenu12">
              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/gerencial_atendimento_externo.php">
                  <p>Externo<p>
                </a>
              </li>

              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/gerencial_atendimento_remoto.php">
                  <p>Remoto<p>
                </a>
              </li>

              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/schedule/gerencial_painel_cliente.php">
                  <p>Painel Cliente<p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

          <li class="bordermenu">
            <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu13">
            <span class="nav-header-primary">
              Avancoins
              <span class="pull-right">
                  <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
              </span>
            </span>

            <ul class="nav collapse" id="submenu13">
              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/reports/ranking/ranking_colaboradores.php">
                  <p>Ranking<p>
                </a>
              </li>
            </ul>
          </li>

          <li class="bordermenu">
            <a href="#" class="accordion-heading" data-toggle="collapse" data-target="#submenu14">
            <span class="nav-header-primary">
              Suporte
              <span class="pull-right">
                  <i id="setinha" class="fa fa-caret-down" aria-hidden="true"></i>
              </span>
            </span>

            <ul class="nav collapse" id="submenu14">
              <li>
                <a href="<?php echo BASE_URL; ?>../capa/public/views/reports/calls/consulta_atendimentos.php">
                  <p>Atendimentos<p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div><!-- sidebar -->

  <div id="page-content-wrapper"><!-- conteúdo da página -->
    <div class="container-fluid"><!-- container -->
