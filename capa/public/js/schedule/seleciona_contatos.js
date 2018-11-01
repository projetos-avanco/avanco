$(function() {
  $(document).on('click', '#contatos .btn-xs', function(e) {
    e.preventDefault;

    $('#contatos .btn-xs.btn-success').removeClass('btn-success').addClass('btn-default');
    $(this).removeClass('btn-default').addClass('btn-success');

    var contato = {
      'id'    : 0,
      'nome'  : '',
      'fixo'  : '',
      'movel' : '',
      'email' : ''
    };

    contato.id    = $(this).closest('tr').find('td[data-id]').data('id');
    contato.nome  = $(this).closest('tr').find('td[data-nome]').data('nome');
    contato.fixo  = $(this).closest('tr').find('td[data-fixo]').text();
    contato.movel = $(this).closest('tr').find('td[data-movel]').text();
    contato.email = $(this).closest('tr').find('td[data-email]').text();

    $('#id-contato').val(contato.id);
    $('#nome-contato').val(contato.nome);
    $('#fixo-contato').val(contato.fixo);
    $('#movel-contato').val(contato.movel);
    $('#email-contato').val(contato.email);

    /* js do bloco complementar */
    $('#contatos-copia').empty();

    var li = 
      '<li class="list-group-item list-group-item-info">' +
        '<div class="text-center">' +
          '<strong>enviar e-mail em cópia para</strong>' +
        '</div>' +
      '</li>';

    var i = 0;

    $('#contatos tbody tr').each(function() {
      var nome = $(this).find('td[data-nome]').data('nome');
      var id = $(this).find('td[data-id]').data('id');

      if (id != contato.id) {
        li +=
          '<li class="list-group-item">' +
            '<div class="checkbox">' +
              '<label>' +
                '<input type="checkbox" name="copia[]" value="'+id+'">' + nome +
              '</label>' +
            '</div>' +
          '</li>';
        
        i++;
      }      
    });

    if (i >= 1) {$('#contatos-copia').html(li);}    
  });
});