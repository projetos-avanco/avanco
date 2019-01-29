$(function() {
  // gerando relatório ao clicar no botão consultar
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var date = new Date();
    var tmp = null;

    var externo = {};

    externo.id = $('#id').val();

    tmp = date.toISOString();
    tmp = tmp.split('T');

    externo.dataFinal = tmp[0];

    date.setDate(- 182);

    tmp = date.toISOString();
    tmp = tmp.split('T');

    externo.dataInicial = tmp[0];

    // verificando se alguma empresa foi selecionada
    if (externo.id === '') {
      swal({
        title: "Aviso!",
        text: "Pesquise e selecione uma empresa antes de consultar.",
        icon: "info",
      });
    } else {
      $.ajax({
        type: 'post',
        url: '../../../database/functions/schedule/external/ajax/dados_paginacao_relatorio.php',
        dataType: 'json',
        data: {
          id: externo.id,
          data_inicial: externo.dataInicial,
          data_final: externo.dataFinal,
        },
        success: function(dados) {
          var table = '';
          var tbody = '';
  
          table += '<table class="table table-condensed" id="relatorio-externo">' +
            '<thead>'                                      +
              '<tr>'                                       +
                '<th class="text-center">Registro</th>'    +
                '<th class="text-center">Empresa</th>'     +
                '<th class="text-center">Colaborador</th>' +
                '<th class="text-center">Período</th>'     +
                '<th class="text-center">Situação</th>'    +
                '<th class="text-center">Atendimento</th>' +
                '<th class="text-center">Externo</th>'     +
                '<th class="text-center">Relatório</th>'   +
                '<th class="text-center">Pesquisa</th>'    +
              '</tr>'                                      +
            '</thead>'                                     +
            '<tbody>';
  
          for (var i = 0; i < dados.length; i++) {
            tbody += 
              '<tr ' +
                'data-id="'          + dados[i].id                 + '"' +
                'data-id-contato="'  + dados[i].id_contato         + '"' +
                'data-id-cnpj="'     + dados[i].id_cnpj            + '"' +
                'data-id-issue="'    + dados[i].id_issue           + '"' +
                'data-lancado="'     + dados[i].registrado         + '"' +
                'data-registro="'    + dados[i].registro           + '"' +
                'data-status="'      + dados[i].status             + '"' +
                'data-supervisor="'  + dados[i].supervisor         + '"' +
                'data-colaborador="' + dados[i].colaborador        + '"' +
                'data-tipo="'        + dados[i].tipo               + '"' +
                'data-empresa="'     + dados[i].empresa            + '"' +
                'data-cnpj="'        + dados[i].cnpj               + '"' +
                'data-contato="'     + dados[i].contato            + '"' +
                'data-periodo="'     + dados[i].periodo            + '"' +
                'data-produto="'     + dados[i].produto            + '"' +
                'data-observacao="'  + dados[i].observacao         + '"' +
                'data-faturado="'    + dados[i].faturado           + '"' +
                'data-despesas="'    + dados[i].despesas           + '"' +
                'data-relatorio="'   + dados[i].relatorio_entregue + '"' +
                'data-pesquisa="'    + dados[i].pesquisa_realizada + '">';
            tbody += '<td class="text-center">' + dados[i].registro              + '</td>';
            tbody += '<td class="text-left">'   + dados[i].empresa.toUpperCase() + '</td>';
            tbody += '<td class="text-left">'   + dados[i].colaborador           + '</td>';
            tbody += '<td class="text-center">' + dados[i].periodo               + '</td>';
            tbody += '<td class="text-center">' + dados[i].status                + '</td>';
            tbody += '<td class="text-center">' + dados[i].tipo                  + '</td>';
            
            tbody += 
              '<td>' +
                '<button class="btn btn-success btn-sm btn-block" id="visualizar-atendimento" type="button" value="' + dados[i].id + '">' +
                  '<i class="fa fa-eye" aria-hidden="true"></i> Visualizar' +
                '</button' +
              '</td>';
            
            if (dados[i].relatorio_entregue === 'Sim') {
              tbody += 
                '<td>' +
                  '<button class="btn btn-success btn-sm btn-block" id="visualizar-relatorio" type="button" value="' + dados[i].issue + '">' +
                    '<i class="fa fa-eye" aria-hidden="true"></i> Visualizar' +
                  '</button' +
                '</td>';
            } else if (dados[i].relatorio_entregue === null) {
              tbody += '<td></td>';
            } else {
              tbody += '<td></td>';
            }
    
            if (dados[i].pesquisa_realizada === 'Sim') {
              tbody += 
                '<td>' +
                  '<button class="btn btn-success btn-sm btn-block" id="visualizar-pesquisa" type="button" value="' + dados[i].id_pesquisa + '">' +
                    '<i class="fa fa-eye" aria-hidden="true"></i> Visualizar' +
                  '</button' +
                '</td>';
            } else if (dados[i].pesquisa_realizada === null) {
              tbody += '<td></td>';            
            } else {
              tbody += '<td></td>';
            }

            tbody += '</tr>'
          }
  
          table += tbody;
          table += 
            '</tbody>' +
          '</table>';
    
          $('#tabela-relatorio-externo').html(table);
  
          // paginando a tabela
          $('#relatorio-externo').DataTable({
            "aaSorting": [[3, "desc"]],   
            "oLanguage": {
              "sEmptyTable": "Nenhum registro encontrado",
              "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
              "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
              "sInfoFiltered": "(Filtrados de _MAX_ registros)",
              "sInfoPostFix": "",
              "sInfoThousands": ".",
              "sLengthMenu": "_MENU_ Contratos exibidos por página",
              "sLoadingRecords": "Carregando...",
              "sProcessing": "Processando...",
              "sZeroRecords": "Nenhum registro encontrado",
              "sSearch": "Pesquisar",
              "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
              }
            }
          });
        },
        error: function(dados) {
          console.log(dados);
        }
      });
    }
  });  
});