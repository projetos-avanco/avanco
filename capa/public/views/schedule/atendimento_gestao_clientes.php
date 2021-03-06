<?php require '../../../init.php'; ?>
<?php require_once DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('atendimento_gestao_clientes.php')) : ?>

<?php $data = date('Y-m-d'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro Atendimento Gestão de Clientes</title>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/normalize/css/normalize_7.0.0.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>libs/bootstrap/css/bootstrap_3.3.7.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/fontes.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/home.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/sidebar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbar.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/schedule/tabelas.css">

  <!-- dispositivos com largura máxima de 769px (por exemplo tablets) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbartablet.css" type="text/css" media="screen and (max-width: 769px)" />
  <!-- dispositivos com largura máxima de 450px (por exemplo smartphones) -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/css/navbarsmart.css" type="text/css" media="screen and (max-width:450px)" />

  <style>
    .erro {
      border: 2px solid red;
    }

    .btn-file {
      position: relative;
      overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
  </style>
</head>

<body>

  <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
  <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
          <div class="col-sm-12">
            <h2>Cadastro Atendimento Gestão de Clientes</h2>
            <hr>
          </div>
        </div>

        <?php if ((!empty($_SESSION['atividades']['mensagens'])) && $_SESSION['atividades']['exibe'] == true) : ?>

        <?php for ($i = 0; $i < count($_SESSION['atividades']['mensagens']); $i++) : ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="text-center">
                <div class="alert alert-<?php echo $_SESSION['atividades']['tipo']; ?>" role="alert">
                    <?php if ($_SESSION['atividades']['tipo'] == 'danger') : ?>
                      <strong>Ops!</strong>
                    <?php else : ?>
                      <strong>Tudo Certo!</strong>
                    <?php endif; ?>

                    <?php echo $_SESSION['atividades']['mensagens'][$i]; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endfor; ?>

        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/customers/processa_atendimento_clientes.php" method="post">

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

              <div class="row"><!-- painel empresa -->
                <div class="col-sm-12">

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

                  <input class="form-control required" id="id" type="hidden" name="gestao[id-cnpj]" value="">                  
                </div>
              </div><!-- painel empresa -->

              <div class="row hidden" id="bloco-endereco"><!-- painel endereço -->
                <div class="col-sm-12">
                
                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-left">
                        <strong>Endereço</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->

                      <div class="row">
                        <div class="col-sm-3 col-sm-offset-9">
                          <div class="form-group">
                            <button class="btn btn-info btn-sm btn-block" id="novo-endereco" type="button">
                              <i class="fa fa-map-marker" aria-hidden="true"></i> Novo Endereço
                            </button>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="logradouro">Logradouro</label>
                            <input class="form-control" id="logradouro" type="text" name="endereco[logradouro]" placeholder="Avenida" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="distrito">Bairro</label>
                            <input class="form-control" id="distrito" type="text" name="endereco[distrito]" placeholder="Bairro" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="localidade">Cidade</label>
                            <input class="form-control" id="localidade" type="text" name="endereco[localidade]" placeholder="Cidade" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="uf">Estado</label>
                            <input class="form-control" id="uf" type="text" name="endereco[uf]" placeholder="Estado" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="tipo">Tipo do Endereco</label>
                            <input class="form-control" id="tipo" type="text" name="endereco[tipo]" placeholder="Tipo do Endereço" readonly>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="cep">Código Postal</label>
                            <input class="form-control" id="cep" type="text" name="endereco[cep]" placeholder="Código Postal" readonly>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label for="numero">Número</label>
                            <input class="form-control" id="numero" type="text" name="endereco[numero]" placeholder="Número" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input class="form-control" id="complemento" type="text" name="endereco[complemento]" placeholder="Complemento" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="referencia">Referência</label>
                            <input class="form-control" id="referencia" type="text" name="endereco[referencia]" placeholder="Referência" readonly>
                          </div>
                        </div>
                      </div>

                    </div><!-- panel-body -->
                  </div><!-- panel -->

                </div>
              </div><!-- painel endereço -->

              <div class="row"><!-- painel atendimento -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Atendimento</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="colaborador">Lista Colaboradores</label>
                            <select class="form-control required" id="colaborador" name="gestao[colaborador]">

                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="produto">Produto</label>
                            <select class="form-control required" id="produto" name="gestao[produto]">
                              <option value="0" selected>Selecione um Produto</option>
                              <option value="1">Integral</option>
                              <option value="2">Frente de Loja</option>
                              <option value="3">Gestor</option>
                              <option value="4">Novo ERP</option>
                              <option value="5">Outros</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="modulo">Módulo</label>
                            <select class="form-control required" id="modulo" name="gestao[modulo]">
                              <option value="0"> Selecione um Módulo</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="data-inicial">Data Inicial</label>
                            <input class="form-control required" id="data-inicial" type="date" name="gestao[data-inicial]" value="<?php echo $data; ?>">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="data-final">Data Final</label>
                            <input class="form-control required" id="data-final" type="date" name="gestao[data-final]" value="<?php echo $data; ?>">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="horario">Horário</label>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                  <span class="glyphicon glyphicon-time"></span>
                                </button>
                              </span>                              
                              <input class="form-control required" id="horario" type="text" name="gestao[horario]" placeholder="Horário">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control" id="observacao" name="gestao[observacao]" rows="4" cols="30" placeholder="Observações..."></textarea>
                          </div>
                        </div>
                      </div>                                         
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="gestao[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">
                </div>
              </div><!-- painel atendimento -->

            </div><!-- primeira coluna principal -->

            <div class="col-sm-6"><!-- segunda coluna principal -->

              <div class="row"><!-- painel contato -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Contato</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-3 col-sm-offset-9">
                          <div class="form-group">
                            <button class="btn btn-info btn-sm btn-block" id="novo-contato" type="button">
                              <i class="fa fa-user-plus" aria-hidden="true"></i> Novo Contato
                            </button>
                          </div>
                        </div>
                      </div>

                      <div class="text-center" id="contatos"><!-- tabela contatos -->

                      </div><!-- tabela contatos -->
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="contato[id-contato]"    id="id-contato">
                  <input type="hidden" name="contato[nome-contato]"  id="nome-contato">
                  <input type="hidden" name="contato[fixo-contato]"  id="fixo-contato">
                  <input type="hidden" name="contato[movel-contato]" id="movel-contato">
                  <input type="hidden" name="contato[email-contato]" id="email-contato">
                </div>
              </div><!-- painel contato -->

              <div class="row">
                <div class="col-sm-12">

                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <strong>Complementar</strong>
                    </div>

                    <div class="panel-body">
                      <div class="text-left">
                        <ul class="list-group" id="contatos-copia">
                          
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row"><!-- painel financeiro -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Financeiro</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="situacao">Situação</label>
                            <select class="form-control required" id="situacao" name="gestao[situacao]">                              
                              <option value="1"selected>Confirmado</option>
                              <option value="2">À Confirmar</option>
                              <option value="3">Reservado</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="tipo-atendimento">Tipo Atendimento</label>
                            <select class="form-control required" id="tipo-atendimento" name="gestao[tipo-atendimento]">
                              <option value="0" selected>Selecione um Tipo de Atendimento</option>
                              <option value="1">Visita de Relacionamento</option>
                              <option value="2">Ligação para o Dono</option>
                            </select>
                          </div>
                        </div>                        
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                </div>
              </div><!-- painel financeiro -->

              <div class="row"><!-- painel registro -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <div class="text-center">
                        <strong>Registro</strong>
                      </div>
                    </div>

                    <div class="panel-body"><!-- panel-body -->
                      <div class="text-center">
                        <h1>
                          <strong id="ticket">
                            <?php if (isset($_SESSION['registro'])) : ?>
                              <?php echo $_SESSION['registro']; ?>
                            <?php else : ?>
                              0
                            <?php endif; ?>
                          </strong>
                        </h1>
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                </div>
              </div><!-- painel registro -->

              <div class="row">
                <div class="col-sm-3 col-sm-offset-6">
                  <button class="btn btn-block btn-default btn-sm" id="btn-atualizar" type="button">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                    Resetar
                  </button>
                </div>

                <div class="col-sm-3">
                  <button class="btn btn-block btn-success btn-sm" type="submit" name="submit" value="submit">
                    <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                    Gravar
                  </button>
                </div>
              </div>

            </div><!-- segunda coluna principal -->
          </div><!-- linha principal -->
          
        </form>

        <?php unset($_SESSION['atividades'], $_SESSION['registro']); ?>

      </div><!-- container -->
    </div><!-- conteúdo da página -->
  </div><!-- wrapper -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
  <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

  <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/pesquisa.js"></script>  
  <script src="<?php echo BASE_URL; ?>public/js/schedule/seleciona_empresa.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/seleciona_contatos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/direciona_usuario.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/deleta_contato.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/customers/tipo_atendimento.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/modulos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/external/validacao.js"></script>

  <script>
    $(function() {
      $(document).ready(function() {        
        $('#horario').mask('00:00');
      });

      // atualizando página
      $(document).on('click', '#btn-atualizar', function(e) {
        e.preventDefault;

        window.location.reload(true);
      });

      // aterando data final caso a data inicial seja alterada
      $(document).on('change', '#data-inicial', function(e) {
        e.preventDefault;

        var dataInicial = $('#data-inicial').val();

        $('#data-final').val(dataInicial);
      });

      // alterando tipo de atendimento
      $(document).on('change', '#tipo-atendimento', function(e) {
        e.preventDefault;

        var tipo = $('#tipo-atendimento').val();

        // verificando se o tipo de atendimento é visita de relacionamento
        if (tipo == '1') {
          $('#bloco-endereco').removeClass('hidden');
          
          $('#logradouro').addClass('required');
          $('#distrito').addClass('required');
          $('#localidade').addClass('required');
          $('#uf').addClass('required');
          $('#tipo').addClass('required');
          $('#cep').addClass('required');
          $('#numero').addClass('required');
        } else {
          $('#bloco-endereco').addClass('hidden');

          $('#logradouro').removeClass('required');
          $('#distrito').removeClass('required');
          $('#localidade').removeClass('required');
          $('#uf').removeClass('required');
          $('#tipo').removeClass('required');
          $('#cep').removeClass('required');
          $('#numero').removeClass('required');
        }
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
