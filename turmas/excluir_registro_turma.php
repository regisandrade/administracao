<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Turma
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco
$comando  = "DELETE FROM turma WHERE Ano = ".$_REQUEST['ano']." AND Turma = '".$_REQUEST['turma']."' AND Curso = ".$_REQUEST['curso']." AND Disciplina = ".$_REQUEST['disciplina']." AND Professor = '".$_REQUEST['professor']."'";
mysql_query($comando) or die ("Erro na Exclus�o da Turma. ".mysql_error());

header("location: gride_turmas.php?ano=".$_REQUEST['ano']."&codigo=".$_REQUEST['turma']);
?>