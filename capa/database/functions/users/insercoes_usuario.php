<?php

/**
 * insere um registro do usuário na tabela av_avancoins_carteiras
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 */
function insereCarteiraAvancoinsDoUsuario($db, $id)
{
    $query = "INSERT INTO av_avancoins_carteiras VALUES ($id, 0, CURRENT_DATE(), CURRENT_TIME())";

    mysqli_query($db, $query);
}

/**
 * insere as especialidades do módulo integral
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function insereEspecialidadesDoIntegral($db, $id, $especialidades)
{
    if ($especialidades['integral']['materiais']) {
        for ($j = 1; $j <= 83; $j++) {
            if ($j <= 17) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 1, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 1, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 1; $j <= 83; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 1, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['fiscal']) {
        for ($j = 84; $j <= 97; $j++) {
            if ($j <= 86) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 2, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 2, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 84; $j <= 97; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 2, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['financeiro']) {
        for ($j = 98; $j <= 114; $j++) {
            if ($j <= 101) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 3, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 3, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 98; $j <= 114; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 3, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['contabil']) {
        for ($j = 115; $j <= 124; $j++) {
            if ($j <= 116) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 4, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 4, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 115; $j <= 124; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 4, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['cotacao']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 125, 5, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 125, 5, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['tnfe']) {
        for ($j = 126; $j <= 129; $j++) {
            if ($j <= 126) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 6, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 6, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 126; $j <= 129; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 6, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['wms']) {
        for ($j = 130; $j <= 133; $j++) {
            if ($j <= 130) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 7, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 7, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 130; $j <= 133; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 7, 0)";

            mysqli_query($db, $query);
        }
    }
} */

/**
 * insere as especialidades do módulo integral
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
function insereEspecialidadesDoIntegral($db, $id, $especialidades)
{
    if ($especialidades['integral']['cadastros_gerais']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 245, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 245, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['calculo_precos']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 246, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 246, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['coletores']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 247, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 247, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['contabil']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 248, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 248, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['contas_pagar']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 249, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 249, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['controle_bancario']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 250, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 250, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['cotacao_precos']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 251, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 251, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['emissao_etiquetas']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 252, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 252, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['estoque']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 253, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 253, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['exportacao_produtos']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 254, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 254, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['fechamento_caixa']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 255, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 255, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['importacao_vendas']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 256, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 256, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['movimentacoes']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 257, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 257, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['online_vendas']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 258, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 258, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['pedido_vendas']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 259, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 259, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['plano_contas']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 260, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 260, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['precos_venda']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 261, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 261, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['recebimento_coletor']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 262, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 262, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['relatorios_entrada']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 263, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 263, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['relatorios_fiscais']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 264, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 264, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['rotina_convenio']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 265, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 265, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['rotina_producao']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 266, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 266, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['sped_sintegra']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 267, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 267, 36, 0)";
        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['wms']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 268, 36, 1)";
        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 268, 36, 0)";
        mysqli_query($db, $query);
    }
}

/**
 * insere as especialidades do módulo frente de loja
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function insereEspecialidadesDoFrente($db, $id, $especialidades)
{
    if ($especialidades['frente']['windows']) {
        for ($j = 134; $j <= 137; $j++) {
            if ($j <= 134) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 8, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 8, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 134; $j <= 137; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 8, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['linux']) {
        for ($j = 138; $j <= 142; $j++) {
            if ($j <= 138) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 9, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 9, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 138; $j <= 142; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 9, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['supervisor']) {
        for ($j = 143; $j <= 145; $j++) {
            if ($j <= 143) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 10, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 10, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 143; $j <= 145; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 10, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['scanntech']) {
        for ($j = 146; $j <= 148; $j++) {
            if ($j <= 146) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 11, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 11, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 146; $j <= 148; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 11, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['sitef']) {
        for ($j = 149; $j <= 151; $j++) {
            if ($j <= 149) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 12, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 12, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 149; $j <= 151; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 12, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['comandas']) {
        for ($j = 152; $j <= 154; $j++) {
            if ($j <= 152) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 13, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 13, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 152; $j <= 154; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 13, 0)";

            mysqli_query($db, $query);
        }
    }
} */

