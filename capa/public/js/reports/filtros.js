$('document').ready(function() {

  $('#bloco-colaborador').addClass('hidden');
  
  $('#tipo').change(function() {

    var tipo = $(this).val();

    if (tipo == '2') {

      $('#bloco-pesquisa').addClass('hidden');
      $('#bloco-colaborador').removeClass('hidden');      
      $('#bloco-filtro').addClass('hidden');

    } else if (tipo == '3') {

      $('#bloco-pesquisa').removeClass('hidden');
      $('#bloco-colaborador').removeClass('hidden');      
      $('#bloco-filtro').removeClass('hidden');      

    }else if (tipo == '1') {

      $('#bloco-pesquisa').removeClass('hidden');
      $('#bloco-colaborador').addClass('hidden');      
      $('#bloco-filtro').removeClass('hidden');      

    }

  });

});