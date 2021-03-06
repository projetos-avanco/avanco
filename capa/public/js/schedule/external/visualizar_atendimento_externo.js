$(function() {
  // visualizando relatório do atendimento externo
  $(document).on('click', '#visualizar-atendimento', function(e) {
    e.preventDefault;

    var gerencial = {};

    gerencial.id                 = $(this).closest('tr').attr('data-id');
    gerencial.id_cnpj            = $(this).closest('tr').attr('data-id-cnpj');
    gerencial.id_contato         = $(this).closest('tr').attr('data-id-contato');    
    gerencial.lancado            = $(this).closest('tr').attr('data-lancado');
    gerencial.registro           = $(this).closest('tr').attr('data-registro');
    gerencial.status             = $(this).closest('tr').attr('data-status');
    gerencial.supervisor         = $(this).closest('tr').attr('data-supervisor');
    gerencial.colaborador        = $(this).closest('tr').attr('data-colaborador');
    gerencial.tipo               = $(this).closest('tr').attr('data-tipo');
    gerencial.empresa            = $(this).closest('tr').attr('data-empresa');
    gerencial.cnpj               = $(this).closest('tr').attr('data-cnpj');
    gerencial.contato            = $(this).closest('tr').attr('data-contato');
    gerencial.periodo            = $(this).closest('tr').attr('data-periodo');
    gerencial.produto            = $(this).closest('tr').attr('data-produto');
    gerencial.tarefa             = $(this).closest('tr').attr('data-tarefa');
    gerencial.observacao         = $(this).closest('tr').attr('data-observacao');
    gerencial.faturado           = $(this).closest('tr').attr('data-faturado');
    gerencial.despesas           = $(this).closest('tr').attr('data-despesas');
    gerencial.relatorio_entregue = $(this).closest('tr').attr('data-relatorio');
    gerencial.pesquisa_realizada = $(this).closest('tr').attr('data-pesquisa');

    gerencial.empresa = gerencial.empresa.substr(0, 32).toUpperCase();
    
    // verificando se o relatorio de horas foi deletado, ou seja, o atendimento foi cancelado
    if (gerencial.relatorio_entregue == 'null') {
      gerencial.relatorio_entregue = 'Deletado';
    }

    // verificando se a pesquisa externa foi deletada, ou seja, o atendimento foi cancelado
    if (gerencial.pesquisa_realizada == 'null') {
      gerencial.pesquisa_realizada = 'Deletado';
    }

    if (gerencial.status === 'Reservado') {      
      swal({
        icon: 'info',
        title: 'Atendimento Externo!',
        text:               
          'Lançado: '             + gerencial.lancado            + "\n\n" +
          'Registro: '            + gerencial.registro           + "\n\n" +
          'Situação: '            + gerencial.status             + "\n\n" +
          'Supervisor: '          + gerencial.supervisor         + "\n\n" +
          'Colaborador: '         + gerencial.colaborador        + "\n\n" +
          'Tipo de Atendimento: ' + gerencial.tipo               + "\n\n\n\n" +
          'Empresa: '             + gerencial.empresa            + "\n\n" +
          'CNPJ: '                + gerencial.cnpj               + "\n\n" +
          'Contato: '             + gerencial.contato            + "\n\n" +
          'Período: '             + gerencial.periodo            + "\n\n" +
          'Produto: '             + gerencial.produto            + "\n\n" +
          'Tarefa: '              + gerencial.tarefa             + "\n\n" +
          'Observacao: '          + gerencial.observacao         + "\n\n\n\n" +
          'Faturado: '            + gerencial.faturado           + "\n\n" +
          'Despesas: '            + gerencial.despesas           + "\n\n" +
          'Relatório Entregue: '  + gerencial.relatorio_entregue + "\n\n" +
          'Pesquisa Realizada: '  + gerencial.pesquisa_realizada,
        buttons: {
          confirm: {
            text: 'Confirmar'
          },
          catch: {
            text: 'Alterar',
            value: 'alterar'
          },
          cancel: {
            text: 'Fechar',
            closeModal: true,
            visible: true
          }        
        }
      }).then((valor) => {
        if (valor === true) {
          var url = window.location.href;
          var tmp = url.split('/');

          url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/confirma_atendimento_externo.php?id=' + gerencial.id + '&id-cnpj=' + gerencial.id_cnpj + '&id-contato=' + gerencial.id_contato;
          
          window.open(url, '_self');
        } else if (valor === 'alterar') {
          var url = window.location.href;
          var tmp = url.split('/');

          url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/edita_atendimento_externo.php?id=' + gerencial.id;
          
          window.open(url, '_self');          
        }
      });
    } else if (gerencial.status === 'À Confirmar') {
      swal({
        icon: 'info',
        title: 'Atendimento Externo!',
        text:               
          'Lançado: '             + gerencial.lancado            + "\n\n" +
          'Registro: '            + gerencial.registro           + "\n\n" +
          'Situação: '            + gerencial.status             + "\n\n" +
          'Supervisor: '          + gerencial.supervisor         + "\n\n" +
          'Colaborador: '         + gerencial.colaborador        + "\n\n" +
          'Tipo de Atendimento: ' + gerencial.tipo               + "\n\n\n\n" +
          'Empresa: '             + gerencial.empresa            + "\n\n" +
          'CNPJ: '                + gerencial.cnpj               + "\n\n" +
          'Contato: '             + gerencial.contato            + "\n\n" +
          'Período: '             + gerencial.periodo            + "\n\n" +
          'Produto: '             + gerencial.produto            + "\n\n" +
          'Tarefa: '              + gerencial.tarefa             + "\n\n" +
          'Observacao: '          + gerencial.observacao         + "\n\n\n\n" +
          'Faturado: '            + gerencial.faturado           + "\n\n" +
          'Despesas: '            + gerencial.despesas           + "\n\n" +
          'Relatório Entregue: '  + gerencial.relatorio_entregue + "\n\n" +
          'Pesquisa Realizada: '  + gerencial.pesquisa_realizada,
          buttons: {
            confirm: {
              text: 'Confirmar'
            },
            catch: {
              text: 'Alterar',
              value: 'alterar'
            },
            cancel: {
              text: 'Fechar',
              closeModal: true,
              visible: true
            }        
          }
      }).then((valor) => {
        if (valor === true) {
         $.ajax({
          type: 'post',
          url: '../../../app/requests/post/schedule/confirmation/processa_confirmacao_atendimento.php',
          dataType: 'json',
          data: {
            id: gerencial.id,
            pagina: 'externo'
          },
          success: function(confirmacao) {
            swal({
              icon: 'success',
              title: 'Atendimento Externo!',
              text: 'Atendimento confirmado com sucesso.',
              buttons: {
                confirm: {
                  text: 'Ok'
                },                
              }
            }).then((confirmar) => {
              if (confirmar) {
                location.reload();
              }
            });
          },
          error: function(erro) {
            console.log(erro);
          }
         });
        } else if (valor === 'alterar') {
          var url = window.location.href;
          var tmp = url.split('/');

          url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/edita_atendimento_externo.php?id=' + gerencial.id;
          
          window.open(url, '_self'); 
        }
      });
    } else if (gerencial.status === 'Cancelado') {
      swal({
        icon: 'info',
        title: 'Atendimento Externo!',
        text:               
          'Lançado: '             + gerencial.lancado            + "\n\n" +
          'Registro: '            + gerencial.registro           + "\n\n" +
          'Situação: '            + gerencial.status             + "\n\n" +
          'Supervisor: '          + gerencial.supervisor         + "\n\n" +
          'Colaborador: '         + gerencial.colaborador        + "\n\n" +
          'Tipo de Atendimento: ' + gerencial.tipo               + "\n\n\n\n" +
          'Empresa: '             + gerencial.empresa            + "\n\n" +
          'CNPJ: '                + gerencial.cnpj               + "\n\n" +
          'Contato: '             + gerencial.contato            + "\n\n" +
          'Período: '             + gerencial.periodo            + "\n\n" +
          'Produto: '             + gerencial.produto            + "\n\n" +
          'Tarefa: '              + gerencial.tarefa             + "\n\n" +
          'Observacao: '          + gerencial.observacao         + "\n\n\n\n" +
          'Faturado: '            + gerencial.faturado           + "\n\n" +
          'Despesas: '            + gerencial.despesas           + "\n\n" +
          'Relatório Entregue: '  + gerencial.relatorio_entregue + "\n\n" +
          'Pesquisa Realizada: '  + gerencial.pesquisa_realizada,
        buttons: {          
          cancel: {
            text: 'Fechar',
            closeModal: true,
            visible: true
          }        
        }
      });
    } else {
      swal({
        icon: 'info',
        title: 'Atendimento Externo!',
        text:               
          'Lançado: '             + gerencial.lancado            + "\n\n" +
          'Registro: '            + gerencial.registro           + "\n\n" +
          'Situação: '            + gerencial.status             + "\n\n" +
          'Supervisor: '          + gerencial.supervisor         + "\n\n" +
          'Colaborador: '         + gerencial.colaborador        + "\n\n" +
          'Tipo de Atendimento: ' + gerencial.tipo               + "\n\n\n\n" +
          'Empresa: '             + gerencial.empresa            + "\n\n" +
          'CNPJ: '                + gerencial.cnpj               + "\n\n" +
          'Contato: '             + gerencial.contato            + "\n\n" +
          'Período: '             + gerencial.periodo            + "\n\n" +
          'Produto: '             + gerencial.produto            + "\n\n" +
          'Tarefa: '              + gerencial.tarefa             + "\n\n" +
          'Observacao: '          + gerencial.observacao         + "\n\n\n\n" +
          'Faturado: '            + gerencial.faturado           + "\n\n" +
          'Despesas: '            + gerencial.despesas           + "\n\n" +
          'Relatório Entregue: '  + gerencial.relatorio_entregue + "\n\n" +
          'Pesquisa Realizada: '  + gerencial.pesquisa_realizada,
        buttons: {
          catch: {
            text: 'Alterar',
            value: 'alterar'
          },
          cancel: {
            text: 'Fechar',
            closeModal: true,
            visible: true
          }        
        }
      }).then((valor) => {
        if (valor === 'alterar') {
          var url = window.location.href;
          var tmp = url.split('/');

          url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/edita_atendimento_externo.php?id=' + gerencial.id;
          
          window.open(url, '_self');           
        }
      });
    }
  });
});