<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Exerc�cio
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

$comando  = "DELETE FROM exercicio WHERE Codg_Exercicio = ".$_REQUEST['codg_exercicio'];
mysql_query($comando) or die ("Erro na Exclus�o do Exerc�cio. ".mysql_error());

if (file_exists($_REQUEST['exercicio'])) {
	$deletar_exercicio = "/home/ipecon1/public_html/exercicios/".$_REQUEST['exercicio'];
	unlink($deletar_exercicio);
}

header("location: listar_exercicio.php");
?>