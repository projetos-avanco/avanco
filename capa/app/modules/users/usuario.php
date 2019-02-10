<?php 

/**
 * responsável por cadastrar o usuário, registrar o time e cadastrar os módulos
 * @param - array com os dados do cadastro
 * @param - string com o código do time
 * @param - array com os módulos
 */
function recebeCadastroDeUsuario($cadastro, $target = null, $time = null, $opcoes = null)
{  
  require_once DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';
  require_once DIRETORIO_FUNCTIONS . 'users/insercoes_usuario.php';
  require_once ABS_PATH . '../dashboard/app/helpers/query.php';
  require_once ABS_PATH . '../dashboard/app/models/colaborador.php';

  $db = abre_conexao();

  # verificando se o usuário não possui cadastro no portal avanção
  if (! consultaRegistroExistenteDeUsuario($db, $cadastro['nome'], $cadastro['sobrenome'], $cadastro['usuario'])) {
    # verificando se o usuário foi cadastrado com sucesso no portal avanção
    if (cadastraUsuario($db, $cadastro)) {
      # verificando se o usuário cadastrado é do suporte
      if ($cadastro['nivel'] == 1 || $cadastro['nivel'] == 3) {
        # verificando se a foto do usuário foi enviada
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
          # verificando se a foto do usuário foi movida 
          if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $colaborador = defineArrayModeloDeColaborador();

            $tmp = explode('/', $target);

            $colaborador['pessoal']['id'] = $cadastro['id_colaborador'];
            $colaborador['pessoal']['nome'] = $cadastro['nome'];
            $colaborador['pessoal']['sobrenome'] = $cadastro['sobrenome'];
            $colaborador['pessoal']['caminho_foto'] = '/' . $tmp[4] . '/' . $tmp[5] . '/' . $tmp[6] . '/' . $tmp[7] . '/' . $tmp[8] .  '/' . $tmp[9] . '/' . $tmp[10];
            $colaborador['periodo']['data_1'] = date('Y-m-d');
            $colaborador['periodo']['data_2'] = date('Y-m-d');
        
            unset($colaborador['pessoal']['usuario']);
        
            $query = criaQueryDeColaborador($colaborador, 0);
            
            # verificando se o registro da tabela de colaborador foi inserido com sucesso
            if (insereRegistroDeColaborador($db, $query)) {
              # verificando se o registro de histório de time foi inserido com sucesso
              if (insereHistoricoDoTimeDoUsuario($db, $cadastro['id_colaborador'], $time)) {
                # chamando função que insere as especialidades de acordo com os módulos selecionados
                insereEspecialidadesDoUsuario($db, $cadastro['id_colaborador'], $opcoes);

                # chamando função que insere um registro do usuário na carteira de avancoins
                insereCarteiraAvancoinsDoUsuario($db, $cadastro['id_colaborador']);
              }
            }
          }
        } else {
          $colaborador = defineArrayModeloDeColaborador();
      
          $colaborador['pessoal']['id'] = $cadastro['id_colaborador'];
          $colaborador['pessoal']['nome'] = $cadastro['nome'];
          $colaborador['pessoal']['sobrenome'] = $cadastro['sobrenome'];    
          $colaborador['periodo']['data_1'] = date('Y-m-d');
          $colaborador['periodo']['data_2'] = date('Y-m-d');
      
          unset($colaborador['pessoal']['usuario']);
      
          $query = criaQueryDeColaborador($colaborador, 0);
          
          # verificando se o registro da tabela de colaborador foi inserido com sucesso
          if (insereRegistroDeColaborador($db, $query)) {
            # verificando se o registro de histório de time foi inserido com sucesso
            if (insereHistoricoDoTimeDoUsuario($db, $cadastro['id_colaborador'], $time)) {
              # chamando função que insere as especialidades de acordo com os módulos selecionados
              insereEspecialidadesDoUsuario($db, $cadastro['id_colaborador'], $opcoes);

              # chamando função que insere um registro do usuário na carteira de avancoins
              insereCarteiraAvancoinsDoUsuario($db, $cadastro['id_colaborador']);
            }
          }
        }
      }

      $_SESSION['atividades']['tipo'] = 'success';
      $_SESSION['atividades']['mensagens'][] = 'O usuário cadastrado com sucesso.';
    }    
  } else {    
    $_SESSION['atividades']['mensagens'][] = 'O usuário já está cadastrado no portal Avanção.';
  }

  $_SESSION['atividades']['exibe'] = true;

  header('location: ' . BASE_URL . 'public/views/users/cadastro.php'); exit;
}

/**
 * responsável por verificar e retornar os dados de um usuário do chat
 * @param - string com o id do usuário
 */
function retornaDadosDoUsuarioDoChat($id) {
  require_once DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';

  $db = abre_conexao();

  $dados = consultaDadosDoUsuarioDoChat($db, $id);

  echo json_encode($dados[0]);
}

/**
 * responsável por atualizar os dados do usuário 
 * @param - array com os dados do formulário de conta
 */
function atualizaContaDoUsuario($usuario)
{
  require DIRETORIO_FUNCTIONS . 'users/atualiza_conta.php';

  $db = abre_conexao();

  # chamando função que atualiza o ramal do usuário
  $resultado = atualizaRamalDoUsuario($db, $usuario);

  # verificando se a consulta foi executada com sucesso
  if ($resultado) {

    # gerando mensagem de sucesso
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Tudo Certo!</strong> Dados atualizados com sucesso.</p>';
    $_SESSION['mensagens']['tipo']     = 'success';
    $_SESSION['mensagens']['exibe']    = true;

  } else {

    # gerando mensagem de erro
    $_SESSION['mensagens']['mensagem'] = '<p class="text-center"><strong>Ops!</strong> Os Dados não foram atualizados! Houve erro de SQL.</p>';
    $_SESSION['mensagens']['tipo']     = 'danger';
    $_SESSION['mensagens']['exibe']    = true;

  }

  fecha_conexao($db);

  # redirecionando usuário para página de conta
  header('Location: ' . BASE_URL . 'public/views/users/conta.php');

}

/**
 * responsável por consultar o ramal do usuário 
 * @param - array com os dados do formulário de conta
 */
function consultaRamalDoUsuario($usuario)
{
  require DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';

  $db = abre_conexao();

  # chamando função que retorna o ramal do usuário
  $ramal = retornaRamalDoUsuario($db, $usuario);

  fecha_conexao($db);

  return $ramal;

}

/**
 * responsável por consultar e retornar todos os ramais dos usuários 
 * @param - array com os dados do formulário de conta
 */
function consultaRamaisDosUsuarios()
{
  require DIRETORIO_FUNCTIONS . 'users/consulta_conta.php';

  $db = abre_conexao();

  # chamando função que retorna todos os ramais dos usuários
  $ramais = retornaTodosOsRamaisDosUsuarios($db);

  fecha_conexao($db);

  return $ramais;
  
}