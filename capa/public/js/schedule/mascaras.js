$(document).ready(function() {
  $('#data-inicial').mask('00/00/0000');
  $('#data-final').mask('00/00/0000');
  $('#data').mask('00/00/0000');
  $('#horario').mask('00:00');
  $('#valor').mask('#0.00', {reverse: true});
});
