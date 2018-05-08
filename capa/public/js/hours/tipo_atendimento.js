$('document').ready(function() {

  // recuperando o valor do option alterado pelo supervisor
  $('select[name="issues[tipo]"]').change(function() {

    var tipo = $('select[name="issues[tipo]"]').val();
    
    if (tipo == 'remoto') {

      // ocultando bloco despesas
      $('#bloco-despesas').addClass('hidden');

    } else {

      // exibindo bloco despesas
      $('#bloco-despesas').removeClass('hidden');

    }
    
  });  
  
});