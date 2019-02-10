$('document').ready(function() {

  $('#lancamentos').on('click', '#botao-excluir', function() {

    var numero = $(this).attr('numero-botao');
    
    $('#lancamentos div[numero-bloco="'+numero+'"]').remove();

  });
  
});