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

     include "professores.php";

     if ( !isset($_SESSION['logado'])){
          header("Location: ../html/login.html");
     }

     if ( $_SESSION['logado'] == false ){
          header("Location: ../html/login.html");
     }

     if ( !isset($_POST["cpf"]) ){
          header("Location: ../html/login.html");
     }

     $dados   = array();
     $dados['ra']            = $_POST["ra"];
     $dados['cpf']           = $_POST["cpf"];
     $dados['dataNasc']      = $_POST["dataNasc"];
     $dados['titulo']        = $_POST["titulo"];
     $dados['nome']          = $_POST["nome"];
     $dados['email']         = $_POST["email"];
     $dados['ramal']         = $_POST["ramal"];
     $dados['setor']         = $_POST["setor"];
     $dados['locacao']       = $_POST["locacao"];
     $dados['curso']         = $_POST["curso"];
     
     $mensagem = criarProfessor($dados);
     
     $formProf = file_get_contents("../html/formProfessor.html");
     $menu    = file_get_contents("../html/menu.html");
     $pagina  = str_replace("<!-- #nao tire esse comentario -->", $formProf, $menu);
     $pagina  = str_replace("<!--mensagem-->", $mensagem, $pagina);
     echo $pagina;

?>