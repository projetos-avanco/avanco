$(function() {
  // agendando pedido de férias
  $(document).on('click', '#agendar', function(e) {
    e.preventDefault;

    $('#tbody .btn-sm').removeClass('btn-success');
    $('#tbody .btn-sm').addClass('btn-default');
    $(this).removeClass('btn-default');
    $(this).addClass('btn-success');

    // liberando seleção de períodos de férias
    $('#periodos').prop('disabled', false);
  });  
});