/**
 * insere as especialidades do módulo frente de loja
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
function insereEspecialidadesDoFrente($db, $id, $especialidades)
{
    if ($especialidades['frente']['comandas']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 239, 34, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 239, 34, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['frente_linux']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 240, 34, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 240, 34, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['frente_windows']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 241, 34, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 241, 34, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['sitef']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 242, 34, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 242, 34, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['supervisor']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 243, 34, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 243, 34, 0)";

        mysqli_query($db, $query);
    }
}

/**
 * insere as especialidades do módulo gestor
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function insereEspecialidadesDoGestor($db, $id, $especialidades)
{
    if ($especialidades['gestor']['instalacao']) {
        for ($j = 155; $j <= 158; $j++) {
            if ($j <= 155) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 14, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 14, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 155; $j <= 158; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 14, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['cadastro']) {
        for ($j = 159; $j <= 164; $j++) {
            if ($j <= 160) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 15, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 15, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 159; $j <= 164; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 15, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['movimento']) {
        for ($j = 165; $j <= 168; $j++) {
            if ($j <= 165) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 16, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 16, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 165; $j <= 168; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 16, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['contabil']) {
        for ($j = 169; $j <= 171; $j++) {
            if ($j <= 169) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 17, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 17, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 169; $j <= 171; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 17, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['fiscal']) {
        for ($j = 172; $j <= 174; $j++) {
            if ($j <= 172) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 18, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 18, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 172; $j <= 174; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 18, 0)";

            mysqli_query($db, $query);
        }
    }
} */

/**
 * insere as especialidades do módulo outros
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
function insereEspecialidadesDoOutros($db, $id, $especialidades)
{
    if ($especialidades['outros']['app_avanco']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 234, 29, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 234, 29, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['central_compras']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 235, 30, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 235, 30, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['conciliador_cartoes']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 236, 31, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 236, 31, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['ecommerce']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 237, 32, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 237, 32, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['fgf_systax']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 238, 33, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 238, 33, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['gestor']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 244, 35, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 244, 35, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['mercafacil']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 269, 37, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 269, 37, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['nfce']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 270, 38, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 270, 38, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['novo_erp']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 271, 39, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 271, 39, 0)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['tramitador_nfe']) {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 272, 40, 1)";

        mysqli_query($db, $query);
    } else {
        $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 272, 40, 0)";

        mysqli_query($db, $query);
    }
}

/**
 * insere as especialidades do módulo novo erp
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function insereEspecialidadesDoNovoERP($db, $id, $especialidades)
{
    if ($especialidades['novo_erp']['instalacao']) {
        for ($j = 175; $j <= 178; $j++) {
            if ($j <= 175) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 19, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 19, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 175; $j <= 178; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 19, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['pessoas']) {
        for ($j = 179; $j <= 184; $j++) {
            if ($j <= 180) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 20, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 20, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 179; $j <= 184; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 20, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['produtos']) {
        for ($j = 185; $j <= 191; $j++) {
            if ($j <= 186) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 21, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 21, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 185; $j <= 191; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 21, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['fiscal']) {
        for ($j = 192; $j <= 199; $j++) {
            if ($j <= 193) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 22, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 22, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 192; $j <= 199; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 22, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['financeiro']) {
        for ($j = 200; $j <= 203; $j++) {
            if ($j <= 200) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 23, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 23, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 200; $j <= 203; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 23, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['lancamentos']) {
        for ($j = 204; $j <= 207; $j++) {
            if ($j <= 204) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 24, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 24, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 204; $j <= 207; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 24, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['relatorios_graficos']) {
        for ($j = 208; $j <= 215; $j++) {
            if ($j <= 209) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 25, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 25, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 208; $j <= 215; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 25, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['importacao_exportacao']) {
        for ($j = 216; $j <= 220; $j++) {
            if ($j <= 216) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 26, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 26, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 216; $j <= 220; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 26, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['configuracoes_pdv']) {
        for ($j = 221; $j <= 227; $j++) {
            if ($j <= 222) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 27, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 27, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 221; $j <= 227; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 27, 0)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['minha_conta']) {
        for ($j = 228; $j <= 233; $j++) {
            if ($j <= 229) {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 28, 1)";
            } else {
                $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 28, 0)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 228; $j <= 233; $j++) {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, $j, 28, 0)";

            mysqli_query($db, $query);
        }
    }
} */

