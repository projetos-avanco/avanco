$(function() {
  $(document).on('click', '#selecionar', function(e) {
    e.preventDefault;

    // selecionando opção 0 e bloqueando seleção de períodos de férias
    $('#periodos').val('0');
    $('#periodos').prop('disabled', true);

    // adicionando classe hidden nas linhas
    $('#linha-1').addClass('hidden');
    $('#linha-2').addClass('hidden');
    $('#linha-3').addClass('hidden');

    // setando valor default
    $('#data-inicial-1').val('');
    $('#data-inicial-2').val('');
    $('#data-inicial-3').val('');

    $('#data-final-1').val('');
    $('#data-final-2').val('');
    $('#data-final-3').val('');

    $('#total-dias-1').val('0');
    $('#total-dias-2').val('0');
    $('#total-dias-3').val('0');

    // removendo classe btn-success e removendo classe fa-check-square-o do botão selecionado
    $('tbody .btn-sm').removeClass('btn-success').addClass('btn-default');
    $('tbody .btn-sm').find('i').removeClass('fa-check-square-o').addClass('fa-square-o');

    // vericando se o elemento selecionado possui a classe btn-default
    if ($(this).hasClass('btn-default')) {
      // adicionando a classe btn-success no button e a classe fa-check-square-o no i
      $(this).removeClass('btn-default').addClass('btn-success');
      $(this).find('i').removeClass('fa-square-o').addClass('fa-check-square-o');
    }

    // recuperando o id do exercício de férias
    var id = $(this).val();

    $.ajax({
      type: 'get',
      url: '../../../app/requests/get/vacation/recebe_pedidos.php',
      dataType: 'json',
      data: {
        id: id
      },
      success: function(dados) {
        var table = '';
        var tbody = '';

        table += '<table class="table table-condensed table-striped" id="pedidos">' +
          '<thead>'                                                  +
            '<tr>'                                                   +
              '<th class="text-center">Registro</th>'                +
              '<th class="text-center">Situação</th>'                +
              '<th class="text-center">Data Inicial</th>'            +
              '<th class="text-center">Data Final</th>'              +
              '<th class="text-center">Dias</th>'                    +
            '</tr>'                                                  +
          '</thead>'                                                 +
          '<tbody>';
  
        for (var i = 0; i < dados.length; i++) {
          tbody += '<tr>';
          tbody += '<td class="text-center">' + dados[i].registro     + '</td>';
          tbody += '<td class="text-center">' + dados[i].situacao     + '</td>';
          tbody += '<td class="text-center">' + dados[i].data_inicial + '</td>';
          tbody += '<td class="text-center">' + dados[i].data_final   + '</td>';
          tbody += '<td class="text-center">' + dados[i].dias         + '</td>';
          tbody += '</tr>';
        }

        table += tbody;
        table += 
          '</tbody>' +
        '</table>' +
        '<br>';

        // verificando se o exercício selecionado já foi aprovado
        if (dados[0].situacao === 'Aprovado') {
          $('#alerta').removeClass('hidden');
          $('#btn-aprovacao').addClass('hidden');
        } else {
          $('#btn-aprovacao').removeClass('hidden');
          $('#alerta').addClass('hidden');
        }

        $('#tabela-pedidos').html(table);

        // paginando a tabela
        $('#pedidos').DataTable({
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
          "bFilter": false //removendo a pesquisa
        });
      },
      error: function(resposta) {
        console.log(resposta);
      }
    });
  });
});