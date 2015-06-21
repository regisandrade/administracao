<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Link
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = "DELETE FROM links WHERE Codg_Link = $codg_link";
mysql_query($comando) or die ("Erro na Exclusão do Link. ".mysql_error());

header("location: listar_links.php");
?>