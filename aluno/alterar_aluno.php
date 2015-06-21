<?php
require('../../conexao.php');

//== Selecionar Cursos
$cmd_cursos = "SELECT * FROM curso ORDER BY Nome";
$res_cursos = mysql_query($cmd_cursos) or die('Erro na consulta dos Cursos. '.mysql_error());
$num_cursos = mysql_num_rows($res_cursos);

//== Selecionar o Aluno
$comando = "
SELECT
	TA.Ano,
	TA.Id_Numero,
	TA.Nome,
	DATE_FORMAT(TA.Data_Nascimento,'%d/%m/%Y') AS Data_Nascimento,
	TA.Naturalidade,
	TA.UF_Naturalidade,
	TA.Nacionalidade,
	TA.Sexo,
	TA.RG,
	TA.Orgao,
	TA.CPF,
	TA.e_Mail,
	TA.Status,
	TA.Curso,
	TE.Endereco,
	TE.Bairro,
	TE.CEP,
	TE.Cidade,
	TE.UF,
	TE.Fone_Residencial,
	TE.Fone_Comercial,
	TE.Celular,
	TG.Curso_Graduacao,
	TG.Instituicao,
	TG.Sigla,
	TG.Ano_Conclusao,
	TA.Curso,
	TA.Data_Vencimento,
	TA.twitter
FROM
	aluno TA
LEFT OUTER JOIN endereco TE ON TE.Id_Numero = TA.Id_Numero
LEFT OUTER JOIN graduacao TG ON TG.Id_Numero = TA.Id_Numero
WHERE
	TA.Id_Numero = '".$_GET['id_numero']."'
	AND
	TA.Ano = ".$_GET['ano']."
	AND
	TE.Tipo_Pessoa = 'A'
";

$resultado = mysql_query($comando) or die ("Erro na Consulta do Aluno.<br>Comando:".$comando."<br>Erro: ".mysql_error());

