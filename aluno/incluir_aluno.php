<?php
require('../../conexao.php');

//== Selecionar Cursos
$comando = "SELECT * FROM curso WHERE Status = 1 ORDER BY Nome";
$result = mysql_query($comando) or die('Erro na consulta dos Cursos. '.mysql_error());
$num = mysql_num_rows($result);
?>
<html>
<head>
	<title>Administração :: IPECON - Ensino e Consultoria</title>
	<script language="JavaScript">
		function Verificar(){
			if(document.form_aluno.codg_curso.value==''){
				alert('Favor, selecionar um Curso.');
				document.form_aluno.codg_curso.focus();
				return false;
			}
			if(document.form_aluno.nome.value==''){
				alert('Favor, digitar o Nome do Aluno.');
				document.form_aluno.nome.focus();
				return false;
			}
			if(document.form_aluno.cpf.value==''){
				alert('Favor, digitar o CPF do Aluno.');
				document.form_aluno.cpf.focus();
				return false;
			}
			if(document.form_aluno.txtUsuario.value==''){
				alert('Favor, digitar o Usuário do Aluno.');
				document.form_aluno.txtUsuario.focus();
				return false;
			}
			if(document.form_aluno.txtSenha.value==''){
				alert('Favor, digitar a Senha do Aluno.');
				document.form_aluno.txtSenha.focus();
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
					document.form_aluno[campo].value = vr.substr(0,tam - 2) + '/' + vr.substr( tam - 2, tam );
				if ( tam > 5 && tam < 8 )
					document.form_aluno[campo].value = vr.substr(0, 2)+'/' +vr.substr( 2, 2) + '/' + vr.substr( 4, 4);
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
					<h3>Cadastro de Alunos </h3></div>
				</td>
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
						<form name="form_aluno" action="aluno_incluido.php" method="post" onSubmit="return Verificar()">
						<input type="hidden" name="tipo_pessoa" value="A">
						<tr bgcolor="#E0DFE3">
							<td align="right" class="Texto"><strong>Dados do Aluno:</strong></td>
							<td colspan="3" class="Texto">&nbsp;</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Curso:</td>
							<td colspan="3">&nbsp;<select name="codg_curso" class="TextoFormulario">
								<option value="">[-- Selecionar um Curso --]</option>
								<?PHP
								while($registro = mysql_fetch_array($result)){
								?>
									<option value="<?php print $registro['Codg_Curso']; ?>"><?php print($registro['Nome']); ?></option>
								<?php
								}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Ano:</td>
							<td colspan="3">&nbsp;<?php include('../../form_ano.php'); ?></td>
						</tr>
						<tr>
							<td width="125" height="22" align="right" class="Texto">Nome:</td>
							<td colspan="3">&nbsp;<input name="nome" type="text" class="TextoFormulario" id="nome" size="60" maxlength="255"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Data de Nascimento:</td>
							<td width="285">&nbsp;<input name="data_nascimento" type="text" class="TextoFormulario" id="data_nascimento" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
							&nbsp;<font color="#FF0000" size="1" face="Verdana">sem "/"</font></td>
							<td width="166">&nbsp;</td>
							<td width="160">&nbsp;</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Naturalidade:</td>
							<td>&nbsp;<input name="naturalidade" type="text" class="TextoFormulario" id="naturalidade" size="40" maxlength="150"></td>
							<td colspan="2" align="left" class="Texto">&nbsp;Estado:&nbsp;<select name="uf_1" class="TextoFormulario">
									<option value="">UF
									<option value="AC">AC
									<option value="AL">AL
									<option value="AM">AM
									<option value="BA">BA
									<option value="CE">CE
									<option value="DF">DF
									<option value="ES">ES
									<option value="GO" selected>GO
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
								</select>
							</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Nacionalidade:</td>
							<td>&nbsp;<input name="nacionalidade" type="text" class="TextoFormulario" id="nacionalidade" value="Brasileira" size="40" maxlength="150"></td>
							<td colspan="2" align="left" valign="middle" class="Texto">&nbsp;Sexo:
								<input name="sexo" type="radio" value="M" checked>M
								<input type="radio" name="sexo" value="F">F
							</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Identidade (RG):</td>
							<td>&nbsp;<input name="rg" type="text" class="TextoFormulario" id="rg" size="15" maxlength="25">
								<span class="Texto">&nbsp;Órgão Exp..:&nbsp;<input name="orgao" type="text" class="TextoFormulario" id="orgao" size="10" maxlength="10">
								</span>
							</td>
							<td colspan="2" align="left" class="Texto">&nbsp;</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">C.P.F. N&ordm;:</td>
							<td>&nbsp;<input name="cpf" type="text" class="TextoFormulario" id="cpf" size="15" maxlength="14"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Endere&ccedil;o:</td>
							<td colspan="3">&nbsp;<input name="endereco" type="text" class="TextoFormulario" id="endereco" size="60" maxlength="255"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Bairro:</td>
							<td>&nbsp;<input name="bairro" type="text" class="TextoFormulario" id="bairro" size="40" maxlength="150"></td>
							<td colspan="2" align="left" class="Texto">&nbsp;CEP:&nbsp;<input name="cep" type="text" class="TextoFormulario" id="cep" size="11" maxlength="9"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Cidade:</td>
							<td>&nbsp;<input name="cidade" type="text" class="TextoFormulario" id="cidade" size="40" maxlength="150"></td>
							<td colspan="2" align="left" class="Texto">&nbsp;Estado:&nbsp;<select name="uf_2" class="TextoFormulario">
									<option value="">UF
									<option value="AC">AC
									<option value="AL">AL
									<option value="AM">AM
									<option value="BA">BA
									<option value="CE">CE
									<option value="DF">DF
									<option value="ES">ES
									<option value="GO" selected>GO
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
								</select>
							</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Fone Resid&ecirc;ncial:</td>
							<td colspan="3" class="Texto">&nbsp;<input name="fone_residencial" type="text" class="TextoFormulario" id="fone_residencial" size="13" maxlength="12">&nbsp;&nbsp;Fone Comercial:&nbsp;<input name="fone_comercial" type="text" class="TextoFormulario" id="fone_comercial" size="13" maxlength="12"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Celular:</td>
							<td>&nbsp;<input name="celular" type="text" class="TextoFormulario" id="celular" size="13" maxlength="12"></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">e-Mail:</td>
							<td colspan="3">&nbsp;<input name="email" type="text" class="TextoFormulario" id="email" size="60" maxlength="150"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Curso de Gradua&ccedil;&atilde;o:</td>
							<td colspan="3">&nbsp;<input name="curso" type="text" class="TextoFormulario" id="curso" size="60" maxlength="255"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Institui&ccedil;&atilde;o:</td>
							<td colspan="3">&nbsp;<input name="instituicao" type="text" class="TextoFormulario" id="instituicao" size="60" maxlength="255"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Sigla da Institui&ccedil;&atilde;o:</td>
							<td colspan="3" class="Texto">&nbsp;<input name="sigla" type="text" class="TextoFormulario" id="sigla2" size="13" maxlength="13">
							&nbsp;&nbsp;Ano de Conclus&atilde;o:&nbsp;<input name="conclusao" type="text" class="TextoFormulario" id="conclusao" size="5" maxlength="4"></td>
						</tr>
						<tr>
							<td height="22" align="right" class="Texto">Vencimento:</td>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td height="22" align="right">&nbsp;</td>
							<td colspan="3"><table width="50%" border="0" cellpadding="0" cellspacing="0" class="Texto">
						<tr>
							<td align="center">05</td>
							<td align="center">10</td>
							<td align="center">15</td>
							<td align="center">20</td>
							<td align="center">25</td>
							<td align="center">30</td>
						</tr>
						<tr>
							<td align="center"><input name="vencimento" type="radio" value="5" checked></td>
							<td align="center"><input name="vencimento" type="radio" value="10"></td>
							<td align="center"><input name="vencimento" type="radio" value="15"></td>
							<td align="center"><input name="vencimento" type="radio" value="20"></td>
							<td align="center"><input name="vencimento" type="radio" value="25"></td>
							<td align="center"><input name="vencimento" type="radio" value="30"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td height="22" align="right" class="Texto">Twitter:</td>
				<td colspan="3">&nbsp;<input name="twitter" type="text" class="TextoFormulario" id="twitter" size="40" maxlength="100"></td>
			</tr>
			<tr>
				<td height="22" colspan="4" align="left" class="Texto">Dados do usu&aacute;rio: </td>
			</tr>
			<tr>
				<td height="22" align="right" class="Texto">Usu&aacute;rio:</td>
				<td colspan="3"><input name="txtUsuario" type="text" class="TextoFormulario" id="txtUsuario" size="30">
					<span class="Texto">* Sugerimos que seja o e-mail do aluno.</span>
				</td>
			</tr>
			<tr>
				<td height="22" align="right" class="Texto">Senha:</td>
				<td colspan="3"><input name="txtSenha" type="text" class="TextoFormulario" id="txtSenha" size="30"></td>
			</tr>
			<tr>
				<td height="45" align="right">&nbsp;</td>
				<td colspan="3">&nbsp;<input name="ok" type="submit" id="ok" value="Gravar">
				&nbsp;&nbsp;<input name="limpar" type="reset" id="limpar" value="Limpar" onClick="document.form_aluno.nome.focus()"></td>
			</tr>
			<script language="JavaScript">document.form_aluno.nome.focus();</script>
		</form>
		</table>
	</td>
	</tr>
	<tr>
		<td colspan="2" align="center" valign="bottom"><div class="Texto" id="siteInfo">Administra&ccedil;&atilde;o IPECON  | &copy;2004 IPECON Ensino e Consultoria Ltda.</div></td>
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
