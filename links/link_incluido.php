<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Inclus�o do Link
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados

$comando = "
INSERT INTO	links (
	Descricao,
	Link,
	Tipo
)VALUES(
	'$descricao',
	'$link1',
	'$tipo'
)
";
mysql_query($comando) or die ("Erro na Grava��o do Link. ".mysql_error());
?>
<script>
	alert('Link inclu�do com sucesso!');
	document.location='incluir_link.php';	
</script>