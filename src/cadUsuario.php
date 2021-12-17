<?php
   /**
    * Cadastrar Usuários
    * Utiliza a "biblioteca" usuarios.php
    *
    */

     session_start();


     if(isset($_POST['botaoCancelar'])){
          header("Location: ./menu.php");
     }

     include "usuarios.php";

     if ( !isset($_SESSION['logado'])){
          header("Location: ../html/login.html");
     }

     if ( $_SESSION['logado'] == false ){
          header("Location: ../html/login.html");
     }

     if ( !isset($_POST["cpf"]) ){
          header("Location: ../html/login.html");
     }
     
     $cpf     = $_POST["cpf"];
     $senha   = $_POST["senha"];
     $senha   = criptUsuario($senha);
     $email   = $_POST["email"];
     $dados   = array();
     $dados['login'] = $cpf;
     $dados['senha'] = $senha;
     $dados['email'] = $email;
     $resultado = criarUsuario($dados);
     $mensagem="";
     if ($resultado){
          $mensagem = "<h4>Cadastro realizado com sucesso!</h4>";
     }
     else {
          $mensagem = "<h4>Não realizado. Já existia um cadastro com esse mesmo login.</h4>";
     }
   
     $formUsu = file_get_contents("../html/formUsuario.html");
     $menu    = file_get_contents("../html/menu.html");
     $pagina  = str_replace("<!-- #nao tire esse comentario -->", $formUsu, $menu);
     $pagina  = str_replace("<!--mensagem-->", $mensagem, $pagina);
     echo $pagina;

?>