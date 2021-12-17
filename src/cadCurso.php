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

     include "cursos.php";
     include "professores.php";
     

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
     $dados['nome']     = $_POST["nome"];
     $dados['area']     = $_POST["area"];
     $dados['spec']    = $_POST["spec"];
     $dados['ch']       = $_POST["ch"];
     $dados['data']     = $_POST["data"];
     $dados['hora']     = $_POST["hora"];
     $dados['tipo']     = $_POST["tipo"];
     $dados['local']    = $_POST["local"];
     $dados['professor']     = $_POST["professor"];
     
     
     $mensagem = criarCurso($dados);

     $nomes = getNomesProf();
     $nomes_options = '<option value="">Selecione uma opção</option>';

     if(!is_null($nomes)){
         foreach($nomes as $nome){
             $nomes_options = $nomes_options . '<option value="' . $nome . '">' . $nome . '</option>';
         }
     }
     else{
         $nomes_options = '<option value="">Sem professores cadastrados na base</option>';
     }
 
     $formCurso = file_get_contents("../html/formCurso.html");
     $formCurso = str_replace("<!----#PROFESSORES---->", $nomes_options, $formCurso);

     $menu    = file_get_contents("../html/menu.html");
     $pagina  = str_replace("<!-- #nao tire esse comentario -->", $formCurso, $menu);
     $pagina  = str_replace("<!--mensagem-->", $mensagem, $pagina);
     echo $pagina;

?>