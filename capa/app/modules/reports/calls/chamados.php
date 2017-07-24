
<?php

require ABS_PATH . 'app/models/departamentos.php';
require ABS_PATH . 'app/models/chamados.php';
require ABS_PATH . 'database/functions/reports/calls/general/funcoes-geral.php';
require ABS_PATH . 'database/functions/reports/calls/general/funcoes-triagem.php';
require ABS_PATH . 'database/functions/reports/calls/general/funcoes-indices.php';
require ABS_PATH . 'database/functions/reports/calls/general/funcoes-comentarios.php';

require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-comentarios.php';
require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-demandas.php';
require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-triagem.php';
require ABS_PATH . 'database/functions/reports/calls/specific/funcoes-indices.php';

/**
 * gera o relatório geral (de todos os clientes) dos chamados de um período ou uma data específica
 * @param - array com uma conexão aberta
 * @param - array com a data inicial e data final
 */
function geraRelatorioGeralDeChamados($conexao, $datas)
{
  # criando array's utilizando os modelos pré definidos
  $departamentos = defineArrayDeDepartamentos();
  $resultados    = defineArrayDeRelatorioDeChamados();

  /*
   * departamento auge + integral + parceiros
   */

  # gerando resultados geral da departamento auge + integral + parceiros
  $resultados
    ['aug_int_parc']
      ['geral']
        ['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamentos['aug_int_parc']);
  $resultados
    ['aug_int_parc']
      ['geral']
        ['atendidos'] = retornaAtendidos($conexao, $datas, $departamentos['aug_int_parc']);
  $resultados
    ['aug_int_parc']
      ['geral']
        ['perdidos'] = retornaPerdidos($conexao, $datas, $departamentos['aug_int_parc']);
  $resultados
    ['aug_int_parc']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamentos['aug_int_parc']);

  # gerando resultados de triagem da departamento auge + integral + parceiros
  $resultados
    ['aug_int_parc']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15Minutos($conexao, $datas,$departamentos['aug_int_parc']);
  $resultados
    ['aug_int_parc']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamentos['aug_int_parc']);
  $resultados
    ['aug_int_parc']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamentos['aug_int_parc']);

  # gerando resultados de índices da departamento auge + integral + parceiros
  $resultados
    ['aug_int_parc']
      ['indices']
        ['avancino'] = calculaPercentualAvancino($conexao, $datas, $departamentos['aug_int_parc']);
  $resultados
    ['aug_int_parc']
      ['indices']
        ['geral'] = calculaPercentualGeral($conexao, $datas, $departamentos['aug_int_parc']);

  /*
   * departamento auge
   */

  # gerando resultados geral da departamento auge
  $resultados
    ['auge']
      ['geral']
        ['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamentos['auge']);
  $resultados
    ['auge']
      ['geral']
        ['atendidos'] = retornaAtendidos($conexao, $datas, $departamentos['auge']);
  $resultados
    ['auge']
      ['geral']
        ['perdidos'] = retornaPerdidos($conexao, $datas, $departamentos['auge']);
  $resultados
    ['auge']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamentos['auge']);

  # gerando resultados de triagem da departamento auge
  $resultados
    ['auge']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15Minutos($conexao, $datas,$departamentos['auge']);
  $resultados
    ['auge']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamentos['auge']);
  $resultados
    ['auge']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamentos['auge']);

  # gerando resultados de índices da departamento auge
  $resultados
    ['auge']
      ['indices']
        ['avancino'] = calculaPercentualAvancino($conexao, $datas, $departamentos['auge']);
  $resultados
    ['auge']
      ['indices']
        ['geral'] = calculaPercentualGeral($conexao, $datas, $departamentos['auge']);

  /*
   * departamento integral
   */

  # gerando resultados geral da departamento integral
  $resultados
    ['integral']
      ['geral']
        ['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamentos['integral']);
  $resultados
    ['integral']
      ['geral']
        ['atendidos'] = retornaAtendidos($conexao, $datas, $departamentos['integral']);
  $resultados
    ['integral']
      ['geral']
        ['perdidos'] = retornaPerdidos($conexao, $datas, $departamentos['integral']);
  $resultados
    ['integral']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamentos['integral']);

  # gerando resultados de triagem da departamento integral
  $resultados
    ['integral']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15Minutos($conexao, $datas,$departamentos['integral']);
  $resultados
    ['integral']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamentos['integral']);
  $resultados
    ['integral']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamentos['integral']);

  # gerando resultados de índices da departamento integral
  $resultados
    ['integral']
      ['indices']
        ['avancino'] = calculaPercentualAvancino($conexao, $datas, $departamentos['integral']);
  $resultados
    ['integral']
      ['indices']
        ['geral'] = calculaPercentualGeral($conexao, $datas, $departamentos['integral']);

  /*
   * departamento parceiros
   */

  # gerando resultados geral da departamento parceiros
  $resultados
    ['parceiros']
      ['geral']
        ['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamentos['parceiros']);
  $resultados
    ['parceiros']
      ['geral']
        ['atendidos'] = retornaAtendidos($conexao, $datas, $departamentos['parceiros']);
  $resultados
    ['parceiros']
      ['geral']
        ['perdidos'] = retornaPerdidos($conexao, $datas, $departamentos['parceiros']);
  $resultados
    ['parceiros']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamentos['parceiros']);

  # gerando resultados de triagem da departamento parceiros
  $resultados
    ['parceiros']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15Minutos($conexao, $datas,$departamentos['parceiros']);
  $resultados
    ['parceiros']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamentos['parceiros']);
  $resultados
    ['parceiros']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamentos['parceiros']);

  # gerando resultados de índices da departamento parceiros
  $resultados
    ['parceiros']
      ['indices']
        ['avancino'] = calculaPercentualAvancino($conexao, $datas, $departamentos['parceiros']);
  $resultados
    ['parceiros']
      ['indices']
        ['geral'] = calculaPercentualGeral($conexao, $datas, $departamentos['parceiros']);

  /*
   * departamento novo erp
   */

  # gerando resultados geral da departamento novo erp
  $resultados
    ['novo_erp']
      ['geral']
        ['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamentos['novo_erp']);
  $resultados
    ['novo_erp']
      ['geral']
        ['atendidos'] = retornaAtendidos($conexao, $datas, $departamentos['novo_erp']);
  $resultados
    ['novo_erp']
      ['geral']
        ['perdidos'] = retornaPerdidos($conexao, $datas, $departamentos['novo_erp']);
  $resultados
    ['novo_erp']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamentos['novo_erp']);

  # gerando resultados de triagem da departamento novo erp
  $resultados
    ['novo_erp']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15Minutos($conexao, $datas,$departamentos['novo_erp']);
  $resultados
    ['novo_erp']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamentos['novo_erp']);
  $resultados
    ['novo_erp']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamentos['novo_erp']);

  # gerando resultados de índices da departamento novo erp
  $resultados
    ['novo_erp']
      ['indices']
        ['avancino'] = calculaPercentualAvancino($conexao, $datas, $departamentos['novo_erp']);
  $resultados
    ['novo_erp']
      ['indices']
        ['geral'] = calculaPercentualGeral($conexao, $datas, $departamentos['novo_erp']);

  /*
   * departamento tecnologia
   */

  # gerando resultados geral da departamento tecnologia
  $resultados
    ['tecnologia']
      ['geral']
        ['demanda_total'] = retornaDemandaTotal($conexao, $datas, $departamentos['tecnologia']);
  $resultados
    ['tecnologia']
      ['geral']
        ['atendidos'] = retornaAtendidos($conexao, $datas, $departamentos['tecnologia']);
  $resultados
    ['tecnologia']
      ['geral']
        ['perdidos'] = retornaPerdidos($conexao, $datas, $departamentos['tecnologia']);
  $resultados
    ['tecnologia']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerda($conexao, $datas, $departamentos['tecnologia']);

  # gerando resultados de triagem da departamento tecnologia
  $resultados
    ['tecnologia']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15Minutos($conexao, $datas,$departamentos['tecnologia']);
  $resultados
    ['tecnologia']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30Minutos($conexao, $datas, $departamentos['tecnologia']);
  $resultados
    ['tecnologia']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30Minutos($conexao, $datas, $departamentos['tecnologia']);

  # gerando resultados de índices da departamento tecnologia
  $resultados
    ['tecnologia']
      ['indices']
        ['avancino'] = calculaPercentualAvancino($conexao, $datas, $departamentos['tecnologia']);
  $resultados
    ['tecnologia']
      ['indices']
        ['geral'] = calculaPercentualGeral($conexao, $datas, $departamentos['tecnologia']);

  # comentários satisfeitos
  $resultados
    ['comentarios']
      ['satisfeitos'] = retornaComentariosSatisfeitos($conexao, $datas);

  # comentários insatisfeitos
  $resultados
    ['comentarios']
      ['insatisfeitos'] = retornaComentariosInsatisfeitos($conexao, $datas);

  $_SESSION['relatorio_de_chamados_geral'] = $resultados;
}

