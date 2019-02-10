$('document').ready(function() {

  // paginando a tabela
  var table = $('#tabela').DataTable({
    "aaSorting": [[0, "desc"]],
    "oLanguage" : {
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
      "url": "../../../database/functions/hours/ajax/paginacao_lancamentos.php",
      "type": "post"
    },
    "columns": [      
      {"data": "id"},      
      {"data": "issue"},
      {"data": "razao_social"},
      {"data": "supervisor"},
      {
        "data": null,
        "defaultContent": '<button class="btn btn-sm btn-block btn-success" id="btn-visualiza"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</button>'        
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

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/hours/visualiza_lancamentos.php?issue=' + data.issue;

    window.open(url, '_self');
  });

  // função do botão edita
  $('#tabela tbody').on('click', '#btn-edita', function() {
    var data = table.row($(this).parents('tr')).data();

    var url = window.location.href;

    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/hours/edita_lancamentos.php?issue=' + data.issue;

    window.open(url, '_self');
  });

  // função do botão deleta
  $('#tabela tbody').on('click', '#btn-deleta', function() {
    var data = table.row($(this).parents('tr')).data();

    var url = window.location.href;

    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/app/requests/get/processa_lancamento.php?id=' + data.id;

    var resposta = confirm('Confirma a exclusão da Issue: ' + data.issue + '?');

    // verificando a resposta do usuário
    if (resposta) {

      window.open(url, '_self');

    } else {

      window.location.reload(true);
      
    }
  });
});