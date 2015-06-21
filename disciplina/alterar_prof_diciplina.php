<?php
require('../../conexao.php');

$cmdTurma = "SELECT DISTINCT Nome, Turma FROM turma ORDER BY Nome";
$resTurma = mysql_query($cmdTurma) or die('Erro na consulta das turmas.'.mysql_error());
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
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
			  <h3>Alterar Disciplina do Professor</h3>
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
				<form name="formTurma" method="post" action="listar_disciplina_turma.php" target="centro">
				  <tr> 
					<td width="76" height="22" align="right">Turma:</td>
					<td width="637" align="left">&nbsp;
					  <select name="turma" class="TextoFormulario" onChange="document.formTurma.submit()">
						<option value="0">[-- Selecionar Turma --]</option>
					<?php
					while($regTurma = mysql_fetch_array($resTurma)){
					?>
						<option value="<?php print($regTurma['Turma']); ?>|<?php print($regTurma['Nome']); ?>"><?php print($regTurma['Turma']); ?>&nbsp;-&nbsp;<?php print($regTurma['Nome']); ?></option>
					<?php
					}
					?>
					</select>					</td>
				  </tr>
				  <tr>
					<td align="left" colspan="2"><iframe name="centro" src="listar_disciplina_turma.php" width="100%" height="450px" frameborder="0" /></td>
				  </tr>
				  <script language="JavaScript">document.formTurma.turma.focus()</script>
				</form>
			  </table>			</td>
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