<?php
   /**
    * Alterar Senha de  Usuários
    * Utiliza a "biblioteca" usuarios.php
    *
    */

     session_start();


     if(isset($_POST['botaoCancelar'])){
          header("Location: ./menu.php");
          exit(0);
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
     
     $dados = getUsuarioViaLogin($_SESSION['cpf']);
     
     $novaSenha   = criptUsuario($_POST['senha']);
     
     $dados['senha'] = $novaSenha;
     $resultado = alteraSenha($dados);
     $mensagem="";
     if ($resultado){
          $mensagem = "<h4>Senha alterada com sucesso!</h4>";

     }
     else {
          $mensagem = "<h4>Não realizado. Ocorreu um erro.</h4>";
     }

     $_SESSION['senhaTrocada'] = True;
     $_SESSION['mensagem'] = $mensagem;
     
     header("Location: ./formAlteraSenha.php");
?>