<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Aluno
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

//== Excluir Login do Usu�rio Aluno
$comando_4  = "DELETE FROM usuario_aluno WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_4) or die ("Erro na Exclus�o do Login do Usu�rio.<br>Comando:".$comando_5."<br>Erro: ".mysql_error());

//== Excluir Gradu��o do Aluno
$comando_3  = "DELETE FROM graduacao WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_3) or die ("Erro na Exclus�o da Gradua��o do Aluno.<br>Comando:".$comando_3."<br>Erro: ".mysql_error());

//== Excluir Endere�o do Aluno
$comando_2  = "DELETE FROM endereco WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_2) or die ("Erro na Exclus�o do Endere�o do Aluno.<br>Comando:".$comando_2."<br>Erro: ".mysql_error());

//== Excluir Alunos
$comando  = "DELETE FROM aluno WHERE Id_Numero = '".$_GET['id_numero']."' AND Ano = ".$_GET['ano']."";
mysql_query($comando) or die ("Erro na Exclus�o do Aluno.<br>Comando:".$comando."<br>Erro: ".mysql_error());

// Otimizar Tabelas
$sql = 'OPTIMIZE TABLE `aluno`, `endereco`, `graduacao`, `usuario_aluno`'; 
mysql_query($sql) or die ("Erro na Otimiza��o das Tabelas.<br>Erro:".mysql_error());

header("location: alunos_cadastrados_pela_web.php");
?>