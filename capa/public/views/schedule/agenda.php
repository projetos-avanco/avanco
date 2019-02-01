<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('agenda.php')) : ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Agenda Registros</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)"/>
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)"/>

  <style>
    .fc-sun {background-color: #FBEFEF;}
    .fc-sat {background-color: #FBEFEF;}

    #lista-colaboradores {
      border: 2px solid #ccc;
      width: 230px;
      height: 150px;
      overflow-y: scroll;
    }

    .checkbox {
      padding-left: 2.5%;
    }

    .swal-text {
      font-size: 15px;
      padding: 12px;
      display: block;
      margin: 22px;
      text-align: left;
      color: #61534e;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Agenda do Atendimento</h2>
              <hr>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div id="calendario">

            </div>
          </div>
        </div>

        <br>

        <div class="row">
          <div class="col-sm-6 col-sm-offset-6"><!-- coluna 1 -->
            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Filtros</strong>
                </div>
              </div>

              <div class="panel-body"><!-- panel-body -->
                <div class="row">
                  <div class="col-sm-6"><!-- coluna 1 -->
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="colaborador">Lista Colaboradores</label>
                          <div id="lista-colaboradores">

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">                  
                      <div class="col-sm-6">                        
                        <div class="form-group">
                          <label for="grupos">Grupos</label>
                          <button class="btn btn-block btn-info btn-sm" id="grupo-1" type="button">Interno</button>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <button class="btn btn-block btn-info btn-sm" id="grupo-2" type="button">Externo</button>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <button class="btn btn-block btn-danger btn-sm" id="grupo-3" type="button">Desmarcar</button>
                        </div>
                      </div>
                    </div>
                  </div><!-- coluna 1 -->

                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-12">
                        <label for="eventos">Lista Eventos</label>
                        <div id="lista-eventos">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="eventos" value="1"> Atendimento Externo
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="eventos" value="2"> Atendimento Remoto
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="eventos" value="3"> Gestão Clientes
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="eventos" value="4"> Férias
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="eventos" value="5"> Faltas
                            </label>
                          </div>

                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="eventos" value="6"> Folgas
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3 col-sm-offset-3">
                    <div class="form-group">
                      <button class="btn btn-block btn-default btn-sm" id="btn-atualizar" type="button">
                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        Atualizar
                      </button>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group">
                      <button class="btn btn-block btn-info btn-sm" id="btn-consultar" type="button">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        Consultar
                      </button>
                    </div>
                  </div>
                </div>

              </div><!-- panel-body -->
            </div><!-- panel -->
          </div><!-- coluna 1 -->          
        </div>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/fullcalendar/lib/moment.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/fullcalendar/fullcalendar.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/fullcalendar/locale/pt-br.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/schedule/exibe_eventos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/filtros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/grupos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/atualiza_pagina.js"></script>

  <script>
    $(function() {
      // executando ao clicar diretamente em um checkbox
      $(document).on('click', '#lista-colaboradores', function(e) {
        var id = [];

        // percorrendo todos os checkboxers
        $('input:checkbox').each(function() {
          // verificando quais checkboxers estão marcados
          if ($(this).is(':checked')) {
            id.push($(this).val());
          }
        });
        
        // salvando id's no formato JSON
        localStorage.setItem('dadosForm', JSON.stringify({listaColaboladores: id}));
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
