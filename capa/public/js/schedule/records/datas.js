$(document).on('keyup', '#data-inicial', function(e) {
  e.preventDefault;

  var dataInicial = $('#data-inicial').val();

  $('#data-final').val(dataInicial);
});