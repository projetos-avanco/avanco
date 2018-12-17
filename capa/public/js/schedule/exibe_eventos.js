$(function() {
  $(document).ready(function(e) {
    e.preventDefault;

    $('#calendario').fullCalendar({          
      header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
      },          
      editable: true,
      eventLimit: true, 
      eventSources: [
        {
          url: '../../../database/functions/schedule/dados_agenda_externo.php',              
          color: '#FF7F50',
          textColor: '#FFFFFF'              
        },            
        {
          url: '../../../database/functions/schedule/dados_agenda_remoto.php',
          color: '#FFD700',
          textColor: '#FFFFFF'
        },
        {
          url: '../../../database/functions/schedule/dados_agenda_folgas.php',
          color: '#00FF00',
          textColor: '#FFFFFF'
        },
        {
          url: '../../../database/functions/schedule/dados_agenda_faltas.php',
          color: '#8A2BE2',
          textColor: '#FFFFFF'
        },/*
        {
          url: '../../../database/functions/schedule/dados_agenda_atrasos.php',
          color: '#FF00FF',
          textColor: '#FFFFFF'
        },
        {
          url: '../../../database/functions/schedule/dados_agenda_extras.php',
          color: '#00FFFF',
          textColor: '#FFFFFF'
        }*/
      ],
      eventClick: function(evento) {            
        var titulo = evento.title.toLowerCase();
        
        switch (titulo) {
          case 'atendimento externo':                
            swal({
              icon: 'info',
              title: 'Atendimento Externo!',
              text:               
                'Lançado: '             + evento.registrado         + "\n\n" +
                'Registro: '            + evento.registro           + "\n\n" +
                'Situação: '            + evento.status             + "\n\n" +
                'Supervisor: '          + evento.supervisor         + "\n\n" +
                'Colaborador: '         + evento.colaborador        + "\n\n" +
                'Tipo de Atendimento: ' + evento.tipo               + "\n\n\n\n" +
                'Empresa: '             + evento.empresa            + "\n\n" +
                'CNPJ: '                + evento.cnpj               + "\n\n" +
                'Contato: '             + evento.contato            + "\n\n" +
                'Período: '             + evento.periodo            + "\n\n" +
                'Produto: '             + evento.produto            + "\n\n" +
                'Observacao: '          + evento.observacao                  
            });
          break;

          case 'atendimento remoto':
            swal({
                icon: 'info',
                title: 'Atendimento Remoto!',
                text:               
                  'Lançado: '             + evento.registrado         + "\n\n" +
                  'Registro: '            + evento.registro           + "\n\n" +
                  'Situação: '            + evento.status             + "\n\n" +
                  'Supervisor: '          + evento.supervisor         + "\n\n" +
                  'Colaborador: '         + evento.colaborador        + "\n\n" +
                  'Tipo de Atendimento: ' + evento.tipo               + "\n\n\n\n" +
                  'Empresa: '             + evento.empresa            + "\n\n" +
                  'CNPJ: '                + evento.cnpj               + "\n\n" +
                  'Contato: '             + evento.contato            + "\n\n" +
                  'Data: '                + evento.data               + "\n\n" +
                  'Produto: '             + evento.produto            + "\n\n" +
                  'Observacao: '          + evento.observacao                  
              });
          break;

          case 'abater nas horas':
          case 'abater nas férias':
          case 'premiação avanção':
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

          case 'descontar o dia':
          case 'atestado médico':
          case 'atestado de óbito':
          case 'atestado de acompanhamento':
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
                  'Observacao: '          + evento.observacao                  
              });
          break;
        }     
      }
    });
  });
});