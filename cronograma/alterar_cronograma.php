<?php
session_start();
require('../../conexao.php'); //== Conexão com o Banco de Dados

// Consultar as turmas
$sql_turma = "SELECT DISTINCT Turma, Nome FROM turma ORDER BY Nome";
$res_turma = mysql_query($sql_turma) or die('Erro na consulta das Turmas. '.mysql_error());
// Fim consulta turma

// Consultar as disciplinas
$sql_disciplina = "SELECT TUR.Disciplina AS CodgDisciplina, DISC.Nome as NomeDisciplina FROM `turma` TUR
INNER JOIN disciplina DISC ON DISC.Codg_Disciplina = TUR.Disciplina
WHERE TUR.Turma = '".$_REQUEST['codgTurma']."' ORDER BY DISC.Nome";
$res_disciplina = mysql_query($sql_disciplina) or die('Erro na consulta das Disciplinas. '.mysql_error());
// Fim consulta disciplina

$comando = "
SELECT
      CRO.Id_Numero,
      CRO.Turma,
	  CRO.Disciplina,
      DISC.Nome AS Disciplina,
      DATE_FORMAT(Data_01,'%d/%m/%Y') AS Data_01,
      DATE_FORMAT(Data_02,'%d/%m/%Y') AS Data_02,
      DATE_FORMAT(Data_03,'%d/%m/%Y') AS Data_03,
      DATE_FORMAT(Data_04,'%d/%m/%Y') AS Data_04,
      DATE_FORMAT(Data_05,'%d/%m/%Y') AS Data_05,
      DATE_FORMAT(Data_06,'%d/%m/%Y') AS Data_06
FROM
    cronograma CRO
INNER JOIN disciplina DISC ON
    DISC.Codg_Disciplina = CRO.Disciplina
WHERE
	CRO.Id_Numero = ".$_REQUEST['codg'];
$resultado = mysql_query($comando) or die('Erro na consulta do Cronograma');
$reg_cronograma = mysql_fetch_array($resultado);

?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_cronograma.turma.value == 0){
		alert('Favor, selecionar uma Turma.');
		document.form_cronograma.turma.focus();
		return false;
	}
	if(document.form_cronograma.disciplina.value == '??'){
		alert('Favor, selecionar uma Disciplina.');
		document.form_cronograma.disciplina.focus();
		return false;
	}
	if(document.form_cronograma.data1.value == ''){
		alert('Favor, digitar a 1ª Data.');
		document.form_cronograma.data1.focus();
		return false;
	}
	if(document.form_cronograma.data2.value == ''){
		alert('Favor, digitar a 2ª Data.');
		document.form_cronograma.data2.focus();
		return false;
	}
	if(document.form_cronograma.data3.value == ''){
		alert('Favor, digitar a 3ª Data.');
		document.form_cronograma.data3.focus();
		return false;
	}
	if(document.form_cronograma.data4.value == ''){
		alert('Favor, digitar a 4ª Data.');
		document.form_cronograma.data4.focus();
		return false;
	}
}

// Formatar a data
function FormataData(campo,teclapress)  {
	var tecla = teclapress.keycode;
	vr = teclapress;

	vr = vr.replace(".","");
	vr = vr.replace("/","");
	tam = vr.length ;

	if ( tecla != 9 && tecla != 8 )   {
		if ( tam > 2 && tam < 5 )
			document.form_cronograma[campo].value = vr.substr(0,tam - 2) + '/' + vr.substr( tam - 2, tam );
		if ( tam > 5 && tam < 8 )
			document.form_cronograma[campo].value = vr.substr(0, 2)+'/' +vr.substr( 2, 2) + '/' + vr.substr( 4, 4);
	}
}
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
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
			  <h3>Cadastro de Cronogramas</h3>
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
			  <form name="form_cronograma" method="get" action="alterado.php" onSubmit="return Verificar()">
			  <input type="hidden" name="codg" value="<?php echo $_REQUEST['codg']; ?>">
			  <input type="hidden" name="local" value="<?php echo $_REQUEST['local']; ?>">
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Turma:</td>
				  <td width="78%" style="padding-left: 0.3em"><select name="turma" class="TextoFormulario">
					<option value="0">-- Selecionar Turma --</option>
					<?
					while($reg_turma = mysql_fetch_array($res_turma)){
					?>
						<option value="<?php echo $reg_turma['Turma']; ?>" <?php echo ($reg_turma['Turma'] == $reg_cronograma['Turma']) ? 'selected' : ''; ?>><?php echo $reg_turma['Turma'].'|'.$reg_turma['Nome']; ?></option>
					<?
					}
					?>
					</select>
				  </td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Disciplina:</td>
				  <td style="padding-left: 0.3em"><select name="disciplina" class="TextoFormulario">
					<option value="0">-- Selecionar Disciplina --</option>
					<?
					while($reg_disciplina = mysql_fetch_array($res_disciplina)){
					?>
						<option value="<?php echo $reg_disciplina['CodgDisciplina']; ?>" <?php echo ($_REQUEST['codgDisciplina'] == $reg_disciplina['CodgDisciplina']) ? 'selected' : ''; ?>><?php print($reg_disciplina['NomeDisciplina']); ?></option>
					<?
					}
					?>
					</select>
				  </td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td class="Texto" style="padding-left: 0.3em">1&ordf; Data:
				<input name="data1" type="text" class="TextoFormulario" id="data1" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)" value="<?php print($reg_cronograma['Data_01']); ?>">
				<span class="style1">*</span>              2&ordf; Data:
					<input name="data2" type="text" class="TextoFormulario" id="data2" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)" value="<?php print($reg_cronograma['Data_02']); ?>">
					<span class="style1">*</span>              3&ordf; Data:
				  <input name="data3" type="text" class="TextoFormulario" id="data3" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)" value="<?php print($reg_cronograma['Data_03']); ?>">
				  <span class="style1">*</span><br>
				  4&ordf; Data:
				  <input name="data4" type="text" class="TextoFormulario" id="data4" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)" value="<?php print($reg_cronograma['Data_04']); ?>">
				  <span class="style1">*</span>              5&ordf; Data:
				  <input name="data5" type="text" class="TextoFormulario" id="data5" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)" value="<?php print($reg_cronograma['Data_05']); ?>">
				  <span class="style1">*</span>              6&ordf; Data:
				  <input name="data6" type="text" class="TextoFormulario" id="data6" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)" value="<?php print($reg_cronograma['Data_06']); ?>">
				  <span class="style1">*</span> <br>
				  <span class="style1">*Aten&ccedil;&atilde;o, digitar a data sem barra &quot;/&quot;.</span> </td>
				</tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="alterar" type="submit" id="alterar" value="Alterar">

				  &nbsp;&nbsp;<input name="limpar" type="reset" id="limpar" onClick="document.form_cronograma.codg_curso.focus()" value="Limpar"></td>
				</tr>
				<tr>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em">&nbsp;</td>
				</tr>
				<script language="JavaScript">document.form_cronograma.turma.focus()</script>
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