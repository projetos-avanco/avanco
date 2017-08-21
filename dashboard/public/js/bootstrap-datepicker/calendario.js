$(document).ready(function() {

  $('.input-daterange input').each(function() {

    $(this).datepicker({

      language: 'pt-BR',
      format: 'dd/mm/yyyy',
      autoclose: true

    });
    
  });

});