/**
 * insere as especialidades do usuário
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array com os módulos
 */
/* function insereEspecialidadesDoUsuario($db, $id, $opcoes)
{
  $especialidades = array(
    'integral' => array(
      'materiais' => false,
      'fiscal' => false,
      'financeiro' => false,
      'contabil' => false,
      'cotacao' => false,
      'tnfe' => false,
      'wms' => false
    ),

    'frente' => array(
      'windows' => false,
      'linux' => false,
      'supervisor' => false,
      'scanntech' => false,
      'sitef' => false,
      'comandas' => false
    ),

    'gestor' => array(
      'instalacao' => false,
      'cadastro' => false,
      'movimento' => false,
      'contabil' => false,
      'fiscal' => false
    ),

    'novo_erp' => array(
      'instalacao' => false,
      'pessoas' => false,
      'produtos' => false,
      'fiscal' => false,
      'financeiro' => false,
      'lancamentos' => false,
      'relatorios_graficos' => false,
      'importacao_exportacao' => false,
      'configuracoes_pdv' => false,
      'minha_conta' => false
    )
  );

  # verificando quais módulos foram selecionados
  for ($i = 0; $i < count($opcoes['produto']); $i++) {
    if ($opcoes['produto'][$i] == 1) {
      switch ($opcoes['modulo'][$i]) {
        case 1:
          $especialidades['integral']['materiais'] = true;
            break;

        case 2:
          $especialidades['integral']['fiscal'] = true;
            break;

        case 3:
          $especialidades['integral']['financeiro'] = true;
            break;

        case 4:
          $especialidades['integral']['contabil'] = true;
            break;

        case 5:
          $especialidades['integral']['cotacao'] = true;
            break;

        case 6:
          $especialidades['integral']['tnfe'] = true;
            break;

        case 7:
          $especialidades['integral']['wms'] = true;
            break;
      }
    } elseif ($opcoes['produto'][$i] == 2) {
      switch ($opcoes['modulo'][$i]) {
        case 8:
          $especialidades['frente']['windows'] = true;
            break;

        case 9:
          $especialidades['frente']['linux'] = true;
            break;

        case 10:
          $especialidades['frente']['supervisor'] = true;
            break;

        case 11:
          $especialidades['frente']['scanntech'] = true;
            break;

        case 12:
          $especialidades['frente']['sitef'] = true;
            break;

        case 13:
          $especialidades['frente']['comandas'] = true;
            break;
      }
    } elseif ($opcoes['produto'][$i] == 3) {
      switch ($opcoes['modulo'][$i]) {
        case 14:
          $especialidades['gestor']['instalacao'] = true;
            break;

        case 15:
          $especialidades['gestor']['cadastro'] = true;
            break;

        case 16:
          $especialidades['gestor']['movimento'] = true;
            break;

        case 17:
          $especialidades['gestor']['contabil'] = true;
            break;

        case 18:
          $especialidades['gestor']['fiscal'] = true;
      }
    } elseif ($opcoes['produto'][$i] == 4) {
      switch ($opcoes['modulo'][$i]) {
        case 19:
          $especialidades['novo_erp']['instalacao'] = true;
            break;

        case 20:
          $especialidades['novo_erp']['pessoas'] = true;
            break;

        case 21:
          $especialidades['novo_erp']['produtos'] = true;
            break;

        case 22:
          $especialidades['novo_erp']['fiscal'] = true;
            break;

        case 23:
          $especialidades['novo_erp']['financeiro'] = true;
            break;

        case 24:
          $especialidades['novo_erp']['lancamentos'] = true;
            break;

        case 25:
          $especialidades['novo_erp']['relatorios_graficos'] = true;
            break;

        case 26:
          $especialidades['novo_erp']['importacao_exportacao'] = true;
            break;

        case 27:
          $especialidades['novo_erp']['configuracoes_pdv'] = true;
            break;

        case 28:
          $especialidades['novo_erp']['minha_conta'] = true;
            break;
      }
    }
  }

  # chamando funções que inserem as especialidades de acordo com os módulos selecionados
  insereEspecialidadesDoIntegral($db, $id, $especialidades);
  insereEspecialidadesDoFrente($db, $id, $especialidades);
  insereEspecialidadesDoGestor($db, $id, $especialidades);
  insereEspecialidadesDoNovoERP($db, $id, $especialidades);
} */

