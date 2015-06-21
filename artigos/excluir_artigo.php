<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Artigo
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = "DELETE FROM artigo WHERE Codg_Artigo = ".$_GET['codg_artigo'];
mysql_query($comando) or die ("Erro na Exclusão do Artigo. ".mysql_error());

$deletar_artigo = "../../artigos_publicados/".$_GET['artigo'];
unlink($deletar_artigo);

header("location: listar_artigos.php");
?>
