<?php
/**
 * usuarios.php
 * Cuida das funções que tratam o cadastro JSON de usuários
 * 
 */

 /**
  * getUsuarios()
  * retorna um array com dados de usuários lidos em um arquivo json
  */
function getUsuarios()
{
  return json_decode(file_get_contents(__DIR__ . '/usuarios.json'), true);
}


/**
 * getUsuarioViaLogin()
 * 
 * Recebe um campo com o login.
 * identificar um usuário através do campo do login.
 * Vai retornar todos os campos do usuário identificado. Se não achar retorna nulo.
 *
 */
function getUsuarioViaLogin($login)
{
  $usuarios   = getUsuarios();
  foreach($usuarios as $usuario){
    if ( $usuario['login']  ==  $login ){
        return $usuario;
    }

  }
  return null;
}

/**
 * criarUsuario()
 * 
 * Recebe um array com os dados do novo usuário onde a senha virá já criptografada
 * 
 */
function criarUsuario($dadosUsuario)
{
    $usuarios   = getUsuarios();
    $dados      = getUsuarioViaLogin($dadosUsuario['login']);
    if ( is_null($dados)){
           $usuarios[]  = $dadosUsuario;  // atribui dados do novo usuário para a próxima 
                                          // posição disponivel no array usuarios
           gravarJson($usuarios);
           return true;
    }
    else {
      return false;
    }
}

/**
 * Criptografa a senha, incluindo uma cadeia de caracteres para deixa-la mais forte.
 * 
 */
function criptUsuario($senha = "1s3#")
{
  $senha      = $senha . "!3@Ç";
  $senha      = md5($senha);
  return $senha;
}


/**
 * Altera a senha do usuário logado
 * 
 */
function alteraSenha($dadosUsuario)
{
  $usuarios   = getUsuarios();

  foreach($usuarios as $key => $usuario){
    if ( $usuario['login']  ==  $dadosUsuario['login']){
      $usuarios[$key]['senha'] = $dadosUsuario['senha'];
    }
  }
  gravarJson($usuarios);
  return true;
}




function gravarJson($usuarios)
{
    file_put_contents(__DIR__ . '/usuarios.json', json_encode($usuarios));
}
?>