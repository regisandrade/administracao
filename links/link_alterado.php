<?php 
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Alterar Link
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados

$comando = "
	UPDATE links SET
		Descricao = '".$_GET['descricao']."',
		Link = '".$_GET['link1']."',
		Tipo = ".$_GET['tipo']."
	WHERE
		Codg_Link = ".$_GET['codg_link'];
mysql_query($comando) or die ("Erro na Altera��o do Link. ".mysql_error());
?>
<script>
	alert('Link alterado com sucesso!');
	document.location='listar_links.php';	
</script>