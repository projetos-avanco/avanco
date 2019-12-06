<?php

/**
 * atualiza o conhecimento do colaborador para zero
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 */
function atualizaConhecimentoParaZero($db, $id)
{
    $query = "UPDATE av_dashboard_colaborador_especialidades SET conhecimento = 0 WHERE id_colaborador = $id";

    $resultado = mysqli_query($db, $query);

    return $resultado;
}

/**
 * atualiza data de saída do colaborador de um time
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 */
function atualizaDataSaidaDoTime($db, $id)
{
    $query =
        "UPDATE av_dashboard_colaborador_times 
      SET 
        data_saida = NOW() 
      WHERE (id_colaborador = $id)
        AND data_saida IS NULL";

    $resultado = mysqli_query($db, $query);

    return $resultado;
}

/**
 * atualiza dados do usuário no portal avanção
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de cadastro
 */
function atualizaDadosPortalUsuario($db, $cadastro)
{
    $query =
        "UPDATE av_usuarios_login 
      SET 
        nivel    =  {$cadastro['nivel']},
        regime   = '{$cadastro['regime']}',
        contrato = '{$cadastro['contrato']}',
        admissao = '{$cadastro['admissao']}',
        ramal    = '{$cadastro['ramal']}'
      WHERE id =  {$cadastro['id_portal']}";

    mysqli_query($db, $query);
}

/**
 * atualiza o nível de usuário para administrador
 * @param - objeto com uma conexão aberta
 * @param - array com os dados de cadastro
 */
function atualizaDadosPortalAdministrador($db, $cadastro)
{
    $query =
        "UPDATE av_usuarios_login 
      SET 
        nivel    = 2,
        regime   = '1',
        contrato = '0',
        admissao = '{$cadastro['admissao']}',
        ramal    = '{$cadastro['ramal']}'
      WHERE id = {$cadastro['id_portal']}";

    mysqli_query($db, $query);
}

/**
 * atualiza a senha do usuário do portal
 * @param - objeto com uma conexão aberta
 * @param - string com a senha alterada
 * @param - inteiro com o id do usuário do portal avanção
 */
function atualizaSenhaDoPortal($db, $senha, $id)
{
    $query = "UPDATE av_usuarios_login SET senha = '$senha' WHERE id = $id";

    mysqli_query($db, $query);
}

/**
 * atualiza as especialidades do módulo integral
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function atualizaEspecialidadesDoIntegral($db, $id, $especialidades)
{
    if ($especialidades['integral']['materiais']) {
        for ($j = 1; $j <= 83; $j++) {
            if ($j <= 17) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1 
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 1)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 1)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 1; $j <= 83; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 1)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['fiscal']) {
        for ($j = 84; $j <= 97; $j++) {
            if ($j <= 86) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 2)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 2)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 84; $j <= 97; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 2)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['financeiro']) {
        for ($j = 98; $j <= 114; $j++) {
            if ($j <= 101) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 3)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 3)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 98; $j <= 114; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 3)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['contabil']) {
        for ($j = 115; $j <= 124; $j++) {
            if ($j <= 116) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 4)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 4)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 115; $j <= 124; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 4)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['cotacao']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
        SET conhecimento = 1
          WHERE (id_colaborador = $id)
            AND (id_especialidade = 125)
            AND (id_modulo = 5)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
        SET conhecimento = 0
          WHERE (id_colaborador = $id)
            AND (id_especialidade = 125)
            AND (id_modulo = 5)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['tnfe']) {
        for ($j = 126; $j <= 129; $j++) {
            if ($j <= 126) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 6)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 6)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 126; $j <= 129; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 6)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['wms']) {
        for ($j = 130; $j <= 133; $j++) {
            if ($j <= 130) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 7)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 7)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 130; $j <= 133; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 7)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['integral']['nfce']) {
        $query =
            "SELECT
        id_especialidade
      FROM av_dashboard_colaborador_especialidades
      WHERE (id_colaborador = $id)
        AND (id_especialidade = 234)";

        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows > 0) {
            for ($j = 234; $j <= 234; $j++) {
                if ($j <= 234) {
                    $query =
                        "UPDATE av_dashboard_colaborador_especialidades 
              SET conhecimento = 1
                WHERE (id_colaborador = $id)
                  AND (id_especialidade = $j)
                  AND (id_modulo = 29)";
                } else {
                    $query =
                        "UPDATE av_dashboard_colaborador_especialidades 
              SET conhecimento = 0
                WHERE (id_colaborador = $id)
                  AND (id_especialidade = $j)
                  AND (id_modulo = 29)";
                }

                mysqli_query($db, $query);
            }
        } else {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 234, 29, 1)";

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 234; $j <= 234; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 29)";

            mysqli_query($db, $query);
        }
    }
} */

