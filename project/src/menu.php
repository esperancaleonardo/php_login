<?php
session_start();

// verifica se NÃO existe a variavel de sessão logado
if(!isset($_SESSION['logado']) || $_SESSION['logado'] != true   )
{
    header("Location: ../html/login.html");
}

$textoMenu = file_get_contents("../html/textoMenu.html");
$menu = file_get_contents("../html/menu.html");
$pagina  = str_replace("<!-- #nao tire esse comentario -->", $textoMenu, $menu);


echo $pagina;
?>