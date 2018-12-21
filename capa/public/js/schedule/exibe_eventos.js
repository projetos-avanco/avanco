$(function() {
  $(document).ready(function(e) {
    e.preventDefault;

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
        },
      ],
      eventSources: [
        {
          url: '../../../database/functions/schedule/dados_agenda_externo.php',              
          color: '#00BFFF',
          textColor: '#FFFFFF'              
        },            
        {
          url: '../../../database/functions/schedule/dados_agenda_remoto.php',
          color: '#FF0000',
          textColor: '#FFFFFF'
        },
        {
          url: '../../../database/functions/schedule/dados_agenda_folgas.php',
          color: '#3ADF00',
          textColor: '#FFFFFF'
        },
        {
          url: '../../../database/functions/schedule/dados_agenda_faltas.php',
          color: '#FF00FF',
          textColor: '#FFFFFF'
        }
      ],
      timeFormat: 'HH:mm',
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