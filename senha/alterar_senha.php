<?php session_start(); ?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_senha.login.value==''){
		alert('Favor, digitar o Login.');
		document.form_senha.login.focus();
		return false;
	}

	if(document.form_senha.senha_antiga.value==''){
		alert('Favor, digitar a Senha Antiga.');
		document.form_senha.senha_antiga.focus();
		return false;
	}

	if(document.form_senha.nova_senha.value==''){
		alert('Favor, digitar a Nova Senha.');
		document.form_senha.nova_senha.focus();
		return false;
	}

	if(document.form_senha.repetir_senha.value==''){
		alert('Favor, repetir a Senha.');
		document.form_senha.repetir_senha.focus();
		return false;
	}
	
	if(document.form_senha.nova_senha.value == document.form_senha.repetir_senha.value){
		return true;
	}else{
		alert('A nova Senha esta diferente da repetir Senha.\nTente novamente.');
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
	<!-- Conteúdo -->
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Alterar senha </h3>
			</div></td>
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
			<form name="form_senha" method="get" action="senha_alterada.php" onSubmit="return Verificar()">
			<input name="login" type="hidden" value="<?php print($_SESSION['login']); ?>">
			  <?php
			  if(!isset($msg)){
				echo '';
			  }else{
			  ?>
			  <tr> 
				<td width="18%" height="22">&nbsp;</td>
				<td width="82%" style="padding-left: 0.3em"><font color="#FF0000"><?php print($msg); ?></font></td>
			  </tr>
			  <?php
			  }
			  ?>
			  <tr> 
				<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Nova senha:</td>
				<td style="padding-left: 0.3em"><input name="nova_senha" type="password" class="TextoFormulario" id="nova_senha" size="15" maxlength="15"></td>
			  </tr>
			  <tr> 
				<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Repetir senha:</td>
				<td style="padding-left: 0.3em"><input name="repetir_senha" type="password" class="TextoFormulario" id="repetir_senha" size="15" maxlength="15"></td>
			  </tr>
			  <tr> 
				<td height="40" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				<td style="padding-left: 0.3em"><input name="alterar" type="submit" id="alterar" value="Alterar"> 
				  &nbsp;&nbsp; <input type="button" name="voltar" value="Cancelar" onClick="history.back()"></td>
			  </tr>
			  <tr> 
				<td height="22" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				<td valign="middle" style="padding-left: 0.3em">
				<ul>
					<li class="Texto" style="color:#FF0000">Nova senha no m&aacute;ximo 15 letras e/ou n&uacute;mero;</li>
				</ul></td>
			  </tr>
			  <script language="JavaScript">document.form_senha.nova_senha.focus()</script>
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