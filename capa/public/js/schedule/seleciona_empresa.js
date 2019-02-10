$(function() {
  $(document).on('click', '#lista-empresas .btn-xs', function(e) {
    e.preventDefault;

    $('#lista-empresas .btn-xs.btn-success').removeClass('btn-success').addClass('btn-default');
    $(this).removeClass('btn-default').addClass('btn-success');

    var id = $(this).closest('tr').find('td[data-id]').data('id');

    $('#id').val(id);
    
    var url = window.location.href;
    var script = url.split('/');

    // deixando id's vazios ao selecionar uma nova empresa
    $('#id-contato').val('');
    $('#nome-contato').val('');
    $('#fixo-contato').val('');
    $('#movel-contato').val('');
    $('#email-contato').val('');

    if (script[8] == 'atendimento_remoto.php') {
      $.ajax({
        type: 'get',
        url: '../../../app/requests/post/schedule/contact/processa_contato.php?id-cnpj=' + id,
        dataType: 'html',
        success: function(tr) {
          $('#contatos').html(tr);
        },
        error: function(retorno) {
          console.log(retorno);
        }
      });
    } else if (script[8] == 'atendimento_externo.php' || script[8] == 'atendimento_gestao_clientes.php') {
      $.ajax({
        type: 'get',
        url: '../../../app/requests/post/schedule/contact/processa_contato.php?id-cnpj=' + id,
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
        url: '../../../app/requests/post/schedule/address/processa_endereco.php?id-cnpj=' + id,
        dataType: 'json',
        success: function(retorno) {                          
          if (typeof retorno === 'object' && retorno) {            
            $('#novo-endereco').removeClass('btn-info').addClass('btn-warning').attr('id', 'editar-endereco');
            $('#editar-endereco').html('<i class="fa fa-map-marker" aria-hidden="true"></i> Editar Endereço');

            switch (retorno.tipo) {
              case '1':
                retorno.tipo = 'Apartamento';
                  break;
              
              case '2':
                retorno.tipo = 'Casa';
                  break;
  
              case '3':
                retorno.tipo = 'Comercial'
                  break;
  
              case '4':
                retorno.tipo = 'Outros';
                  break;
            }
    
            $('#logradouro').val(retorno.logradouro);
            $('#distrito').val(retorno.distrito);
            $('#localidade').val(retorno.localidade);
            $('#uf').val(retorno.uf);          
            $('#tipo').val(retorno.tipo);
            $('#cep').val(retorno.cep);
            $('#numero').val(retorno.numero);
            $('#complemento').val(retorno.complemento);
            $('#referencia').val(retorno.referencia);
          } else {
            $('#editar-endereco').removeClass('btn-warning').addClass('btn-info').attr('id', 'novo-endereco');            
            $('#novo-endereco').html('<i class="fa fa-map-marker" aria-hidden="true"></i> Novo Endereço');

            $('#logradouro').val('');
            $('#distrito').val('');
            $('#localidade').val('');
            $('#uf').val('');          
            $('#tipo').val('');
            $('#cep').val('');
            $('#numero').val('');
            $('#complemento').val('');
            $('#referencia').val('');
          }
        },
        error: function(retorno) {
          console.log(retorno);
        }
      });
    }
  });
});
