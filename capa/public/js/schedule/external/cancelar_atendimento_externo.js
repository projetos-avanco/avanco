$(function() {
  // cancelando atendimento externo      
  $(document).on('click', '#cancelar-atendimento', function(e) {
    e.preventDefault;

    var id        = $(this).val();
    var registro  = $(this).closest('tr').attr('data-registro');
    var idCnpj    = $(this).closest('tr').attr('data-id-cnpj');
    var idContato = $(this).closest('tr').attr('data-id-contato');
    var status    = $(this).closest('tr').attr('data-status');

    if (status === 'Confirmada') {
      swal({
        icon: 'info',
        title: 'Atendimento Externo!',
        text: 'Confirma o Cancelamento do Atendimento de Registro: ' + registro + '?',
        buttons: {
          confirm: {
            text: 'Confirmar Cancelamento'
          },
          cancel: {
            text: 'Fechar',
            closeModal: true,
            visible: true
          }        
        }
      }).then((confirmar) => {
        if (confirmar) {
          var url = window.location.href;
          var tmp = url.split('/');
  
          url = tmp[0]+'//'+tmp[2]+'/'+tmp[3]+'/'+tmp[4]+'/public/views/schedule/cancela_atendimento_externo.php?id=' + id + '&id-cnpj=' + idCnpj + '&id-contato=' + idContato;
  
          window.open(url, '_self');
        }
      });
    } else {
      swal({
        icon: 'info',
        title: 'Atendimento Externo!',
        text: 'Confirma o Cancelamento do Atendimento de Registro: ' + registro + '?',
        buttons: {
          confirm: {
            text: 'Confirmar Cancelamento'
          },
          cancel: {
            text: 'Fechar',
            closeModal: true,
            visible: true
          }        
        }
      }).then((confirmar) => {
        if (confirmar) {
          $.ajax({
            type: 'get',
            url: '../../../app/requests/get/schedule/external/recebe_atendimento.php?id=' + id,
            dataType: 'json',            
            success: function(retorno) {
              swal({
                icon: 'success',
                title: 'Atendimento Externo',
                text: 'Atendimento Externo cancelado com sucesso.',
                buttons: {                  
                  cancel: {
                    text: 'Fechar',
                    closeModal: true,
                    visible: true
                  }        
                }
              }).then((confirmar) => {
                location.reload();
              });
            },
            error: function(erro) {
              console.log(erro);
            }
          });          
        }
      });      
    }
  });
});