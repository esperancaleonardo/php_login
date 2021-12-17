<?php
/**
 * Cursos.php
 * Cuida das funções que tratam o cadastro JSON de professores
 * 
 */

 /**
  * getProfessores()
  * retorna um array com dados de professores lidos em um arquivo json
  */
function getCursos()
{
  return json_decode(file_get_contents(__DIR__ . '/cursos.json'), true);
}



function getNomes(){
  $nomes = array();
  $cursos   = getCursos();

  if(!is_null($cursos) and count($cursos) > 0){
    foreach($cursos as $curso){
      $nomes[] = $curso['nome'];
    }
  
    return $nomes;
  }
  else{
    $nomes[] = 'Sem Curso Cadastrado';
    return $nomes;
  }
}

/**
 * criarProfessor()
 * 
 * Recebe um array com os dados do novo professor
 * 
 */
function criarCurso($dadosCurso)
{
    $cursos   = getCursos();

    if(!is_null($cursos) and is_null(getCurso($dadosCurso['nome']))){
      if(count($cursos) == 0){
        $cursos[0]  = $dadosCurso;
        gravarJson($cursos);
        return "<h4>Novo curso cadastrado com sucesso!</h4>";
      }
      else if (count($cursos) > 0){
        $cursos[]  = $dadosCurso;
        gravarJson($cursos);
        return "<h4>Novo curso cadastrado com sucesso!</h4>";
      }
    }
    else {
      if(!is_null(getCurso($dadosCurso['nome']))){
        return "<h4>Curso já cadastrado no sistema.</h4>";
      }
      return "<h4>Não realizado. Ocorreu um erro.</h4>";
    }
}


function getCurso($nome)
{
  $cursos   = getCursos();
  foreach($cursos as $curso){
    if ( $curso['nome']  ==  $nome ){
        return $curso;
    }
  }
  return null;
}


function gravarJson($cursos)
{
    file_put_contents(__DIR__ . '/cursos.json', json_encode($cursos));
}
?>