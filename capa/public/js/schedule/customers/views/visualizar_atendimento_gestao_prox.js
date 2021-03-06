$(function() {
  // visualizando relatório do atendimento externo
  $(document).on('click', '#visualizar-atendimento-gestao-prox', function(e) {
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
    gerencial.observacao         = $(this).closest('tr').attr('data-observacao');
    gerencial.faturado           = $(this).closest('tr').attr('data-faturado');
    gerencial.despesas           = $(this).closest('tr').attr('data-despesas');
    gerencial.relatorio_entregue = $(this).closest('tr').attr('data-relatorio');
    gerencial.pesquisa_realizada = $(this).closest('tr').attr('data-pesquisa');

    gerencial.empresa = gerencial.empresa.substr(0, 32).toUpperCase();

    swal({
      icon: 'info',
      title: 'Gestão Clientes!',
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
        'Observacao: '          + gerencial.observacao         + "\n\n\n\n" +
        'Faturado: '            + gerencial.faturado           + "\n\n" +
        'Despesas: '            + gerencial.despesas,          
      buttons: {          
        cancel: {
          text: 'Fechar',
          closeModal: true,
          visible: true
        }        
      }
    });
  });
});