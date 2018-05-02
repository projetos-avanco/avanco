$('document').ready(function() {

  var tipo = '';

  // recuperando o valor do option gravado na tabela
  tipo = $('select[name="issues[tipo]"] :selected').val();

  // verificando se o valor do option é in-loco
  if (tipo == 'in-loco') {

    // exibindo o bloco de despesas
    $('#bloco-despesas').removeClass('hidden');

  }

  // recuperando o valor do option alterado pelo supervisor
  $('select[name="issues[tipo]"]').change(function() {

    var tipoSelecionado = $('select[name="issues[tipo]"]').val();
    
    if (tipoSelecionado == 'remoto') {

      // ocultando bloco despesas
      $('#bloco-despesas').addClass('hidden');

    } else {

      // exibindo bloco despesas
      $('#bloco-despesas').removeClass('hidden');

    }
    
  });  
  
});