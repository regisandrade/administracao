<?php
if(isset($_POST['turma']) || isset($_GET['turma'])){
	require('../../conexao.php');
	
	// SEPARAR INFORMAÇÃO
	$nome = explode('|',$_POST['turma']);
	$turma = $nome[0];
	$nomeTurma = $nome[1];

	// Selecionar todas as discilinas da Turma escolhida
	$sqlTurmas = "
	SELECT
		CUR.Nome AS Curso,
		DIS.Codg_Disciplina,
		DIS.Nome AS Disciplina,
		PRO.Id_Numero,
		PRO.Nome AS Professor 
	FROM
		turma TUR
	INNER JOIN disciplina DIS ON
		DIS.Codg_Disciplina = TUR.Disciplina
	INNER JOIN curso CUR ON
		CUR.Codg_Curso = TUR.Curso
	INNER JOIN professor PRO ON
		PRO.Id_Numero = TUR.Professor
	WHERE
		TUR.Turma = '".$turma."'
	ORDER BY DIS.Nome";
	$resTurmas = mysql_query($sqlTurmas) or die('Erro na consulta das Turmas'.mysql_error());
	$numTurmas = mysql_num_rows($resTurmas);
	?>
	<style type="text/css">
		.Texto{
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color:#000000;
		}
	</style>
	<table width="100%" border="0" cellpadding="0" cellspacing="2">
		<tr>
		  <td height="17" colspan="3" class="Texto" align="left">Curso: <strong><?php print($nomeTurma); ?></strong></td>
	  </tr>
		<tr bgcolor="#DDDDDD">
			<th height="17" class="Texto">Disciplina</th>
			<th class="Texto">Professor</th>
			<th>&nbsp;</th>
		</tr>
	<?php
	if($numTurmas == 0){
	?>
		<tr>
			<td class="Texto" colspan="3" align="center" height="17" style="color:#FF0000">Nenhum registro encontrado.</td>
		</tr>
	<?php
	}else{
		$conta = 1;
		while($dados = mysql_fetch_array($resTurmas)){
	?>
		<tr bgcolor="#EFEFEF">
			<td height="17" class="Texto" style="padding-left: 0.3em"><?php print($conta); ?>.&nbsp;<?php print($dados['Disciplina']); ?></td>
			<td class="Texto" style="padding-left: 0.3em"><?php print($dados['Professor']); ?></td>
			<td align="center"><a href="alt_prof_disc.php?turma=<?php print($turma); ?>&disciplina=<?php print($dados['Codg_Disciplina']); ?>&professor=<?php print($dados['Id_Numero']); ?>"><img src="../imagens/gif_ativar.gif" width="14" height="14" border="0"></a>
			  </th>		
		</tr>
	<?php
			$conta++;
		}// Fim while
	}// Fim IF
?>
</table>
<div class="Texto">
<strong>Legenda:</strong><br>
<img src="../imagens/gif_ativar.gif" width="14" height="14" border="0">&nbsp;->&nbsp;Alterar professor.
</div><?php
}// Fim isset()
?>
