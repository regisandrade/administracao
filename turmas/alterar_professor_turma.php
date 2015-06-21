<?php
//== Conexão com o Banco de Dados
require('../../conexao.php');

/** ALTERAR PROFESSOR E/OU DISCIPLINA DA TURMA **/
if(isset($_POST['alterar'])){
	$sql_alterar = "UPDATE turma SET 
		Disciplina = '".$_POST['disciplina']."', 
		Professor = '".$_POST['professor']."' 
	WHERE 
		Ano = ".$_POST['ano']." AND 
		Turma = '".$_POST['turma']."' AND
		Disciplina = ".$_POST['disc_antiga']." AND
		Professor = ".$_POST['prof_antigo'];
	
	if(!mysql_query($sql_alterar)){
		die('ERRO: ALTERAR PROFESSOR E/OU DISCIPLINA DA TURMA');
		exit;
	}
?>
	<script language="javascript">
		alert('Alteração realizada com sucesso.');
		window.location = "resultado_consultar_turmas.php?ano=<?=$_POST['ano']?>";
	</script>
<?php
	exit;
}

// Selecionar as Disciplinas
$sql_disciplina = "SELECT * FROM disciplina ORDER BY Nome";
$res_disciplina = mysql_query($sql_disciplina) or die('Erro na consulta das disciplinas');

// Selecionar os professores
$sql_professor = "SELECT * FROM professor ORDER BY Nome";
$res_professor = mysql_query($sql_professor) or die('Erro na consulta dos professores.');

?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body onLoad="document.form_turma.disciplina.focus()">
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
			  <h3>Alterar professor e/ou disciplina da turma </h3>
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
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
			  <form name="form_turma" method="post" action="alterar_professor_turma.php">
				<input type="hidden" name="ano" value="<?=$_GET['ano']?>" />
				<input type="hidden" name="turma" value="<?=$_GET['turma']?>" />
				<input type="hidden" name="prof_antigo" value="<?=$_GET['prof']?>" />
				<input type="hidden" name="disc_antiga" value="<?=$_GET['disciplina']?>" />
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Ano:</td>
				  <td style="padding-left: 0.3em;" class="Texto"><strong><?=$_GET['ano']?></strong></td>
			    </tr>
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Turma:</td>
				  <td width="78%" style="padding-left: 0.3em;" class="Texto"><strong><?=$_GET['turma']?></strong></td>
				</tr>
				
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Disciplina:</td>
				  <td style="padding-left: 0.3em"><select name="disciplina" class="TextoFormulario" id="disciplina">
				  	<option value="">[-- Selecionar --]</option>
					<?php
					while($reg_disciplina = mysql_fetch_array($res_disciplina)){
					?>
					<option value="<?=$reg_disciplina['Codg_Disciplina']?>" <?php if($reg_disciplina['Codg_Disciplina'] == $_GET['disciplina']){ echo 'selected="selected"'; } ?>><?php print($reg_disciplina['Nome']); ?></option>
					<?php
					}
					?>
			      </select></td>
			    </tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Professor:</td>
				  <td style="padding-left: 0.3em"><select name="professor" class="TextoFormulario" id="professor">
				  	<option value="">[-- Selecionar --]</option>
					<?php
					while($reg_professor = mysql_fetch_array($res_professor)){
					?>
					<option value="<?=$reg_professor['Id_Numero']?>" <?php if($reg_professor['Id_Numero'] == $_GET['prof']){ echo 'selected="selected"'; } ?>><?php print($reg_professor['Nome']); ?></option>
					<?php
					}
					?>
			      </select></td>
			    </tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="alterar" type="submit" id="alterar" value="Alterar">
					&nbsp;&nbsp;<input name="Voltar" type="button" id="Voltar" onClick="JavaScript:history.back(-1)" value="Voltar"></td>
				</tr>
				
				<tr>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td class="Texto style1" style="padding-left: 0.3em">&nbsp;</td>
			    </tr>
			  </form>
			</table></td>
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