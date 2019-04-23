$(function() {
  // marcando checkboxers dos colaboradores do atendimento interno
  $(document).on('click', '#grupo-1', function(e) {
    e.preventDefault;

    localStorage.clear();

    var id = [];

    // percorrendo todos os input checkboxers
    $('#lista-colaboradores input:checkbox').each(function() {
      //marcando colaboradores do atendimento interno e desmarcando colaboradores do atendimento externo
      if ($(this).val() == '20' ||
          $(this).val() == '37' ||
          $(this).val() == '38' || 
          $(this).val() == '39' || 
          $(this).val() == '40' || 
          $(this).val() == '41' || 
          $(this).val() == '61') {
        $(this).prop('checked', false);
      } else {
        $(this).prop('checked', true);

        id.push($(this).val());
      }

      // salvando id's no formato JSON
      localStorage.setItem('dadosForm', JSON.stringify({listaColaboladores: id}));
    });
  });

  // marcando checkboxers dos colaboradores do atendimento externo
  $(document).on('click', '#grupo-2', function(e) {
    e.preventDefault;

    localStorage.clear();

    var id = [];

    // percorrendo todos os input checkboxers
    $('#lista-colaboradores input:checkbox').each(function() {
      //marcando colaboradores do atendimento externo e desmarcando colaboradores do atendimento interno
      if ($(this).val() == '20' ||
          $(this).val() == '37' ||
          $(this).val() == '38' || 
          $(this).val() == '39' || 
          $(this).val() == '40' || 
          $(this).val() == '41' || 
          $(this).val() == '61') {
        $(this).prop('checked', true);

        id.push($(this).val());

      } else {
        $(this).prop('checked', false);
      }

      // salvando id's no formato JSON
      localStorage.setItem('dadosForm', JSON.stringify({listaColaboladores: id}));
    });
  });

  // marcando checkboxers dos colaboradores do atendimento externo
  $(document).on('click', '#grupo-3', function(e) {
    e.preventDefault;

    localStorage.clear();

    var id = [];

    // percorrendo todos os input checkboxers dos colaboradores
    $('#lista-colaboradores input:checkbox').each(function() {
      // desmarcando todos os checkboxers      
      $(this).prop('checked', false);
    });
  });
});