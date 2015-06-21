<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_usuario.nome.value==''){
		alert('Favor, digitar o Nome do Usuário.');
		document.form_usuario.nome.focus();
		return false;
	}

	if(document.form_usuario.login.value==''){
		alert('Favor, digitar o Login do Usuário.');
		document.form_usuario.login.focus();
		return false;
	}

	if(document.form_usuario.senha.value==''){
		alert('Favor, digitar a Senha do Usuário.');
		document.form_usuario.senha.focus();
		return false;
	}

	if(document.form_usuario.confirmar.value==''){
		alert('Favor, digitar a Confirmação da Senha do Usuário.');
		document.form_usuario.confirmar.focus();
		return false;
	}
	
	if(document.form_usuario.senha.value == document.form_usuario.confirmar.value){
		return true;
	}else{
		alert('A Senha esta diferente da Confirma Senha.');
		document.form_usuario.senha.focus();
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
			  <h3>Cadastro de Usu&aacute;rio </h3>
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
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="Texto">
				<form name="form_usuario" method="get" action="usuario_incluido.php" onSubmit="return Verificar()">
				  <tr> 
					<td width="18%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Nome:</td>
					<td width="82%" style="padding-left: 0.3em"><input name="nome" type="text" class="TextoFormulario" size="46" maxlength="150"></td>
				  </tr>
				  <tr> 
					<td height="22" align="right" valign="top" class="Texto" style="padding-left: 0.3em">Sexo:</td>
					<td style="padding-left: 0.3em"> <input name="sexo" type="radio" value="M" checked>
					  Masculino<br> <input type="radio" name="sexo" value="F">
					  Feminino </td>
				  </tr>
				  <tr> 
					<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Login:</td>
					<td style="padding-left: 0.3em"><input name="login" type="text" class="TextoFormulario" id="login" size="15" maxlength="15"></td>
				  </tr>
				  <tr> 
					<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Senha:</td>
					<td style="padding-left: 0.3em"><input name="senha" type="password" class="TextoFormulario" id="senha" size="15" maxlength="10"></td>
				  </tr>
				  <tr> 
					<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Confirmar 
					  Senha:</td>
					<td style="padding-left: 0.3em"><input name="confirmar" type="password" class="TextoFormulario" id="confirmar" size="15" maxlength="10"></td>
				  </tr>
				  <tr> 
					<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
					<td style="padding-left: 0.3em"><input name="gravar" type="submit" id="gravar" value="Gravar">&nbsp;&nbsp;<input type="button" name="voltar" value="Cancelar" onClick="history.back()"></td>
				  </tr>
				  <script language="JavaScript">document.form_usuario.nome.focus()</script>
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