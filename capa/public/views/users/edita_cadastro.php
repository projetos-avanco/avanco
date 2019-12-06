<?php require '../../../init.php'; ?>

<?php if (verificaUsuarioLogado('edita_cadastro.php')) : ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portal Avanção - Edita de Usuário</title>

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

        <style>
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

            table thead tr th {
                font-size: 0.85em;
                text-align: left;
            }

            table tbody tr td {
                height: 0.1em;
            }

            .table tbody tr td {
                font-size: 12px;
                vertical-align: middle;
                padding-top: 0.5%;
                padding-left: 1.5%;
                padding-bottom: 0.5%;
            }

            .table {
                font-family: 'Lato Regular', sans-serif;
            }
        </style>
    </head>

    <body>

        <?php include ABS_PATH . 'inc/templates/navbar.php' ?>
        <?php include ABS_PATH . 'inc/templates/sidebar.php' ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <h2>Edição de Usuário</h2>
                    <hr>
                </div>
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

        <form action="<?php echo BASE_URL; ?>app/requests/post/users/recebe_edicao_cadastro.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <!-- linha principal -->
                <div class="col-sm-7">
                    <!-- primeira coluna principal -->

                    <div class="row">
                        <!-- painel dashboard -->
                        <div class="col-sm-12">

                            <div class="panel panel-info">
                                <!-- panel -->
                                <div class="panel-heading">
                                    <div class="text-left">
                                        <strong>Dashboard</strong>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <!-- panel-body -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="sr-only" for="time">Times</label>
                                                <select class="form-control" id="time" name="cadastro[time]">
                                                    <option value="1" selected>Nenhum Selecionado</option>

                                                    <optgroup label="Times">
                                                        <option value="6">Águia</option>
                                                        <option value="7">Phoenix</option>
                                                        <option value="8">Integradores</option>
                                                        <option value="9">Store Front</option>
                                                        <option value="10">Specialists</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="sr-only" for="foto">Foto</label>
                                                <span class="btn btn-danger btn-block btn-file">
                                                    Anexar Foto <input id="foto" type="file" name="foto">
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" colspan="4">Módulos</th>
                                                    </tr>

                                                    <tr>
                                                        <th class="text-center">Integral</th>
                                                        <th class="text-center">Frente</th>
                                                        <th class="text-center">Outros</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="245" name="cadastro[opcoes][245]" value="36"> Cadastros Gerais
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="239" name="cadastro[opcoes][239]" value="34"> Comandas
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="234" name="cadastro[opcoes][234]" value="29"> App Avanço / Farol de Preços / Integweb / Ivisual / Novos Relatórios Web
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="246" name="cadastro[opcoes][246]" value="36"> Cálculo de Preços
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="240" name="cadastro[opcoes][240]" value="34"> Frente Linux
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="235" name="cadastro[opcoes][235]" value="30"> Central de Compras
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="247" name="cadastro[opcoes][247]" value="36"> Coletores
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="241" name="cadastro[opcoes][241]" value="34"> Frente Windows
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="236" name="cadastro[opcoes][236]" value="31"> Conciliador de Cartões
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="248" name="cadastro[opcoes][248]" value="36"> Contábil
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="242" name="cadastro[opcoes][242]" value="34"> Sitef
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="237" name="cadastro[opcoes][237]" value="32"> E-commerce / MG Mobile
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="249" name="cadastro[opcoes][249]" value="36"> Contas à Pagar / Receber
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="243" name="cadastro[opcoes][243]" value="34">
                                                                    Supervisor
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="238" name="cadastro[opcoes][238]" value="33"> FGF / Systax
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="250" name="cadastro[opcoes][250]" value="36">
                                                                    Controle Bancário
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="244" name="cadastro[opcoes][244]" value="35"> Gestor
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="251" name="cadastro[opcoes][251]" value="36">
                                                                    Cotação de Preços / Sugestão de Compras / Pedidos de Compras
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="269" name="cadastro[opcoes][269]" value="37"> Mercafácil / Dotz / DMCard / Scanntech
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="252" name="cadastro[opcoes][252]" value="36"> Emissão de Etiquetas
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="270" name="cadastro[opcoes][270]" value="38"> NFC-e
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="253" name="cadastro[opcoes][253]" value="36"> Estoque
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="271" name="cadastro[opcoes][271]" value="39"> NovoERP
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="254" name="cadastro[opcoes][254]" value="36"> Exportação de Produtos para o Frente de Loja e Balanças
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="272" name="cadastro[opcoes][272]" value="40"> Tramitador NF-e
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="255" name="cadastro[opcoes][255]" value="36"> Fechamento de Caixa
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="256" name="cadastro[opcoes][256]" value="36"> Importação de Vendas Cupons / Redução Z
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="257" name="cadastro[opcoes][257]" value="36"> Movimentações
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="258" name="cadastro[opcoes][258]" value="36"> Online de Vendas / Clientes
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="259" name="cadastro[opcoes][259]" value="36"> Pedidos de Vendas / DAV / Pré Vendas
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="260" name="cadastro[opcoes][260]" value="36"> Plano de Contas Gerencial / Contábil
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="261" name="cadastro[opcoes][261]" value="36"> Preços de Venda
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="262" name="cadastro[opcoes][262]" value="36"> Recebimento via Coletor / Nota Antecipada / Confronto XML
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="263" name="cadastro[opcoes][263]" value="36"> Relatórios de Entradas e Saidas
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="264" name="cadastro[opcoes][264]" value="36"> Relatórios Fiscais
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="265" name="cadastro[opcoes][265]" value="36"> Rotina de Convênio
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="266" name="cadastro[opcoes][266]" value="36"> Rotina de Produção / Transformação
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="267" name="cadastro[opcoes][267]" value="36"> SPED / Sintegra
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" id="268" name="cadastro[opcoes][268]" value="36"> WMS
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="checkbox">
                                                                <label></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div><!-- panel-body -->
                            </div><!-- panel -->

                        </div>
                    </div><!-- painel dashboard -->

                </div><!-- primeira coluna principal -->

                <div class="col-sm-5">
                    <!-- segunda coluna principal -->
                    <div class="row">
                        <!-- painel usuário -->
                        <div class="col-sm-12">

                            <div class="panel panel-info">
                                <!-- panel -->
                                <div class="panel-heading">
                                    <div class="text-left">
                                        <strong>Usuário</strong>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <!-- panel-body -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="colaborador">Lista Colaboradores</label>
                                                <select class="form-control required" id="colaborador" name="cadastro[colaborador]">

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="senha">Senha</label>
                                                <input class="form-control required" id="senha" type="password" name="cadastro[senha]" placeholder="Senha para o Portal Avanção">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="repita-senha">Confirmação Senha</label>
                                                <input class="form-control required" id="repita-senha" type="password" name="cadastro[repita-senha]" placeholder="Confirmação de Senha para o Portal Avanção">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="nivel">Nível</label>
                                                <select class="form-control" id="nivel" name="cadastro[nivel]">
                                                    <option value="0" selected>Nível de Usuário</option>
                                                    <option value="1">Suporte</option>
                                                    <option value="2">Administrador</option>
                                                    <option value="3">Estagiário</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row hidden" id="bloco-contrato">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="contrato">Contrato</label>
                                                <select class="form-control" name="cadastro[contrato]" id="contrato">
                                                    <option value="1" selected>Contrato Semestral</option>
                                                    <option value="2">Contrato Anual</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="data-admissao">Data Admissão</label>
                                                <input class="form-control" id="data-admissao" type="date" name="cadastro[admissao]" placeholder="Admissão">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="ramal">Ramal</label>
                                                <input class="form-control" id="ramal" type="text" name="cadastro[ramal]" placeholder="Ramal">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- panel-body -->

                                <input type="hidden" id="id-portal" name="cadastro[id-portal]">
                                <input type="hidden" id="nome" name="cadastro[nome]">
                                <input type="hidden" id="sobrenome" name="cadastro[sobrenome]">
                            </div><!-- panel -->
                        </div>
                    </div><!-- painel usuário -->

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
                                <button class="btn btn-block btn-success btn-sm" type="submit" name="submit" value="users">
                                    <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>
                                    Gravar
                                </button>
                            </div>
                        </div>
                    </div>

                </div><!-- segunda coluna principal -->
            </div><!-- linha principal -->

        </form>

        <?php unset($_SESSION['atividades']); ?>

        </div><!-- container -->
        </div><!-- conteúdo da página -->
        </div><!-- wrapper -->
        <script src="<?php echo BASE_URL; ?>libs/jquery/js/jquery_3.2.1.min.js"></script>
        <script src="<?php echo BASE_URL; ?>libs/bootstrap/js/bootstrap_3.3.7.min.js"></script>
        <script src="<?php echo BASE_URL; ?>libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>

        <script src="<?php echo BASE_URL; ?>public/js/sidebar.js"></script>
        <script src="<?php echo BASE_URL; ?>public/js/outros.js"></script>
        <script src="<?php echo BASE_URL; ?>public/js/schedule/colaboradores.js"></script>
        <script src="<?php echo BASE_URL; ?>public/js/users/recupera_dados.js"></script>
        <script src="<?php echo BASE_URL; ?>public/js/users/verifica_nivel.js"></script>

        <script>
            $(function() {
                $(document).ready(function(e) {
                    e.preventDefault;

                    // adicionando classe disabled nos checkboxes
                    $('.checkbox').addClass('disabled');

                    // adicionando atributo disabled nos inputs checkboxes
                    $('input:checkbox').prop('disabled', 'disabled');

                    // percorrendo e desmarcando todos os checkboxes que estiverem marcados
                    $('input:checkbox').each(function() {
                        $(this).prop('checked', false);
                    });

                    // adicionando atributo disabled no select de times
                    $('#time').prop('disabled', 'disabled');

                    // percorrendo options do select de times
                    $('#time option').each(function() {
                        // adicionando o atributo selected no option de valor 1, nos outros, retirando o selected
                        if ($(this).val() == 1) {
                            $(this).prop('selected', true);
                        } else {
                            $(this).prop('selected', false);
                        }
                    });

                    // adicionando o atributo disabled do input file
                    $('#foto').prop('disabled', true);
                    $('#foto').val('');

                    // ocultando bloco de contrato de estagiário
                    $('#bloco-contrato').addClass('hidden');
                    $('#bloco-contrato').prop('disabled', true);

                    // ocultando bloco de contrato de estagiário
                    $('#bloco-contrato').addClass('hidden');
                    $('#bloco-contrato').prop('disabled', true);

                    $('#senha').prop('disabled', 'disabled');
                    $('#repita-senha').prop('disabled', 'disabled');
                    $('#nivel').prop('disabled', 'disabled');
                    $('#contrato').prop('disabled', 'disabled');
                    $('#data-admissao').prop('disabled', 'disabled');
                    $('#ramal').prop('disabled', 'disabled');
                });
            });
        </script>
    </body>

    </html>

<?php else : ?>

    <?php header('Location: ' . BASE_URL . '../capa/public/views/login/form_login.php'); ?>

<?php endif; ?>