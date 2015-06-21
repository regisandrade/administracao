<?php
require('../../conexao.php');

$comando = "
SELECT
	TP.Id_Numero,
	TP.Nome,
	DATE_FORMAT(TP.Data_Nascimento,'%d/%m/%Y') AS Nascimento,
	TP.Sexo,
	TP.RG,
	TP.Orgao,
	TP.CPF,
	TP.e_Mail,
	TP.Pis,
	TP.Banco,
	TP.Agencia,
	TP.Conta,
	TE.Endereco,
	TE.Bairro,
	TE.CEP,
	TE.Cidade,
	TE.UF,
	TE.Fone_Residencial,
	TE.Fone_Comercial,
	TE.Celular
FROM
	professor TP
INNER JOIN endereco TE ON
	TE.Id_Numero = TP.Id_Numero
WHERE
	TP.Id_Numero = '".$_GET['id_numero']."'";
$result = mysql_query($comando);
$registro = mysql_fetch_array($result);
?><html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function FormataData(campo,teclapress)  {
	var tecla = teclapress.keycode;
	vr = teclapress;
	
	vr = vr.replace(".","");
	vr = vr.replace("/","");

	tam = vr.length ;

	if ( tecla != 9 && tecla != 8 )   {
		if ( tam > 2 && tam < 5 )
			document.form_professor[campo].value = vr.substr(0,tam - 2) + '/' + vr.substr( tam - 2, tam );
		if ( tam > 5 && tam < 8 )
			document.form_professor[campo].value = vr.substr(0, 2)+'/' +vr.substr( 2, 2) + '/' + vr.substr( 4, 4);
	}
}

