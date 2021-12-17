<?php
   /**
    * Cadastrar Usuários
    * Utiliza a "biblioteca" usuarios.php
    *
    */

     session_start();

     include "professores.php";

     if ( !isset($_SESSION['logado'])){
          header("Location: ../html/login.html");
     }

     if ( $_SESSION['logado'] == false ){
          header("Location: ../html/login.html");
     }

     if ( !isset($_SESSION["cpf"]) ){
          header("Location: ../html/login.html");
     }
     
     
     $tabela = file_get_contents("../html/tabela.html");
     $tabela = str_replace("<!--TITULO-->","LISTAGEM DE PROFESSORES CADASTRADOS",$tabela);

     $header = "<th scope='col'>Nome do Professor</th><th scope='col'>Titularidade</th><th scope='col'>RA</th><th scope='col'>Curso</th><th scope='col'>E-mail Institucional</th>";
     $tabela = str_replace("<!--COLUNAS-->",$header,$tabela);


     $professores = getProfessores();

     $dadosTabela = "<tr>";

     foreach($professores as $professor){
          $dadosTabela = $dadosTabela . "<td>" . $professor['nome'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $professor['titulo'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $professor['ra'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $professor['curso'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $professor['email'] . "</td>";


          $dadosTabela = $dadosTabela . "</tr><tr>";

     }
     $tabela = str_replace("<!--DADOS-->",$dadosTabela,$tabela);


     $menu    = file_get_contents("../html/menu.html");
     $pagina  = str_replace("<!-- #nao tire esse comentario -->", $tabela, $menu);
     echo $pagina;

?>