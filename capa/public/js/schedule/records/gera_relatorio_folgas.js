$(function() {
  // gerando relatório após clicar em consultar
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var folgas = {};
    
    folgas.nivel       = $('#nivel').val();
    folgas.id          = $('#id-chat').val();
    folgas.dataInicial = $('#data-inicial').val();
    folgas.dataFinal   = $('#data-final').val();
    folgas.colaborador = $('#colaborador').val();
    folgas.motivo      = $('#motivo').val();
    
    $.ajax({
      type: 'post',
      url: '../../../database/functions/schedule/records/ajax/dados_relatorio_folgas.php',
      dataType: 'json',
      data: {
        nivel: folgas.nivel,
        id: folgas.id,
        data_inicial: folgas.dataInicial,
        data_final: folgas.dataFinal,
        colaborador: folgas.colaborador,
        motivo: folgas.motivo
      },
      success: function(dados) {
        var table = '';
        var tbody = '';

        if (folgas.nivel == '2') {
          table += '<table class="table table-condensed" id="relatorio">' +
          '<thead>' +
            '<tr>' +              
              '<th class="text-center">Registro</th>' +
              '<th class="text-center">Supervisor</th>' +
              '<th class="text-center">Colaborador</th>' +
              '<th class="text-center">Motivo</th>' +
              '<th class="text-center">Período</th>' +                
              '<th class="text-center">Observação</th>' +
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
            tbody += '<td class="text-center">'          + dados[i].periodo     + '</td>';            
            tbody += '<td class="text-left">'            + dados[i].observacao  + '</td>';
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
            tbody += '</tr>';            
          }
        } else if (folgas.nivel == '1') {
          table += '<table class="table table-condensed" id="relatorio">' +
          '<thead>' +
            '<tr>' +              
              '<th class="text-center">Registro</th>' +
              '<th class="text-center">Supervisor</th>' +
              '<th class="text-center">Colaborador</th>' +
              '<th class="text-center">Motivo</th>' +
              '<th class="text-center">Período</th>' +                
              '<th class="text-center">Observação</th>' +              
            '</tr>' +
          '</thead>' +
          '<tbody>';
  
          for (var i = 0; i < dados.length; i++) {
            tbody += '<tr>';            
            tbody += '<td class="text-center">' + dados[i].registro    + '</td>';
            tbody += '<td class="text-center">' + dados[i].supervisor  + '</td>';
            tbody += '<td class="text-center">' + dados[i].colaborador + '</td>';
            tbody += '<td class="text-center">' + dados[i].motivo      + '</td>';
            tbody += '<td class="text-center">' + dados[i].periodo     + '</td>';            
            tbody += '<td class="text-left">'   + dados[i].observacao  + '</td>';            
            tbody += '</tr>';            
          }
        }

        table += tbody;
        table += 
          '</tbody>' +
        '</table>';
  
        $('#tabela-relatorio').html(table);

        // paginando a tabela
        $('#relatorio').DataTable({
          "aaSorting": [[4, "desc"]],   
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
      error: function() {

      }
    });
  });
  
  // atualizando página
  $(document).on('click', '#btn-atualizar', function(e) {
    e.preventDefault;

    window.location.reload(true);
  });

  // editando registro
  $(document).on('click', '#btn-editar', function(e) {
    e.preventDefault;

    var id = $(this).val();
    
    var url = window.location.href;

    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/edita_folgas.php?id=' + id;

    window.open(url, '_self');
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
          registro: 'folgas'
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