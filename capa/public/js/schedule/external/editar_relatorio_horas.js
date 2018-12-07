$(function() {
  // editando relatório de horas
  $(document).on('click', '#editar-relatorio', function(e) {
    e.preventDefault;

    var issue = $(this).val();
    var url = window.location.href;
    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/hours/edita_lancamentos.php?issue=' + issue;          

    window.open(url, '_blank');
  });
});