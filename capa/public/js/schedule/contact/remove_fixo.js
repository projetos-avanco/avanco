$(function() {
  $('#remover-fixo').on('click', function(e) {
    e.preventDefault;

    var seletor = '#';
    var arr = [];
    var i = 1;

    $('#lista-fixo .row').each(function() {
      var id = $(this).attr('id');

      arr.push(id);

      i++;
    });

    // recuperando o último id do último campo de telefone
    seletor += $(arr).get(-1);

    console.log(seletor);

    $(seletor).remove();
  });
});
