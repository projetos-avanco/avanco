$(function() {
  // recuperando id do contato
  var url = window.location.href;
  var arr = url.split('=');

  // recuperando id do cnpj da empresa e id do contato  
  var idContato = arr[1];
  
  // inserindo id do contato no campo input hidden  
  $('#id-contato').val(idContato);

  $.ajax({
    type: 'get',
    url: '../../../../app/requests/get/schedule/contact/busca_contato.php?id=' + idContato,
    dataType: 'json',
    success: function(contato) {      
      $('#nome').val(contato.nome);
      
      // verificando se o contato possui números fixos
      if (typeof contato.fixos === 'object') {
        $('#fixo-0').val(contato.fixos[0]); // adicionando o primeiro número fixo no campo obrigatório

        for (var i = 1; i < contato.fixos.length; i++) {
          var fixo  = '#fixo-';

          // inserindo números fixos na página
          $('#lista-fixo').append('<div class="row" id="linha-fixo-'+i+'"><div class="col-sm-12"><div class="form-group"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></button></span><label class="sr-only" for="fixo">Telefone Fixo</label><input class="form-control" id="fixo-'+i+'" type="tel" name="contato[fixo]['+i+']" value="'+contato.fixos[i]+'" maxlength="14" placeholder="(00) 0000-0000"></div></div></div></div>');
  
          fixo += i;
  
          $(fixo).mask('(00) 0000-0000');
        }
      }

      // verificando se o contato possui números móveis
      if (typeof contato.moveis === 'object') {
        $('#movel-0').val(contato.moveis[0]); // adicionando o primeiro número móvel no campo obrigatório

        for (var i = 1; i < contato.moveis.length; i++) {
          var movel  = '#movel-';
          
          // inserindo números móveis na página
          $('#lista-movel').append('<div class="row" id="linha-movel-'+i+'"><div class="col-sm-12"><div class="form-group"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span></button></span><label class="sr-only" for="movel">Telefone Móvel</label><input class="form-control" id="movel-'+i+'" type="tel" name="contato[movel]['+i+']" value="'+contato.moveis[i]+'" maxlength="15" placeholder="(00) 00000-0000"></div></div></div></div>');
  
          movel += i;
  
          $(movel).mask('(00) 00000-0000');
        }
      }

      // verificando se o contato possui endereços de e-mails
      if (typeof contato.emails === 'object') {
        $('#email-0').val(contato.emails[0]); // adicionando o primeiro endereço de e-mail no campo obrigatório

        for (var i = 1; i < contato.emails.length; i++) {
          // inserindo endereços de e-mail na página
          $('#lista-email').append('<div class="row" id="linha-email-'+i+'"><div class="col-sm-12"><div class="form-group"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button></span><label class="sr-only" for="email">E-mail</label><input class="form-control" id="email-'+i+'" type="email" name="contato[email]['+i+']" value="'+contato.emails[i]+'" maxlength="100" placeholder="exemplo@exemplo.com.br"></div></div></div></div>');
        }
      }
    },
    error: function(contato) {
      console.log(contato);
    }
  });
});
