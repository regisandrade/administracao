<?php
session_start();

require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Selecionar Alunos
$cmd_aluno = "SELECT Nome, e_Mail FROM aluno WHERE e_Mail <> '' ORDER BY Nome";
$res_aluno = mysql_query($cmd_aluno) or die('Erro na Consulta de Alunos. '.mysql_error());

//== Selecionar Cursos
$cmd_turma = "SELECT DISTINCT Turma, Nome FROM turma ORDER BY Nome";
$res_turma = mysql_query($cmd_turma) or die('Erro na Consulta dos Cursos. '.mysql_error());
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_mail.turma.value=='??'){
		alert('Favor, selecionar uma Turma.');
		document.form_mail.turma.focus();
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
			  <h3>Mensagem para os Alunos por Turma </h3>
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
			<form name="form_mail" method="get" action="para_turma.php" onSubmit="return Verificar()">
			  <tr> 
				<td width="18%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Turma:</td>
				<td width="82%" style="padding-left: 0.3em"><select name="turma" class="TextoFormulario">
				<option value="??" selected>--- Selecionar Turma ---</option>
				<?php 
				while($reg_turma = mysql_fetch_array($res_turma)){
				?>
				  <option value="<?php print($reg_turma['Turma']); ?> | <?php print($reg_turma['Nome']); ?>"><?php print($reg_turma['Turma']); ?> | <?php print($reg_turma['Nome']); ?></option>
				<?php
				}
				?>
				</select></td>
			  </tr>
			  <tr> 
				<td height="45" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				<td style="padding-left: 0.3em"><input name="ok" type="submit" id="ok" value="Continuar &gt;&gt;"> 
				  &nbsp;&nbsp; <input type="button" name="voltar" value="Cancelar" onClick="history.back()"></td>
			  </tr>
			  <script language="JavaScript">document.form_mail.turma.focus()</script>
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