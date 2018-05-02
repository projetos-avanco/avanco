$('document').ready(function() {

  var i = 0;

  // contabilizando a quantidade de lançamentos já registrados no banco de dados
  $('#lancamentos input[type="date"]').each(function(index, element) {

    i++;
        
  });

  $('#botao').click(function() {
    
    $('#lancamentos').append(
    
    '<div class="row" numero-bloco="'+i+'"><div class="col-sm-12"><div class="row"><div class="col-sm-2"><label for="data">Data</label><input class="form-control required" id="data" type="date" name="lancamentos['+i+'][data]" numero="'+i+'"></div></div><br> <div class="row"><div class="col-sm-2"><label for="produto">Produto</label><select class="form-control required" id="produto" name="lancamentos['+i+'][produto]" numero="'+i+'"><option value="0" selectec>Selecione um Produto</option><option value="1">Integral</option><option value="2">Frente de Loja</option><option value="3">Gestor</option><option value="4">Novo ERP</option></select></div></div><br><div class="row"><div class="col-sm-2"><label for="horas-trabalhadas">Horas Trabalhadas</label><input class="form-control required" id="horas-trabalhadas" type="time" name="lancamentos['+i+'][horas-trabalhadas]" numero="'+i+'"></div><div class="col-sm-2"><label for="horas-faturadas">Horas Faturadas</label><input class="form-control required" id="horas-faturadas" type="time" name="lancamentos['+i+'][horas-faturadas]" numero="'+i+'"></div></div><br><div class="row"><div class="col-sm-2"><label for="valor-horas">Valor Horas</label><input class="form-control required" id="valor-horas" type="text" name="lancamentos['+i+'][valor-horas]" numero="'+i+'" value="0"></div><div class="col-sm-2"><label for="valor-toral">Valor Total</label><input class="form-control required" id="valor-total" type="text" name="lancamentos['+i+'][valor-total]" numero="'+i+'" value="0"></div></div><br><div class="row"><div class="col-sm-1"><button class="btn btn-danger btn-block" id="botao-excluir" type="button" numero-botao="'+i+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></div></div><hr></div></div>');

    i++;
    
  });

});

