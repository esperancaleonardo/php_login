<?php
session_start();
include "usuarios.php";


// verifica se NÃO existe a variavel de sessão logado
if(!isset($_SESSION['logado']) || $_SESSION['logado'] != true   )
{
    header("Location: ../html/login.html");
}


$dadosUsuario = getUsuarioViaLogin($_SESSION['cpf']);


$formUsu = file_get_contents("../html/formAlteraSenha.html");
$CPF = '<input id="cpf" name="cpf" type="text" class="form-control" placeholder="CPF para login" disabled value="' . $dadosUsuario['login'] .'">';

$formUsu = str_replace("<!----VALOR_CPF_JSON---->",$CPF,$formUsu);

$email = '<input id="email" name="email" type="email" class="form-control" placeholder="Email para contato" disabled value="' . $dadosUsuario['email'] .'">';


$formUsu = str_replace("<!----VALOR_EMAIL_JSON---->",$email,$formUsu);

if(isset($_SESSION['senhaTrocada'])){
    if($_SESSION['senhaTrocada'] == True){
        $_SESSION['senhaTrocada'] = False;
        $mensagem = $_SESSION['mensagem'];
        $formUsu  = str_replace("<!--mensagem-->", $mensagem, $formUsu);    
    }
}


$menu    = file_get_contents("../html/menu.html");
$pagina  = str_replace("<!-- #nao tire esse comentario -->", $formUsu, $menu);
echo $pagina;
?>