<?php

/**
 * preenche a sessão de gráficos com o nível de conhecimento do colaborador em cada módulo
 * @param - objeto com uma conexão aberta
 * @param - string com o id do colaborador (id do chat)
 */
function verificaConhecimentoDoColaborador($conexao, $id)
{
  # chamando a função que cria a sessão para os gráficos
  criaSessaoDeGraficos();

  # preenchendo a sessão com o nível de conhecimento do colaborador em cada módulo
  for ($i = 1; $i <= 18; $i++) {

    $query =
      "SELECT
          ROUND(100 * (
            (SELECT
              COUNT(conhecimento) AS conhecimento
            FROM av_dashboard_colaborador_especialidades
            WHERE (conhecimento = 1)
              AND (id_modulo = $i)
              AND (id_colaborador = $id))

            /

            (SELECT
              COUNT(nome) AS especialidade
            FROM av_dashboard_especialidades
            WHERE (id_modulo = $i))), 2) AS nivel_de_conhecimento";

    $resultado = mysqli_query($conexao, $query);

    $percentual = mysqli_fetch_row($resultado);

    # preencho a sessão com o nível de conhecimento de acordo com o id do módulo
    switch ($i) {
      case 1:
        $_SESSION['graficos']['integral']['materiais'] = (float)$percentual[0];
        break;

      case 2:
        $_SESSION['graficos']['integral']['fiscal'] = (float)$percentual[0];
        break;

      case 3:
        $_SESSION['graficos']['integral']['financeiro'] = (float)$percentual[0];
        break;

      case 4:
        $_SESSION['graficos']['integral']['contabil'] = (float)$percentual[0];
        break;

      case 5:
        $_SESSION['graficos']['integral']['cotacao'] = (float)$percentual[0];
        break;

      case 6:
        $_SESSION['graficos']['integral']['tnfe'] = (float)$percentual[0];
        break;

      case 7:
        $_SESSION['graficos']['integral']['wms'] = (float)$percentual[0];
        break;

      case 8:
        $_SESSION['graficos']['frente_de_loja']['frente_windows'] = (float)$percentual[0];
        break;

      case 9:
        $_SESSION['graficos']['frente_de_loja']['frente_linux'] = (float)$percentual[0];
        break;

      case 10:
        $_SESSION['graficos']['frente_de_loja']['supervisor'] = (float)$percentual[0];
        break;

      case 11:
        $_SESSION['graficos']['frente_de_loja']['scanntech'] = (float)$percentual[0];
        break;

      case 12:
        $_SESSION['graficos']['frente_de_loja']['sitef'] = (float)$percentual[0];
        break;

      case 13:
        $_SESSION['graficos']['frente_de_loja']['comandas'] = (float)$percentual[0];
        break;

      case 14:
        $_SESSION['graficos']['gestor']['instalacao'] = (float)$percentual[0];
        break;

      case 15:
        $_SESSION['graficos']['gestor']['cadastro'] = (float)$percentual[0];
        break;

      case 16:
        $_SESSION['graficos']['gestor']['movimento'] = (float)$percentual[0];
        break;

      case 17:
        $_SESSION['graficos']['gestor']['contabil'] = (float)$percentual[0];
        break;

      case 18:
        $_SESSION['graficos']['gestor']['fiscal'] = (float)$percentual[0];
        break;

    }

  }

  # fechando conexão aberta
  fecha_conexao($conexao);

}
