<?php
require('../conexao.php');

// Alterar a senha
if(isset($_REQUEST['btnAlterar']) && $_REQUEST['senha'] != '' && $_REQUEST['login'] != ''){
	$comando = "UPDATE usuario_aluno SET Senha = '".$_REQUEST['senha']."', Login = '".$_REQUEST['login']."' WHERE Sequencia = ".$_REQUEST['seq'];
	if(mysql_query($comando) or die($comando.'Erro na alteração da tabela'.mysql_error())){
		$mensagem = "Senha alterada com sucesso!";
	}
	
}

// Consultar dados do aluno na tabela de usuario_aluno
$sql = "SELECT * FROM usuario_aluno WHERE Sequencia = ".$_REQUEST['seq'];
$resultado = mysql_query($sql) or die('Erro na consulta da tabela');
$dados = mysql_fetch_array($resultado);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/xhtml1-loose.dtd">
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<link href="css/siteAdm.css" rel="stylesheet" type="text/css"></link>
</head>
<body>
<h3 align="center">Alterar a senha do aluno</h3>
<br />
<center><strong><?php echo isset($mensagem) ? $mensagem : ""; ?></strong></center>
<form name="frmAlterarAluno" action="alterarSenhaAluno.php" method="post">
	<input type="hidden" name="seq" value="<?=$_REQUEST['seq']?>" />
	<table width="100%" cellpadding="0" cellspacing="4" border="0" align="left">
		<tr>
			<td><strong>Aluno:</strong></td>
			<td><?=$dados['Nome']?></td>
		</tr>
		<tr>
			<td><strong>Usuário:</strong></td>
			<td><input type="text" name="login" size="30" class="campo" value="<?=$dados['Login']?>" /></td>
		</tr>
		<tr>
			<td><strong>Senha atual:</strong></td>
			<td><?=$dados['Senha']?></td>
		</tr>
		<tr style="background-color: #FFFFF0">
			<td>Senha nova:</td>
			<td><input type="text" name="senha" size="20" class="campo" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="btnAlterar" value="Alterar" class="botao" />&nbsp;<input type="button" name="btnVoltar" value="Fechar" onClick="window.close()"  class="botao" /></td>
		</tr>
	</table>
</form>
</body>
</html>