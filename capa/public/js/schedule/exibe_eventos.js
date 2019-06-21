$(function() {
    $(document).ready(function(e) {
        e.preventDefault;

        // percorrendo todos os checkboxers da lista de eventos
        $('#lista-eventos input:checkbox').each(function() {
            // marcando todos os checkboxers 
            $(this).prop('checked', true)
        });

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
            eventSources: [{
                    url: '../../../database/functions/schedule/dados_agenda_externo.php',
                    color: '#FF8000',
                    textColor: '#FFFFFF',
                    data: function() {
                        var id = [];

                        // percorrendo todos os checkboxers
                        $('#lista-colaboradores input:checkbox').each(function() {
                            // verificando se o checkbox está marcado
                            if ($(this).is(':checked')) {
                                id.push($(this).val());
                            }
                        });

                        var evento = true;

                        // percorrendo todos os checkboxers
                        $('#lista-eventos input:checkbox').each(function() {
                            // verificando se o checkbox está desmarcado
                            if (!$(this).is(':checked')) {
                                // verificando se o checkbox é referente ao evento atendimento externo
                                if ($(this).val() == '1') {
                                    evento = false;
                                }
                            }
                        });

                        return {
                            colaboradores: id,
                            evento: evento
                        }
                    }
                },
                {
                    url: '../../../database/functions/schedule/dados_agenda_remoto.php',
                    color: '#00BFFF',
                    textColor: '#FFFFFF',
                    data: function() {
                        var id = [];

                        // percorrendo todos os checkboxers
                        $('#lista-colaboradores input:checkbox').each(function() {
                            // verificando se o checkbox está marcado
                            if ($(this).is(':checked')) {
                                id.push($(this).val());
                            }
                        });

                        var evento = true;

                        // percorrendo todos os checkboxers
                        $('#lista-eventos input:checkbox').each(function() {
                            // verificando se o checkbox está desmarcado
                            if (!$(this).is(':checked')) {
                                // verificando se o checkbox é referente ao evento atendimento remoto
                                if ($(this).val() == '2') {
                                    evento = false;
                                }
                            }
                        });

                        return {
                            colaboradores: id,
                            evento: evento
                        }
                    },
                },
                {
                    url: '../../../database/functions/schedule/dados_agenda_gestao_clientes.php',
                    color: '#FF00FF',
                    textColor: '#FFFFFF',
                    data: function() {
                        var id = [];

                        // percorrendo todos os checkboxers
                        $('#lista-colaboradores input:checkbox').each(function() {
                            // verificando se o checkbox está marcado
                            if ($(this).is(':checked')) {
                                id.push($(this).val());
                            }
                        });

                        var evento = true;

                        // percorrendo todos os checkboxers
                        $('#lista-eventos input:checkbox').each(function() {
                            // verificando se o checkbox está desmarcado
                            if (!$(this).is(':checked')) {
                                // verificando se o checkbox é referente ao evento gestão de clientes
                                if ($(this).val() == '3') {
                                    evento = false;
                                }
                            }
                        });

                        return {
                            colaboradores: id,
                            evento: evento
                        }
                    },
                },
                {
                    url: '../../../database/functions/vacation/dados_agenda_ferias.php',
                    color: '#FE2E2E',
                    textColor: '#FFFFFF',
                    data: function() {
                        var id = [];

                        // percorrendo todos os checkboxers
                        $('#lista-colaboradores input:checkbox').each(function() {
                            // verificando se o checkbox está marcado
                            if ($(this).is(':checked')) {
                                id.push($(this).val());
                            }
                        });

                        var evento = true;

                        // percorrendo todos os checkboxers
                        $('#lista-eventos input:checkbox').each(function() {
                            // verificando se o checkbox está desmarcado
                            if (!$(this).is(':checked')) {
                                // verificando se o checkbox é referente ao evento férias
                                if ($(this).val() == '4') {
                                    evento = false;
                                }
                            }
                        });

                        return {
                            colaboradores: id,
                            evento: evento
                        }
                    },
                },
                {
                    url: '../../../database/functions/schedule/dados_agenda_faltas.php',
                    color: '#8000FF',
                    textColor: '#FFFFFF',
                    data: function() {
                        var id = [];

                        // percorrendo todos os checkboxers
                        $('#lista-colaboradores input:checkbox').each(function() {
                            // verificando se o checkbox está marcado
                            if ($(this).is(':checked')) {
                                id.push($(this).val());
                            }
                        });

                        var evento = true;

                        // percorrendo todos os checkboxers
                        $('#lista-eventos input:checkbox').each(function() {
                            // verificando se o checkbox está desmarcado
                            if (!$(this).is(':checked')) {
                                // verificando se o checkbox é referente ao evento faltas
                                if ($(this).val() == '5') {
                                    evento = false;
                                }
                            }
                        });

                        return {
                            colaboradores: id,
                            evento: evento
                        }
                    },
                },
                {
                    url: '../../../database/functions/schedule/dados_agenda_folgas.php',
                    color: '#3ADF00',
                    textColor: '#FFFFFF',
                    data: function() {
                        var id = [];

                        // percorrendo todos os checkboxers
                        $('#lista-colaboradores input:checkbox').each(function() {
                            // verificando se o checkbox está marcado
                            if ($(this).is(':checked')) {
                                id.push($(this).val());
                            }
                        });

                        var evento = true;

                        // percorrendo todos os checkboxers
                        $('#lista-eventos input:checkbox').each(function() {
                            // verificando se o checkbox está desmarcado
                            if (!$(this).is(':checked')) {
                                // verificando se o checkbox é referente ao evento folgas
                                if ($(this).val() == '6') {
                                    evento = false;
                                }
                            }
                        });

                        return {
                            colaboradores: id,
                            evento: evento
                        }
                    },
                }
            ],
            timeFormat: 'HH:mm',
            eventClick: function(evento) {
                var titulo = evento.title.toLowerCase();

                titulo = titulo.split('-');
                titulo = titulo[1].trim();

                switch (titulo) {
                    case 'férias':

                        swal({
                            icon: 'info',
                            title: 'Período de Férias!',
                            text: 'Lançado: ' + evento.registrado + "\n\n" +
                                'Registro: ' + evento.registro + "\n\n" +
                                'Situação: ' + evento.status + "\n\n" +
                                'Supervisor: ' + evento.supervisor + "\n\n" +
                                'Colaborador: ' + evento.colaborador + "\n\n\n\n" +
                                'Período: ' + evento.periodo + "\n\n" +
                                'Dias: ' + evento.dias
                        });
                        break;

                    case 'atd externo':
                        evento.empresa = evento.empresa.substr(0, 32);

                        swal({
                            icon: 'info',
                            title: 'Atendimento Externo!',
                            text: 'Lançado: ' + evento.registrado + "\n\n" +
                                'Registro: ' + evento.registro + "\n\n" +
                                'Situação: ' + evento.status + "\n\n" +
                                'Supervisor: ' + evento.supervisor + "\n\n" +
                                'Colaborador: ' + evento.colaborador + "\n\n" +
                                'Período: ' + evento.periodo + "\n\n" +
                                'Atendimento: ' + evento.tipo + "\n\n\n\n" +
                                'Empresa: ' + evento.empresa + "\n\n" +
                                'CNPJ: ' + evento.cnpj + "\n\n" +
                                'Contato: ' + evento.contato + "\n\n" +
                                'Fixo: ' + evento.fixo + "\n\n" +
                                'Móvel: ' + evento.movel + "\n\n" +
                                'E-mail: ' + evento.email + "\n\n" +
                                'Tarefa: ' + evento.tarefa + "\n\n" +
                                'Produto: ' + evento.produto + "\n\n" +
                                'Observacao: ' + evento.observacao
                        });
                        break;

                    case 'gestão clientes':
                        evento.empresa = evento.empresa.substr(0, 32);

                        swal({
                            icon: 'info',
                            title: 'Gestão de Clientes!',
                            text: 'Lançado: ' + evento.registrado + "\n\n" +
                                'Registro: ' + evento.registro + "\n\n" +
                                'Situação: ' + evento.status + "\n\n" +
                                'Supervisor: ' + evento.supervisor + "\n\n" +
                                'Colaborador: ' + evento.colaborador + "\n\n" +
                                'Período: ' + evento.periodo + "\n\n" +
                                'Atendimento: ' + evento.tipo + "\n\n\n\n" +
                                'Empresa: ' + evento.empresa + "\n\n" +
                                'CNPJ: ' + evento.cnpj + "\n\n" +
                                'Contato: ' + evento.contato + "\n\n" +
                                'Fixo: ' + evento.fixo + "\n\n" +
                                'Móvel: ' + evento.movel + "\n\n" +
                                'E-mail: ' + evento.email + "\n\n" +
                                'Produto: ' + evento.produto + "\n\n" +
                                'Observacao: ' + evento.observacao
                        });
                        break;

                    case 'atd remoto':
                        evento.empresa = evento.empresa.substr(0, 32);

                        swal({
                            icon: 'info',
                            title: 'Atendimento Remoto!',
                            text: 'Lançado: ' + evento.registrado + "\n\n" +
                                'Registro: ' + evento.registro + "\n\n" +
                                'Situação: ' + evento.status + "\n\n" +
                                'Supervisor: ' + evento.supervisor + "\n\n" +
                                'Colaborador: ' + evento.colaborador + "\n\n" +
                                'Data: ' + evento.data + "\n\n" +
                                'Atendimento: ' + evento.tipo + "\n\n\n\n" +
                                'Empresa: ' + evento.empresa + "\n\n" +
                                'CNPJ: ' + evento.cnpj + "\n\n" +
                                'Contato: ' + evento.contato + "\n\n" +
                                'Fixo: ' + evento.fixo + "\n\n" +
                                'Móvel: ' + evento.movel + "\n\n" +
                                'E-mail: ' + evento.email + "\n\n" +
                                'Produto: ' + evento.produto + "\n\n" +
                                'Tarefa: ' + evento.tarefa + "\n\n" +
                                'Observacao: ' + evento.observacao
                        });
                        break;

                    case 'folga':
                        swal({
                            icon: 'info',
                            title: 'Registro de Folga!',
                            text: 'Lançado: ' + evento.registrado + "\n\n" +
                                'Registro: ' + evento.registro + "\n\n" +
                                'Supervisor: ' + evento.supervisor + "\n\n" +
                                'Colaborador: ' + evento.colaborador + "\n\n\n\n" +
                                'Motivo: ' + evento.motivo + "\n\n" +
                                'Período: ' + evento.periodo + "\n\n" +
                                'Observacao: ' + evento.observacao
                        });
                        break;

                    case 'falta':
                        var motivo = evento.motivo.toLowerCase();

                        // verificando se o motivo da falta exige a exibição do botão atestado
                        if (motivo == 'atestado médico' || motivo == 'atestado de óbito' || motivo == 'atestado de acompanhamento') {
                            swal({
                                icon: 'info',
                                title: 'Registro de Falta!',
                                text: 'Lançado: ' + evento.registrado + "\n\n" +
                                    'Registro: ' + evento.registro + "\n\n" +
                                    'Supervisor: ' + evento.supervisor + "\n\n" +
                                    'Colaborador: ' + evento.colaborador + "\n\n\n\n" +
                                    'Motivo: ' + evento.motivo + "\n\n" +
                                    'Período: ' + evento.periodo + "\n\n" +
                                    'Observacao: ' + evento.observacao,
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
                        } else {
                            swal({
                                icon: 'info',
                                title: 'Registro de Falta!',
                                text: 'Lançado: ' + evento.registrado + "\n\n" +
                                    'Registro: ' + evento.registro + "\n\n" +
                                    'Supervisor: ' + evento.supervisor + "\n\n" +
                                    'Colaborador: ' + evento.colaborador + "\n\n\n\n" +
                                    'Motivo: ' + evento.motivo + "\n\n" +
                                    'Período: ' + evento.periodo + "\n\n" +
                                    'Observacao: ' + evento.observacao
                            });
                        }
                        break;
                }
            }
        });

        // atualizando página
        $(document).on('click', '#btn-atualizar', function(e) {
            e.preventDefault;

            window.location.reload(true);
        });

        // filtrando colaboradores
        $(document).on('click', '#btn-consultar', function(e) {
            e.preventDefault;

            // atualizando eventos
            $('#calendario').fullCalendar('refetchEvents');
        });
    });
});