$registro = mysql_fetch_array($resultado);

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



	if(document.form_aluno.data_nascimento.value==''){

		alert('Favor, digitar a Data de Nascimento do Aluno.');

		document.form_aluno.data_nascimento.focus();

		return false;

	}



	if(document.form_aluno.naturalidade.value==''){

		alert('Favor, digitar a Naturalidade do Aluno.');

		document.form_aluno.data_nascimento.focus();

		return false;

	}



	if(document.form_aluno.uf_1.value==''){

		alert('Favor, selecionar o Estado da Naturalidade do Aluno.');

		document.form_aluno.uf_1.focus();

		return false;

	}



	if(document.form_aluno.cpf.value==''){

		alert('Favor, digitar o CPF do Aluno.');

		document.form_aluno.cpf.focus();

		return false;

	}



	if(document.form_aluno.endereco.value==''){

		alert('Favor, digitar o Endereço do Aluno.');

		document.form_aluno.endereco.focus();

		return false;

	}



	if(document.form_aluno.bairro.value==''){

		alert('Favor, digitar o Bairro do Aluno.');

		document.form_aluno.bairro.focus();

		return false;

	}



	if(document.form_aluno.cep.value==''){

		alert('Favor, digitar o CEP do Aluno.');

		document.form_aluno.cep.focus();

		return false;

	}



	if(document.form_aluno.cidade.value==''){

		alert('Favor, digitar a Cidade do Aluno.');

		document.form_aluno.cidade.focus();

		return false;

	}



	if(document.form_aluno.uf_2.value==''){

		alert('Favor, digitar o Estado do Aluno.');

		document.form_aluno.uf_2.focus();

		return false;

	}



	if(document.form_aluno.fone_residencial.value==''){

		alert('Favor, digitar o Fone Residêncial do Aluno.');

		document.form_aluno.fone_residencial.focus();

		return false;

	}



	if(document.form_aluno.curso.value==''){

		alert('Favor, digitar o Curso de Graduação do Aluno.');

		document.form_aluno.curso.focus();

		return false;

	}



	if(document.form_aluno.instituicao.value==''){

		alert('Favor, digitar a Instituição do Aluno.');

		document.form_aluno.instituicao.focus();

		return false;

	}



	if(document.form_aluno.sigla.value==''){

		alert('Favor, digitar a Sigla da Instituição do Aluno.');

		document.form_aluno.sigla.focus();

		return false;

	}



	if(document.form_aluno.conclusao.value==''){

		alert('Favor, digitar o Ano de Conclusão do Aluno.');

		document.form_aluno.conclusao.focus();

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

			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Alterar Aluno</h3></div></td>

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

			<form name="form_aluno" action="aluno_alterado.php" method="post" onSubmit="return Verificar()">

			  <input type="hidden" name="id_numero" value="<?php print($registro['Id_Numero']); ?>">
			  <input type="hidden" name="anoAlterar" value="<?=$_GET['ano']?>">

			  <tr bgcolor="#E0DFE3">

			    <td align="right" class="Texto"><strong>Dados do Aluno:</strong></td>

			    <td colspan="3" class="Texto">&nbsp;</td>
			  </tr>

			  <tr>

			    <td height="22" align="right" class="Texto">Curso:</td>

			    <td colspan="3">&nbsp;<select name="codg_curso" class="TextoFormulario">

                    <option value="">[-- Selecionar um Curso --]</option>

                    <?PHP

					  while($reg_cursos = mysql_fetch_array($res_cursos)){

				    ?>

                    <option value="<?php print $reg_cursos['Codg_Curso']; ?>" <?php if($reg_cursos['Codg_Curso'] == $registro['Curso']){ print('selected'); }?>><?php print($reg_cursos['Nome']); ?></option>

                    <?php

						}

					?>

                  </select>			    </td>
			    </tr>

			  <tr>

			    <td height="22" align="right" class="Texto">Ano:</td>

			    <td colspan="3">&nbsp;<select name="ano" class="TextoFormulario" id="ano">

				<?php

					for($i=2001; $i<=date('Y'); $i++){

				?>

					<option value="<?php print($i); ?>" <?php if($i == $registro['Ano']){ print('selected'); }?>><?php print($i); ?></option>

				<?php

					}

				?>

				</select></td>
			  </tr>

			  <tr>

				<td width="117" height="22" align="right" class="Texto">Nome:</td>

				<td colspan="3">&nbsp;<input name="nome" type="text" class="TextoFormulario" id="nome" size="60" maxlength="255" value="<?php print($registro['Nome']); ?>"></td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Data de Nascimento:</td>

				<td width="249">&nbsp;<input name="data_nascimento" type="text" class="TextoFormulario" id="data_nascimento" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)" value="<?php print($registro['Data_Nascimento']); ?>">

				  &nbsp;<font color="#FF0000" size="1" face="Verdana">sem "/"</font></td>

				<td width="164">&nbsp;</td>

				<td width="110">&nbsp;</td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Naturalidade:</td>

				<td>&nbsp;<input name="naturalidade" type="text" class="TextoFormulario" id="naturalidade" size="40" maxlength="150" value="<?php print($registro['Naturalidade']); ?>"></td>

				<td colspan="2" align="left" class="Texto">&nbsp;Estado:&nbsp;<select name="uf_1" class="TextoFormulario">

					<option value="" selected>UF
					<option value="AC" <?php if($registro['UF_Naturalidade'] == 'AC'){ print('selected'); }?>>AC</option>

					<option value="AL" <?php if($registro['UF_Naturalidade'] == 'AL'){ print('selected'); }?>>AL</option>

					<option value="AM" <?php if($registro['UF_Naturalidade'] == 'AM'){ print('selected'); }?>>AM</option>

					<option value="BA" <?php if($registro['UF_Naturalidade'] == 'BA'){ print('selected'); }?>>BA</option>

					<option value="CE" <?php if($registro['UF_Naturalidade'] == 'CE'){ print('selected'); }?>>CE</option>

					<option value="DF" <?php if($registro['UF_Naturalidade'] == 'DF'){ print('selected'); }?>>DF</option>

					<option value="ES" <?php if($registro['UF_Naturalidade'] == 'ES'){ print('selected'); }?>>ES</option>

					<option value="GO" <?php if($registro['UF_Naturalidade'] == 'GO'){ print('selected'); }?>>GO</option>

					<option value="MA" <?php if($registro['UF_Naturalidade'] == 'MA'){ print('selected'); }?>>MA</option>

					<option value="MG" <?php if($registro['UF_Naturalidade'] == 'MG'){ print('selected'); }?>>MG</option>

					<option value="MS" <?php if($registro['UF_Naturalidade'] == 'MS'){ print('selected'); }?>>MS</option>

					<option value="MT" <?php if($registro['UF_Naturalidade'] == 'MT'){ print('selected'); }?>>MT</option>

					<option value="PA" <?php if($registro['UF_Naturalidade'] == 'PA'){ print('selected'); }?>>PA</option>

					<option value="PB" <?php if($registro['UF_Naturalidade'] == 'PB'){ print('selected'); }?>>PB</option>

					<option value="PE" <?php if($registro['UF_Naturalidade'] == 'PE'){ print('selected'); }?>>PE</option>

					<option value="PI" <?php if($registro['UF_Naturalidade'] == 'PI'){ print('selected'); }?>>PI</option>

					<option value="PR" <?php if($registro['UF_Naturalidade'] == 'PR'){ print('selected'); }?>>PR</option>

					<option value="RJ" <?php if($registro['UF_Naturalidade'] == 'RJ'){ print('selected'); }?>>RJ</option>

					<option value="RN" <?php if($registro['UF_Naturalidade'] == 'RN'){ print('selected'); }?>>RN</option>

					<option value="RO" <?php if($registro['UF_Naturalidade'] == 'RO'){ print('selected'); }?>>RO</option>

					<option value="RR" <?php if($registro['UF_Naturalidade'] == 'RR'){ print('selected'); }?>>RR</option>

					<option value="RS" <?php if($registro['UF_Naturalidade'] == 'RS'){ print('selected'); }?>>RS</option>

					<option value="SC" <?php if($registro['UF_Naturalidade'] == 'SC'){ print('selected'); }?>>SC</option>

					<option value="SP" <?php if($registro['UF_Naturalidade'] == 'SP'){ print('selected'); }?>>SP</option>

					<option value="TO" <?php if($registro['UF_Naturalidade'] == 'TO'){ print('selected'); }?>>TO</option>

				</select> </td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Nacionalidade:</td>

				<td>&nbsp;<input name="nacionalidade" type="text" class="TextoFormulario" id="nacionalidade" value="Brasileira" size="40" maxlength="150"></td>

				<td colspan="2" align="left" valign="middle" class="Texto">&nbsp;Sexo:

				  <input name="sexo" type="radio" value="M" <?php if($registro['Sexo'] == 'M'){ print('checked'); }?>>

				  M

				  <input type="radio" name="sexo" value="F" <?php if($registro['Sexo'] == 'F'){ print('checked'); }?>>

				F</td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Identidade (RG):</td>

				<td>&nbsp;<input name="rg" type="text" class="TextoFormulario" id="rg" size="15" maxlength="25" value="<?php print($registro['RG']); ?>">

				  <span class="Texto">Órgão Exp..:&nbsp;<input name="orgao" type="text" class="TextoFormulario" id="orgao" size="10" maxlength="10" value="<?php print($registro['Orgao']); ?>">
				</span></td>

				<td colspan="2" align="left" class="Texto">&nbsp;</td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">C.P.F. N&ordm;:</td>

				<td>&nbsp;<input name="cpf" type="text" class="TextoFormulario" value="<?php print($registro['CPF']); ?>" size="15" maxlength="14" readonly="true" style="background-color:#FFFFCC ">&nbsp;<font color="#FF0000" size="1" face="Verdana">[NÃO PODE ALTERAR]</font></td>

				<td>&nbsp;</td>

				<td>&nbsp;</td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Endere&ccedil;o:</td>

				<td colspan="3">&nbsp;<input name="endereco" type="text" class="TextoFormulario" id="endereco" size="60" maxlength="255" value="<?php print($registro['Endereco']); ?>"></td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Bairro:</td>

				<td>&nbsp;<input name="bairro" type="text" class="TextoFormulario" id="bairro" size="40" maxlength="150" value="<?php print($registro['Bairro']); ?>"></td>

				<td colspan="2" align="left" class="Texto">&nbsp;CEP:&nbsp;<input name="cep" type="text" class="TextoFormulario" id="cep" size="11" maxlength="10" value="<?php print($registro['CEP']); ?>"></td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Cidade:</td>

				<td>&nbsp;<input name="cidade" type="text" class="TextoFormulario" id="cidade" size="40" maxlength="150" value="<?php print($registro['Cidade']); ?>"></td>

				<td colspan="2" align="left" class="Texto">&nbsp;Estado:&nbsp;<select name="uf_2" class="TextoFormulario">

					<option value="" selected>UF
					<option value="AC" <?php if($registro['UF'] == 'AC'){ print('selected'); }?>>AC</option>

					<option value="AL" <?php if($registro['UF'] == 'AL'){ print('selected'); }?>>AL</option>

					<option value="AM" <?php if($registro['UF'] == 'AM'){ print('selected'); }?>>AM</option>

					<option value="BA" <?php if($registro['UF'] == 'BA'){ print('selected'); }?>>BA</option>

					<option value="CE" <?php if($registro['UF'] == 'CE'){ print('selected'); }?>>CE</option>

					<option value="DF" <?php if($registro['UF'] == 'DF'){ print('selected'); }?>>DF</option>

					<option value="ES" <?php if($registro['UF'] == 'ES'){ print('selected'); }?>>ES</option>

					<option value="GO" <?php if($registro['UF'] == 'GO'){ print('selected'); }?>>GO</option>

					<option value="MA" <?php if($registro['UF'] == 'MA'){ print('selected'); }?>>MA</option>

					<option value="MG" <?php if($registro['UF'] == 'MG'){ print('selected'); }?>>MG</option>

					<option value="MS" <?php if($registro['UF'] == 'MS'){ print('selected'); }?>>MS</option>

					<option value="MT" <?php if($registro['UF'] == 'MT'){ print('selected'); }?>>MT</option>

					<option value="PA" <?php if($registro['UF'] == 'PA'){ print('selected'); }?>>PA</option>

					<option value="PB" <?php if($registro['UF'] == 'PB'){ print('selected'); }?>>PB</option>

					<option value="PE" <?php if($registro['UF'] == 'PE'){ print('selected'); }?>>PE</option>

					<option value="PI" <?php if($registro['UF'] == 'PI'){ print('selected'); }?>>PI</option>

					<option value="PR" <?php if($registro['UF'] == 'PR'){ print('selected'); }?>>PR</option>

					<option value="RJ" <?php if($registro['UF'] == 'RJ'){ print('selected'); }?>>RJ</option>

					<option value="RN" <?php if($registro['UF'] == 'RN'){ print('selected'); }?>>RN</option>

					<option value="RO" <?php if($registro['UF'] == 'RO'){ print('selected'); }?>>RO</option>

					<option value="RR" <?php if($registro['UF'] == 'RR'){ print('selected'); }?>>RR</option>

					<option value="RS" <?php if($registro['UF'] == 'RS'){ print('selected'); }?>>RS</option>

					<option value="SC" <?php if($registro['UF'] == 'SC'){ print('selected'); }?>>SC</option>

					<option value="SP" <?php if($registro['UF'] == 'SP'){ print('selected'); }?>>SP</option>

					<option value="TO" <?php if($registro['UF'] == 'TO'){ print('selected'); }?>>TO</option>

				</select> </td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Fone Resid&ecirc;ncial:</td>

				<td colspan="3" class="Texto">&nbsp;<input name="fone_residencial" type="text" class="TextoFormulario" id="fone_residencial" size="13" maxlength="12" value="<?php print($registro['Fone_Residencial']); ?>">

				&nbsp;&nbsp;Fone Comercial:&nbsp;<input name="fone_comercial" type="text" class="TextoFormulario" id="fone_comercial" size="13" maxlength="12" value="<?php print($registro['Fone_Comercial']); ?>"></td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Celular:</td>

				<td>&nbsp;<input name="celular" type="text" class="TextoFormulario" id="celular" size="13" maxlength="12" value="<?php print($registro['Celular']); ?>"></td>

				<td>&nbsp;</td>

				<td>&nbsp;</td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">e-Mail:</td>

				<td colspan="3">&nbsp;<input name="email" type="text" class="TextoFormulario" id="email" size="60" maxlength="150" value="<?php print($registro['e_Mail']); ?>"></td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Curso de Gradua&ccedil;&atilde;o:</td>

				<td colspan="3">&nbsp;<input name="curso" type="text" class="TextoFormulario" id="curso" size="60" maxlength="255" value="<?php print($registro['Curso_Graduacao']); ?>"></td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Institui&ccedil;&atilde;o:</td>

				<td colspan="3">&nbsp;<input name="instituicao" type="text" class="TextoFormulario" id="instituicao" size="60" maxlength="255" value="<?php print($registro['Instituicao']); ?>"></td>
			  </tr>

			  <tr>

				<td height="22" align="right" class="Texto">Sigla da Institui&ccedil;&atilde;o:</td>

				<td colspan="3" class="Texto">&nbsp;<input name="sigla" type="text" class="TextoFormulario" id="sigla2" size="13" maxlength="13" value="<?php print($registro['Sigla']); ?>">

				&nbsp;&nbsp;Ano de Conclus&atilde;o:&nbsp;<input name="conclusao" type="text" class="TextoFormulario" id="conclusao" size="5" maxlength="4" value="<?php print($registro['Ano_Conclusao']); ?>"></td>
			  </tr>
			  <tr>
			    <td height="22" align="right" class="Texto">Vencimento:</td>
			    <td colspan="3" align="left" class="Texto"><table width="50%" border="0" cellpadding="0" cellspacing="0" class="Texto">
            <tr>
              <td align="center">05</td>
              <td align="center">10</td>
              <td align="center">15</td>
              <td align="center">20</td>
              <td align="center">25</td>
              <td align="center">30</td>
            </tr>
            <tr>
              <td align="center"><input name="vencimento" type="radio" value="5 <?php if($registro['Data_Vencimento'] == '5'){ print('checked'); } ?>"></td>
              <td align="center"><input name="vencimento" type="radio" value="10" <?php if($registro['Data_Vencimento'] == '10'){ print('checked'); } ?>></td>
              <td align="center"><input name="vencimento" type="radio" value="15" <?php if($registro['Data_Vencimento'] == '15'){ print('checked'); } ?>></td>
              <td align="center"><input name="vencimento" type="radio" value="20" <?php if($registro['Data_Vencimento'] == '20'){ print('checked'); } ?>></td>
              <td align="center"><input name="vencimento" type="radio" value="25" <?php if($registro['Data_Vencimento'] == '25'){ print('checked'); } ?>></td>
              <td align="center"><input name="vencimento" type="radio" value="30" <?php if($registro['Data_Vencimento'] == '30'){ print('checked'); } ?>></td>
            </tr>
          </table></td>
			    </tr>
            <tr>
				<td height="22" align="right" class="Texto">Twitter:</td>
				<td colspan="3">&nbsp;<input name="twitter" type="text" class="TextoFormulario" id="twitter" size="40" maxlength="100" value="<?php $registro['twitter']?>"/></td>
			</tr>
			  <tr bgcolor="#FFFFF0">

				<td height="22" align="right" class="Texto"><font color="#FF0000">Situa&ccedil;&atilde;o

				  do Aluno:</font></td>

				<td colspan="3" align="left" class="Texto">&nbsp; Ativo<input type="radio" name="status" value="1" <?php if($registro['Status'] == '1'){ print('checked'); } ?>>&nbsp; Inativo<input type="radio" name="status" value="0" <?php if($registro['Status'] == '0'){ print('checked'); } ?>></td>
			  </tr>

			  <tr>

				<td height="45" align="right">&nbsp;</td>

				<td colspan="2">&nbsp;<input name="ok" type="submit" id="ok" value="Alterar">

				  &nbsp;&nbsp;<input name="cancelar" type="button" id="cancelar" value="Cancelar" onClick="history.back()"></td>

				<td>&nbsp;</td>
			  </tr>

			  <script language="JavaScript">document.form_aluno.nome.focus();</script>
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
