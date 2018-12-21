$(function() {
  // exibindo checkboxes dos colaboradores
  $(document).ready(function(e) {
    e.preventDefault;

    $.ajax({
      type: 'get',
      url: '../../../app/requests/get/schedule/processa_colaboradores.php',
      dataType: 'json',
      success: function(dados) {        
        var colaboradores = '';

        for (var i = 0; i < Object.keys(dados).length; i++) {
          colaboradores +=
            '<div class="checkbox">' +
              '<label>' +
                '<input type="checkbox" name="colaboradores[]" value="' + dados[i].id + '">' + dados[i].nome +
              '</label>' +
            '</div>';
        }

        $('#lista-colaboradores').append(colaboradores);
      },
      error: function(erro) {
        console.log(erro);
      }    
    });
  });

  // atualizando página
  $(document).on('click', '#btn-atualizar', function(e) {
    e.preventDefault;

    window.location.reload(true);
  });

  // realizando busca dos eventos dos colaboradores marcados
  $(document).on('click', '#btn-consultar', function(e) {
    e.preventDefault;

    var colaboradores = [];

    $('input:checkbox').each(function() {
      if ($(this).is(':checked')) {
        colaboradores.push($(this).val());
      }
    });

    $('#calendario').fullCalendar('removeEvents');

    $('#calendario').fullCalendar({      
      header: {        
        left: 'prev,next today',
        center: 'title',
        right: 'month, agendaWeek, agendaDay, listWeek'          
      },          
      editable: true,
      eventLimit: true,
      events: [ // adicionando cor de fundo para os feriados
        {
          start: '2019-01-01',
          end: '2019-01-01',
          rendering: 'background',          
          color: '#F6CECE'
        },
        {
          start: '2019-03-05',
          end: '2019-03-05',
          rendering: 'background',
          color: '#F6CECE'
        },
        {
          start: '2019-04-19',
          end: '2019-04-19',
          rendering: 'background',
          color: '#F6CECE'
        },        
        {
          start: '2019-05-01',
          end: '2019-05-01',
          rendering: 'background',
          color: '#F6CECE'
        },
        {
          start: '2019-06-20',
          end: '2019-06-20',
          rendering: 'background',
          color: '#F6CECE'
        },
        {
          start: '2019-07-01',
          end: '2019-07-01',
          rendering: 'background',
          color: '#F6CECE'
        },
        {
          start: '2019-08-01',
          end: '2019-08-01',
          rendering: 'background',
          color: '#F6CECE'
        },
        {
          start: '2019-11-15',
          end: '2019-11-15',
          rendering: 'background',
          color: '#F6CECE'
        },
        {
          start: '2019-12-25',
          end: '2019-12-25',
          rendering: 'background',
          color: '#F6CECE'
        }        
      ],
      events: function(evento) {
        $.ajax({
          url: '../../../database/functions/schedule/dados_agenda_filtros.php',
          dataType: 'json',
          data: {
            ids: colaboradores
          },
          success: function(dados) {
            console.log(dados);            
          },
          error: function(erro) {
            console.log(erro);
          }
        });
      },
      eventClick: function(evento) {      
        var titulo = evento.title.toLowerCase();        

        titulo = titulo.split('-');
        titulo = titulo[0].trim();

        switch (titulo) {
          case 'atd externo':
            evento.empresa = evento.empresa.substr(0, 32);

            swal({
              icon: 'info',
              title: 'Atendimento Externo!',
              text:               
                'Lançado: '             + evento.registrado         + "\n\n" +
                'Registro: '            + evento.registro           + "\n\n" +
                'Situação: '            + evento.status             + "\n\n" +
                'Supervisor: '          + evento.supervisor         + "\n\n" +
                'Colaborador: '         + evento.colaborador        + "\n\n" +
                'Período: '             + evento.periodo            + "\n\n" +
                'Tipo de Atendimento: ' + evento.tipo               + "\n\n\n\n" +
                'Empresa: '             + evento.empresa            + "\n\n" +
                'CNPJ: '                + evento.cnpj               + "\n\n" +
                'Contato: '             + evento.contato            + "\n\n" +                
                'Produto: '             + evento.produto            + "\n\n" +
                'Observacao: '          + evento.observacao                  
            });
          break;

          case 'atd remoto':
            evento.empresa = evento.empresa.substr(0, 32);

            swal({
                icon: 'info',
                title: 'Atendimento Remoto!',
                text:               
                  'Lançado: '             + evento.registrado         + "\n\n" +
                  'Registro: '            + evento.registro           + "\n\n" +
                  'Situação: '            + evento.status             + "\n\n" +
                  'Supervisor: '          + evento.supervisor         + "\n\n" +
                  'Colaborador: '         + evento.colaborador        + "\n\n" +
                  'Data: '                + evento.data               + "\n\n" +
                  'Tipo de Atendimento: ' + evento.tipo               + "\n\n\n\n" +
                  'Empresa: '             + evento.empresa            + "\n\n" +
                  'CNPJ: '                + evento.cnpj               + "\n\n" +
                  'Contato: '             + evento.contato            + "\n\n" +                  
                  'Produto: '             + evento.produto            + "\n\n" +
                  'Observacao: '          + evento.observacao                  
              });
          break;

          case 'folga':          
            swal({
                icon: 'info',
                title: 'Registro de Folga!',
                text:               
                  'Lançado: '             + evento.registrado         + "\n\n" +
                  'Registro: '            + evento.registro           + "\n\n" +                      
                  'Supervisor: '          + evento.supervisor         + "\n\n" +
                  'Colaborador: '         + evento.colaborador        + "\n\n" +
                  'Motivo: '              + evento.motivo             + "\n\n" +
                  'Período: '             + evento.periodo            + "\n\n" +                      
                  'Observacao: '          + evento.observacao                  
              });
          break;

          case 'falta':          
            swal({
                icon: 'info',
                title: 'Registro de Falta!',
                text:               
                  'Lançado: '             + evento.registrado         + "\n\n" +
                  'Registro: '            + evento.registro           + "\n\n" +                      
                  'Supervisor: '          + evento.supervisor         + "\n\n" +
                  'Colaborador: '         + evento.colaborador        + "\n\n" +
                  'Motivo: '              + evento.motivo             + "\n\n" +
                  'Período: '             + evento.periodo            + "\n\n" +                      
                  'Observacao: '          + evento.observacao,
                  buttons: {
                    confirm: {
                      text: 'Atestado'
                    },
                    cancel: {
                      text: 'Ok',
                      closeModal: true,
                      visible: true
                    }        
                  }
              }).then((confirmar) => {
                if (confirmar) {                                  
                  var url = window.location.href;
                  var tmp = url.split('/');

                  url = tmp[0] + '//' + tmp[2] + evento.arquivo;
                  
                  window.open(url, '_blank');
                }
              });
          break;
        }     
      }
    });    
  });
});