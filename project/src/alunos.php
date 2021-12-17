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
function getAlunos()
{
  return json_decode(file_get_contents(__DIR__ . '/alunos.json'), true);
}


/**
 * criarProfessor()
 * 
 * Recebe um array com os dados do novo professor
 * 
 */
function criarAluno($dadosAluno)
{
    $alunos   = getAlunos();

    if(!is_null($alunos) and is_null(getAluno($dadosAluno['ra']))){
      if(count($alunos) == 0){
        $alunos[0]  = $dadosAluno;
        gravarJsonAlunos($alunos);
        return "<h4>Novo aluno cadastrado com sucesso!</h4>";
      }
      else if (count($alunos) > 0){
        $alunos[]  = $dadosAluno;
        gravarJsonAlunos($alunos);
        return "<h4>Novo aluno cadastrado com sucesso!</h4>";
      }
    }
    else {
      if(!is_null(getAluno($dadosAluno['ra']))){
        return "<h4>Aluno já cadastrado no sistema.</h4>";
      }
      return "<h4>Não realizado. Ocorreu um erro.</h4>";
    }
}


function getAluno($ra)
{
  $alunos   = getAlunos();
  foreach($alunos as $aluno){
    if ( $aluno['ra']  ==  $ra ){
        return $aluno;
    }
  }
  return null;
}


function gravarJsonAlunos($alunos)
{
    file_put_contents(__DIR__ . '/alunos.json', json_encode($alunos));
}
?>