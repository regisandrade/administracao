<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Link
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

$comando  = "DELETE FROM links WHERE Codg_Link = $codg_link";
mysql_query($comando) or die ("Erro na Exclus�o do Link. ".mysql_error());

header("location: listar_links.php");
?>