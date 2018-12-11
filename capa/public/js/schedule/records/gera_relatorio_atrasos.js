$(function() {
  // gerando relatório após clicar em consultar
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var atrasos = {};
    
    atrasos.nivel       = $('#nivel').val();
    atrasos.id          = $('#id-chat').val();
    atrasos.dataInicial = $('#data-inicial').val();
    atrasos.dataFinal   = $('#data-final').val();
    atrasos.colaborador = $('#colaborador').val();
    atrasos.motivo      = $('#motivo').val();
    
    $.ajax({
      type: 'post',
      url: '../../../database/functions/schedule/records/ajax/dados_relatorio_atrasos.php',
      dataType: 'json',
      data: {
        nivel: atrasos.nivel,
        id: atrasos.id,
        data_inicial: atrasos.dataInicial,
        data_final: atrasos.dataFinal,
        colaborador: atrasos.colaborador,
        motivo: atrasos.motivo
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
              '<th class="text-center" width="10%">Data</th>' +
              '<th class="text-center" width="15%">Tempo Atraso</th>' +
              '<th class="text-center" width="30%">Observação</th>' +
            '</tr>' +
          '</thead>' +
          '<tbody>';

        for (var i = 0; i < dados.length; i++) {
          tbody += '<tr>';
          tbody += '<td class="text-center">' + dados[i].registrado   + '</td>';
          tbody += '<td class="text-center">' + dados[i].registro     + '</td>';
          tbody += '<td class="text-left">'   + dados[i].supervisor   + '</td>';
          tbody += '<td class="text-left">'   + dados[i].colaborador  + '</td>';
          tbody += '<td class="text-left">'   + dados[i].motivo       + '</td>';
          tbody += '<td class="text-center">' + dados[i].data         + '</td>';
          tbody += '<td class="text-center">' + dados[i].tempo_atraso + '</td>';          
          tbody += '<td class="text-left">'   + dados[i].observacao   + '</td>';
          tbody += '</tr>'          
        }

        table += tbody;
        table += 
          '</tbody>' +
        '</table>';

        $('#tabela-relatorio').html(table);

        // paginando a tabela
        $('#relatorio').DataTable({
          //"aaSorting": [[5, "desc"]],   
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

        var total = dados[i - 1].total_atraso;

        var horas = Math.floor(total / 3600);
        var minutos = Math.floor((total - (horas * 3600)) / 60);
        var segundos = Math.floor(total % 60);

        if (horas < 9) {
          horas = '0' + horas;
        }

        if (minutos < 9) {
          minutos = '0' + minutos;
        }

        if (segundos < 9) {
          segundos = '0' + segundos;
        }

        $('#total-atraso').val(horas + ':' + minutos + ':' + segundos);
        
        $('#panel').removeClass('hidden');
      },
      error: function(error) {
        console.log(error);
      }
    });
  });
  
  // atualizando página
  $(document).on('click', '#btn-atualizar', function(e) {
    e.preventDefault;

    window.location.reload(true);
  });
});