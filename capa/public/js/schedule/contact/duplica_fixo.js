$(function() {
  var i = 1;

  $('#duplicar-fixo').on('click', function(e) {
    e.preventDefault;

    var fixo  = '#fixo-';

    $('#lista-fixo').append('<div class="row" id="linha-fixo-'+i+'"><div class="col-sm-12"><div class="form-group"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span></button></span><label class="sr-only" for="fixo">Telefone Fixo</label><input class="form-control" id="fixo-'+i+'" type="tel" name="contato[fixo]['+i+']" maxlength="14" placeholder="(00) 0000-0000"></div></div></div></div>');

    fixo += i;

    $(fixo).mask('(00) 0000-0000');

    i++;
  });
});