/**
 * atualiza as especialidades do módulo integral
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
function atualizaEspecialidadesDoIntegral($db, $id, $especialidades)
{
    if ($especialidades['integral']['cadastros_gerais']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 245)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 245)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['calculo_precos']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 246)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 246)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['coletores']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 247)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 247)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['contabil']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 248)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 248)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['contas_pagar']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 249)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 249)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['controle_bancario']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 250)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 250)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['cotacao_precos']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 251)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 251)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['emissao_etiquetas']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 252)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 252)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['estoque']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 253)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 253)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['exportacao_produtos']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 254)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 254)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['fechamento_caixa']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 255)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 255)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['importacao_vendas']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 256)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 256)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['movimentacoes']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 257)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 257)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['online_vendas']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 258)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 258)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['pedido_vendas']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 259)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 259)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['plano_contas']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 260)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 260)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['precos_venda']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 261)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 261)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['recebimento_coletor']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 262)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 262)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['relatorios_entrada']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 263)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 263)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['relatorios_fiscais']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 264)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 264)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['rotina_convenio']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 265)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 265)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['rotina_producao']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 266)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 266)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['sped_sintegra']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 267)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 267)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }

    if ($especialidades['integral']['wms']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades
                SET conhecimento = 1 
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 268)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 268)
                AND (id_modulo = 36)";

        mysqli_query($db, $query);
    }
}

/**
 * atualiza as especialidades do módulo frente de loja
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function atualizaEspecialidadesDoFrente($db, $id, $especialidades)
{
    if ($especialidades['frente']['windows']) {
        for ($j = 134; $j <= 137; $j++) {
            if ($j <= 134) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 8)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 8)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 134; $j <= 137; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 8)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['linux']) {
        for ($j = 138; $j <= 142; $j++) {
            if ($j <= 138) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 9)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 9)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 138; $j <= 142; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 9)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['supervisor']) {
        for ($j = 143; $j <= 145; $j++) {
            if ($j <= 143) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 10)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 10)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 143; $j <= 145; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 10)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['scanntech']) {
        for ($j = 146; $j <= 148; $j++) {
            if ($j <= 146) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 11)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 11)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 146; $j <= 148; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 11)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['sitef']) {
        for ($j = 149; $j <= 151; $j++) {
            if ($j <= 149) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 12)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 12)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 149; $j <= 151; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 12)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['comandas']) {
        for ($j = 152; $j <= 154; $j++) {
            if ($j <= 152) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 13)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 13)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 152; $j <= 154; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 13)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['frente']['nfce']) {
        $query =
            "SELECT
        id_especialidade
      FROM av_dashboard_colaborador_especialidades
      WHERE (id_colaborador = $id)
        AND (id_especialidade = 235)";

        $resultado = mysqli_query($db, $query);

        if ($resultado->num_rows > 0) {
            for ($j = 235; $j <= 235; $j++) {
                if ($j <= 235) {
                    $query =
                        "UPDATE av_dashboard_colaborador_especialidades 
              SET conhecimento = 1
                WHERE (id_colaborador = $id)
                  AND (id_especialidade = $j)
                  AND (id_modulo = 30)";
                } else {
                    $query =
                        "UPDATE av_dashboard_colaborador_especialidades 
              SET conhecimento = 0
                WHERE (id_colaborador = $id)
                  AND (id_especialidade = $j)
                  AND (id_modulo = 30)";
                }

                mysqli_query($db, $query);
            }
        } else {
            $query = "INSERT INTO av_dashboard_colaborador_especialidades VALUES ($id, 235, 30, 1)";

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 235; $j <= 235; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 30)";

            mysqli_query($db, $query);
        }
    }
} */

