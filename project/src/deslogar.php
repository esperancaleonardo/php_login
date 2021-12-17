<?php
session_start();

// verifica se NÃO existe a variavel de sessão logado
if(isset($_SESSION['logado']) || $_SESSION['logado'] == true   )
{
    $_SESSION['logado'] = false;
}

header("Location: ../html/login.html");
?>