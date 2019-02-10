$(function() {
  $(document).ready(function(e) {
    e.preventDefault;

    $.ajax({
      type: 'get',
      url: '../../../app/requests/get/vacation/recebe_manifestacao.php',
      dataType: 'json',
      success: function(dados) {
        var table = '';
        var tbody = '';

        table += '<table class="table table-condensed table-striped" id="relatorio">' +
          '<thead>'                                                  +
            '<tr>'                                                   +
              '<th class="text-center">Supervisor</th>'              +
              '<th class="text-center">Colaborador</th>'             +
              '<th class="text-center">Regime</th>'                  +
              '<th class="text-center">Contrato</th>'                +
              '<th class="text-center">Férias</th>'                  +
              '<th class="text-center">Situação</th>'                +
              '<th class="text-center">Exercício Inicial</th>'       +
              '<th class="text-center">Exercício Final</th>'         +
              '<th class="text-center">Data Limite</th>'             +
              '<th class="text-center">Registrado</th>'              +
              '<th class="text-center"></th>'                        +
            '</tr>'                                                  +
          '</thead>'                                                 +
          '<tbody>';
  
        for (var i = 0; i < dados.length; i++) {
          tbody += 
            '<tr>';

          tbody += '<td class="text-center">' + dados[i].supervisor        + '</td>';              
          tbody += '<td class="text-left">'   + dados[i].colaborador       + '</td>';
          tbody += '<td class="text-left">'   + dados[i].regime            + '</td>';
          tbody += '<td class="text-left">'   + dados[i].contrato          + '</td>';
          tbody += '<td class="text-center">' + dados[i].status            + '</td>';
          tbody += '<td class="text-left">'   + dados[i].pedido            + '</td>';
          tbody += '<td class="text-center">' + dados[i].exercicio_inicial + '</td>';          
          tbody += '<td class="text-center">' + dados[i].exercicio_final   + '</td>';         
          tbody += '<td class="text-center">' + dados[i].vencimento        + '</td>';           
          tbody += '<td class="text-center">' + dados[i].registrado        + '</td>';          
          tbody +=
            '<td>' +
              '<button class="btn btn-default btn-sm btn-block" id="selecionar" type="button" value="' + dados[i].id + '" data-id-colaborador="' + dados[i].id_colaborador + '" data-inicial="' + dados[i].exercicio_inicial +'" data-final="' + dados[i].exercicio_final + '" data-vencimento="' + dados[i].vencimento + '">' +
                '<i class="fa fa-square-o" aria-hidden="true"></i> Selecionar' +
              '</button' +
            '</td>';

          tbody += '</tr>';
        }

        table += tbody;
        table += 
          '</tbody>' +
        '</table>' +
        '<br>';
  
        $('#tabela-manifestacao').html(table);

        // paginando a tabela
        $('#relatorio').DataTable({
          //"aaSorting": [[3, "desc"]],   
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
          },
          "pageLength": 10
        });
      },
      error: function(resposta) {
        console.log(resposta);
      }
    });
  });
});