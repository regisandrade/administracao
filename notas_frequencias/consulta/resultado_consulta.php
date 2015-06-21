<?php
require('../../../conexao.php');

//== Selecionar o nome e a turma
$seq = explode('|',$_REQUEST['turma']);
$codg_turma = $seq[0];
$nome_turma = $seq[1];
$ano_turma = $seq[2];
$codg_curso = $seq[3];

// Consultar Disciplinas
$cmd_disciplinas = "SELECT DISTINCT
                          DIS.Codg_Disciplina
                         ,DIS.Nome AS Nome_Disciplina
                    FROM
                          alunos_academicos AC
                    INNER JOIN disciplina DIS ON
                          DIS.Codg_Disciplina = AC.Disciplina
                    WHERE
                          AC.Ano = ".$ano_turma."
                      AND AC.Turma = '".$codg_turma."'
                    ORDER BY
                          DIS.Nome";
$res_disciplinas = mysql_query($cmd_disciplinas) or die('Erro na consulta das Disciplinas');
$num_disciplinas = mysql_num_rows($res_disciplinas);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(nForm){
	// Gravar dados
	ano = nForm.ano.value;
	turma = nForm.turma.value;
	disciplina = nForm.disciplina.value;
	curso = nForm.curso.value;
	
	pagina = "gride_resultado_consulta.php?ano="+ano+"&turma="+turma+"&disciplina="+disciplina+"&curso="+curso;
	gride_resultado.location = pagina;

	// Direcionar o cursor
	nForm.disciplina.focus();
}
</script>
<link rel="stylesheet" href="../../emx_nav_left.css" type="text/css">
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19" height="19"><img src="../../img_menu/top_esquerda.gif" width="19" height="19"></td>
    <td width="162" height="19" background="../../img_menu/topo.gif">&nbsp;</td>
    <td width="19"><img src="../../img_menu/top_direita.gif" width="19" height="19"></td>
  </tr>
  <tr>
    <td height="100%" background="../../img_menu/esquerda.gif">&nbsp;</td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
	<!-- Conteúdo -->
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
		  <td height="25" colspan="2" valign="top"><div id="pageName" style="font-family:Verdana">
			<h3>Cadastro de Notas &amp; Frequ&ecirc;ncias </h3>
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
			<form method="get" name="notas">
			<input type="hidden" name="ano" value="<?php print($ano_turma); ?>">
			<input type="hidden" name="turma" value="<?php print($codg_turma); ?>">
			<input type="hidden" name="curso" value="<?php print($codg_curso); ?>">
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Ano:</td>
				  <td class="Texto" style="padding-left: 0.3em"><b><?php print($ano_turma); ?></b></td>
			    </tr>
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Turma:</td>
				  <td width="78%" class="Texto" style="padding-left: 0.3em"><b><?php print($codg_turma); ?></b></td>
				</tr>
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Curso:</td>
				  <td width="78%" class="Texto" style="padding-left: 0.3em"><b><?php print($nome_turma); ?></b></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Disciplina:</td>
				  <td class="Texto" style="padding-left: 0.3em"><?php
				  if($num_disciplinas == 0){
				  ?>
				  	<span style="color:#FF0000">Nenhuma Disciplina cadastrada.</span>
				  <?php
				  }else{
				  ?>
				  <select name="disciplina" class="TextoFormulario">
				  <?php
				  	while($reg_disciplina = mysql_fetch_array($res_disciplinas)){
				  ?>
				  	<option value="<?php print($reg_disciplina['Codg_Disciplina']); ?>"><?php print($reg_disciplina['Nome_Disciplina']); ?></option>
				  <?php
					}
				  ?>
				  </select>
				  <?php
				  }
				  ?></td>
			    </tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td class="Texto" style="padding-left: 0.3em"><input name="buscar" type="button" id="buscar" value="Buscar" onClick="Verificar(this.form)">
				  &nbsp;<input type="button" name="voltar" value="Voltar" onClick="JavaScript: history.back()"></td>
				</tr>
				<tr>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
			    </tr>
				<tr>
				  <td colspan="2" class="Texto" style="padding-left: 0.3em"><iframe name="gride_resultado" width="100%" height="300" frameborder="0" src="gride_resultado_consulta.php"></iframe></td>
			    </tr>
			  </table>
			</form>
			</td>
		</tr>
	</table>
	<!-- Fim -->
	</td>
    <td background="../../img_menu/direita.gif">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="../../img_menu/baixo_esquerda.gif" width="19" height="19"></td>
    <td height="19" background="../../img_menu/baixo.gif">&nbsp;</td>
    <td><img src="../../img_menu/baixo_direita.gif" width="19" height="19"></td>
  </tr>
</table>
</body>
</html>
