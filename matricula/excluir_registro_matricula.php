<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Matricula
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco
$comando  = "DELETE FROM matricula WHERE Ano = ".$_GET['ano']." AND Turma = '".$_GET['turma']."' AND Aluno = '".$_GET['aluno']."' AND Disciplina = ".$_GET['disciplina'];
mysql_query($comando) or die ("Erro na Exclus�o da Matricula. ".mysql_error());

// academicos
$cmd_academicos  = "DELETE FROM alunos_academicos WHERE Ano = ".$_GET['ano']." AND Turma = '".$_GET['turma']."' AND Disciplina = ".$_GET['disciplina']." AND Aluno = '".$_GET['aluno']."'";
mysql_query($cmd_academicos) or die ("Erro na Exclus�o da alunos_academicos. ".mysql_error());

header("location: resultado.php?turma=".$_GET['turma']."|".$_GET['nome_turma']."|".$_GET['ano']."|".$_GET['curso']);
?>