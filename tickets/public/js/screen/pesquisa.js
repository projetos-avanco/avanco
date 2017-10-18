$('document').ready(function() {

  const BASE_URL = '../../../';

  $('#pesquisa').keyup(function() {

    var pesquisa = $('#pesquisa').val();

    if (pesquisa != '') {

      $.ajax({
        type: 'post',
        url: BASE_URL + 'app/requests/post/processa_pesquisa.php?pesquisa=' + pesquisa,
        dataType: 'html',
        success: function(linhas)
        {
          if (linhas === 'erro') {

            alert('Ops! Houve um erro durante a execução da consulta de pesquisa.');

          } else {

            $('#linhas').html(linhas);

          }

        },
        error: function(linhas)
        {
          alert(linhas);
        }
      });

    }

  });

});