function insereEspecialidadesDoUsuario($db, $id, $opcoes)
{
    $especialidades = array(
        'integral' => array(
            'cadastros_gerais' => false,
            'calculo_precos' => false,
            'coletores' => false,
            'contabil' => false,
            'contas_pagar' => false,
            'controle_bancario' => false,
            'cotacao_precos' => false,
            'emissao_etiquetas' => false,
            'estoque' => false,
            'exportacao_produtos' => false,
            'fechamento_caixa' => false,
            'importacao_vendas' => false,
            'movimentacoes' => false,
            'online_vendas' => false,
            'pedido_vendas' => false,
            'plano_contas' => false,
            'precos_venda' => false,
            'recebimento_coletor' => false,
            'relatorios_entrada' => false,
            'relatorios_fiscais' => false,
            'rotina_convenio' => false,
            'rotina_producao' => false,
            'sped_sintegra' => false,
            'wms' => false,
        ),

        'frente' => array(
            'comandas' => false,
            'frente_linux' => false,
            'frente_windows' => false,
            'sitef' => false,
            'supervisor' => false
        ),

        'outros' => array(
            'app_avanco' => false,
            'central_compras' => false,
            'conciliador_cartoes' => false,
            'ecommerce' => false,
            'fgf_systax' => false,
            'gestor' => false,
            'mercafacil' => false,
            'nfce' => false,
            'novo_erp' => false,
            'tramitador_nfe' => false
        )
    );

    # verificando quais módulos foram selecionados
    for ($i = 0; $i < count($opcoes['produto']); $i++) {
        if ($opcoes['produto'][$i] == 36) {
            switch ($opcoes['modulo'][$i]) {
                case 245:
                    $especialidades['integral']['cadastros_gerais'] = true;
                    break;

                case 246:
                    $especialidades['integral']['calculo_precos'] = true;
                    break;

                case 247:
                    $especialidades['integral']['coletores'] = true;
                    break;

                case 248:
                    $especialidades['integral']['contabil'] = true;
                    break;

                case 249:
                    $especialidades['integral']['contas_pagar'] = true;
                    break;

                case 250:
                    $especialidades['integral']['controle_bancario'] = true;
                    break;

                case 251:
                    $especialidades['integral']['cotacao_precos'] = true;
                    break;

                case 252:
                    $especialidades['integral']['emissao_etiquetas'] = true;
                    break;

                case 253:
                    $especialidades['integral']['estoque'] = true;
                    break;

                case 254:
                    $especialidades['integral']['exportacao_produtos'] = true;
                    break;

                case 255:
                    $especialidades['integral']['fechamento_caixa'] = true;
                    break;

                case 256:
                    $especialidades['integral']['importacao_vendas'] = true;
                    break;

                case 257:
                    $especialidades['integral']['movimentacoes'] = true;
                    break;

                case 258:
                    $especialidades['integral']['online_vendas'] = true;
                    break;

                case 259:
                    $especialidades['integral']['pedido_vendas'] = true;
                    break;

                case 260:
                    $especialidades['integral']['plano_contas'] = true;
                    break;

                case 261:
                    $especialidades['integral']['precos_venda'] = true;
                    break;

                case 262:
                    $especialidades['integral']['recebimento_coletor'] = true;
                    break;

                case 263:
                    $especialidades['integral']['relatorios_entrada'] = true;
                    break;

                case 264:
                    $especialidades['integral']['relatorios_fiscais'] = true;
                    break;

                case 265:
                    $especialidades['integral']['rotina_convenio'] = true;
                    break;

                case 266:
                    $especialidades['integral']['rotina_producao'] = true;
                    break;

                case 267:
                    $especialidades['integral']['sped_sintegra'] = true;
                    break;

                case 268:
                    $especialidades['integral']['wms'] = true;
                    break;
            }
        } elseif ($opcoes['produto'][$i] == 34) {
            switch ($opcoes['modulo'][$i]) {
                case 239:
                    $especialidades['frente']['comandas'] = true;
                    break;

                case 240:
                    $especialidades['frente']['frente_linux'] = true;
                    break;

                case 241:
                    $especialidades['frente']['frente_windows'] = true;
                    break;

                case 242:
                    $especialidades['frente']['sitef'] = true;
                    break;

                case 243:
                    $especialidades['frente']['supervisor'] = true;
                    break;
            }
        } else {
            switch ($opcoes['produto'][$i]) {
                case 29:
                    $especialidades['outros']['app_avanco'] = true;
                    break;

                case 30:
                    $especialidades['outros']['central_compras'] = true;
                    break;

                case 31:
                    $especialidades['outros']['conciliador_cartoes'] = true;
                    break;

                case 32:
                    $especialidades['outros']['ecommerce'] = true;
                    break;

                case 33:
                    $especialidades['outros']['fgf_systax'] = true;
                    break;

                case 35:
                    $especialidades['outros']['gestor'] = true;
                    break;

                case 37:
                    $especialidades['outros']['mercafacil'] = true;
                    break;

                case 38:
                    $especialidades['outros']['nfce'] = true;
                    break;

                case 39:
                    $especialidades['outros']['novo_erp'] = true;
                    break;

                case 40:
                    $especialidades['outros']['tramitador_nfe'] = true;
                    break;
            }
        }
    }

    # chamando funções que inserem as especialidades de acordo com os módulos selecionados
    insereEspecialidadesDoIntegral($db, $id, $especialidades);
    insereEspecialidadesDoFrente($db, $id, $especialidades);
    insereEspecialidadesDoOutros($db, $id, $especialidades);
    // insereEspecialidadesDoNovoERP($db, $id, $especialidades);
}