/**
 * gera o relatório específico (de um cliente específico) dos chamados de um período ou uma data específica
 * @param - array com uma conexão aberta
 * @param - array com a data inicial e data final
 * @param - variável com o cnpj de um cliente específico
 */
function geraRelatorioEspecificoDeChamados($conexao, $datas, $cnpj)
{
  # criando array's utilizando os modelos pré definidos
  $departamentos = defineArrayDeDepartamentos();
  $resultados    = defineArrayDeRelatorioDeChamados();

  /*
   * departamento auge + integral + parceiros
   */

  # gerando resultados geral da departamento auge + integral + parceiros
  $resultados
    ['aug_int_parc']
      ['geral']
        ['demanda_total'] = retornaDemandaTotalDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);
  $resultados
    ['aug_int_parc']
      ['geral']
        ['atendidos'] = retornaChamadosAtendidosDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);
  $resultados
    ['aug_int_parc']
      ['geral']
        ['perdidos'] = retornaChamadosPerdidosDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);
  $resultados
    ['aug_int_parc']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerdaDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);

  # gerando resultados de triagem da departamento auge + integral + parceiros
  $resultados
    ['aug_int_parc']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15MinutosDeUmCliente($conexao, $datas,$departamentos['aug_int_parc'], $cnpj);
  $resultados
    ['aug_int_parc']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);
  $resultados
    ['aug_int_parc']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30MinutosDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);

  # gerando resultados de índices da departamento auge + integral + parceiros
  $resultados
    ['aug_int_parc']
      ['indices']
        ['avancino'] = calculaPercentualDoIndiceAvancinoDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);
  $resultados
    ['aug_int_parc']
      ['indices']
        ['geral'] = calculaPercentualDoIndiceGeralDeUmCliente($conexao, $datas, $departamentos['aug_int_parc'], $cnpj);

  /*
   * departamento auge
   */

  # gerando resultados geral da departamento auge
  $resultados
    ['auge']
      ['geral']
        ['demanda_total'] = retornaDemandaTotalDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);
  $resultados
    ['auge']
      ['geral']
        ['atendidos'] = retornaChamadosAtendidosDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);
  $resultados
    ['auge']
      ['geral']
        ['perdidos'] = retornaChamadosPerdidosDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);
  $resultados
    ['auge']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerdaDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);

  # gerando resultados de triagem da departamento auge
  $resultados
    ['auge']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15MinutosDeUmCliente($conexao, $datas,$departamentos['auge'], $cnpj);
  $resultados
    ['auge']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);
  $resultados
    ['auge']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30MinutosDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);

  # gerando resultados de índices da departamento auge
  $resultados
    ['auge']
      ['indices']
        ['avancino'] = calculaPercentualDoIndiceAvancinoDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);
  $resultados
    ['auge']
      ['indices']
        ['geral'] = calculaPercentualDoIndiceGeralDeUmCliente($conexao, $datas, $departamentos['auge'], $cnpj);

  /*
   * departamento integral
   */

  # gerando resultados geral da departamento integral
  $resultados
    ['integral']
      ['geral']
        ['demanda_total'] = retornaDemandaTotalDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);
  $resultados
    ['integral']
      ['geral']
        ['atendidos'] = retornaChamadosAtendidosDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);
  $resultados
    ['integral']
      ['geral']
        ['perdidos'] = retornaChamadosPerdidosDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);
  $resultados
    ['integral']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerdaDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);

  # gerando resultados de triagem da departamento integral
  $resultados
    ['integral']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15MinutosDeUmCliente($conexao, $datas,$departamentos['integral'], $cnpj);
  $resultados
    ['integral']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);
  $resultados
    ['integral']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30MinutosDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);

  # gerando resultados de índices da departamento integral
  $resultados
    ['integral']
      ['indices']
        ['avancino'] = calculaPercentualDoIndiceAvancinoDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);
  $resultados
    ['integral']
      ['indices']
        ['geral'] = calculaPercentualDoIndiceGeralDeUmCliente($conexao, $datas, $departamentos['integral'], $cnpj);

  /*
   * departamento parceiros
   */

  # gerando resultados geral da departamento parceiros
  $resultados
    ['parceiros']
      ['geral']
        ['demanda_total'] = retornaDemandaTotalDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);
  $resultados
    ['parceiros']
      ['geral']
        ['atendidos'] = retornaChamadosAtendidosDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);
  $resultados
    ['parceiros']
      ['geral']
        ['perdidos'] = retornaChamadosPerdidosDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);
  $resultados
    ['parceiros']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerdaDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);

  # gerando resultados de triagem da departamento parceiros
  $resultados
    ['parceiros']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15MinutosDeUmCliente($conexao, $datas,$departamentos['parceiros'], $cnpj);
  $resultados
    ['parceiros']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);
  $resultados
    ['parceiros']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30MinutosDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);

  # gerando resultados de índices da departamento parceiros
  $resultados
    ['parceiros']
      ['indices']
        ['avancino'] = calculaPercentualDoIndiceAvancinoDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);
  $resultados
    ['parceiros']
      ['indices']
        ['geral'] = calculaPercentualDoIndiceGeralDeUmCliente($conexao, $datas, $departamentos['parceiros'], $cnpj);

  /*
   * departamento novo erp
   */

  # gerando resultados geral da departamento novo erp
  $resultados
    ['novo_erp']
      ['geral']
        ['demanda_total'] = retornaDemandaTotalDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);
  $resultados
    ['novo_erp']
      ['geral']
        ['atendidos'] = retornaChamadosAtendidosDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);
  $resultados
    ['novo_erp']
      ['geral']
        ['perdidos'] = retornaChamadosPerdidosDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);
  $resultados
    ['novo_erp']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerdaDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);

  # gerando resultados de triagem da departamento novo erp
  $resultados
    ['novo_erp']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15MinutosDeUmCliente($conexao, $datas,$departamentos['novo_erp'], $cnpj);
  $resultados
    ['novo_erp']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);
  $resultados
    ['novo_erp']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30MinutosDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);

  # gerando resultados de índices da departamento novo erp
  $resultados
    ['novo_erp']
      ['indices']
        ['avancino'] = calculaPercentualDoIndiceAvancinoDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);
  $resultados
    ['novo_erp']
      ['indices']
        ['geral'] = calculaPercentualDoIndiceGeralDeUmCliente($conexao, $datas, $departamentos['novo_erp'], $cnpj);

  /*
   * departamento tecnologia
   */

  # gerando resultados geral da departamento tecnologia
  $resultados
    ['tecnologia']
      ['geral']
        ['demanda_total'] = retornaDemandaTotalDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);
  $resultados
    ['tecnologia']
      ['geral']
        ['atendidos'] = retornaChamadosAtendidosDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);
  $resultados
    ['tecnologia']
      ['geral']
        ['perdidos'] = retornaChamadosPerdidosDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);
  $resultados
    ['tecnologia']
      ['geral']
        ['taxa_de_perda'] = calculaTaxaDePerdaDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);

  # gerando resultados de triagem da departamento tecnologia
  $resultados
    ['tecnologia']
      ['triagem']
        ['ate_15_minutos'] = calculaPercentualAte15MinutosDeUmCliente($conexao, $datas,$departamentos['tecnologia'], $cnpj);
  $resultados
    ['tecnologia']
      ['triagem']
        ['entre_15_e_30_minutos'] = calculaPercentualEntre15E30MinutosDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);
  $resultados
    ['tecnologia']
      ['triagem']
        ['acima_de_30_minutos'] = calculaPercentualAcimaDe30MinutosDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);

  # gerando resultados de índices da departamento tecnologia
  $resultados
    ['tecnologia']
      ['indices']
        ['avancino'] = calculaPercentualDoIndiceAvancinoDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);
  $resultados
    ['tecnologia']
      ['indices']
        ['geral'] = calculaPercentualDoIndiceGeralDeUmCliente($conexao, $datas, $departamentos['tecnologia'], $cnpj);

  # comentários satisfeitos
  $resultados
    ['comentarios']
      ['satisfeitos'] = retornaComentariosSatisfeitosDeUmCliente($conexao, $datas, $cnpj);

  # comentários insatisfeitos
  $resultados
    ['comentarios']
      ['insatisfeitos'] = retornaComentariosInsatisfeitosDeUmCliente($conexao, $datas, $cnpj);

  $_SESSION['relatorio_de_chamados_especifico'] = $resultados;
}
