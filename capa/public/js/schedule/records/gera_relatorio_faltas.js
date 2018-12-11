$(function() {
  // gerando relatório após clicar em consultar
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var faltas = {};
    
    faltas.nivel       = $('#nivel').val();
    faltas.id          = $('#id-chat').val();
    faltas.dataInicial = $('#data-inicial').val();
    faltas.dataFinal   = $('#data-final').val();
    faltas.colaborador = $('#colaborador').val();
    faltas.motivo      = $('#motivo').val();

    $.ajax({
      type: 'post',
      url: '../../../database/functions/schedule/records/ajax/dados_relatorio_faltas.php',
      dataType: 'json',
      data: {
        nivel: faltas.nivel,
        id: faltas.id,
        data_inicial: faltas.dataInicial,
        data_final: faltas.dataFinal,
        colaborador: faltas.colaborador,
        motivo: faltas.motivo
      },
      success: function(dados) {
        var table = '';
        var tbody = '';

        table += '<table class="table table-condensed" id="relatorio">' +
          '<thead>' +
            '<tr>' +
              '<th class="text-center" width="10%">Lançado</th>' +
              '<th class="text-center" width="10%">Registro</th>' +
              '<th class="text-center" width="10%">Supervisor</th>' +
              '<th class="text-center" width="10%">Colaborador</th>' +
              '<th class="text-center" width="10%">Motivo</th>' +
              '<th class="text-center">Atestado</th>' +
              '<th class="text-center" width="15%">Período</th>' +                
              '<th class="text-center" width="20%">Observação</th>' +
              '<th class="text-center"></th>' +
            '</tr>' +
          '</thead>' +
          '<tbody>';
  
        for (var i = 0; i < dados.length; i++) {
          tbody += '<tr>';
          tbody += '<td class="text-center">' + dados[i].registrado  + '</td>';
          tbody += '<td class="text-center">' + dados[i].registro    + '</td>';
          tbody += '<td class="text-left">'   + dados[i].supervisor  + '</td>';
          tbody += '<td class="text-left">'   + dados[i].colaborador + '</td>';
          tbody += '<td class="text-left">'   + dados[i].motivo      + '</td>';
          tbody += '<td class="text-center">' + dados[i].atestado    + '</td>';
          tbody += '<td class="text-center">' + dados[i].periodo     + '</td>';            
          tbody += '<td class="text-left">'   + dados[i].observacao  + '</td>';

          if (dados[i].atestado === 'Sim') {
            tbody += 
            '<td>' +
              '<a class="btn btn-info btn-sm btn-block" id="download-atestado" href="' + dados[i].arquivo + '" download>' +
                '<i class="fa fa-download" aria-hidden="true"></i> Download' +
              '</a' +
            '</td>';
          } else {
            tbody += 
            '<td></td>';
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
          "aaSorting": [[0, "asc"]],   
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
        
        $('#panel').removeClass('hidden');
      },
      error: function(erro) {
        console.log(erro);
      }
    });    
  });
  
  // atualizando página
  $(document).on('click', '#btn-atualizar', function(e) {
    e.preventDefault;

    window.location.reload(true);
  });
});