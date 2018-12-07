$('document').ready(function() {
  var gerencial = {};

  gerencial.dataInicial = $('#data-inicial').val();
  gerencial.dataFinal = $('#data-final').val();

  $.ajax({
    type: 'post',
    url: '../../../database/functions/schedule/external/ajax/paginacao_externo.php',
    dataType: 'json',
    data: {
      data_inicial: gerencial.dataInicial,
      data_final: gerencial.dataFinal
    },
    success: function(dados) {
      var tbody = '';

      for (var i = 0; i < dados.length; i++) {
        tbody += 
          '<tr ' +
            'data-id="' + dados[i].id + '"' +
            'data-id-issue="' + dados[i].id_issue + '"' +
            'data-lancado="' + dados[i].registrado + '"' +
            'data-registro="' + dados[i].registro + '"' +
            'data-status="' + dados[i].status + '"' +
            'data-supervisor="' + dados[i].supervisor + '"' +
            'data-colaborador="' + dados[i].colaborador + '"' +
            'data-tipo="' + dados[i].tipo + '"' +
            'data-empresa="' + dados[i].empresa + '"' +
            'data-cnpj="' + dados[i].cnpj + '"' +
            'data-contato="' + dados[i].contato + '"' +
            'data-periodo="' + dados[i].periodo + '"' +
            'data-produto="' + dados[i].produto + '"' +
            'data-observacao="' + dados[i].observacao + '"' +
            'data-faturado="' + dados[i].faturado + '"' +
            'data-despesas="' + dados[i].despesas + '"' +
            'data-relatorio="' + dados[i].relatorio_entregue + '"' +
            'data-pesquisa="' + dados[i].pesquisa_realizada + '">';
        tbody += '<td class="text-center">' + dados[i].registrado + '</td>';
        tbody += '<td class="text-center">' + dados[i].registro + '</td>';
        tbody += '<td class="text-center">' + dados[i].status.toUpperCase() + '</td>';
        tbody += '<td class="text-center">' + dados[i].colaborador.toUpperCase() + '</td>';
        tbody += '<td class="text-center">' + dados[i].tipo.toUpperCase() + '</td>';
        tbody += '<td class="text-left">' + dados[i].empresa.toUpperCase() + '</td>';              
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
        } else {
          tbody += 
          '<td>' +
            '<button class="btn btn-warning btn-sm btn-block" id="editar-relatorio" type="button" value="' + dados[i].issue + '">' +
              '<i class="fa fa-pencil" aria-hidden="true"></i> Editar' +
            '</button' +
          '</td>';
        }

        if (dados[i].pesquisa_realizada === 'Sim') {
          tbody += 
          '<td>' +
            '<button class="btn btn-success btn-sm btn-block" id="visualizar-pesquisa" type="button" value="' + dados[i].id_pesquisa + '">' +
              '<i class="fa fa-eye" aria-hidden="true"></i> Visualizar' +
            '</button' +
          '</td>';                
        } else {
          tbody += 
          '<td>' +
            '<button class="btn btn-warning btn-sm btn-block" id="editar-pesquisa" type="button" value="' + dados[i].id_pesquisa + '">' +
              '<i class="fa fa-pencil" aria-hidden="true"></i> Editar' +
            '</button' +
          '</td>';
        }

        tbody +=
        '<td>' +
          '<button class="btn btn-danger btn-sm btn-block" id="cancelar-atendimento" type="button" value="' + dados[i].id + '">' +
            '<i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar' +
          '</button' +
        '</td>';

        tbody += '</tr>'
      }            

      $('#tbody').html(tbody);

      // paginando a tabela
      $('#relatorio').DataTable({
        "aaSorting": [[0, "desc"]],   
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