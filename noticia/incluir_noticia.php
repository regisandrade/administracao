<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_noticia.titulo.value==''){
		alert('Favor, digitar o Título da Notícia.');
		document.form_noticia.titulo.focus();
		return false;
	}

	if(document.form_noticia.descricao.value==''){
		alert('Favor, digitar a Notícia.');
		document.form_noticia.descricao.focus();
		return false;
	}

	if(document.form_noticia.autor.value==''){
		alert('Favor, digitar o Autor da Notícia.');
		document.form_noticia.autor.focus();
		return false;
	}
}

function FormataData(campo,teclapress)  {
	var tecla = teclapress.keycode;
	vr = teclapress;
	
	vr = vr.replace(".","");
	vr = vr.replace("/","");
	tam = vr.length ;

	if ( tecla != 9 && tecla != 8 )   {
		if ( tam > 2 && tam < 5 )
			document.form_noticia[campo].value = vr.substr(0,tam - 2) + '/' + vr.substr( tam - 2, tam );
		if ( tam > 5 && tam < 8 )
			document.form_noticia[campo].value = vr.substr(0, 2)+'/' +vr.substr( 2, 2) + '/' + vr.substr( 4, 4);
	}
}
</script>
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
			  <h3>Cadastro de Not&iacute;cias </h3>
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
			  <form name="form_noticia" method="post" action="noticia_incluida.php" onSubmit="return Verificar()">
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">T&iacute;tulo:</td>
				  <td width="78%" style="padding-left: 0.3em"><input name="titulo" type="text" class="TextoFormulario" id="titulo" size="45" maxlength="150"></td>
				</tr>
				<tr>
				  <td height="22" align="right" valign="top" class="Texto" style="padding-left: 0.3em">Not&iacute;cia:</td>
				  <td style="padding-left: 0.3em"><textarea name="descricao" cols="45" rows="5" class="TextoFormulario" id="descricao"></textarea></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Autor:</td>
				  <td style="padding-left: 0.3em"><input name="autor" type="text" class="TextoFormulario" id="autor" size="45" maxlength="150"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Data:</td>
				  <td style="padding-left: 0.3em"><input name="data" type="text" class="TextoFormulario" id="data" value="<?php print(date('d/m/Y')); ?>" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
					  <font color="#FF0000" size="1">&nbsp;sem "/"</font></td>
				</tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="gravar" type="submit" id="gravar" value="Gravar">
			&nbsp;&nbsp;
					<input name="limpar" type="reset" id="limpar" onClick="document.form_noticia.titulo.focus()" value="Limpar"></td>
				</tr>
				<script language="JavaScript">document.form_noticia.titulo.focus()</script>
			  </form>
			</table></td>
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