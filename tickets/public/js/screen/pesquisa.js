$('document').ready(function() {

  const BASE_URL = '../../../';

  $('#pesquisa').keyup(function() {

    var pesquisa = $('#pesquisa').val();

    if (pesquisa != '') {

      $.ajax({
        type: 'post',
        url: BASE_URL + 'app/requests/post/processa_pesquisa.php?pesquisa=' + pesquisa,
        dataType: 'html',
        success: function(tabela)
        {
          if (tabela === 'erro') {

            alert('Ops! Houve um erro durante a execução da consulta de pesquisa.');

          } else {

            $('#bloco').html(tabela);

            // paginando a tabela
            $('#tabela').dataTable({
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
                 },
                 "oAria": {
                   "sSortAscending": ": Ordenar colunas de forma ascendente",
                   "sSortDescending": ": Ordenar colunas de forma descendente"
                 }
               },
               "bFilter": false //removendo a pesquisa
            });

          }

        },
        error: function(tabela)
        {
          alert(tabela);
        }
      });

    } else {

      $('#bloco').empty(); //limpando o bloco da tabela se a pesquisa for vazia

    }

  });

});
