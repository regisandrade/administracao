<?php 
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Alterar Link
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

$comando = "
	UPDATE links SET
		Descricao = '".$_GET['descricao']."',
		Link = '".$_GET['link1']."',
		Tipo = ".$_GET['tipo']."
	WHERE
		Codg_Link = ".$_GET['codg_link'];
mysql_query($comando) or die ("Erro na Alteração do Link. ".mysql_error());
?>
<script>
	alert('Link alterado com sucesso!');
	document.location='listar_links.php';	
</script>