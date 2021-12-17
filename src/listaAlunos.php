<?php
   /**
    * Cadastrar Usuários
    * Utiliza a "biblioteca" usuarios.php
    *
    */

     session_start();

     include "alunos.php";

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
     $tabela = str_replace("<!--TITULO-->","LISTAGEM DE ALUNOS CADASTRADOS",$tabela);

     $header = "<th scope='col'>Nome</th><th scope='col'>RA</th><th scope='col'>Data Nascimento</th><th scope='col'>Idade (anos)</th><th scope='col'>Gênero</th><th scope='col'>Cidade</th><th scope='col'>Estado</th><th scope='col'>Curso</th>";
     $tabela = str_replace("<!--COLUNAS-->",$header,$tabela);


     $alunos = getAlunos();

     $dadosTabela = "<tr>";

     foreach($alunos as $aluno){

          $nasc = new DateTime($aluno['dataNasc']);
          $hoje = new DateTime("now");
          $idade = $nasc->diff($hoje);

          $dadosTabela = $dadosTabela . "<td>" . $aluno['nome'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $aluno['ra'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $aluno['dataNasc'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $idade->y . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $aluno['gereno'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $aluno['cidade'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $aluno['estado'] . "</td>";
          $dadosTabela = $dadosTabela . "<td>" . $aluno['curso'] . "</td>";
          $dadosTabela = $dadosTabela . "</tr><tr>";

     }
     $tabela = str_replace("<!--DADOS-->",$dadosTabela,$tabela);


     $menu    = file_get_contents("../html/menu.html");
     $pagina  = str_replace("<!-- #nao tire esse comentario -->", $tabela, $menu);
     echo $pagina;

?>