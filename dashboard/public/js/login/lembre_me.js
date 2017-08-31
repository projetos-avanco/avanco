function setCookie(name,exdays)    //função universal para criar cookie
    {
      var expires;

      var date;
      var value;
      date = new Date(); //  criando o COOKIE com a data atual
      date.setTime(date.getTime()+(exdays*24*60*60*1000));
      expires = date.toUTCString();
      value = document.getElementById("usuario").value;;
      document.cookie = name+"="+value+"; expires="+expires+"; path=/";
    }

    function tratanome(c_name)
    {
      var nome;
      nome = c_name.replace(/(?:(?:^|.*;\s*)usuario\s*\=\s*([^;]*).*$)|^.*$/, "$1");
      return nome;
    }

    function getCookie()
    {
      var c_name = document.cookie; // listando o nome de todos os cookies
        if(c_name!=undefined && c_name.length > 0) // verificando se o mesmo existe
        {

          document.getElementById('usuario').value = tratanome(c_name);

        }
    }

    document.getElementById("usuario").onclick = function(e) {
        getCookie();
      
    }

    // Evento que é executado ao clicar no botão de enviar
    document.getElementById("submetido").onclick = function(e) {
      if(document.getElementById("marcado").checked==true)
      {
        setCookie("usuario",1);
      }

    }
