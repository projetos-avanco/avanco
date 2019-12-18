<?php

$curva = true;

$contador = count($colaboradores);

if ($cliente['produto'] == '29') {
    switch ($cliente['modulo']) {
        case '234': # App Avanço / Farol de Preços / Integweb / Ivisual / Novos Relatórios Web
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '30') {
    switch ($cliente['modulo']) {
        case '235': # Central de Compras
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '31') {
    switch ($cliente['modulo']) {
        case '236': # Conciliador de Cartões
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '32') {
    switch ($cliente['modulo']) {
        case '237': # E-commerce / MG Mobile
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '33') {
    switch ($cliente['modulo']) {
        case '238': # FGF / Systax
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '34') {
    switch ($cliente['modulo']) {
        case '239': # Comandas
        case '240': # Frente Linux
        case '241': # Frente Windows
        case '242': # Sitef
        case '243': # Supervisor
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '30') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '35') {
    switch ($cliente['modulo']) {
        case '244': # Gestor
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '30') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '36') {
    switch ($cliente['modulo']) {
        case '245': # Cadastros Gerais
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '23' || $colaboradores[$i]['id'] == '64') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '246': # Cálculo de Preços
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '247': # Coletores
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '248': # Contábil
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '64' || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '249': # Contas à Pagar / Receber
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '250': # Controle Bancário
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '251': # Cotação de Preços / Sugestão de Compras / Pedidos de Compras
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '252': # Emissão de Etiquetas
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '253': # Estoque
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '254': # Exportação de Produtos para o Frente de Loja e Balanças
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '255': # Fechamento de Caixa
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '256': # Importação de Vendas Cupons / Redução Z
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '23' || $colaboradores[$i]['id'] == '64'  || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '257': # Movimentações
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '64') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '258': # Online de Vendas / Clientes
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '23' || $colaboradores[$i]['id'] == '64') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '259': # Pedidos de Vendas / DAV / Pré Vendas
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '260': # Plano de Contas Gerencial / Contábil
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '64' || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '261': # Preços de Venda
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '262': # Recebimento via Coletor / Nota Antecipada / Confronto XML
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '23') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '263': # Relatórios de Entradas e Saidas
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14' || $colaboradores[$i]['id'] == '23') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '264': # Relatórios Fiscais
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '64' || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '265': # Rotina de Convênio
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '266': # Rotina de Produção / Transformação
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
        case '267': # SPED / Sintegra
            $capitaes = [];

            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '64' || $colaboradores[$i]['id'] == '66') {
                    array_push($capitaes, $colaboradores[$i]);
                }
            }

            if (count($capitaes) > 0) {
                $capitaes = verificaFilaDosColaboradores($capitaes, count($capitaes), $conexao);

                usort($capitaes, "comparaChavesDosArraysInternos");
                redirecionaClienteParaDepartamento($capitaes, $cliente, $curva);
            }
            break;
        case '268': # WMS
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '23') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '37') {
    switch ($cliente['modulo']) {
        case '269': # Mercafácil / Dotz / DMCard / Scanntech
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '38') {
    switch ($cliente['modulo']) {
        case '270': # NFC-e
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '39') {
    switch ($cliente['modulo']) {
        case '271': # NovoERP
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}

if ($cliente['produto'] == '40') {
    switch ($cliente['modulo']) {
        case '272': # Tramitador NF-e
            for ($i = 0; $i < $contador; $i++) {
                if ($colaboradores[$i]['id'] == '14') {
                    $colaborador = [];

                    array_push($colaborador, $colaboradores[$i]);
                    redirecionaClienteParaDepartamento($colaborador, $cliente, $curva);
                }
            }
            break;
    }
}
