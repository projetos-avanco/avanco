$('document').ready(function() {

  $('#deleta').click(function() {

    var ticket = 0;
    var ticket = $('table tbody tr').find('td:nth-child(2)').html();

    if (ticket != 0) {

      var resposta = confirm('Confirma a exclusão do Ticket: ' + ticket + '?');

      if (resposta) {

        return true;

      } else {

        return false;

      }

    } else {

      return false;

    }

  });

});
