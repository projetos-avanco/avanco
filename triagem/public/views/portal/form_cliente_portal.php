<?php require '../../../init.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Formulário de Teste</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style media="screen">
        body {
            margin: 20px 0 0 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <form class="form-inline" action="<?php echo BASE_URL; ?>app/requests/post/recebe_cliente_portal.php" method="post">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only" for="nome">Nome: </label>
                        <input type="text" id="nome" name="cliente[nome]" value="Marlene">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only" for="nome_usuario">Nome de Usuário: </label>
                        <input type="text" id="nome_usuario" name="cliente[nome_usuario]" value="MarleneAdmin">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only" for="cnpj">CNPJ: </label>
                        <input type="text" id="cnpj" name="cliente[cnpj]" value="03111258000153">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only" for="conta_contrato">Conta Contrato: </label>
                        <input type="text" id="conta_contrato" name="cliente[conta_contrato]" value="0000114">
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="sr-only" for="razao_social">Razão Social: </label>
                        <input type="text" id="razao_social" name="cliente[razao_social]" value="SUPERMERCADO MENDES">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="form-control" for="telefone">Telefone: </label>
                        <input type="text" id="telefone" name="cliente[telefone]" value="(31) 3322-8563">
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <select class="form-control" id="produto" name="cliente[produto]">
                        <option value="0" selected>Selecione um Produto</option>

                        <option value="29">App Avanço / Farol de Preços / Integweb / Ivisual / Novos Relatórios Web</option>
                        <option value="30">Central de Compras</option>
                        <option value="31">Conciliador de Cartões</option>
                        <option value="32">E-commerce / MG Mobile</option>
                        <option value="33">FGF / Systax</option>
                        <option value="34">Frente de Loja</option>
                        <option value="35">Gestor</option>
                        <option value="36">Integral</option>
                        <option value="37">Mercafácil / Dotz / DMCard / Scanntech</option>
                        <option value="38">NFC-e</option>
                        <option value="39">NovoERP</option>
                        <option value="40">Tramitador NF-e</option>
                        <option value="5">Tecnologia</option>
                    </select>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <select class="form-control" id="modulo" name="cliente[modulo]">
                        <option value="0" selected>Selecione um Módulo</option>
                    </select>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="sr-only" for="duvida">Dúvida: </label>
                        <input type="text" id="duvida" name="cliente[duvida]" placeholder="Dúvida" required>
                    </div>
                </div>
            </div>

            <br>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" id="enviar">Enviar</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $('document').ready(function() {

            $('#nome').hide();
            $('#nome_usuario').hide();
            $('#cnpj').hide();
            $('#conta_contrato').hide();
            $('#razao_social').hide();

            $('#produto').change(function() {
                var produto = $('#produto').val();

                if (produto == '5') {
                    $('#modulo').hide();
                } else {
                    if ($('#modulo').hide()) {
                        $('#modulo').show();
                    }
                }

                switch (produto) {
                    case '0':
                        $('#modulo').html('<option value="0">Selecione um Módulo</option>');
                        break;

                    case '36':
                        var integral =
                            '<option value="245">Cadastros Gerais (Cliente, Fornecedor, Produto, Filial)</option>' +
                            '<option value="246">Cálculo de Preços (Custo, PMZ, Sugestão)</option>' +
                            '<option value="247">Coletores</option>' +
                            '<option value="248">Contábil (Balancete, DRE, SPED, Integração Contábil)</option>' +
                            '<option value="249">Contas à Pagar / Receber (Cheques, Cartões, Formas de Pagamento, Baixas por Faixa, Indivudual, Lançamentos em Geral)</option>' +
                            '<option value="250">Controle Bancário (Emissão de Boletos, Remessas, Pagamento Escritural, Extrato, Lançamentos)</option>' +
                            '<option value="251">Cotação de Preços / Sugestão de Compras / Pedidos de Compras</option>' +
                            '<option value="252">Emissão de Etiquetas</option>' +
                            '<option value="253">Estoque (Atualização de Inventário, Conferência de Estoque, Relatórios, Ruptura, Validade Extrato)</option>' +
                            '<option value="254">Exportação de Produtos para o Frente de Loja e Balanças</option>' +
                            '<option value="255">Fechamento de Caixa</option>' +
                            '<option value="256">Importação de Vendas Cupons / Redução Z</option>' +
                            '<option value="257">Movimentações (Faturamento, Transferências, Devolução, Entradas de Notas de Compras, Devolução, Serviços, Troca, Requisição Consumo, Quebra)</option>' +
                            '<option value="258">Online de Vendas / Clientes</option>' +
                            '<option value="259">Pedidos de Vendas / DAV / Pré Vendas</option>' +
                            '<option value="260">Plano de Contas Gerencial / Contábil</option>' +
                            '<option value="261">Preços de Venda (Promoções, Tabelas, por Grupo, Individual, a partir das Entradas)</option>' +
                            '<option value="262">Recebimento via Coletor / Nota Antecipada / Confronto XML</option>' +
                            '<option value="263">Relatórios de Entradas e Saidas (Vendas, Compras, Contribuição Marginal, Curva ABC, Média por Cliente, Consultas de Cupons)</option>' +
                            '<option value="264">Relatórios Fiscais (Apuração, PIS / COFINS, DAPI, CIAP, Livros Fiscais)</option>' +
                            '<option value="265">Rotina de Convênio</option>' +
                            '<option value="266">Rotina de Produção / Transformação (Cestas Básicas, Produtos de Padaria, Transformação de Carnes, Montagem de Kits)</option>' +
                            '<option value="267">SPED / Sintegra</option>' +
                            '<option value="268">WMS</option>';

                        $('#modulo').html(integral);
                        break;

                    case '34':
                        var frente =
                            '<option value="239">Comandas</option>' +
                            '<option value="240">Frente Linux</option>' +
                            '<option value="241">Frente Windows</option>' +
                            '<option value="242">Sitef</option>' +
                            '<option value="243">Supervisor</option>';

                        $('#modulo').html(frente);
                        break;

                    case '29':
                        var outros = '<option value="234">App Avanço / Farol de Preços / Integweb / Ivisual / Novos Relatórios Web</option>';

                        $('#modulo').html(outros);
                        break;

                    case '30':
                        var outros = '<option value="235">Central de Compras</option>';

                        $('#modulo').html(outros);
                        break;

                    case '31':
                        var outros = '<option value="236">Conciliador de Cartões</option>';

                        $('#modulo').html(outros);
                        break;

                    case '32':
                        var outros = '<option value="237">E-commerce / MG Mobile</option>';

                        $('#modulo').html(outros);
                        break;

                    case '33':
                        var outros = '<option value="238">FGF / Systax</option>';

                        $('#modulo').html(outros);
                        break;

                    case '35':
                        var outros = '<option value="244">Gestor</option>';

                        $('#modulo').html(outros);
                        break;

                    case '37':
                        var outros = '<option value="269">Mercafácil / Dotz / DMCard / Scanntech</option>';

                        $('#modulo').html(outros);
                        break;

                    case '38':
                        var outros = '<option value="270">NFC-e</option>';

                        $('#modulo').html(outros);
                        break;

                    case '39':
                        var outros = '<option value="271">NovoERP</option>';

                        $('#modulo').html(outros);
                        break;

                    case '40':
                        var outros = '<option value="272">Tramitador NF-e</option>';

                        $('#modulo').html(outros);
                        break;
                }
            });

            $('#enviar').click(function() {
                if ($('#duvida').val() == '') {
                    alert('O campo dúvida deve ser preenchido!');
                }
            });
        });
    </script>

</body>

</html>