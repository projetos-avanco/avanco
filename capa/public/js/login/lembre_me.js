function guardaEmail() {
  var checkbox = document.getElementById('lembre');

  if(checkbox.checked == true) {
    var email = document.getElementById('email');

    var data = new Date();
    data.setTime(data.getTime() + (365 * 24 * 60 * 60 * 1000));

    var duracao = 'expires=' + data.toUTCString();

    document.cookie = 'lembreMe' + '=' + email.value + ';' + duracao + ';path=/';
    //document.cookie = 'email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
  }
}

if (document.cookie != undefined && document.cookie.length > 0) {
  var nome = 'lembreMe' + '=';
  var cookieDecodificado = decodeURIComponent(document.cookie);
  var cookie = cookieDecodificado.split(';');

  for(var i = 0; i < cookie.length; i++) {
    var c = cookie[i];

    while(c.charAt(0) == ' ') {
      c = c.substring(1);
    }

    if(c.indexOf(nome) == 0) {
      var email = c.substring(nome.length, c.length);

      document.getElementById('email').value = email;
    }
  }
}