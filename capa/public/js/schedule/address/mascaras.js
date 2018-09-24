$('document').ready(function() {
  $('#cep').mask('00000-000');

  var url = window.location.href;
  var arr = url.split('=');

  document.getElementById('id-cnpj').value = arr[1];
})
