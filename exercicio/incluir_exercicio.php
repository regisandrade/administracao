<?php
require('../../conexao.php');

// Consultar Turma e Discipina
$cmd_turma = "
	SELECT 
		TUR.Turma,
		TUR.Disciplina AS Codg_Disciplina,
		DIS.Nome
	FROM
		turma TUR
	INNER JOIN disciplina DIS ON
		DIS.Codg_Disciplina = TUR.Disciplina
	ORDER BY
		TUR.Turma, DIS.Nome";
/*echo "<pre>";
print_r($cmd_turma);
echo "</pre>";
*/
$res_turma = mysql_query($cmd_turma) or die('Erro na consulta da tabela turna. '.mysql_error());
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_exercicio.turma.value=='??'){
		alert('Favor, selecionar a Turma | Disciplina.');
		document.form_exercicio.turma.focus();
		return false;
	}
	if(document.form_exercicio.file.value==''){
		alert('Favor, selecionar o Exercício.');
		document.form_exercicio.file.focus();
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
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Cadastro de Material</h3>
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
			  <form name="form_exercicio" method="post" action="exercicio_incluido.php" enctype="multipart/form-data" onSubmit="return Verificar()">
				<input type="hidden" name="ligado" value="1">
				<input type="hidden" name="ano" value="<?php print(date('Y')); ?>">
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Turma|Disciplina:</td>
				  <td style="padding-left: 0.3em"><select name="turma" class="TextoFormulario">
					  <option value="??">[-- Selecionar Turma|Disciplina --]</option>
				  <?php
				  while($reg_turma = mysql_fetch_array($res_turma)){
				  ?>
				  	  <option value="<?php print($reg_turma['Turma']); ?>|<?php print($reg_turma['Codg_Disciplina']); ?>"><?php print($reg_turma['Turma']); ?>|<?php print($reg_turma['Nome']); ?></option>
				  <?php
				  }
				  ?>
				  </select>
				  </td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Material:</td>
				  <td style="padding-left: 0.3em"><input name="txt_arquivo" type="file" class="TextoFormulario" id="file"></td>
				</tr>
				<tr>
				  <td height="22" align="right" valign="top" class="Texto" style="padding-left: 0.3em">Tipo de Material: </td>
				  <td class="Texto">
					<input name="tipo_material" type="radio" value="1">Exerc&iacute;cios<br>
					<input name="tipo_material" type="radio" value="2">Material did&aacute;tico <br>
					<input name="tipo_material" type="radio" value="3">Material de apoio <br>
					<input name="tipo_material" type="radio" value="4">Trabalhos<br>
					<input name="tipo_material" type="radio" value="5">Apostilas</td>
				</tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="gravar" type="submit" id="gravar" value="Gravar">
			&nbsp;&nbsp;
					<input name="limpar" type="reset" id="limpar" onClick="document.form_exercicio.codg_curso.focus()" value="Limpar"></td>
				</tr>
				<script language="JavaScript">document.form_exercicio.turma.focus()</script>
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
