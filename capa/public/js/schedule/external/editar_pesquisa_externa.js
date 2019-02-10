$(function() {
  // editando pesquisa externa
  $(document).on('click', '#editar-pesquisa', function(e) {
    e.preventDefault;

    var id = $(this).val();
    var url = window.location.href;
    var tmp = url.split('/');

    url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/pesquisa_externa.php?id=' + id;          

    window.open(url, '_self');
  });
});