<?php require '../../../init.php'; ?>
<?php require_once DIRETORIO_HELPERS . 'datas.php'; ?>

<?php if (verificaUsuarioLogado('atendimento_externo.php')) : ?>

<?php $data = date('Y-m-d'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Portal Avanção - Cadastro Atendimento Externo</title>

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
            <h2>Cadastro Atendimento Externo</h2>
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

        <form action="<?php echo BASE_URL; ?>app/requests/post/schedule/external/processa_atendimento_externo.php" method="post" enctype="multipart/form-data">

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

                  <input class="form-control required" id="id" type="hidden" name="externo[id-cnpj]" value="">                  
                </div>
              </div><!-- painel empresa -->

              <div class="row"><!-- painel endereço -->
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
                            <input class="form-control required" id="logradouro" type="text" name="endereco[logradouro]" placeholder="Avenida" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="distrito">Bairro</label>
                            <input class="form-control required" id="distrito" type="text" name="endereco[distrito]" placeholder="Bairro" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="localidade">Cidade</label>
                            <input class="form-control required" id="localidade" type="text" name="endereco[localidade]" placeholder="Cidade" readonly>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="uf">Estado</label>
                            <input class="form-control required" id="uf" type="text" name="endereco[uf]" placeholder="Estado" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="tipo">Tipo do Endereco</label>
                            <input class="form-control required" id="tipo" type="text" name="endereco[tipo]" placeholder="Tipo do Endereço" readonly>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="cep">Código Postal</label>
                            <input class="form-control required" id="cep" type="text" name="endereco[cep]" placeholder="Código Postal" readonly>
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label for="numero">Número</label>
                            <input class="form-control required" id="numero" type="text" name="endereco[numero]" placeholder="Número" readonly>
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
                            <select class="form-control required" id="colaborador" name="externo[colaborador]">

                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="produto">Produto</label>
                            <select class="form-control required" id="produto" name="externo[produto]">
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
                            <select class="form-control required" id="modulo" name="externo[modulo]">
                              <option value="0"> Selecione um Módulo</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="data-inicial">Data Inicial</label>
                            <input class="form-control required" id="data-inicial" type="date" name="externo[data-inicial]" value="<?php echo $data; ?>">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="data-final">Data Final</label>
                            <input class="form-control required" id="data-final" type="date" name="externo[data-final]" value="<?php echo $data; ?>">
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
                              <input class="form-control required" id="horario" type="text" name="externo[horario]" placeholder="Horário">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label for="anexo">Anexo</label>
                            <span class="btn btn-danger btn-block btn-file">
                              Anexar Arquivo <input id="anexo" type="file" name="externo[anexo]">
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="tarefa">Tarefa</label>
                            <input class="form-control required" id="tarefa" type="text" name="externo[tarefa]" maxlength="255" placeholder="Descreva o trabalho a ser realizado...">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="observacao">Observação</label>
                            <textarea class="form-control" id="observacao" name="externo[observacao]" rows="4" cols="30" placeholder="Observações..."></textarea>
                          </div>
                        </div>
                      </div>                                         
                    </div><!-- panel-body -->
                  </div><!-- panel -->

                  <input type="hidden" name="externo[supervisor]" value="<?php echo $_SESSION['usuario']['id']; ?>">
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

              <div class="row"><!-- painel id's dos contatos em cópia oculta -->
                <div class="col-sm-12">

                  <div class="panel panel-info"><!-- panel -->
                    <div class="panel-heading">
                      <strong>Complementar</strong>
                    </div>

                    <div class="panel-body"><!-- panel-body -->                    
                      <div class="text-left">
                        <ul class="list-group" id="contatos-copia"><!-- tabela contatos -->
                          
                        </ul><!-- tabela contatos -->
                      </div>
                    </div><!-- panel-body -->
                  </div><!-- panel -->                  
                </div>
              </div><!-- painel id's dos contatos em cópia oculta -->

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
                            <select class="form-control required" id="situacao" name="externo[situacao]">                              
                              <option value="1"selected>Confirmado</option>
                              <option value="2">À Confirmar</option>
                              <option value="3">Reservado</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="tipo-atendimento">Tipo Atendimento</label>
                            <select class="form-control required" id="tipo-atendimento" name="externo[tipo-atendimento]">
                              <option value="0" selected>Selecione um Tipo de Atendimento</option>
                              <option value="1">Suporte ao Cliente</option>
                              <option value="2">Projeto Mais Gestão</option>
                              <option value="3">Implantação</option>
                              <option value="4">Treinamento Avanço</option>
                              <option value="5">Instalação</option>
                              <option value="6">Atualização</option>
                            </select>
                          </div>
                        </div>                        
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="despesa">Despesa</label>
                            <select class="form-control required" id="despesa" name="externo[despesa]">
                              <option value="0" selected>Cobrança de Despesas?</option>
                              <option value="1">Sim</option>
                              <option value="2">Não</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="faturado">Faturado</label>
                            <select class="form-control required" id="faturado" name="externo[faturado]">
                              <option value="0" selected>Pedido Faturado?</option>
                              <option value="1">Sim</option>
                              <option value="2">Não</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="cobranca">Tipo Cobrança</label>
                            <select class="form-control" id="cobranca" name="externo[cobranca]">
                              <option value="0" selected>Selecione o Tipo de Cobrança</option>
                              <option value="1">Hora</option>
                              <option value="2">Pacote</option>
                              <option value="3">Não Informado</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="valor">Valor</label>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                  <span class="glyphicon glyphicon-usd"></span>
                                </button>
                              </span>                              
                              <input class="form-control required" id="valor" type="text" name="externo[valor]" placeholder="0.00">
                            </div>
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
  <script src="<?php echo BASE_URL; ?>public/js/schedule/altera_cobranca.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/direciona_usuario.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/contact/deleta_contato.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/colaboradores.js"></script>
  <script src="<?php echo BASE_URL; ?>../tickets/public/js/screen/modulos.js"></script>
  <script src="<?php echo BASE_URL; ?>public/js/schedule/external/validacao.js"></script>

  <script>
    $(function() {
      $(document).ready(function() {        
        $('#horario').mask('00:00');
        $('#valor').mask('#0.00', {reverse: true});        
      });

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

      $(document).on('change', '#cobranca', function(e) {
        e.preventDefault;

        var tipo = $(this).val();

        if (tipo === '3') {
          $('#valor').val('0.00');
          $('#valor').attr('disabled', true);
        } else {
          $('#valor').val('0.00');
          $('#valor').attr('disabled', false);
        } 
      });
    });
  </script>
</body>
</html>

<?php else : ?>

  <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>
