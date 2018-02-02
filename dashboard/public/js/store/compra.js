$('document').ready(function() {

  $('button').click(function() {

    var data = new Date();

    var dia = data.getDate();
    
    
    if (dia >= 10 && dia <= 15) { // verificando se o dia atual está entre dia 10 e 15 (entre essas datas que a loja estará disponível)

      var idProduto   = '';    
      var descricao   = '';    
      var confirmacao = false;
      
      idProduto = $(this).val(); // recuperando id do produto clicado

      switch (idProduto) {

        case '14':
          descricao = 'Açai 300ml';
            break;
        
        case '13':
          descricao = 'Açai 500ml';
            break;

        case '12':
          descricao = 'Manicure';
            break;

        case '11':
          descricao = 'Ventilador de Mesa';
            break;

        case '10':
          descricao = 'PenDrive 64GB';
            break;

        case '9':
          descricao = 'Par de Ingressos para o Cinema';
            break;

        case '8':
          descricao = 'Rodízio de Pizza com Acompanhante';
            break;

        case '7':
          descricao = 'Garrafa de Cachaça Vale Verde';
            break;

        case '6':
          descricao = '1 Dia de Folga';
            break;

        case '5':
          descricao = 'Garrafa de Jack Daniels';
            break;

        case '4':
          descricao = 'Garrafa de Absolut';
            break;

        case '3':
          descricao = 'Rodízio Baby Beef com Acompanhante';
            break;

        case '2':
          descricao = 'Home Theater';
            break;

        case '1':
          descricao = '1 Semana de Folga';
            break;

      }

      confirmacao = confirm('Confirma a compra do produto ' + descricao + '?'); // aguardando confirmação da compra do produto clicado
      
      if (confirmacao) {
        
        var idColaborador = ''; 
        var email         = '';     
        var url           = '';

        idColaborador = $('#colaborador').val(); // recuperando id do colaborador que está logado na loja
        email         = $('#email').val();      // recuperando email do colaborador que está logado na loja
              
        url = '../../../app/requests/ajax/compra_produtos.php'; // path do script que realiza a compra do produto

        $.ajax({
          type: 'get',
          url: url + '?idcolaborador=' + idColaborador + '&idproduto=' + idProduto + '&email=' + email,
          dataType: 'json',
          success: function(resposta) {

            alert(resposta);
            
            window.location.reload(true); // atualizando página

          },
          error: function(resposta) {
            
            alert('Erro: ' + resposta);

            window.location.reload(true); // atualizando página
            
          }

        });
        
      }

    } else {

      alert('A Loja Avanção estará disponível para compras entre os dias 10 e 15 do mês!');

    }

  });

});