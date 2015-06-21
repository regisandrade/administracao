<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Inclusão de Aviso
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Data de Inclusão
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
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Inclusão do Aviso. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());
?>
<script>
	alert('Aviso incluído com sucesso!');
	document.location='incluir_aviso.php';	
</script>