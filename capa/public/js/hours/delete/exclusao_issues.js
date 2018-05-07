/*
 * exclui issue após confirmação do usuário
 * @param - id da issue
 * @param - nome da issue
 */
function confirmaExclusao(id, issue)
{
  // verificando se o id retornado é uma string
  if (isNaN(id)) {

    alert('Erro ao recuperar o id da issue!');

  } else {

    // exibindo aviso de confirmação
    var resposta = confirm('Confirma a exclusão da issue ' + issue + '?');

    // verificando se o usuário confirmou a exclusão da issue
    if (resposta) {

      // recuperando endereço do recurso atual
      var uri = window.location.href;

      // separando endereço do recurso atual
      var arr = uri.split('/');

      // montando url do recurso que deleta a issue
      var url = arr[0]+'//'+arr[2]+'/'+arr[3]+'/'+arr[4]+'/'+'app/requests/get/processa_lancamento.php?id='+id+'';

      // chamando url montada
      window.location.href = url;

    } else {

      // recarregando página atual
      window.location.reload(true);

    }

  }

}