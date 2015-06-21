<?php
require('../../conexao.php');

$comando = "
	SELECT
		Nome,
		Qtde_Horas,
		DATE_FORMAT(Data_Inicio,'%d/%m/%Y')AS Data_Inicio,
		DATE_FORMAT(Data_Fim,'%d/%m/%Y')AS Data_Fim,
		Status
	FROM
		curso
	WHERE
		Codg_Curso = ".$_GET['codg_curso'];

$result = mysql_query($comando) or die ("Erro na Consulta do Curso. ".mysql_error());
$registro = mysql_fetch_array($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_cursos.nome.value==''){
		alert('Favor, digitar o Nome do Curso.');
		document.form_cursos.nome.focus();
		return false;
	}

	if(document.form_cursos.qtde_horas.value==''){
		alert('Favor, digitar a Quantidade de Horas para o Curso.');
		document.form_cursos.qtde_horas.focus();
		return false;
	}

	if(document.form_cursos.turma.value==''){
		alert('Favor, digitar a Turma.');
		document.form_cursos.turma.focus();
		return false;
	}

	if(document.form_cursos.data_inicio.value==''){
		alert('Favor, digitar a Data de Início do Curso.');
		document.form_cursos.data_inicio.focus();
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
			document.form_cursos[campo].value = vr.substr(0,tam - 2) + '/' + vr.substr( tam - 2, tam );
		if ( tam > 5 && tam < 8 )
			document.form_cursos[campo].value = vr.substr(0, 2)+'/' +vr.substr( 2, 2) + '/' + vr.substr( 4, 4);
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
			  <h3>Alterar Curso </h3>
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
			<form name="form_cursos" method="get" action="curso_alterado.php" onSubmit="return Verificar()">
			<input type="hidden" name="codg_curso" value="<?php print($_GET['codg_curso']); ?>">
			  <tr> 
				<td width="18%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Nome:</td>
				<td width="82%" style="padding-left: 0.3em"><input name="nome" type="text" class="TextoFormulario" value="<?php print($registro['Nome']); ?>" size="46" maxlength="150"></td>
			  </tr>
			  <tr> 
				<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Quantidade 
				  de Horas:</td>
				<td style="padding-left: 0.3em"><input name="qtde_horas" type="text" class="TextoFormulario" id="qtde_horas" value="<?php print($registro['Qtde_Horas']); ?>" size="15" maxlength="15"></td>
			  </tr>
			  <tr>
				<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Data 
				   Inicial:</td>
				<td style="padding-left: 0.3em"><input name="data_inicio" type="text" class="TextoFormulario" id="data_inicio" value="<?php print($registro['Data_Inicio']); ?>" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
				  <font color="#FF0000" size="1">&nbsp;sem "/"</font></td>
			  </tr>
			  <tr>
			    <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Data Final: </td>
			    <td style="padding-left: 0.3em"><font color="#FF0000" size="1">
			      <input name="data_fim" type="text" class="TextoFormulario" id="data_fim" value="<?php print($registro['Data_Fim']); ?>" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
                  <font color="#FF0000" size="1">&nbsp;sem "/"</font> </font></td>
			    </tr>
			  <tr>
				<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Curso esta Ativo? </td>
				<td class="Texto" style="padding-left: 0.3em"><input name="status" type="radio" value="1" <?php if($registro['Status'] == 1){ print('checked'); }?>>SIM&nbsp;
				<input name="status" type="radio" value="0" <?php if($registro['Status'] == 0){ print('checked'); }?>><span style="color:#FF0000">N&Atilde;O</span></td>
			  </tr>
			  <tr> 
				<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				<td style="padding-left: 0.3em"><input name="alterar" type="submit" id="alterar" value="Alterar">&nbsp;&nbsp;<input type="button" name="cancelar" value="Cancelar" onClick="history.back()"></td>
			  </tr>
			  <script language="JavaScript">document.form_cursos.nome.focus()</script>
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