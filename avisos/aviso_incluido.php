<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Inclus�o de Aviso
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados

//== Data de Inclus�o
$data_cadastro = date('Y-m-d');

$comando = "
	INSERT INTO	aviso (
		Titulo,
		Descricao,
		Data_Cadastro
	)VALUES(
		'".$_GET['titulo']."',
		'".$_GET['descricao']."',
		'$data_cadastro'
	)
";
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Inclus�o do Aviso. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());
?>
<script>
	alert('Aviso inclu�do com sucesso!');
	document.location='incluir_aviso.php';	
</script>