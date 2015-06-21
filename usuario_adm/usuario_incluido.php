<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Inclusão de Usuario
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Verificar existencia de Usuario
$comando = "SELECT * FROM usuario_adm WHERE Login = '$login'";
$result = mysql_query($comando) or die ("Erro na Consulta do Usuário. ".mysql_error());

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
mysql_query($comando) or die ("Erro na Gravação do Usuário. ".mysql_error());
?>
<script>
	alert('Usuário incluído com sucesso!');
	document.location='incluir_usuario.php';	
</script>
