<?php
require('../../conexao.php');

$comando = "SELECT * FROM links WHERE Codg_Link = $codg_link";
$result = mysql_query($comando) or die ("Erro na Consulta do Link. ".mysql_error());
$registro = mysql_fetch_array($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_link.descricao.value==''){
		alert('Favor, digitar a Descrição do Link.');
		document.form_link.descricao.focus();
		return false;
	}

	if(document.form_link.link1.value==''){
		alert('Favor, digitar o endereço do Link.');
		document.form_link.link1.focus();
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
			  <h3>Alterar Link </h3>
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
				<form name="form_link" method="get" action="link_alterado.php" onSubmit="return Verificar()">
				<input type="hidden" name="codg_link" value="<?php print($codg_link); ?>">
				  <tr> 
					<td width="18%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Descri&ccedil;&atilde;o:</td>
					<td width="82%" style="padding-left: 0.3em"><input name="descricao" type="text" class="TextoFormulario" id="descricao" size="55" maxlength="255" value="<?php print($registro['Descricao']); ?>"></td>
				  </tr>
				  <tr> 
					<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Link (www) :</td>
					<td style="padding-left: 0.3em"><input name="link1" type="text" class="TextoFormulario" id="link1" size="55" maxlength="255" value="<?php print($registro['Link']); ?>"><span class="style1">*</span></td>
				  </tr>
				  <tr>
					<td align="right" class="Texto" style="padding-left: 0.3em">Tipo :</td>
					<td style="padding-left: 0.3em"><select name="tipo" id="tipo" class="TextoFormulario">
						<option value="1" <?php if($registro['Tipo'] == '1'){ print('selected'); }?>>Universidade</option>
						<option value="2" <?php if($registro['Tipo'] == '2'){ print('selected'); }?>>Biblioteca</option>
						<option value="3" <?php if($registro['Tipo'] == '3'){ print('selected'); }?>>Outros</option>
						<option value="4" <?php if($registro['Tipo'] == '4'){ print('selected'); }?>>Conselho</option>
					  </select></td>
				  </tr>
				  <tr>
					<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
					<td class="Texto" style="padding-left: 0.3em; color:#FF0000">* Aten&ccedil;&atilde;o: Quando for digitar o Link (www) n&atilde;o precisa digitar o http://www.<br>
				    Exemplo: http://www.ipecon.com.br =&gt; <strong><em>ipecon.com.br</em></strong>. </td>
				  </tr>
				  <tr> 
					<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
					<td style="padding-left: 0.3em"><input name="alterar" type="submit" id="alterar" value="Alterar"> 
					  &nbsp;&nbsp; <input type="button" name="voltar" value="Cancelar" onClick="history.back()"></td>
				  </tr>
				  <script language="JavaScript">document.form_link.descricao.focus()</script>
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