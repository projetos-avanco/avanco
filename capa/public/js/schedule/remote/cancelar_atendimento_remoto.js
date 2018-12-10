$(function() {
  // cancelando atendimento externo      
  $(document).on('click', '#cancelar-atendimento', function(e) {
    e.preventDefault;

    var id = $(this).val();
    var registro = $(this).closest('tr').attr('data-registro');
    var url = window.location.href;
    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/app/requests/get/schedule/remote/recebe_atendimento.php?id=' + id;

    var resposta = confirm('Confirma a o cancelamento do atendimento de Registro - ' + registro + '?');

    // verificando a resposta do usuário
    if (resposta) {
      window.open(url, '_self');
    } else {
      window.location.reload(true);
    }
  });
});