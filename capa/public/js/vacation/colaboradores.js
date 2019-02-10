$(function() {
  // exibindo checkboxes dos colaboradores
  $(document).ready(function(e) {
    e.preventDefault;

    $.ajax({
      type: 'get',
      url: '../../../app/requests/get/schedule/processa_colaboradores.php',
      dataType: 'json',
      success: function(dados) {        
        var colaboradores = '<option value="0" selected>Selecione um Colaborador</option>';

        for (var i = 0; i < Object.keys(dados).length; i++) {
          colaboradores +=
            '<option value="' + dados[i].id + '">' + dados[i].nome + '</option>';          
        }

        $('#colaborador').append(colaboradores);
      },
      error: function(erro) {
        console.log(erro);
      }    
    });
  });
});