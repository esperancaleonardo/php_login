<?php 

    session_start();

    include "professores.php";

    // verifica se NÃO existe a variavel de sessão logado
    if(!isset($_SESSION['logado']) || $_SESSION['logado'] != true   )
    {
        header("Location: ../html/login.html");
    }

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
    echo $pagina;

?>