<?php
/**
 * professores.php
 * Cuida das funções que tratam o cadastro JSON de professores
 * 
 */

 /**
  * getProfessores()
  * retorna um array com dados de professores lidos em um arquivo json
  */
function getProfessores()
{
  return json_decode(file_get_contents(__DIR__ . '/professores.json'), true);
}



function getNomesProf(){
  $nomes = array();
  $professores   = getProfessores();

  if(!is_null($professores) and count($professores) > 0){
    foreach($professores as $professor){
      $nomes[] = $professor['nome'];
    }
  
    return $nomes;
  }
  else{
    $nomes = null;
    return $nomes;
  }
}

/**
 * criarProfessor()
 * 
 * Recebe um array com os dados do novo professor
 * 
 */
function criarProfessor($dadosProfessor)
{
    $professores   = getProfessores();

    if(!is_null($professores) and is_null(getProfessor($dadosProfessor['ra']))){
      if(count($professores) == 0){
        $professores[0]  = $dadosProfessor;
        gravarJsonProf($professores);
        return "<h4>Novo professor cadastrado com sucesso!</h4>";
      }
      else if (count($professores) > 0){
        $professores[]  = $dadosProfessor;
        gravarJsonProf($professores);
        return "<h4>Novo professor cadastrado com sucesso!</h4>";
      }
    }
    else {
      if(!is_null(getProfessor($dadosProfessor['ra']))){
        return "<h4>RA de professor já cadastrado no sistema.</h4>";
      }
      return "<h4>Não realizado. Ocorreu um erro.</h4>";
    }
}


function getProfessor($ra)
{
  $professores   = getProfessores();
  foreach($professores as $professor){
    if ( $professor['ra']  ==  $ra ){
        return $professor;
    }
  }
  return null;
}


function gravarJsonProf($professores)
{
    file_put_contents(__DIR__ . '/professores.json', json_encode($professores));
}
?>