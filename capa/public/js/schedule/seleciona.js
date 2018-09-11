$(function() {

  $(document).on('click', '#tabela .btn-xs', function(e) {

    e.preventDefault;

    $('.btn-xs.btn-success').removeClass('btn-success').addClass('btn-default');
    $(this).removeClass('btn-default').addClass('btn-success');

    var id             = $(this).closest('tr').find('td[data-id]').data('id');
    var cnpj           = $(this).closest('tr').find('td[data-cnpj]').data('cnpj');
    var conta_contrato = $(this).closest('tr').find('td[data-conta]').data('conta');
    var razao_social   = $(this).closest('tr').find('td[data-razao]').data('razao');

    $('#id').val(id);
    $('#cnpj').val(cnpj);
    $('#conta-contrato').val(conta_contrato);
    $('#razao-social').val(razao_social);

    var url = window.location.href;
    var script = url.split('/');

    if (script[8] == 'atendimentos_remotos.php') {
      $.ajax({
        type: 'get',
        url: '../../../app/requests/post/processa_contato.php?id-cnpj=' + id,
        dataType: 'html',
        success: function(tr) {
          $('#contatos').html(tr);
        },
        error: function(retorno) {
          console.log(retorno);
        }
      });
    } else if (script[8] == 'atendimentos_externos.php') {
      $.ajax({
        type: 'get',
        url: '../../../app/requests/post/processa_endereco.php?id-cnpj=' + id,
        dataType: 'json',
        success: function(retorno) {
          console.log(retorno);
        },
        error: function(retorno) {
          console.log(retorno);
        }
      });
    }
  });
});
