<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
td{
	font: normal 0.7em/1em Verdana, Arial, Helvetica, sans-serif;
}
.TextoFormulario{
	font: normal 0.9em/1em Verdana, Arial, Helvetica, sans-serif;
	border: solid 1px #999999;
}
-->
</style>
<script>
function fechar(){
	window.opener.location.reload();
	self.close();
}
</script>
</head>
<body>
<?php
require('../../conexao.php');

if(isset($_REQUEST['btnGravar'])){
	$comando = "UPDATE aluno SET Ano=".$_REQUEST['ano']." WHERE Sequencia = ".$_REQUEST['seq'];
	//echo $comando;
	$result = mysql_query($comando) or die ("Erro no Update do Aluno.<br>Comando:".$comando."<br>Erro: ".mysql_error());

	echo "<center>";
	echo "Ano alterado com sucesso.<br />";
	echo "<input type=\"button\" name=\"btnFechar\" value=\"Fechar Janela\" onClick=\"JavaScript:fechar();\" class=\"TextoFormulario\" />";
	echo "</center>";
	die();
}
?>

<form name="" action="" method="get">
<input type="hidden" name="seq" value="<?=$_REQUEST['seq']?>" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
		<td colspan="2" valign="top" height="25"><h3 align="center">Alunos Cadastrados pela Internet</h3></td>
	</tr>
	<tr>
		<td colspan="2" height="5"></td>
	</tr>
	<tr>
		<td colspan="2"><b>Alterar o Ano de cadastro do aluno</b></td>
	</tr>
	<tr>
		<td height="20" width="20%"><b>Aluno:</b></td>
		<td width="80%"><i><?=$_REQUEST['nome']?></i></td>
	</tr>
	<tr>
		<td><b>Ano:</b></td>
		<td><i><?=$_REQUEST['ano']?></i></td>
	</tr>
	<tr bgcolor="#EEEEEE">
		<td><b>Novo Ano:</b></td>
		<td><?php include('../../form_ano.php'); ?></td>
	</tr>
	<tr>
		<td height="35">&nbsp;</td>
		<td><input type="submit" name="btnGravar" value="Gravar" class="TextoFormulario" /></td>
	</tr>
</table>
</form>
</body>
</html>