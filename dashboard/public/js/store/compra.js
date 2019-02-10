$('document').ready(function() {

  $('button').click(function() {

    var data = new Date();

    var dia = data.getDate();
        
    // verificando se o dia atual está entre dia 10 e 15 (entre essas datas que a loja estará disponível)
    if (dia >= 10 && dia <= 20) {

      var idProduto   = '';
      var descricao   = '';
      var confirmacao = false;
      var quantidade  = null;

      idProduto = $(this).val(); // recuperando id do produto clicado

      switch (idProduto) {

        case '24':
          descricao = 'Vale Crédito R$1,00 Udemy';
          quantidade = $('#quant-udemy').val();
            break;

        case '22':
          descricao = 'Vale Presente R$50,00 Mercado Livre';
            break;

        case '21':
          descricao = 'Vale Crédito R$10,00 Udemy';
            break;

        case '20':
          descricao = 'Garrafa de Jack Daniels Honey';
            break;

        case '19':
          descricao = 'Smarthphone Asus Zenfone 3';
            break;

        case '18':
          descricao = 'Smarthphone Moto G5 Plus';
            break;

        case '17':
          descricao = 'Massagem Relaxante';
            break;

        case '16':
          descricao = 'Vale Presente R$50,00 Lojas Americanas';
            break;

        case '15':
          descricao = 'Vale Presente R$50,00 Livraria Cultura';
            break;

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

      // aguardando confirmação da compra do produto clicado
      if (quantidade == null) {
        confirmacao = confirm('Confirma a compra do produto ' + descricao + '?');
      } else {
        confirmacao = confirm('Confirma a compra do produto ' + descricao + '? \n Quantidade: ' + quantidade);
      }

      if (confirmacao) {

        var idColaborador = '';
        var email         = '';
        var url           = '';

        idColaborador = $('#colaborador').val(); // recuperando id do colaborador que está logado na loja
        email         = $('#email').val();      // recuperando email do colaborador que está logado na loja

        url = '../../../app/requests/ajax/compra_produtos.php'; // path do script que realiza a compra do produto

        $.ajax({
          type: 'get',
          url: url + '?idcolaborador=' + idColaborador + '&idproduto=' + idProduto + '&email=' + email + '&quantidade=' + quantidade,
          dataType: 'json',
          beforeSend: function() {

            $('.comprar').addClass('hidden');

          },
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

      alert('A Loja Avanção estará disponível para compras entre os dias 10 e 20 do mês!');

    }

  });

});
