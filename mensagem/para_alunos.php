<?php
session_start();
require('../../conexao.php'); //== Conex�o com o Banco de Dados
?>
<html>
<head>
<title>Administra��o :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_mail.assunto.value==''){
		alert('Favor, digitar o Assunto da Mensagem.');
		document.form_mail.assunto.focus();
		return false;
	}

	if(document.form_mail.mensagem.value==''){
		alert('Favor, digitar a Mensagem.');
		document.form_mail.mensagem.focus();
		return false;
	}
}
</script>
<style type="text/css">
<!--
.style1 {
	font-size: x-small;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19" height="19"><img src="../img_menu/top_esquerda.gif" width="19" height="19"></td>
    <td width="162" height="19" background="../img_menu/topo.gif">&nbsp;</td>
    <td width="19"><img src="../img_menu/top_direita.gif" width="19" height="19"></td>
  </tr>
  <tr>
    <td height="100%" background="../img_menu/esquerda.gif">&nbsp;</td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
	<!-- Conte�do -->
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Mensagem para os Alunos</h3></div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
		</tr>
		<tr>
			<td colspan="2" valign="top">
		  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<form name="form_mail" method="post" action="mail_aluno.php" onSubmit="return Verificar()">
			  <tr align="center"> 
				<td height="22" colspan="2" class="Texto" style="padding-left: 0.3em">Para
				  enviar a mensagem, preencha os campos abaixo e click em Enviar.</td>
			  </tr>
			  <tr> 
				<td height="7" colspan="2" background="../../imagens/spacer.gif"></td>
			  </tr>
			  <tr> 
				<td width="18%" align="right" valign="top" class="Texto" style="padding-left: 0.3em">Aluno :</td>
				<td width="82%" style="padding-left: 0.3em"><input name="para" type="text" class="TextoFormulario" size="45" value="<?=$_GET['aluno'];?>"></td>
			  </tr>
			  <tr>
				<td align="right" class="Texto" style="padding-left: 0.3em">Assunto :</td>
				<td style="padding-left: 0.3em"><input name="assunto" type="text" class="TextoFormulario" id="assunto" size="45"></td>
			  </tr>
			  <tr>
				<td align="right" valign="top" class="Texto" style="padding-left: 0.3em">Mensagem :</td>
				<td style="padding-left: 0.3em"><textarea name="mensagem" cols="45" rows="5" id="mensagem" class="TextoFormulario"></textarea></td>
			  </tr>
			  <tr> 
				<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				<td style="padding-left: 0.3em"><input name="ok" type="submit" id="ok" value="Enviar">&nbsp;&nbsp;<input type="button" name="voltar" value="Voltar" onClick="history.back(-1)"></td>
			  </tr>
			<script language="JavaScript">document.form_mail.assunto.focus();</script>
			</form>
		  </table>
			</td>
		</tr>
	</table>
	<!-- Fim -->
	</td>
    <td background="../img_menu/direita.gif">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../img_menu/baixo_esquerda.gif" width="19" height="19"></td>
    <td height="19" background="../img_menu/baixo.gif">&nbsp;</td>
    <td><img src="../img_menu/baixo_direita.gif" width="19" height="19"></td>
  </tr>
</table>
</body>
</html>