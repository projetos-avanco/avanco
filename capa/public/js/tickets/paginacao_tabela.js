$('document').ready(function() {
  // paginando a tabela
  var table = $('#tabela').DataTable({
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
    },    
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "../../../database/functions/tickets/ajax/paginacao_tickets.php",
      "type": "post"
    },
    "columns": [      
      {"data": "data"},
      {"data": "ticket"},
      {"data": "colaborador"},
      {"data": "data_agendada"},
      {"data": "hora_agendada"},
      {"data": "chat_id"},
      {"data": "razao_social"},
      {"data": "validade"},
      {
        "data": null,
        "defaultContent": '<button class="btn btn-sm btn-block btn-success" id="btn-visualiza"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</button>'        
      },
      {
        "data": null,
        "defaultContent": '<button class="btn btn-sm btn-block btn-info" id="btn-invalida"><i class="fa fa-times-circle" aria-hidden="true"></i> Invalidar</button>'
      },
      {
        "data": null,
        "defaultContent": '<button class="btn btn-sm btn-block btn-warning" id="btn-edita"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>'
      },
      {
        "data": null,
        "defaultContent": '<button class="btn btn-sm btn-block btn-danger" id="btn-deleta"><i class="fa fa-trash" aria-hidden="true"></i> Deletar</button>'
      }
    ]    
  });
  
  // função do botão visualiza
  $('#tabela tbody').on('click', '#btn-visualiza', function() {
    var data = table.row($(this).parents('tr')).data();

    var url = window.location.href;

    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/tickets/visualiza_tickets.php?ticket=' + data.ticket + '&funcao=visualiza';

    window.open(url, '_self');
  });

  // função do botão invalida
  $('#tabela tbody').on('click', '#btn-invalida', function() {
    var data = table.row($(this).parents('tr')).data();

    var url = window.location.href;

    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/app/requests/get/processa_ticket.php?ticket=' + data.ticket + '&funcao=invalida';

    window.open(url, '_self');
  });

  // função do botão edita
  $('#tabela tbody').on('click', '#btn-edita', function() {
    var data = table.row($(this).parents('tr')).data();

    var url = window.location.href;

    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/tickets/edita_tickets.php?ticket=' + data.ticket + '&funcao=edita';

    window.open(url, '_self');
  });

  // função do botão deleta
  $('#tabela tbody').on('click', '#btn-deleta', function() {
    var data = table.row($(this).parents('tr')).data();

    var url = window.location.href;

    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/app/requests/get/processa_ticket.php?ticket=' + data.ticket + '&funcao=deleta';

    var resposta = confirm('Confirma a exclusão do Ticket: ' + data.ticket + '?');

    // verificando a resposta do usuário
    if (resposta) {

      window.open(url, '_self');

    } else {

      window.location.reload(true);
      
    }
  });
});
