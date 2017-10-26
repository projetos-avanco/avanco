$(function() {

  $(document).on('click', '.btn-xs', function(e) {

    e.preventDefault;

    $('.btn-xs.btn-info').removeClass('btn-info').addClass('btn-default');
    $(this).removeClass('btn-default').addClass('btn-info');

    var cnpj           = $(this).closest('tr').find('td[data-cnpj]').data('cnpj');
    var conta_contrato = $(this).closest('tr').find('td[data-conta]').data('conta');
    var razao_social   = $(this).closest('tr').find('td[data-razao]').data('razao');

    $('#cnpj').val(cnpj);
    $('#conta-contrato').val(conta_contrato);
    $('#razao-social').val(razao_social);

  });

});
