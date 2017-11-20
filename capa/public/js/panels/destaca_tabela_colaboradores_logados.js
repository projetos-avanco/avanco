$('document').ready(function() {

  $('table tbody tr').each(function() {

    var logado = $(this).find('td:nth-child(6)').html();
    var oculto = $(this).find('td:nth-child(7)').html();

    if (logado == 'Não' && oculto == 'Não') {

      $(this).find('td').addClass('warning');

    } else if (logado == 'Sim' && oculto == 'Sim') {

      $(this).find('td').addClass('danger');

    } else {

      $(this).find('td').addClass('success');

    }

  });

});
