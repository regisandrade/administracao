<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Inclus�o de Curso
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados

/*
Campo status
1 => Ativo
2 => Inativo
*/
$comando = "
	INSERT INTO	curso (
		Nome,
		Qtde_Horas,
		Status
	)VALUES(
		'".$_GET['nome']."',
		'".$_GET['qtde_horas']."',
		1
	)
";
mysql_query($comando) or die ("Erro na Grava��o do Curso. ".mysql_error());
?>
<script>
	alert('Curso inclu�do com sucesso!');
	document.location='incluir_curso.php';	
</script>