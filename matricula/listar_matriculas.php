<?php
require('../../conexao.php'); //== Faz a conex�o com o banco

// Consultar turma
$cmd_turma = "SELECT DISTINCT Turma, Nome, Curso, Ano from turma ORDER BY Turma, Nome";
$res_turma = mysql_query($cmd_turma) or die('Erro na consulta das Turmas');
$num_turma = mysql_num_rows($res_turma);
?>
<html>
<head>
<title>Administra��o :: IPECON - Ensino e Consultoria</title>
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
	<!-- Conte�do -->
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Consulta  de Alunos Matriculados </h3>
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
			  <form name="form_matricula" method="get" action="resultado.php">
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Turma:</td>
				  <td style="padding-left: 0.3em" class="Texto"><?php
				  if($num_turma == 0){
				  ?>
				  	<span style="color:#FF0000">Nenhum Turma cadastrada.</span>
				  <?php
				  }else{
				  ?>
				  <select name="turma" class="TextoFormulario">
				  <?php
				  	while($reg_turma = mysql_fetch_array($res_turma)){
				  ?>
				  	<option value="<?=$reg_turma['Turma'];?>|<?=$reg_turma['Nome'];?>|<?=$reg_turma['Ano'];?>|<?=$reg_turma['Curso'];?>"><?php print($reg_turma['Turma']); ?>|<?php print($reg_turma['Nome']); ?></option>
				  <?php
					}
				  ?>
				  </select>
				  <?php
				  }
				  ?>
			      </td>
				</tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="buscar" type="submit" id="buscar" value="Buscar">
					&nbsp;&nbsp;<input name="voltar" type="reset" id="voltar" onClick="document.form_matricula.ano.focus()" value="Voltar"></td>
				</tr>
				<script language="JavaScript">document.form_matricula.turma.focus()</script>
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