$(function() {
  // exibindo checkboxes dos colaboradores
  $(document).ready(function(e) {
    e.preventDefault;

    $.ajax({
      type: 'get',
      url: '../../../app/requests/get/schedule/processa_colaboradores.php',
      dataType: 'json',
      success: function(dados) {        
        var colaboradores = '';

        for (var i = 0; i < Object.keys(dados).length; i++) {
          colaboradores +=
            '<div class="checkbox">' +
              '<label>' +
                '<input type="checkbox" name="colaboradores[]" value="' + dados[i].id + '">' + dados[i].nome +
              '</label>' +
            '</div>';
        }

        $('#lista-colaboradores').append(colaboradores);

        // recuperando colaboradores marcados do local storage
        var string = localStorage.getItem('dadosForm');
        var obj = JSON.parse(string);

        // percorrendo todos os checkboxers da lista de colaboradores
        $('#lista-colaboradores input:checkbox').each(function() {
          // verificando se a lista de colaboradores não é nula
          if (obj.listaColaboladores.length !== null) {
            // verificando se existe algum índice no array com o valor do id do colaborador
            if (obj.listaColaboladores.indexOf($(this).val()) > -1) {
              $(this).prop('checked', true);
            }
          }    
        });
      },
      error: function(erro) {
        console.log(erro);
      }    
    });
  });
});