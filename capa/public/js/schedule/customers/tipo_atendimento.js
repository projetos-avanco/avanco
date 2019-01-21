$(function() {
  // alterando tipo de atendimento
  $(document).on('change', '#tipo-atendimento', function(e) {
    e.preventDefault;

    var tipo = $('#tipo-atendimento').val();

    // verificando se o tipo de atendimento é visita de relacionamento
    if (tipo == '1') {
      $('#bloco-endereco').removeClass('hidden');

      $('#faturado').val('0');
      $('#valor').val('0.00');
      $('#valor').prop('disabled', false);      
      $('#cobranca').prop('disabled', false);
      $('#cobranca option').each(function() {
        var value = $(this).val();

        //selecionando a opção tipo de cobrança
        if (value == 0) {
          $(this).prop('selected', true);
        }
      });
    } else {
      $('#bloco-endereco').addClass('hidden');

      $('#faturado').val('2');
      $('#valor').val('0.00');
      $('#valor').prop('disabled', 'true');
      $('#cobranca').prop('disabled', 'true');
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