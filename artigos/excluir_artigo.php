<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Artigo
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

$comando  = "DELETE FROM artigo WHERE Codg_Artigo = ".$_GET['codg_artigo'];
mysql_query($comando) or die ("Erro na Exclus�o do Artigo. ".mysql_error());

$deletar_artigo = "../../artigos_publicados/".$_GET['artigo'];
unlink($deletar_artigo);

header("location: listar_artigos.php");
?>
