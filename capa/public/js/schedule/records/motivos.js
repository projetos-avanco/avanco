$(document).ready(function() {
  $('#bloco-atestado').addClass('hidden');
});

$(document).on('change', '#motivo', function(e) {
  e.preventDefault;

  var motivo = $('#motivo').val();
  var atestado = $('#atestado').val();

  if (motivo == '1') {
    $('#bloco-atestado').addClass('hidden');

    if (atestado != '') {
      $('#atestado').val('');
    }              
  } else if (motivo == '2' || motivo == '3' || motivo == '4') {
    $('#bloco-atestado').removeClass('hidden');
  }      
});