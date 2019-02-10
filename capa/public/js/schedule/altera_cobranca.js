$(function() {
  $(document).on('change', '#faturado', function(e) {
    e.preventDefault;

    var option = $('#faturado').val();

    if (option == '2') {
      $('#valor').val('0.00');
      $('#valor').attr('disabled', 'true');
      $('#cobranca').attr('disabled', 'true');
      $('#cobranca option').each(function() {
        var value = $(this).val();

        //selecionando a opção tipo de cobrança
        if (value == 0) {
          $(this).prop('selected', true);
        }
      });
    } else {
      $('#valor').val('0.00');
      $('#valor').removeAttr('disabled');      
      $('#cobranca').removeAttr('disabled');
      $('#cobranca option').each(function() {
        var value = $(this).val();

        //selecionando a opção tipo de cobrança
        if (value == 0) {
          $(this).prop('selected', true);
        }
      });
    }
  });
});
