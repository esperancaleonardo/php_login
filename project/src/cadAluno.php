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

     include "alunos.php";
     include "cursos.php";
     

     if ( !isset($_SESSION['logado'])){
          header("Location: ../html/login.html");
     }

     if ( $_SESSION['logado'] == false ){
          header("Location: ../html/login.html");
     }

     if ( !isset($_POST["nome"]) ){
          header("Location: ../html/login.html");
     }

     $dados   = array();
     $dados['nome']           = $_POST["nome"];
     $dados['ra']             = $_POST["ra"];
     $dados['end']            = $_POST["end"];
     $dados['dataNasc']       = $_POST["dataNasc"];
     $dados['gereno']         = $_POST["gereno"];
     $dados['formacao']       = $_POST["formacao"];
     $dados['cidade']         = $_POST["cidade"];
     $dados['estado']         = $_POST["estado"];
     $dados['curso']          = $_POST["curso"];

     $mensagem = criarAluno($dados);
     

     $nomes = getNomes();
     $nomes_options = '<option value="">Selecione uma opção</option>';
     foreach($nomes as $nome){
         $nomes_options = $nomes_options . '<option value="' . $nome . '">' . $nome . '</option>';
     }
 
     $estados = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
 
     $estados_options = '<option value="">Selecione uma opção</option>';
     foreach($estados as $estado){
         $estados_options = $estados_options . '<option value="' . $estado . '">' . $estado . '</option>';
     }
 
 
     $formAluno = file_get_contents("../html/formAluno.html");
     $formAluno = str_replace("<!----- CURSOS ----->", $nomes_options, $formAluno);
     $formAluno = str_replace("<!--- ESTADOS --->", $estados_options, $formAluno);
 
     $menu    = file_get_contents("../html/menu.html");

     $pagina  = str_replace("<!-- #nao tire esse comentario -->", $formAluno, $menu);
     $pagina  = str_replace("<!--mensagem-->", $mensagem, $pagina);
     echo $pagina;

?>