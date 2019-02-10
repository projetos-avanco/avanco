$(function() {
  $(document).ready(function(e) {
    e.preventDefault;

    var id = $('#id').val();

    $.ajax({
      type: 'post',
      url: '../../../app/requests/post/vacation/recebe_exercicio.php',
      dataType: 'json',
      data: {
        id: id
      },
      success: function(dados) {
        // setando regime no html da página de pedidos
        $('#regime').val(dados.regime);

        // setando contrato no html da página de pedidos
        $('#contrato').val(dados.contrato);

        // verificando se o regime do colaborador é estágio e se o contrato é semestral
        if (dados.regime == '2' && dados.contrato == '1') {
          $('#periodo-1').addClass('hidden');
          $('#periodo-2').addClass('hidden');
          $('#periodo-4').addClass('hidden');
          $('#periodo-5').addClass('hidden');

          // exibindo período de 15 dias
          $('#periodo-6').removeClass('hidden');
        } else {
          $('#periodo-1').removeClass('hidden');
          $('#periodo-2').removeClass('hidden');
          $('#periodo-4').removeClass('hidden');
          $('#periodo-5').removeClass('hidden');

          // ocultando período de 15 dias
          $('#periodo-6').addClass('hidden');
        }
      },
      error: function(erro) {
        console.log(erro);
      }
    });
  });
});