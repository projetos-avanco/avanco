$('document').ready(function() {

  // aguardando alterações no select dos colaboradores
  $('#colaborador').change(function() {

    var id       = '';
    var conteudo = '';

    // recuperando id do colaborador e conteúdo do option
    id       = $('#colaborador').val();
    conteudo = $('#colaborador :selected').text();

    // alterando os valores do select do colaborador registrado
    $('#agendado').empty();
    $('#agendado').append('<option value="'+id+'" selected>'+conteudo+'</option>');

  });

});