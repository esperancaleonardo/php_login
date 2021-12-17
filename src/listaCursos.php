<?php
   /**
    * Cadastrar Usuários
    * Utiliza a "biblioteca" usuarios.php
    *
    */

     session_start();

     include "cursos.php";

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
     $tabela = str_replace("<!--TITULO-->","LISTAGEM DE CURSOS CADASTRADOS",$tabela);

     $header = "<th scope='col'>Nome</th><th scope='col'>Professor</th><th scope='col'>Grande Área</th><th scope='col'>Especialização</th><th scope='col'>CH</th><th scope='col'>Data</th><th scope='col'>Hora</th><th scope='col'>Tipo</th>";
     $tabela = str_replace("<!--COLUNAS-->",$header,$tabela);


     $cursos = getCursos();

     $dadosTabela = "<tr>";

     foreach($cursos as $curso){
          $dadosTabela = $dadosTabela . "<td>" . $curso['nome'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $curso['professor'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $curso['area'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $curso['spec'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $curso['ch'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $curso['data'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $curso['hora'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $curso['tipo'] . "</td>";
          $dadosTabela = $dadosTabela . "</tr><tr>";

     }
     $tabela = str_replace("<!--DADOS-->",$dadosTabela,$tabela);


     $menu    = file_get_contents("../html/menu.html");
     $pagina  = str_replace("<!-- #nao tire esse comentario -->", $tabela, $menu);
     echo $pagina;

?>