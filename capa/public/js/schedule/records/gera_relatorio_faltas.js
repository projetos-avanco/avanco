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

        if (faltas.nivel == '2') {
          table += '<table class="table table-condensed" id="relatorio">' +
          '<thead>' +
            '<tr>' +              
              '<th class="text-center">Registro</th>' +
              '<th class="text-center">Supervisor</th>' +
              '<th class="text-center">Colaborador</th>' +
              '<th class="text-center">Motivo</th>' +
              '<th class="text-center">Atestado</th>' +
              '<th class="text-center">Período</th>' +                
              '<th class="text-center">Observação</th>' +
              '<th class="text-center"></th>' +
              '<th class="text-center"></th>' +
              '<th class="text-center"></th>' +
            '</tr>' +
          '</thead>' +
          '<tbody>';
  
          for (var i = 0; i < dados.length; i++) {
            tbody += '<tr>';            
            tbody += '<td class="text-center registro">' + dados[i].registro    + '</td>';
            tbody += '<td class="text-center">'          + dados[i].supervisor  + '</td>';
            tbody += '<td class="text-center">'          + dados[i].colaborador + '</td>';
            tbody += '<td class="text-center">'          + dados[i].motivo      + '</td>';
            tbody += '<td class="text-center">'          + dados[i].atestado    + '</td>';
            tbody += '<td class="text-center">'          + dados[i].periodo     + '</td>';            
            tbody += '<td class="text-left">'            + dados[i].observacao  + '</td>';

            if (dados[i].atestado === 'Sim') {
              tbody += 
              '<td>' +
                '<a class="btn btn-info btn-sm btn-block" id="btn-atestado" href="' + dados[i].arquivo + '" download>' +
                  '<i class="fa fa-download" aria-hidden="true"></i> Atestado' +
                '</a' +
              '</td>';                
            } else {
              tbody += 
              '<td></td>';
            }

            tbody += 
              '<td>' +
                '<button class="btn btn-warning btn-sm btn-block" id="btn-editar" type="button" value="' + dados[i].id + '">' +
                  '<i class="fa fa-pencil" aria-hidden="true"></i> Editar' +
                '</button>' +
              '</td>';

            tbody += 
              '<td>' +
                '<button class="btn btn-danger btn-sm btn-block" id="btn-deletar" type="button" value="' + dados[i].id + '">' +
                  '<i class="fa fa-trash" aria-hidden="true"></i> Deletar' +
                '</button>' +
              '</td>';

            tbody += '</tr>'
          }
        } else if (faltas.nivel == '1') {
          table += '<table class="table table-condensed" id="relatorio">' +
          '<thead>' +
            '<tr>' +              
              '<th class="text-center">Registro</th>' +
              '<th class="text-center">Supervisor</th>' +
              '<th class="text-center">Colaborador</th>' +
              '<th class="text-center">Motivo</th>' +
              '<th class="text-center">Atestado</th>' +
              '<th class="text-center">Período</th>' +                
              '<th class="text-center">Observação</th>' +
              '<th class="text-center"></th>' +              
            '</tr>' +
          '</thead>' +
          '<tbody>';
  
          for (var i = 0; i < dados.length; i++) {
            tbody += '<tr>';            
            tbody += '<td class="text-center">' + dados[i].registro    + '</td>';
            tbody += '<td class="text-center">' + dados[i].supervisor  + '</td>';
            tbody += '<td class="text-center">' + dados[i].colaborador + '</td>';
            tbody += '<td class="text-center">' + dados[i].motivo      + '</td>';
            tbody += '<td class="text-center">' + dados[i].atestado    + '</td>';
            tbody += '<td class="text-center">' + dados[i].periodo     + '</td>';            
            tbody += '<td class="text-left">'   + dados[i].observacao  + '</td>';

            if (dados[i].atestado === 'Sim') {
              tbody += 
              '<td>' +
                '<a class="btn btn-info btn-sm btn-block" id="btn-atestado" href="' + dados[i].arquivo + '" download>' +
                  '<i class="fa fa-download" aria-hidden="true"></i> Atestado' +
                '</a' +
              '</td>';
            } else {
              tbody += 
              '<td></td>';
            }

            tbody += '</tr>'
          }          
        }

        table += tbody;
        table += 
          '</tbody>' +
        '</table>';
  
        $('#tabela-relatorio').html(table);

        // paginando a tabela
        $('#relatorio').DataTable({
          "aaSorting": [[5, "desc"]],   
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

  // deletando registro
  $(document).on('click', '#btn-deletar', function(e) {
    e.preventDefault;

    var id = $(this).val();
    var registro = $(this).closest('tr').find('.registro').html();

    var confirmacao = confirm('Confirma a exclusão do Registro - ' + registro + '?');
    
    if (confirmacao) {
      $.ajax({
        type: 'post',
        url: '../../../app/requests/post/schedule/records/recebe_exclusao.php',
        dataType: 'json',
        data: {          
          id: id,
          registro: 'faltas'
        },
        success: function(resposta) {
          alert(resposta);
          
          window.location.reload(true);
        },
        error: function(erro) {
          console.log(erro);
        }
      });      
    }
  });
});