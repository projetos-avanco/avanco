$(function() {
  $(document).on('change', '#faturado', function(e) {
    e.preventDefault;

    var option = $('#faturado').val();

    if (option == '2') {
      $('#valor').attr('readonly', 'true');
      $('#cobranca').attr('disabled', 'true');
      $('#valor').val('0.00');
    } else {
      $('#valor').removeAttr('readonly');
      $('#valor').val('0.00');
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
