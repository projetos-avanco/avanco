$(function() {
  $(document).ready(function(e) {
    e.preventDefault;

    var id = $('#id').val();

    if (id != 0) {
      $.ajax({
        type: 'post',
        url: '../../../app/requests/post/vacation/recebe_pedido_exercicio.php',
        dataType: 'html',
        data: {
          id: id              
        },
        success: function(tr) {
          $('#tbody').html(tr);

          // paginando a tabela
          $('.table').DataTable({
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
    } else {
      alert('Selecione um Colaborador!');
    }
  });
});