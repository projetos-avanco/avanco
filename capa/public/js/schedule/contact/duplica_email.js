$(function() {
  var i = 1;

  $('#duplicar-email').on('click', function(e) {
    e.preventDefault;

    $('#lista-email').append('<div class="row" id="linha-email-'+i+'"><div class="col-sm-12"><div class="form-group"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button></span><label class="sr-only" for="email">E-mail</label><input class="form-control" id="email-'+i+'" type="email" name="contato[email]['+i+']" maxlength="100" placeholder="exemplo@exemplo.com.br"></div></div></div></div>');

    i++;
  });
});
