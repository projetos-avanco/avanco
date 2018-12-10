$(function() {
  // visualizando relatório de horas
  $(document).on('click', '#visualizar-relatorio', function(e) {
    e.preventDefault;

    var id = $(this).val();

    $.ajax({
      type: 'post',
      url: '../../../database/functions/schedule/remote/ajax/dados_relatorio.php',
      dataType: 'json',
      data: {
        id_issue: id
      },
      success: function(dados) {
        var registro = {};
        var despesas = {};
        var lancamentos = [];

        registro.id             = dados.id;
        registro.id_colaborador = dados.id_colaborador;
        registro.razao_social   = dados.razao_social;
        registro.conta_contrato = dados.conta_contrato;
        registro.cnpj           = dados.cnpj;
        registro.issue          = dados.issue;
        registro.supervisor     = dados.supervisor;
        registro.colaborador    = dados.colaborador;
        registro.observacao     = dados.observacao;

        registro.razao_social = registro.razao_social.substr(0, 32).toUpperCase();

        despesas.tipo = dados.tipo;
        despesas.deslocamento = dados.deslocamento;
        despesas.alimentacao = dados.alimentacao;
        despesas.hospedagem = dados.hospedagem;
        despesas.total = dados.total_despesas;

        delete dados.id;
        delete dados.id_colaborador;
        delete dados.razao_social;
        delete dados.conta_contrato;
        delete dados.cnpj;
        delete dados.issue;
        delete dados.supervisor;
        delete dados.colaborador;
        delete dados.observacao;

        delete dados.tipo;
        delete dados.deslocamento;
        delete dados.alimentacao;
        delete dados.hospedagem;
        delete dados.total_despesas;

        for (var i = 0; i < Object.keys(dados).length; i++) {
          lancamentos[i] = dados[i];
        }
        
        // exibindo relatório completo pelo alert
        swal({
          icon: 'info',
          title: 'Registro de Horas!',
          text:
            'Empresa: '        + registro.razao_social   + "\n\n" +
            'Conta Contrato: ' + registro.conta_contrato + "\n\n" +
            'CNPJ: '           + registro.cnpj           + "\n\n" +
            'Issue: '          + registro.issue          + "\n\n" +
            'Supervisor: '     + registro.supervisor     + "\n\n" +
            'Colaborador: '    + registro.colaborador    + "\n\n" +
            'Observação: '     + registro.observacao     + "\n\n\n\n" +
            'Tipo: '           + despesas.tipo           + "\n\n" +
            'Deslocamento: '   + despesas.deslocamento   + "\n\n" +
            'Alimentação: '    + despesas.alimentacao    + "\n\n" +
            'Hospedagem: '     + despesas.hospedagem     + "\n\n" +
            'Total Despesas: ' + despesas.total          + "\n\n\n\n" +
            lancamentos.map((l) => {
              return 'Data: ' + l.data + "\n\n" + 'Produto: ' + l.produto + "\n\n" + 'Horas Trabalhadas: ' + l.horas_trabalhadas + "\n\n" + 'Horas Faturadas: ' + l.horas_faturadas + "\n\n" + 'Valor Hora: ' + l.valor_hora + "\n\n" + 'Total: ' + l.total;
          }).join("\n\n ---------- \n\n")
        });                                      
      },
      error: function(erro) {
        console.log(erro);
      }
    });
  });
});