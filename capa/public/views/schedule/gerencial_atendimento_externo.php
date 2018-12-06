<?php require '../../../init.php'; ?>
<?php require DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('gerencial_atendimento_externo.php')) : ?>

<?php 
  $dataInicial = date('Y-m-d');
  $dataFinal = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Consulta Gerencial Atendimento Externo</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">  

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
    .erro {
      border: 2px solid red;
    }

    table thead tr th {
      font-size: 0.95em;
      text-align: left;
    }

    table tbody tr td {
      height: 0.75em;
    }

    .table tbody tr td {
      font-size: 0.80em;
      vertical-align: middle;
    }

    .table {
      font-family: 'Lato Regular', sans-serif;
    }

    .swal-text {      
      padding: 17px;      
      display: block;
      margin: 22px;
      text-align: left;
      color: #61534e;
      font-size: 12.5px;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <h2>Consulta Gerencial Atendimento Externo</h2>
              <hr>
            </div>
          </div>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="row">
            <div class="col-sm-4 col-sm-offset-8">
              <div class="form-group">
                <div class="input-group">                  
                  <input class="form-control" id="pesquisa" type="text" placeholder="Digite a Razão Social ou CNPJ da Empresa">
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="button">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisa
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="row"><!-- linha principal -->
            <div class="col-sm-6"><!-- primeira coluna principal -->

              <div class="panel panel-info"><!-- panel -->
                <div class="panel-heading">
                  <strong>Empresa</strong>
                </div>

                <div class="panel-body"><!-- panel-body -->
                  <div class="row">
                    <div class="col-sm-3 col-sm-offset-9">
                      <div class="form-group">
                        <button class="btn btn-info btn-sm btn-block" id="nova-empresa" type="button">
                          <i class="fa fa-building" aria-hidden="true"></i> Nova Empresa
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="text-center" id="empresas"><!-- tabela de empresas -->
                                        
                  </div><!-- tabela de empresas -->

                  <div class="hidden text-center" id="loader">
                    <img src="<?php echo BASE_URL; ?>public/img/others/loader.gif" alt="loader" width="30%" height="30%">
                  </div>                  
                </div><!-- panel-body -->
              </div><!-- panel -->

              <input type="hidden" id="id" name="id-cnpj">
            </div><!-- primeira coluna principal -->

            <div class="col-sm-6"><!-- segunda coluna principal -->

              <div class="panel panel-info"><!-- panel -->
                <div class="panel-heading">
                  <div class="text-left">
                    <strong>Filtros</strong>
                  </div>
                </div>

                <div class="panel-body"><!-- panel-body -->
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="data-inicial">Data Inicial</label>
                        <input class="form-control" id="data-inicial" type="date" name="data-inicial" value="<?php echo $dataInicial; ?>" placeholder="Data Inicial">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="data-final">Data Final</label>
                        <input class="form-control" id="data-final" type="date" name="data-final" value="<?php echo $dataFinal; ?>" placeholder="Data Final">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="colaborador">Colaborador</label>
                        <select class="form-control required" id="colaborador" name="colaborador">

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="tipo-atendimento">Tipo de Atendimento</label>
                        <select class="form-control required" id="tipo-atendimento" name="tipo-atendimento">
                          <option value="0" selected>Selecione um Tipo</option>
                          <option value="1">Suporte ao Cliente</option>
                          <option value="2">Projeto Mais Gestão</option>
                          <option value="3">Implantação</option>
                          <option value="4">Treinamento Avanço</option>
                          <option value="5">Instalação</option>
                          <option value="6">Atualização</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="produto">Produto</label>
                        <select class="form-control required" id="produto" name="externo[produto]">
                          <option value="0" selected>Selecione um Produto</option>
                          <option value="1">Integral</option>
                          <option value="2">Frente de Loja</option>
                          <option value="3">Gestor</option>
                          <option value="4">Novo ERP</option>
                        </select>
                      </div>
                    </div>
                  </div>                  
                </div><!-- panel-body -->
              </div><!-- panel -->

              <input type="hidden" name="extras[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">

              <div class="row">
                <div class="col-sm-3 col-sm-offset-6">
                  <div class="form-group">
                    <button class="btn btn-block btn-default btn-sm" type="reset">
                      <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                      Resetar
                    </button>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <button class="btn btn-block btn-success btn-sm" id="btn" type="button">
                      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                      Consultar
                    </button>
                  </div>
                </div>
              </div>
              
            </div><!-- segunda coluna principal -->
          </div><!-- linha principal -->
        
        </form>

        <div class="row"><!-- painel registro -->
          <div class="col-sm-12">

            <div class="panel panel-info"><!-- panel -->
              <div class="panel-heading">
                <div class="text-left">
                  <strong>Relatório</strong>
                </div>
              </div>

              <div class="panel-body"><!-- panel-body -->
                <table class="table table-striped table-condensed" id="relatorio">
                  <thead>
                    <tr>
                      <th class="text-center" width="10%">Data</th>
                      <th class="text-center" width="5%">Registro</th>
                      <th class="text-center" width="10%">Situação</th>
                      <th class="text-center" width="15%">Colaborador</th>
                      <th class="text-center" width="15%">Atendimento</th>
                      <th class="text-center" width="30%">Empresa</th>                      
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody id="tbody">               
                  </tbody>                                 
                </table>
              </div><!-- panel-body -->
            </div><!-- panel -->

          </div>
        </div><!-- painel registro -->

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/avancoins/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/pesquisa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/seleciona_empresa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/direciona_usuario.js"></script>

  <script>
    $(function() {
      // imprimindo relatório com a data atual
      $(document).ready(function(e) {
        e.preventDefault;

        var gerencial = {};

        gerencial.dataInicial = $('#data-inicial').val();
        gerencial.dataFinal = $('#data-final').val();

        $.ajax({
          type: 'post',
          url: '../../../database/functions/schedule/external/ajax/paginacao_externo.php',
          dataType: 'json',
          data: {
            data_inicial: '2018-12-04',
            data_final: gerencial.dataFinal
          },
          success: function(dados) {
            var tbody = '';

            for (var i = 0; i < dados.length; i++) {
              tbody += 
                '<tr ' +
                  'data-id="' + dados[i].id + '"' +
                  'data-id-issue="' + dados[i].id_issue + '"' +
                  'data-lancado="' + dados[i].registrado + '"' +
                  'data-registro="' + dados[i].registro + '"' +
                  'data-status="' + dados[i].status + '"' +
                  'data-supervisor="' + dados[i].supervisor + '"' +
                  'data-colaborador="' + dados[i].colaborador + '"' +
                  'data-tipo="' + dados[i].tipo + '"' +
                  'data-empresa="' + dados[i].empresa + '"' +
                  'data-cnpj="' + dados[i].cnpj + '"' +
                  'data-contato="' + dados[i].contato + '"' +
                  'data-periodo="' + dados[i].periodo + '"' +
                  'data-produto="' + dados[i].produto + '"' +
                  'data-observacao="' + dados[i].observacao + '"' +
                  'data-faturado="' + dados[i].faturado + '"' +
                  'data-despesas="' + dados[i].despesas + '"' +
                  'data-relatorio="' + dados[i].relatorio_entregue + '"' +
                  'data-pesquisa="' + dados[i].pesquisa_realizada + '">';
              tbody += '<td class="text-center">' + dados[i].registrado + '</td>';
              tbody += '<td class="text-center">' + dados[i].registro + '</td>';
              tbody += '<td class="text-center">' + dados[i].status.toUpperCase() + '</td>';
              tbody += '<td class="text-left">' + dados[i].colaborador.toUpperCase() + '</td>';
              tbody += '<td class="text-left">' + dados[i].tipo.toUpperCase() + '</td>';
              tbody += '<td class="text-left">' + dados[i].empresa.toUpperCase() + '</td>';              
              tbody += 
                '<td>' +
                  '<button class="btn btn-info btn-sm btn-block" id="visualizar-atendimento" type="button" value="' + dados[i].id + '">' +
                    '<i class="fa fa-eye" aria-hidden="true"></i> Lançamento' +
                  '</button' +
                '</td>';
              
              if (dados[i].relatorio_entregue === 'Sim') {
                tbody += 
                '<td>' +
                  '<button class="btn btn-info btn-sm btn-block" id="visualizar-relatorio" type="button" value="' + dados[i].issue + '">' +
                    '<i class="fa fa-eye" aria-hidden="true"></i> Relatório' +
                  '</button' +
                '</td>';
              } else {
                tbody += 
                '<td>' +
                  '<button class="btn btn-warning btn-sm btn-block" id="editar-relatorio" type="button" value="' + dados[i].issue + '">' +
                    '<i class="fa fa-pencil" aria-hidden="true"></i> Relatório' +
                  '</button' +
                '</td>';
              }

              if (dados[i].pesquisa_realizada === 'Sim') {
                tbody += 
                '<td>' +
                  '<button class="btn btn-info btn-sm btn-block" id="visualizar-pesquisa" type="button" value="' + dados[i].id_pesquisa + '">' +
                    '<i class="fa fa-eye" aria-hidden="true"></i> Pesquisa' +
                  '</button' +
                '</td>';                
              } else {
                tbody += 
                '<td>' +
                  '<button class="btn btn-warning btn-sm btn-block" id="editar-pesquisa" type="button" value="' + dados[i].id_pesquisa + '">' +
                    '<i class="fa fa-eye" aria-hidden="true"></i> Pesquisa' +
                  '</button' +
                '</td>';
              }

              tbody +=
              '<td>' +
                '<button class="btn btn-danger btn-sm btn-block" id="cancelar-atendimento" type="button" value="' + dados[i].id_pesquisa + '">' +
                  '<i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar' +
                '</button' +
              '</td>';

              tbody += '</tr>'
            }            

            $('#tbody').html(tbody);
          },
          error: function(erro) {
            console.log(erro);
          }
        });

        // paginando a tabela
        var table = $('#relatorio').DataTable({
          "aaSorting": [[0, "desc"]],   
          "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ Contratos exibidos por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
            }
          }
        });

        // visualizando relatório do atendimento externo
        $(document).on('click', '#visualizar-atendimento', function(e) {
          e.preventDefault;

          var gerencial = {};

          gerencial.id                 = $(this).closest('tr').attr('data-id');
          gerencial.lancado            = $(this).closest('tr').attr('data-lancado');
          gerencial.registro           = $(this).closest('tr').attr('data-registro');
          gerencial.status             = $(this).closest('tr').attr('data-status');
          gerencial.supervisor         = $(this).closest('tr').attr('data-supervisor');
          gerencial.colaborador        = $(this).closest('tr').attr('data-colaborador');
          gerencial.tipo               = $(this).closest('tr').attr('data-tipo');
          gerencial.empresa            = $(this).closest('tr').attr('data-empresa');
          gerencial.cnpj               = $(this).closest('tr').attr('data-cnpj');
          gerencial.contato            = $(this).closest('tr').attr('data-contato');
          gerencial.periodo            = $(this).closest('tr').attr('data-periodo');
          gerencial.produto            = $(this).closest('tr').attr('data-produto');
          gerencial.observacao         = $(this).closest('tr').attr('data-observacao');
          gerencial.faturado           = $(this).closest('tr').attr('data-faturado');
          gerencial.despesas           = $(this).closest('tr').attr('data-despesas');
          gerencial.relatorio_entregue = $(this).closest('tr').attr('data-relatorio');
          gerencial.pesquisa_realizada = $(this).closest('tr').attr('data-pesquisa');

          gerencial.empresa = gerencial.empresa.substr(0, 32).toUpperCase();

          // exibindo relatório completo pelo alert
          swal({
            icon: 'info',
            title: 'Atendimento Externo!',
            text:               
              'Data: '                + gerencial.lancado            + "\n\n" +
              'Registro: '            + gerencial.registro           + "\n\n" +
              'Situação: '            + gerencial.status             + "\n\n" +
              'Supervisor: '          + gerencial.supervisor         + "\n\n" +
              'Colaborador: '         + gerencial.colaborador        + "\n\n" +
              'Tipo de Atendimento: ' + gerencial.tipo               + "\n\n\n\n" +
              'Empresa: '             + gerencial.empresa            + "\n\n" +
              'CNPJ: '                + gerencial.cnpj               + "\n\n" +
              'Contato: '             + gerencial.contato            + "\n\n" +
              'Período: '             + gerencial.periodo            + "\n\n" +
              'Produto: '             + gerencial.produto            + "\n\n" +
              'Observacao: '          + gerencial.observacao         + "\n\n\n\n" +
              'Faturado: '            + gerencial.faturado           + "\n\n" +
              'Despesas: '            + gerencial.despesas           + "\n\n" +
              'Relatório Entregue: '  + gerencial.relatorio_entregue + "\n\n" +
              'Pesquisa Realizada: '  + gerencial.pesquisa_realizada
          });
        });

        // visualizando relatório de horas
        $(document).on('click', '#visualizar-relatorio', function(e) {
          e.preventDefault;

          var id = $(this).val();

          $.ajax({
            type: 'post',
            url: '../../../database/functions/schedule/external/ajax/dados_relatorio.php',
            dataType: 'json',
            data: {
              id_issue: id
            },
            success: function(dados) {
              var registro = {};
              var despesas = {};
              var lancamentos = [];

              registro.id             = dados.id;
              registro.id_colaborador = dados.id_colaborador;
              registro.razao_social   = dados.razao_social;
              registro.conta_contrato = dados.conta_contrato;
              registro.cnpj           = dados.cnpj;
              registro.issue          = dados.issue;
              registro.supervisor     = dados.supervisor;
              registro.colaborador    = dados.colaborador;
              registro.observacao     = dados.observacao;

              registro.razao_social = registro.razao_social.substr(0, 32).toUpperCase();

              despesas.tipo = dados.tipo;
              despesas.deslocamento = dados.deslocamento;
              despesas.alimentacao = dados.alimentacao;
              despesas.hospedagem = dados.hospedagem;
              despesas.total = dados.total_despesas;

              delete dados.id;
              delete dados.id_colaborador;
              delete dados.razao_social;
              delete dados.conta_contrato;
              delete dados.cnpj;
              delete dados.issue;
              delete dados.supervisor;
              delete dados.colaborador;
              delete dados.observacao;

              delete dados.tipo;
              delete dados.deslocamento;
              delete dados.alimentacao;
              delete dados.hospedagem;
              delete dados.total_despesas;

              for (var i = 0; i < Object.keys(dados).length; i++) {
                lancamentos[i] = dados[i];
              }
              
              // exibindo relatório completo pelo alert
              swal({
                icon: 'info',
                title: 'Registro de Horas!',
                text:
                  'Empresa: '        + registro.razao_social   + "\n\n" +
                  'Conta Contrato: ' + registro.conta_contrato + "\n\n" +
                  'CNPJ: '           + registro.cnpj           + "\n\n" +
                  'Issue: '          + registro.issue          + "\n\n" +
                  'Supervisor: '     + registro.supervisor     + "\n\n" +
                  'Colaborador: '    + registro.colaborador    + "\n\n" +
                  'Observação: '     + registro.observacao     + "\n\n\n\n" +
                  'Tipo: '           + despesas.tipo           + "\n\n" +
                  'Deslocamento: '   + despesas.deslocamento   + "\n\n" +
                  'Alimentação: '    + despesas.alimentacao    + "\n\n" +
                  'Hospedagem: '     + despesas.hospedagem     + "\n\n" +
                  'Total Despesas: ' + despesas.total          + "\n\n\n\n" +
                  lancamentos.map((l) => {
                    return 'Data: ' + l.data + "\n\n" + 'Produto: ' + l.produto + "\n\n" + 'Horas Trabalhadas: ' + l.horas_trabalhadas + "\n\n" + 'Horas Faturadas: ' + l.horas_faturadas + "\n\n" + 'Valor Hora: ' + l.valor_hora + "\n\n" + 'Total: ' + l.total;
                }).join("\n\n ---------- \n\n")
              });                                      
            },
            error: function(erro) {
              console.log(erro);
            }
          });
        });
        
        // editando relatório de horas
        $(document).on('click', '#editar-relatorio', function(e) {
          e.preventDefault;

          var issue = $(this).val();

          var url = window.location.href;

          var tmp = url.split('/');

          url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/hours/edita_lancamentos.php?issue=' + issue;          

          window.open(url, '_blank');
        });

        // visualizando pesquisa externa
        $(document).on('click', '#visualizar-pesquisa', function(e) {
          e.preventDefault;
        });

        $(document).on('click', '#editar-pesquisa', function(e) {
          e.preventDefault;

          var id = $(this).val();

          var url = window.location.href;

          var tmp = url.split('/');

          url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/pesquisa_externa.php?id=' + id;          

          window.open(url, '_blank');
        });
      });
    });    
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
