<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Inclusão de Curso
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

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
mysql_query($comando) or die ("Erro na Gravação do Curso. ".mysql_error());
?>
<script>
	alert('Curso incluído com sucesso!');
	document.location='incluir_curso.php';	
</script>