function validarProfessor(nForm){
	if(nForm.nome.value == ''){
		alert('Por favor, digitar o Nome.');
		nForm.nome.focus();
		return false;
	}
	if(nForm.cpf.value == ''){
		alert('Por favor, digitar o C.P.F.');
		nForm.cpf.focus();
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
			  <h3>Alterar Professor</h3>
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
				<form name="form_professor" method="get" action="professor_alterado.php" onSubmit="return validarProfessor(this);">
				<input type="hidden" name="tipo_pessoa" value="P">
				<input type="hidden" name="id_numero" value="<?php print($registro['Id_Numero']); ?>">
				<tr bgcolor="#E0DFE3">
				  <td width="133" align="right" class="Texto"><strong>Dados do Professor: </strong></td>
				  <td colspan="3" class="Texto">&nbsp;</td>
			    </tr>
				  <tr>
					<td height="22" align="right">Nome:</td>
					<td align="left">&nbsp;<input type="text" name="nome" size="60" maxlength="255" class="TextoFormulario" value="<?php print($registro['Nome']); ?>"></td>
				  </tr>
				  <tr>
					<td height="22" align="right">Data de Nascimento:</td>
					<td align="left">&nbsp;<input type="text" name="data_nascimento" size="11" maxlength="10" class="TextoFormulario" onKeyPress="FormataData(this.name, this.value)" value="<?php print($registro['Nascimento']); ?>">&nbsp;<font size="1" color="#FF0000">sem "/"</font>&nbsp;&nbsp;&nbsp;&nbsp;Sexo:&nbsp;				  <input type="radio" name="sexo" value="M" <?php if($registro['Sexo'] == 'M'){ print "checked"; }?>>
					  M&nbsp;
					  <input type="radio" name="sexo" value="F" <?php if($registro['Sexo'] == 'F'){ print "checked"; }?>>
					F</td>
				  </tr>
				  <tr>
					<td height="22" align="right">Identidade (RG):</td>
					<td align="left">&nbsp;<input type="text" name="rg" size="26" maxlength="25" class="TextoFormulario" value="<?php print($registro['RG']); ?>">
					Órgão Exp.
					<input type="text" name="orgao" size="16" maxlength="15" class="TextoFormulario" value="<?php print($registro['Orgao']); ?>"></td>
				  </tr>
				  <tr>
					<td height="22" align="right">C.P.F. Nº:</td>
					<td align="left">&nbsp;<input type="text" name="cpf" size="15" maxlength="14" class="TextoFormulario" value="<?php print($registro['CPF']); ?>" readonly /></td>
				  </tr>
				  <tr>
					<td height="22" align="right">e-Mail:</td>
					<td align="left">&nbsp;<input type="text" name="email" size="60" maxlength="255" class="TextoFormulario" value="<?php print($registro['e_Mail']); ?>"></td>
				  </tr>
				  <tr>
					<td height="22" align="right">Endereço:</td>
					<td align="left">&nbsp;<input type="text" name="endereco" size="60" maxlength="255" class="TextoFormulario" value="<?php print($registro['Endereco']); ?>"></td>
				  </tr>
				  <tr>
					<td height="22" align="right">Bairro:</td>
					<td align="left">&nbsp;<input type="text" name="bairro" size="35" maxlength="150" class="TextoFormulario" value="<?php print($registro['Bairro']); ?>">				  &nbsp;CEP:&nbsp;				  <input type="text" name="cep" size="10" maxlength="9" class="TextoFormulario" value="<?php print($registro['CEP']); ?>">				  &nbsp;<font color="#FF0000" size="1">(74000-000)</font></td>
				  </tr>
				  <tr>
					<td height="22" align="right">Cidade:</td>
					<td align="left">&nbsp;<input type="text" name="cidade" size="35" maxlength="150" class="TextoFormulario" value="<?php print($registro['Cidade']); ?>">				  
					  &nbsp;Estado:&nbsp;				  <select name="uf" class="TextoFormulario">
						<option value="" selected>Estado
						<option value="AC" <?php if($registro['UF'] == 'AC'){ print "selected"; }?>>AC
						<option value="AL" <?php if($registro['UF'] == 'AL'){ print "selected"; }?>>AL
						<option value="AM" <?php if($registro['UF'] == 'AM'){ print "selected"; }?>>AM
						<option value="BA" <?php if($registro['UF'] == 'BA'){ print "selected"; }?>>BA
						<option value="CE" <?php if($registro['UF'] == 'CE'){ print "selected"; }?>>CE
						<option value="DF" <?php if($registro['UF'] == 'DF'){ print "selected"; }?>>DF
						<option value="ES" <?php if($registro['UF'] == 'ES'){ print "selected"; }?>>ES
						<option value="GO" <?php if($registro['UF'] == 'GO'){ print "selected"; }?>>GO
						<option value="MA" <?php if($registro['UF'] == 'MA'){ print "selected"; }?>>MA
						<option value="MG" <?php if($registro['UF'] == 'MG'){ print "selected"; }?>>MG
						<option value="MS" <?php if($registro['UF'] == 'MS'){ print "selected"; }?>>MS
						<option value="MT" <?php if($registro['UF'] == 'MT'){ print "selected"; }?>>MT
						<option value="PA" <?php if($registro['UF'] == 'PA'){ print "selected"; }?>>PA
						<option value="PB" <?php if($registro['UF'] == 'PB'){ print "selected"; }?>>PB
						<option value="PE" <?php if($registro['UF'] == 'PE'){ print "selected"; }?>>PE
						<option value="PI" <?php if($registro['UF'] == 'PI'){ print "selected"; }?>>PI
						<option value="PR" <?php if($registro['UF'] == 'PR'){ print "selected"; }?>>PR
						<option value="RJ" <?php if($registro['UF'] == 'RJ'){ print "selected"; }?>>RJ
						<option value="RN" <?php if($registro['UF'] == 'RN'){ print "selected"; }?>>RN
						<option value="RO" <?php if($registro['UF'] == 'RO'){ print "selected"; }?>>RO
						<option value="RR" <?php if($registro['UF'] == 'RR'){ print "selected"; }?>>RR
						<option value="RS" <?php if($registro['UF'] == 'RS'){ print "selected"; }?>>RS
						<option value="SC" <?php if($registro['UF'] == 'SC'){ print "selected"; }?>>SC
						<option value="SP" <?php if($registro['UF'] == 'SP'){ print "selected"; }?>>SP
						<option value="TO" <?php if($registro['UF'] == 'TO'){ print "selected"; }?>>TO
					  </select>				</td>
				  </tr>
				  <tr>
					<td height="22" align="right">Fone Residêncial:</td>
					<td align="left">&nbsp;<input type="text" name="fone_residencial" size="13" maxlength="12" class="TextoFormulario" value="<?php print($registro['Fone_Residencial']); ?>">
					&nbsp;Comercial:
					<input type="text" name="fone_comercial" size="13" maxlength="12" class="TextoFormulario" value="<?php print($registro['Fone_Comercial']); ?>">
					&nbsp;Celular:
					<input type="text" name="celular" size="13" maxlength="12" class="TextoFormulario" value="<?php print($registro['Celular']); ?>"></td>
				  </tr>
				  <tr> 
					<td height="22" align="right">PIS:</td>
					<td align="left">&nbsp;<input name="pis" type="text" class="TextoFormulario" id="pis" size="13" maxlength="12" value="<?php print($registro['Pis']); ?>"> 
					  &nbsp;<font size="1" color="#FF0000">sem ponto ou tra&ccedil;o</font></td>
				  </tr>
				<tr bgcolor="#E0DFE3">
				  <td width="133" align="right" class="Texto"><strong>Dados Bancários: </strong></td>
				  <td colspan="3" class="Texto">&nbsp;</td>
			    </tr>
				  <tr>
					<td height="22" align="right">Banco:</td>
					<td align="left">&nbsp;<input name="banco" type="text" class="TextoFormulario" size="25" value="<?php print($registro['Banco']); ?>">
					</td>
				  </tr>
				  <tr> 
					<td height="22" align="right">Ag&ecirc;ncia:</td>
					<td align="left">&nbsp;<input name="agencia" type="text" class="TextoFormulario" size="15" maxlength="15" value="<?php print($registro['Agencia']); ?>">
					</td>
				  </tr>
				  <tr> 
					<td height="22" align="right">Conta Corrente:</td>
					<td align="left">&nbsp;<input name="conta" type="text" class="TextoFormulario" size="15" value="<?php print($registro['Conta']); ?>">
					</td>
				  </tr>
				  <tr>
					<td height="40">&nbsp;</td>
					<td align="left">&nbsp;<input type="submit" name="ok" value="Alterar">&nbsp;&nbsp;<input type="button" name="voltar" value="Cancelar" onClick="history.back()"></td>
				  </tr>
				  <script language="JavaScript">document.form_professor.nome.focus()</script>
				</form>
			  </table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center" valign="bottom"><div class="Texto" id="siteInfo">Administra&ccedil;&atilde;o IPECON | &copy;2004 IPECON Ensino e Consultoria Ltda.</div></td>
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