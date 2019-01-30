$(function() {
  // alterando tipo de atendimento
  $(document).on('change', '#tipo-atendimento', function(e) {
    e.preventDefault;

    var tipo = $('#tipo-atendimento').val();

    // verificando se o tipo de atendimento é visita de relacionamento
    if (tipo == '1') {
      $('#bloco-endereco').removeClass('hidden');
      
      $('#logradouro').addClass('required');
      $('#distrito').addClass('required');
      $('#localidade').addClass('required');
      $('#uf').addClass('required');
      $('#tipo').addClass('required');
      $('#cep').addClass('required');
      $('#numero').addClass('required');

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

      $('#logradouro').removeClass('required');
      $('#distrito').removeClass('required');
      $('#localidade').removeClass('required');
      $('#uf').removeClass('required');
      $('#tipo').removeClass('required');
      $('#cep').removeClass('required');
      $('#numero').removeClass('required');

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