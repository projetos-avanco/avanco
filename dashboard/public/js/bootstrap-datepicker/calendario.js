$(document).ready(function() {
  $('.input-daterange input').each(function() {
    $(this).datepicker({
      language:  'pt-BR',
      format: 'dd/mm/yyyy',
      weekStart: 1,
      todayBtn:  1,
      autoclose: 1,
      todayHighlight: 1,
      minView: 2,
      forceParse: 0
    });
  });
});
