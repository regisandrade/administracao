<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Professor
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

$comando  = "DELETE FROM professor WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando) or die ("Erro na Exclus�o do Professor. ".mysql_error());

$comando_2  = "DELETE FROM endereco WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_2) or die ("Erro na Exclus�o do Endere�o do Professor. ".mysql_error());

//== Excluir Login do Usu�rio Professor
$comando_3  = "DELETE FROM usuario_professor WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_3) or die ("Erro na Exclus�o do Login do Professor.<br>Comando:".$comando_3."<br>Erro: ".mysql_error());

header("location: listar_professores.php");
?>