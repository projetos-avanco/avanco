$(function() {
  $(document).on('click', '#nova-empresa', function(e) {
    e.preventDefault;

    var url = '/avanco/capa/public/views/schedule/empresa.php';

    window.open(url, '_blank');
  });

  $(document).on('click', '#novo-contato', function(e) {
    e.preventDefault;

    var idCnpj = $('#id').val();

    if (idCnpj != '') {
      var url = '/avanco/capa/public/views/schedule/contato.php?id=' + idCnpj;

      window.open(url, '_blank');
    } else {
      alert('É necessário selecionar uma Empresa antes de cadastrar um Novo Contato!');
    }
  });

  $(document).on('click', '#novo-endereco', function(e) {
    e.preventDefault;

    var idCnpj = $('#id').val();

    if (idCnpj != '') {
      var url = '/avanco/capa/public/views/schedule/endereco.php?id=' + idCnpj;

      window.open(url, '_blank');
    } else {
      alert('É necessário selecionar uma Empresa antes de cadastrar um Novo Endereço!');
    }
  });
});
