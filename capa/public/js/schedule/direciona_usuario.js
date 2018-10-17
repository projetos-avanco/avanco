$(function() {
  $(document).on('click', '#nova-empresa', function(e) {
    e.preventDefault;

    var url = '/avanco/capa/public/views/schedule/company/empresa.php';

    window.open(url, '_blank');
  });

  $(document).on('click', '#novo-contato', function(e) {
    e.preventDefault;

    var idCnpj = $('#id').val();

    if (idCnpj != '') {
      var url = '/avanco/capa/public/views/schedule/contact/contato.php?id=' + idCnpj;

      window.open(url, '_blank');
    } else {
      alert('É necessário selecionar uma Empresa antes de cadastrar um Novo Contato!');
    }
  });

  $(document).on('click', '#novo-endereco', function(e) {
    e.preventDefault;

    var idCnpj = $('#id').val();

    if (idCnpj != '') {
      var url = '/avanco/capa/public/views/schedule/address/endereco.php?id=' + idCnpj;

      window.open(url, '_blank');
    } else {
      alert('É necessário selecionar uma Empresa antes de cadastrar um Novo Endereço!');
    }
  });

  $(document).on('click', '#lista-contatos .btn-warning', function(e) {
    e.preventDefault;

    var idContato = $(this).closest('tr').find('td[data-id]').data('id');

    var url = '/avanco/capa/public/views/schedule/contact/edita_contato.php?id=' + idContato;

    window.open(url, '_blank');
  })
});
