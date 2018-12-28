$(function() {
  // gerando relatório ao acessar a página
  $(document).ready(function(e) {
    e.preventDefault;

    var gerencial = {};
  
    gerencial.dataInicial = $('#data-inicial').val();
    gerencial.dataFinal = $('#data-final').val();

    $.ajax({
      type: 'post',
      url: '../../../database/functions/schedule/remote/ajax/dados_paginacao_relatorio.php',
      dataType: 'json',
      data: {
        data_inicial: gerencial.dataInicial,
        data_final: gerencial.dataFinal
      },
      success: function(dados) {
        var table = '';
        var tbody = '';

        table += '<table class="table table-condensed" id="relatorio">' +
          '<thead>'                                      +
            '<tr>'                                       +
              '<th class="text-center">Registro</th>'    +
              '<th class="text-center">Empresa</th>'     +
              '<th class="text-center">Colaborador</th>' +
              '<th class="text-center">Período</th>'     +
              '<th class="text-center">Situação</th>'    +
              '<th class="text-center">Atendimento</th>' +
              '<th class="text-center">Remoto</th>'      +
              '<th class="text-center">Relatório</th>'   +
              '<th class="text-center"></th>'            +
            '</tr>'                                      +
          '</thead>'                                     +
          '<tbody>';
  
        for (var i = 0; i < dados.length; i++) {
          tbody += 
            '<tr '                 +
              'data-id="'          + dados[i].id                 + '"' +
              'data-id-cnpj="'     + dados[i].id_cnpj            + '"' +
              'data-id-contato="'  + dados[i].id_contato         + '"' +
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
              'data-relatorio="'   + dados[i].relatorio_entregue + '">';
          tbody += '<td class="text-center">' + dados[i].registro              + '</td>';
          tbody += '<td class="text-left">'   + dados[i].empresa.toUpperCase() + '</td>';
          tbody += '<td class="text-left">' + dados[i].colaborador           + '</td>';
          tbody += '<td class="text-center">' + dados[i].periodo               + '</td>';
          tbody += '<td class="text-center">' + dados[i].status                + '</td>';
          tbody += '<td class="text-center">'   + dados[i].tipo                  + '</td>';
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
            tbody += 
              '<td>' +
                '<button class="btn btn-warning btn-sm btn-block" id="editar-relatorio" type="button" value="' + dados[i].issue + '">' +
                  '<i class="fa fa-pencil" aria-hidden="true"></i> Editar' +
                '</button' +
              '</td>';
          }

          if (dados[i].status != 'Atendimento Cancelado') {
            tbody +=
              '<td>' +
                '<button class="btn btn-danger btn-sm btn-block" id="cancelar-atendimento" type="button" value="' + dados[i].id + '">' +
                  '<i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar' +
                '</button' +
              '</td>';
          } else {
            tbody += '<td></td>';
          }
  
          tbody += '</tr>'
        }

        table += tbody;
        table += 
          '</tbody>' +
        '</table>';
  
        $('#tabela-relatorio').html(table);

        // paginando a tabela
        $('#relatorio').DataTable({
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
      error: function(erro) {
        console.log(erro);
      }
    });  
  });

  // gerando relatório ao clicar no botão consultar
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var gerencial = {};

    gerencial.empresa     = $('#id').val();    
    gerencial.colaborador = $('#colaborador').val();
    gerencial.dataInicial = $('#data-inicial').val();
    gerencial.dataFinal   = $('#data-final').val();
    gerencial.tipo        = $('#tipo-atendimento').val();
    gerencial.produto     = $('#produto').val();

    if (gerencial.colaborador == '0') {
      gerencial.colaborador = '';
    }

    $.ajax({
      type: 'post',
      url: '../../../database/functions/schedule/remote/ajax/dados_paginacao_relatorio.php',
      dataType: 'json',
      data: {
        id: gerencial.empresa,        
        colaborador: gerencial.colaborador,
        data_inicial: gerencial.dataInicial,
        data_final: gerencial.dataFinal,
        tipo: gerencial.tipo,
        produto: gerencial.produto
      },
      success: function(dados) {
        var table = '';
        var tbody = '';

        table += '<table class="table table-condensed" id="relatorio">' +
          '<thead>'                                      +
            '<tr>'                                       +
              '<th class="text-center">Registro</th>'    +
              '<th class="text-center">Empresa</th>'     +
              '<th class="text-center">Colaborador</th>' +
              '<th class="text-center">Período</th>'     +
              '<th class="text-center">Situação</th>'    +
              '<th class="text-center">Atendimento</th>' +
              '<th class="text-center">Remoto</th>'      +
              '<th class="text-center">Relatório</th>'   +
              '<th class="text-center"></th>'            +
            '</tr>'                                      +
          '</thead>'                                     +
          '<tbody>';

        for (var i = 0; i < dados.length; i++) {
          tbody += 
            '<tr '                 +
              'data-id="'          + dados[i].id                 + '"' +
              'data-id-cnpj="'     + dados[i].id_cnpj            + '"' +
              'data-id-contato="'  + dados[i].id_contato         + '"' +
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
              'data-relatorio="'   + dados[i].relatorio_entregue + '">';
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
            tbody += 
              '<td>' +
                '<button class="btn btn-warning btn-sm btn-block" id="editar-relatorio" type="button" value="' + dados[i].issue + '">' +
                  '<i class="fa fa-pencil" aria-hidden="true"></i> Editar' +
                '</button' +
              '</td>';
          }
          
          if (dados[i].status != 'Atendimento Cancelado') {
            tbody +=
              '<td>' +
                '<button class="btn btn-danger btn-sm btn-block" id="cancelar-atendimento" type="button" value="' + dados[i].id + '">' +
                  '<i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar' +
                '</button' +
              '</td>';
          } else {
            tbody += '<td></td>';
          }
  
          tbody += '</tr>'
        }

        table += tbody;
        table += 
          '</tbody>' +
        '</table>';
  
        $('#tabela-relatorio').html(table);

        // paginando a tabela
        $('#relatorio').DataTable({
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
  });  
});