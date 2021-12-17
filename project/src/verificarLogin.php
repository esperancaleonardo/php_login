<?php
session_start();

include "usuarios.php";

// Vamos receber os dados do formulario
// através do método post

// $cpf 		= $_POST["cpf"];
// $senha	= $_POST["senha"];

// $cpf		= $_GET["cpf"];
// $senha	= $_GET["senha"];

// verifica se tem a variável definida no html
// se  ñ existe a variával executa o que tiver na chave
if( !(isset($_REQUEST["cpf"])) ){
    header("Location: ../html/erro.html");
    exit(0);
}

$cpf 		= $_REQUEST["cpf"];
$senha   	= $_REQUEST["senha"];
$senha      = criptUsuario($senha);  // criptografa a senha com md5 

$dadosUsuario = getUsuarioViaLogin($cpf);
if(is_null($dadosUsuario)){
    header("Location: ../html/erro.html");
    exit(0);     
}

// esperado que o usuario digite oi
if( $senha == $dadosUsuario['senha'] ){
    $_SESSION['logado'] = true;
    $_SESSION['cpf']    = $cpf;

    // Faz um redirecionamento para menu.php
    header("Location: menu.php");

}
else{
    header("Location: ../html/erro.html");
    exit();   
}

// verificar se cpf tem conteúdo
if( $cpf == "" ){
    header("Location: ../html/erro.html");
    exit();
}
/*
echo "<br><h2>Recebi o cpf = $cpf <br> " .
     "Senha digitada: " . $_REQUEST['senha'] . " <br>" .
     "Senha criptografada: $senha</h2>";
*/
$mensagem = "<br><h2>Recebi o cpf = $cpf <br> " .
            "Senha digitada: " . $_REQUEST['senha'] . " <br>" .
            "Senha criptografada: $senha</h2>";
echo $mensagem;




?>