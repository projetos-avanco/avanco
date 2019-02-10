$('document').ready(function() {
  // recuperando id do cnpj da empresa
  var url = window.location.href;
  var arr = url.split('=');
  
  var id = arr[1];

  // inserindo id do cnpj da empresa no input hidden
  $('#id-cnpj').val(id);
  
  $.ajax({
    type: 'get',
    url: '../../../../app/requests/post/schedule/address/processa_endereco.php?id-cnpj=' + id,
    dataType: 'json',
    success: function(retorno) {
      switch (retorno.uf) {
        case 'Acre (AC)':
          retorno.uf = '1';
            break;
        case 'Amapá (AP)':
          retorno.uf = '2';
            break;

        case 'Amazonas (AM)':
          retorno.uf = '3';
              break;

        case 'Pará (PA)':
          retorno.uf = '4';
              break;

        case 'Rondônia (RO)':
          retorno.uf = '5';
              break;

        case 'Roraima (RR)':
          retorno.uf = '6';
              break;

        case 'Tocantins (TO)':
          retorno.uf = '7';
              break;

        case 'Alagoas (AL)':
          retorno.uf = '8';
              break;

        case 'Bahia (BA)':
          retorno.uf = '9';
              break;

        case 'Ceará (CE)':
          retorno.uf = '10';
              break;

        case 'Maranhão (MA)':
          retorno.uf = '11';
              break;

        case 'Paraíba (PB)':
          retorno.uf = '12';
              break;

        case 'Pernambuco (PE)':
          retorno.uf = '13';
              break;

        case 'Piauí (PI)':
          retorno.uf = '14';
              break;

        case 'Rio Grande do Norte (RN)':
          retorno.uf = '15';
              break;

        case 'Sergipe (SE)':
          retorno.uf = '16';
              break;

        case 'Brasília (DF)':
          retorno.uf = '17';
              break;

        case 'Goiás (GO)':
          retorno.uf = '18';
              break;

        case 'Mato Grosso (MT)':
          retorno.uf = '19';
              break;

        case 'Mato Grosso do Sul (MS)':
          retorno.uf = '20';
              break;

        case 'Espiríto Santo (ES)':
          retorno.uf = '21';
              break;

        case 'Minas Gerais (MG)':
          retorno.uf = '22';
              break;

        case 'Rio de Janeiro (RJ)':
          retorno.uf = '23';
              break;

        case 'São Paulo (SP)':
          retorno.uf = '24';
              break;

        case 'Paraná (PR)':
          retorno.uf = '25';
              break;

        case 'Rio Grande do Sul (RS)':
          retorno.uf = '26';
              break;

        case 'Santa Catarina (SC)':
          retorno.uf = '27';
              break;
      }

      // verificando qual foi o endereço retornado
      switch (retorno.tipo) {
        case 'Apartamento':
          retorno.tipo = '1';
            break;

        case 'Casa':
          retorno.tipo = '2';
            break;

        case 'Comercial':
          retorno.tipo = '3';
            break;

        case 'Outros':
          retorno.tipo = '4';
            break;
      }
      
      $('#id-endereco').val(retorno.id);
      $('#logradouro').val(retorno.logradouro);
      $('#distrito').val(retorno.distrito);
      $('#localidade').val(retorno.localidade);
      $('#uf').val(retorno.uf);          
      $('#tipo').val(retorno.tipo);
      $('#cep').val(retorno.cep);
      $('#numero').val(retorno.numero);
      $('#complemento').val(retorno.complemento);
      $('#referencia').val(retorno.referencia);
    },
    error: function(retorno) {
      console.log(retorno);
    }
  });
});
