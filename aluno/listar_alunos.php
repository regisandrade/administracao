<?php
require('../../conexao.php'); //== Faz conexão com o Banco de Dados

//== Condulta do Curso
$cmd_cur = "SELECT * FROM curso ORDER BY Nome";
$res_cur = mysql_query($cmd_cur) or die ("<font face='Verdana' size='2'>Erro na Consulta do Curso. <br><b>Comando:</b> <font color='#FF0000'>".$cmd_cur."</font><br><b>Erro:</b> ".mysql_error());

?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
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
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Consulta de Alunos</h3>
			</div></td>
		</tr>
	    <tr> 
			<td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
	    </tr>
		<tr>
			<td colspan="2" valign="top">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<form name="form_aluno" method="get" action="resultado_alunos.php" onSubmit="return Verificar()">
			  <tr> 
				<td height="7" colspan="2" background="../../imagens/spacer.gif"></td>
			  </tr>
			  <tr>
			    <td height="22" align="right" class="Texto">Ano:</td>
			    <td style="padding-left: 0.3em"><?php include('../../form_ano.php'); ?></td>
			  </tr>
			  <tr> 
				<td width="14%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Curso:</td>
				<td width="86%" style="padding-left: 0.3em"><select name="curso" class="TextoFormulario">
					<option value="" selected>[Selecione um Curso]</option>
					<option value="0">Todos Cursos</option>
					<?php
					while($reg_cur = mysql_fetch_array($res_cur)){
					?>
					<option value="<?php print($reg_cur['Codg_Curso']); ?>"><?php print($reg_cur['Nome']); ?></option>
					<?php
					}
					?>
				  </select>
				</td>
			  </tr>
			  <tr>
			    <td height="22" align="right" class="Texto">Nome:</td>
			    <td style="padding-left: 0.3em"><input name="nome" id="nome" size="40" value="" class="TextoFormulario" /></td>
			  </tr>
			  <tr> 
				<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				<td style="padding-left: 0.3em"><input name="consultar" type="submit" id="consultar" value="Consultar"> 
				  &nbsp;&nbsp; <input type="button" name="voltar" value="Cancelar" onClick="history.back()"></td>
			  </tr>
			  <script language="JavaScript">document.form_aluno.curso.focus()</script>
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