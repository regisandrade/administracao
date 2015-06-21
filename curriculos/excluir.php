<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Curriculo
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = "DELETE FROM curriculo WHERE codgCurriculo = ".$_GET['codg_curriculo'];
mysql_query($comando) or die ("Erro na Exclusão do Curriculo. ".mysql_error());

/*$deletar_curriculo = "docs/".$_GET['curriculo'];
if (file_exists($deletar_curriculo)) {
	unlink($deletar_curriculo);
}*/

header("location: listar.php");
?>
