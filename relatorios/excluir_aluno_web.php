<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Aluno
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

//== Excluir Login do Usuário Aluno
$comando_4  = "DELETE FROM usuario_aluno WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_4) or die ("Erro na Exclusão do Login do Usuário.<br>Comando:".$comando_5."<br>Erro: ".mysql_error());

//== Excluir Gradução do Aluno
$comando_3  = "DELETE FROM graduacao WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_3) or die ("Erro na Exclusão da Graduação do Aluno.<br>Comando:".$comando_3."<br>Erro: ".mysql_error());

//== Excluir Endereço do Aluno
$comando_2  = "DELETE FROM endereco WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_2) or die ("Erro na Exclusão do Endereço do Aluno.<br>Comando:".$comando_2."<br>Erro: ".mysql_error());

//== Excluir Alunos
$comando  = "DELETE FROM aluno WHERE Id_Numero = '".$_GET['id_numero']."' AND Ano = ".$_GET['ano']."";
mysql_query($comando) or die ("Erro na Exclusão do Aluno.<br>Comando:".$comando."<br>Erro: ".mysql_error());

// Otimizar Tabelas
$sql = 'OPTIMIZE TABLE `aluno`, `endereco`, `graduacao`, `usuario_aluno`'; 
mysql_query($sql) or die ("Erro na Otimização das Tabelas.<br>Erro:".mysql_error());

header("location: alunos_cadastrados_pela_web.php");
?>