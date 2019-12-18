<?php

/*
 * responsável por chamar outras funções que consultam informações na base de dados do chat e redireciona o cliente
 */
function consultaChatSuporte()
{
    $curva = false;

    # chamando função que retorna uma conexão com a base de dados
    $conexao = abre_conexao();

    # recuperando os dados do cliente que chamou no portal avanço
    $cliente = $_SESSION['cliente'];

    if ($cliente['produto'] == '39') {
        # indicando que o cliente utiliza o novo ERP
        $cliente['novo_erp'] = '1';
    } else {
        # indicando que o cliente não utiliza o novo ERP
        $cliente['novo_erp'] = '0';
    }

    $quantidade = 0;

    # chamando função que retorna um array modelo para receber os dados dos colaboradores
    $colaboradores = criaModeloDeColaboradores();

    # chamando função que verifica se existe pelo menos um colaborador online no chat
    $colaboradores = verificaColaboradoresOnlineNoChat($colaboradores, $conexao);

    # recuperando a quantidade de colaboradores online
    $quantidade = count($colaboradores);
    
    ### === Curva ABC
    if ($quantidade >= 1 && ($cliente['conta_contrato'] == '0000573' || $cliente['conta_contrato'] == '0000197')) {
        include 'curva/curva_abc.php';
    }
    ### === Curva ABC

    # verificando se existe um ou mais colaboradores online
    if ($quantidade == 1) {

        # chamando função que monta uma URL e redireciona o cliente para o departamento que realizará o atendimento
        redirecionaClienteParaDepartamento($colaboradores, $cliente, $curva);

        # verificando se existe um ou mais colaboradores online no chat
    } elseif ($quantidade > 1) {

        # pesquisar conhecimento dos colaboradores
        $colaboradores = verificaNivelDeConhecimentoDosColaboradoresOnline($colaboradores, $cliente, $quantidade, $conexao);

        # chamando função que grava os colaboradores em uma sessão
        criaSessaoDeColaboradores($colaboradores, $quantidade);

        # chamando função que elimina os colaboradores que possuem menos de 20% de conhecimento
        $colaboradores = eliminaColaboradoresSemConhecimento($colaboradores, $quantidade);

        # recuperando a quantidade de colaboradores que possuem no mínimo 20% de conhecimento
        $quantidade = count($colaboradores);

        # verificando se não existe nenhum colaborador online com no mínimo 20% de conhecimento
        if ($quantidade == 0) {

            # recuperando dados dos colaboradores que estão online
            $colaboradores = $_SESSION['colaboradores'];

            # recuperando a quantidade de colaboradores online e com no mínimo 20% de conhecimento
            $quantidade = count($colaboradores);

            # chamando função que verifica a quantidade de fila
            $colaboradores = verificaFilaDosColaboradores($colaboradores, $quantidade, $conexao);

            # chamando função que ordena o array deixando o colaborador com menor fila na posição 0
            usort($colaboradores, "comparaChavesDosArraysInternos");

            # chamando função que monta uma URL e redireciona o cliente para o departamento que realizará o atendimento
            redirecionaClienteParaDepartamento($colaboradores, $cliente, $curva);

            # verificando se existe um ou mais colaboradores logados que possuem no mínimo 20% de conhecimento
        } elseif ($quantidade > 0) {

            # reordenando os valores do array começando por 0
            $colaboradores = array_values($colaboradores);

            # chamando função que verifica a quantidade de fila
            $colaboradores = verificaFilaDosColaboradores($colaboradores, $quantidade, $conexao);

            # chamando função que ordena o array deixando o colaborador com menor fila na posição 0
            usort($colaboradores, "comparaChavesDosArraysInternos");

            # chamando função que monta uma URL e redireciona o cliente para o departamento que realizará o atendimento
            redirecionaClienteParaDepartamento($colaboradores, $cliente, $curva);
        }

        # eliminando arrays
        unset($colaboradores, $cliente);

        # fechando conexão aberta
        $conexao->close();
    }
}