/**
 * insere um histórico do time do usuário na tabela av_dashboard_colaborador_times
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - inteiro com o id do time
 */
function insereHistoricoDoTimeDoUsuario($db, $colaborador, $time)
{
    $query = "INSERT INTO av_dashboard_colaborador_times VALUES (0, $colaborador, $time, CURRENT_DATE(), NULL)";

    $resultado = mysqli_query($db, $query);

    return $resultado;
}

/**
 * insere um registro na tabela av_dashboard_colaborador
 * @param - objeto com uma conexão aberta
 * @param - string com a query de inserção
 */
function insereRegistroDeColaborador($db, $query)
{
    $resultado = mysqli_query($db, $query);
    
    return $resultado;
}

/**
 * insere um usuário na tabela av_usuarios_login
 * @param - objeto com uma conexão aberta
 * @param - array com os dados do cadastro
 */
function cadastraUsuario($db, $cadastro)
{
    $query =
        "INSERT INTO av_usuarios_login
      VALUES (
         {$cadastro['id']},
        '{$cadastro['nome']}',
        '{$cadastro['sobrenome']}',
        '{$cadastro['usuario']}',
        '{$cadastro['senha']}',
        '{$cadastro['email']}',
         {$cadastro['nivel']},
        '{$cadastro['regime']}',
        '{$cadastro['contrato']}',
         {$cadastro['ativo']},
        '{$cadastro['ramal']}',
        '{$cadastro['admissao']}',
        '{$cadastro['cadastro']}'
      )";

    $resultado = mysqli_query($db, $query);

    return $resultado;
}
