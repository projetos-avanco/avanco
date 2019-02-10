function limpaEndereco() {
  document.getElementById('logradouro').value = '';
  document.getElementById('distrito').value = '';
  document.getElementById('localidade').value = '';
  document.getElementById('complemento').value = '';
}

function recebeJSON(json) {
  if (! ('erro' in json)) {
    document.getElementById('logradouro').value = json.logradouro;
    document.getElementById('distrito').value = json.bairro;
    document.getElementById('localidade').value = json.localidade;
    document.getElementById('complemento').value = json.complemento;

    switch (json.uf) {
      // região norte
      case 'AC':
        document.getElementById('uf').value = '1';
          break;

      case 'AP':
        document.getElementById('uf').value = '2';
          break;

      case 'AM':
        document.getElementById('uf').value = '3';
          break;

      case 'PA':
        document.getElementById('uf').value = '4';
          break;

      case 'RO':
        document.getElementById('uf').value = '5';
          break;

      case 'RR':
        document.getElementById('uf').value = '6';
          break;

      case 'TO':
        document.getElementById('uf').value = '7';
          break;
      // região norte

      // região nordeste
      case 'AL':
        document.getElementById('uf').value = '8';
          break;

      case 'BA':
        document.getElementById('uf').value = '9';
          break;

      case 'CE':
        document.getElementById('uf').value = '10';
          break;

      case 'MA':
        document.getElementById('uf').value = '11';
          break;

      case 'PB':
        document.getElementById('uf').value = '12';
          break;

      case 'PE':
        document.getElementById('uf').value = '13';
          break;

      case 'PI':
        document.getElementById('uf').value = '14';
          break;

      case 'RN':
        document.getElementById('uf').value = '15';
          break;

      case 'SE':
        document.getElementById('uf').value = '16';
          break;
      // região nordeste

      // região centro-oeste
      case 'DF':
        document.getElementById('uf').value = '17';
          break;

      case 'GO':
        document.getElementById('uf').value = '18';
          break;

      case 'MT':
        document.getElementById('uf').value = '19';
          break;

      case 'MS':
        document.getElementById('uf').value = '20';
          break;
      // região centro-oeste

      // região sudeste
      case 'ES':
        document.getElementById('uf').value = '21';
          break;

      case 'MG':
        document.getElementById('uf').value = '22';
          break;

      case 'RJ':
        document.getElementById('uf').value = '23';
          break;

      case 'SP':
        document.getElementById('uf').value = '24';
          break;
      // região sudeste

      // região sul
      case 'PR':
        document.getElementById('uf').value = '25';
          break;

      case 'RS':
        document.getElementById('uf').value = '26';
          break;

      case 'SC':
        document.getElementById('uf').value = '27';
          break;
      // região sul
    }
  } else {
    limpaEndereco();

    alert('CEP não encontrado na base de dados dos Correios!');
  }
}

function pesquisaCEP(valor) {
  var cep = valor.replace(/\D/g, '');

  if (cep != '') {
    var validaCep = /^[0-9]{8}$/;

    if (validaCep.test(cep)) {
      document.getElementById('logradouro').value = '...';
      document.getElementById('distrito').value = '...';
      document.getElementById('localidade').value = '...';
      document.getElementById('complemento').value = '...';

      var script = document.createElement('script');

      script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=recebeJSON';

      document.body.appendChild(script);
    } else {
      alert('Formato de CEP inválido!');
    }
  } else {
    limpaEndereco();
  }
}
