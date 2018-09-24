$(document).ready(function() {
  $('#colaborador').attr('readonly', 'true');
  
  $('#data').mask('00/00/0000');
  $('#horario').mask('00:00');
  $('#valor').mask('#0.00', {reverse: true});
});
