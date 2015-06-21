<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Inclusão do Link
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

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
mysql_query($comando) or die ("Erro na Gravação do Link. ".mysql_error());
?>
<script>
	alert('Link incluído com sucesso!');
	document.location='incluir_link.php';	
</script>