<?php
if(!isset($msg)){
	echo '';
}else{
?>
<script language="JavaScript">
	alert('<?php print($msg); ?>');
</script>
<?php
}
?>
<html>
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
			<td colspan="2" valign="top"><div id="pageName" style="font-family:Verdana">
			  <h3>Cadastro de Professor </h3>
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
			 <table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <form name="form_professor" method="post" action="professor_incluido.php" onSubmit="return validarProfessor(this);">
				<input type="hidden" name="tipo_pessoa" value="P">
				<tr bgcolor="#E0DFE3">
				  <td width="133" align="right" class="Texto"><strong>Dados do Professor: </strong></td>
				  <td colspan="3" class="Texto">&nbsp;</td>
			    </tr>
				<tr>
				  <td height="22" align="right" class="Texto">Nome:</td>
				  <td align="left" colspan="3">&nbsp;<input type="text" name="nome" size="60" maxlength="255" class="TextoFormulario" /><span style="color: #FF0000">&nbsp;*</span></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Data de Nascimento:</td>
				  <td align="left">&nbsp;<input type="text" name="data_nascimento" size="11" maxlength="10" class="TextoFormulario" onKeyPress="FormataData(this.name, this.value)">&nbsp;<font size="1" color="#FF0000">sem "/"</font></td>
				  <td align="right" class="Texto">Sexo:</td>
				  <td align="left" class="Texto">&nbsp;<input type="radio" name="sexo" value="M" checked>Masculino&nbsp;<input type="radio" name="sexo" value="F">Feminino</td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto"> Identidade (RG):</td>
				  <td align="left">&nbsp;<input type="text" name="rg" size="26" maxlength="25" class="TextoFormulario"></td>
				  <td align="right" class="Texto">&Oacute;rg&atilde;o Exp.</td>
				  <td align="left">&nbsp;<input type="text" name="orgao" size="16" maxlength="15" class="TextoFormulario"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">C.P.F. N&ordm;:</td>
				  <td colspan="3" align="left">&nbsp;<input type="text" name="cpf" size="15" maxlength="14" class="TextoFormulario" /><span style="color: #FF0000">&nbsp;*</span></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">e-Mail:</td>
				  <td colspan="3" align="left">&nbsp;<input type="text" name="email" size="60" maxlength="255" class="TextoFormulario"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Endere&ccedil;o:</td>
				  <td colspan="3" align="left">&nbsp;<input type="text" name="endereco" size="60" maxlength="255" class="TextoFormulario"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Bairro:</td>
				  <td align="left">&nbsp;<input type="text" name="bairro" size="35" maxlength="150" class="TextoFormulario"></td>
				  <td align="right" class="Texto">CEP:</td>
				  <td align="left">&nbsp;<input type="text" name="cep" size="10" maxlength="9" class="TextoFormulario">&nbsp;<span style="color: #FF0000">(74000-000)</span></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Cidade:</td>
				  <td align="left">&nbsp;<input type="text" name="cidade" size="35" maxlength="150" class="TextoFormulario"></td>
				  <td align="right" class="Texto">Estado.</td>
				  <td align="left">&nbsp;<select name="uf" class="TextoFormulario">
						<option value="" selected>Estado 
						<option value="AC">AC 
						<option value="AL">AL 
						<option value="AM">AM 
						<option value="BA">BA 
						<option value="CE">CE 
						<option value="DF">DF 
						<option value="ES">ES 
						<option value="GO">GO 
						<option value="MA">MA 
						<option value="MG">MG 
						<option value="MS">MS 
						<option value="MT">MT 
						<option value="PA">PA 
						<option value="PB">PB 
						<option value="PE">PE 
						<option value="PI">PI 
						<option value="PR">PR 
						<option value="RJ">RJ 
						<option value="RN">RN 
						<option value="RO">RO 
						<option value="RR">RR 
						<option value="RS">RS 
						<option value="SC">SC 
						<option value="SP">SP 
						<option value="TO">TO 
					</select></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Fone Residencial:</td>
				  <td align="left">&nbsp;<input type="text" name="fone_residencial" size="13" maxlength="12" class="TextoFormulario"></td>
				  <td align="right" class="Texto">Comercial:</td>
				  <td align="left">&nbsp;<input type="text" name="fone_comercial" size="13" maxlength="12" class="TextoFormulario"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Celular:</td>
				  <td colspan="3" align="left">&nbsp;<input type="text" name="celular" size="13" maxlength="12" class="TextoFormulario"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">PIS:</td>
				  <td align="left" colspan="3">&nbsp;<input name="pis" type="text" class="TextoFormulario" id="pis" size="13" maxlength="12">&nbsp;<span style="color: #FF0000">sem ponto ou tra&ccedil;o</span></td>
				</tr>
				<tr bgcolor="#E0DFE3">
				  <td width="133" align="right" class="Texto"><strong>Dados Bancários: </strong></td>
				  <td colspan="3" class="Texto">&nbsp;</td>
			    </tr>
				<tr>
				  <td height="22" align="right" class="Texto">Banco:</td>
				  <td align="left" colspan="3">&nbsp;<input name="banco" type="text" class="TextoFormulario" id="pis3" size="25"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Ag&ecirc;ncia:</td>
				  <td align="left" colspan="3">&nbsp;<input name="agencia" type="text" class="TextoFormulario" id="pis4" size="15" maxlength="15"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto">Conta Corrente:</td>
				  <td align="left" colspan="3">&nbsp;<input name="conta" type="text" class="TextoFormulario" id="pis5" size="15"></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td align="left" colspan="3"><span style="color: #FF0000">* Obrigatório</span></td>
			    </tr>
				<tr>
				  <td height="40">&nbsp;</td>
				  <td align="left" colspan="3">&nbsp;<input type="submit" name="ok" value="Gravar" />&nbsp;&nbsp;<input name="limpar" type="reset" id="limpar" onClick="document.form_professor.nome.focus()" value="Limpar" /></td>
				</tr>
				<script language="JavaScript">document.form_professor.nome.focus()</script>
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