/**
 * atualiza as especialidades do módulo frente de loja
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
function atualizaEspecialidadesDoFrente($db, $id, $especialidades)
{
    if ($especialidades['frente']['comandas']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 239)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 239)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['frente_linux']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 240)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 240)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['frente_windows']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 241)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 241)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['sitef']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 242)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 242)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    }

    if ($especialidades['frente']['supervisor']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 243)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 243)
                AND (id_modulo = 34)";

        mysqli_query($db, $query);
    }
}

/**
 * atualiza as especialidades do módulo outros
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function atualizaEspecialidadesDoGestor($db, $id, $especialidades)
{
    if ($especialidades['gestor']['instalacao']) {
        for ($j = 155; $j <= 158; $j++) {
            if ($j <= 155) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 14)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 14)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 155; $j <= 158; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 14)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['cadastro']) {
        for ($j = 159; $j <= 164; $j++) {
            if ($j <= 160) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 15)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 15)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 159; $j <= 164; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 15)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['movimento']) {
        for ($j = 165; $j <= 168; $j++) {
            if ($j <= 165) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 16)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 16)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 165; $j <= 168; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 16)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['contabil']) {
        for ($j = 169; $j <= 171; $j++) {
            if ($j <= 169) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 17)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 17)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 169; $j <= 171; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 17)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['gestor']['fiscal']) {
        for ($j = 172; $j <= 174; $j++) {
            if ($j <= 172) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 18)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 18)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 172; $j <= 174; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 18)";

            mysqli_query($db, $query);
        }
    }
} */

function atualizaEspecialidadesDoOutros($db, $id, $especialidades)
{
    if ($especialidades['outros']['app_avanco']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 234)
                AND (id_modulo = 29)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 234)
                AND (id_modulo = 29)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['central_compras']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 235)
                AND (id_modulo = 30)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 235)
                AND (id_modulo = 30)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['conciliador_cartoes']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 236)
                AND (id_modulo = 31)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 236)
                AND (id_modulo = 31)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['ecommerce']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 237)
                AND (id_modulo = 32)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 237)
                AND (id_modulo = 32)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['fgf_systax']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 238)
                AND (id_modulo = 33)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 238)
                AND (id_modulo = 33)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['gestor']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 244)
                AND (id_modulo = 35)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 244)
                AND (id_modulo = 35)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['mercafacil']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 269)
                AND (id_modulo = 37)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 269)
                AND (id_modulo = 37)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['nfce']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 270)
                AND (id_modulo = 38)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 270)
                AND (id_modulo = 38)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['novo_erp']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 271)
                AND (id_modulo = 39)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 271)
                AND (id_modulo = 39)";

        mysqli_query($db, $query);
    }

    if ($especialidades['outros']['tramitador_nfe']) {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 1
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 272)
                AND (id_modulo = 40)";

        mysqli_query($db, $query);
    } else {
        $query =
            "UPDATE av_dashboard_colaborador_especialidades 
                SET conhecimento = 0
            WHERE (id_colaborador = $id)
                AND (id_especialidade = 272)
                AND (id_modulo = 40)";

        mysqli_query($db, $query);
    }
}

/**
 * atualiza as especialidades do módulo novo erp
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array de especialidades com os módulos que serão atividos
 */
