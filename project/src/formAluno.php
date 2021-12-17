<?php 

    session_start();

    include "cursos.php";

    // verifica se NÃO existe a variavel de sessão logado
    if(!isset($_SESSION['logado']) || $_SESSION['logado'] != true   )
    {
        header("Location: ../html/login.html");
    }

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
    echo $pagina;

?>