<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Aluno
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

//== Excluir Alunos
$comando  = "DELETE FROM aluno WHERE Id_Numero = '".$_REQUEST['id_numero']."' AND Ano = ".$_REQUEST['ano']." AND Curso = ".$_REQUEST['codgCurso'];
mysql_query($comando) or die ("Erro na Exclus�o do Aluno.");

//== Excluir Endere�o do Aluno
$comando_2  = "DELETE FROM endereco WHERE Id_Numero = '".$_REQUEST['id_numero']."'";
mysql_query($comando_2) or die ("Erro na Exclus�o do Endere�o do Aluno.");

//== Excluir Gradu��o do Aluno
$comando_3  = "DELETE FROM graduacao WHERE Id_Numero = '".$_REQUEST['id_numero']."'";
mysql_query($comando_3) or die ("Erro na Exclus�o da Gradua��o do Aluno.");

//== Excluir Login do Usu�rio Aluno
$comando_4  = "DELETE FROM usuario_aluno WHERE Id_Numero = '".$_REQUEST['id_numero']."'";
mysql_query($comando_4) or die ("Erro na Exclus�o do Login do Usu�rio.");

// Otimizar Tabelas
$sql = 'OPTIMIZE TABLE `aluno`, `endereco`, `graduacao`, `usuario_aluno`';
mysql_query($sql) or die ("Erro na Otimiza��o das Tabelas.");

header("location: alunosPotenciais.php".($_REQUEST['codgCurso'] ? '?codgCurso='.$_REQUEST['codgCurso'] : ''));
?>
