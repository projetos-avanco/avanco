$('document').ready(function() {
  // recuperando id do cnpj da empresa
  var url = window.location.href;
  var arr = url.split('=');

  // inserindo id do cnpj da empresa no input hidden
  $('#id').val(arr[1]);  
});