/* function atualizaEspecialidadesDoNovoERP($db, $id, $especialidades)
{
    if ($especialidades['novo_erp']['instalacao']) {
        for ($j = 175; $j <= 178; $j++) {
            if ($j <= 175) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 19)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 19)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 175; $j <= 178; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 19)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['pessoas']) {
        for ($j = 179; $j <= 184; $j++) {
            if ($j <= 180) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 20)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 20)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 179; $j <= 184; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 20)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['produtos']) {
        for ($j = 185; $j <= 191; $j++) {
            if ($j <= 186) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 21)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 21)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 185; $j <= 191; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 21)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['fiscal']) {
        for ($j = 192; $j <= 199; $j++) {
            if ($j <= 193) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 22)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 22)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 192; $j <= 199; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 22)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['financeiro']) {
        for ($j = 200; $j <= 203; $j++) {
            if ($j <= 200) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 23)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 23)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 200; $j <= 203; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 23)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['lancamentos']) {
        for ($j = 204; $j <= 207; $j++) {
            if ($j <= 204) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 24)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 24)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 204; $j <= 207; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 24)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['relatorios_graficos']) {
        for ($j = 208; $j <= 215; $j++) {
            if ($j <= 209) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 25)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 25)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 208; $j <= 215; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 25)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['importacao_exportacao']) {
        for ($j = 216; $j <= 220; $j++) {
            if ($j <= 216) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 26)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 26)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 216; $j <= 220; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 26)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['configuracoes_pdv']) {
        for ($j = 221; $j <= 227; $j++) {
            if ($j <= 222) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 27)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 27)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 221; $j <= 227; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 27)";

            mysqli_query($db, $query);
        }
    }

    if ($especialidades['novo_erp']['minha_conta']) {
        for ($j = 228; $j <= 233; $j++) {
            if ($j <= 229) {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 1
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 28)";
            } else {
                $query =
                    "UPDATE av_dashboard_colaborador_especialidades 
            SET conhecimento = 0
              WHERE (id_colaborador = $id)
                AND (id_especialidade = $j)
                AND (id_modulo = 28)";
            }

            mysqli_query($db, $query);
        }
    } else {
        for ($j = 228; $j <= 233; $j++) {
            $query =
                "UPDATE av_dashboard_colaborador_especialidades 
          SET conhecimento = 0
            WHERE (id_colaborador = $id)
              AND (id_especialidade = $j)
              AND (id_modulo = 28)";

            mysqli_query($db, $query);
        }
    }
} */

/**
 * atualiza as especialidades do usuário
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array com os módulos
 */
/* function atualizaEspecialidadesDoUsuario($db, $id, $opcoes)
{
  $especialidades = array(
    'integral' => array(
      'materiais' => false,
      'fiscal' => false,
      'financeiro' => false,
      'contabil' => false,
      'cotacao' => false,
      'tnfe' => false,
      'wms' => false,
      'nfce' => false,
    ),

    'frente' => array(
      'windows' => false,
      'linux' => false,
      'supervisor' => false,
      'scanntech' => false,
      'sitef' => false,
      'comandas' => false,
      'nfce' => false,
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

        case 29:
          $especialidades['integral']['nfce'] = true;
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

        case 30:
          $especialidades['frente']['nfce'] = true;
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

  # chamando funções que atualizam as especialidades de acordo com os módulos selecionados
  atualizaEspecialidadesDoIntegral($db, $id, $especialidades);
  atualizaEspecialidadesDoFrente($db, $id, $especialidades);
  atualizaEspecialidadesDoGestor($db, $id, $especialidades);
  atualizaEspecialidadesDoNovoERP($db, $id, $especialidades);
} */

/**
 * atualiza as especialidades do usuário
 * @param - objeto com uma conexão aberta
 * @param - inteiro com o id do colaborador
 * @param - array com os módulos
 */
function atualizaEspecialidadesDoUsuario($db, $id, $opcoes)
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

    # chamando funções que atualizam as especialidades de acordo com os módulos selecionados
    atualizaEspecialidadesDoIntegral($db, $id, $especialidades);
    atualizaEspecialidadesDoFrente($db, $id, $especialidades);
    atualizaEspecialidadesDoOutros($db, $id, $especialidades);
    // atualizaEspecialidadesDoNovoERP($db, $id, $especialidades);
}


/**
 * atualiza o ramal do usuário
 * @param - objeto com uma conexão aberta
 * @param - array com os dados da conta do usuário
 */
function atualizaRamalDoUsuario($db, $usuario)
{
    $query =
        "UPDATE av_usuarios_login
      SET ramal = {$usuario['ramal']}
    WHERE (id = {$usuario['id']});";

    # verificando se a consulta pode ser executada
    if ($db->query($query)) {

        $resultado = true;
    }

    return $resultado;
}
