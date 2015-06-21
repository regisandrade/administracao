<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Exercício
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = "DELETE FROM exercicio WHERE Codg_Exercicio = ".$_REQUEST['codg_exercicio'];
mysql_query($comando) or die ("Erro na Exclusão do Exercício. ".mysql_error());

if (file_exists($_REQUEST['exercicio'])) {
	$deletar_exercicio = "/home/ipecon1/public_html/exercicios/".$_REQUEST['exercicio'];
	unlink($deletar_exercicio);
}

header("location: listar_exercicio.php");
?>