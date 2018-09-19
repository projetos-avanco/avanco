$(function() {
  var i = 1;

  $('#duplicar-movel').on('click', function(e) {
    e.preventDefault;

    var movel  = '#movel-';

    $('#lista-movel').append('<div class="row" id="linha-movel-'+i+'"><div class="col-sm-12"><div class="form-group"><div class="input-group"><span class="input-group-btn"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span></button></span><label class="sr-only" for="movel">Telefone Móvel</label><input class="form-control" id="movel-'+i+'" type="tel" name="contato[movel]['+i+']" maxlength="15" placeholder="(00) 00000-0000"></div></div></div></div>');

    movel += i;

    $(movel).mask('(00) 00000-0000');

    i++;
  });
});
