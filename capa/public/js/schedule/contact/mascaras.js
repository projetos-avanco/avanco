$('document').ready(function() {
  $('#lista-fixo .row input').each(function() {
    var fixo = '#' + $(this).attr('id');
    
    $(fixo).mask('(00) 0000-0000');
  });

  $('#lista-movel .row input').each(function() {
    var movel = '#' + $(this).attr('id');

    $(movel).mask('(00) 00000-0000');
  });  
});
