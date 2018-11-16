$(function() {
  $(document).on('click', '#lista-contatos .btn-danger', function(e) {
    e.preventDefault;

    var nome = $(this).closest('tr').find('td[data-nome]').data('nome');
    var id   = $(this).closest('tr').find('td[data-id]').data('id');

    var resultado = confirm('Confirma a exclusão do contato: ' + nome + '?');

    if (resultado) {
      $.ajax({
        type: 'get',
        url: '../../../app/requests/get/schedule/contact/recebe_contato.php?id=' + id,
        dataType: 'json',
        success: function(retorno) {
          alert(retorno);
        },
        error: function(retorno) {
          console.log(retorno);
        }
      });
    }
  });
});
