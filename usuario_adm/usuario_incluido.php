<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Inclus�o de Usuario
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados

//== Verificar existencia de Usuario
$comando = "SELECT * FROM usuario_adm WHERE Login = '$login'";
$result = mysql_query($comando) or die ("Erro na Consulta do Usu�rio. ".mysql_error());

$comando = "
	INSERT INTO	usuario_adm (
		Nome,
		Sexo,
		Login,
		Senha,
		Confirma
	)VALUES(
		'".$_REQUEST['nome']."',
		'".$_REQUEST['sexo']."',
		'".$_REQUEST['login']."',
		'".$_REQUEST['senha']."',
		'".$_REQUEST['confirmar']."'
	)
";
mysql_query($comando) or die ("Erro na Grava��o do Usu�rio. ".mysql_error());
?>
<script>
	alert('Usu�rio inclu�do com sucesso!');
	document.location='incluir_usuario.php';	
</script>
