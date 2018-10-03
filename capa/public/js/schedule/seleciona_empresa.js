$(function() {

  $(document).on('click', '#lista-empresas .btn-xs', function(e) {

    e.preventDefault;

    $('#lista-empresas .btn-xs.btn-success').removeClass('btn-success').addClass('btn-default');
    $(this).removeClass('btn-default').addClass('btn-success');

    var id = $(this).closest('tr').find('td[data-id]').data('id');

    $('#id').val(id);

    var url = window.location.href;
    var script = url.split('/');

    if (script[8] == 'atendimento_remoto.php') {
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
    } else if (script[8] == 'atendimento_externo.php') {
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

      $.ajax({
        type: 'get',
        url: '../../../app/requests/post/processa_endereco.php?id-cnpj=' + id,
        dataType: 'json',
        success: function(retorno) {
          $('#logradouro').val(retorno.logradouro);
          $('#distrito').val(retorno.distrito);
          $('#localidade').val(retorno.localidade);
          $('#uf').val(retorno.uf);
          $('#tipo').val(retorno.tipo);
          $('#cep').val(retorno.cep);
          $('#numero').val(retorno.numero);
          $('#complemento').val(retorno.complemento);
          $('#referencia').val(retorno.referencia);
        },
        error: function(retorno) {
          console.log(retorno);
        }
      });
    }
  });
});