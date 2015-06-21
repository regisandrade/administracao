<?php
require('../../conexao.php'); //== Faz a conexão com o banco
$comando = "SELECT 
		T.*,
		DIS.Nome AS NomeDisciplina,
		PRO.Nome AS NomeProfessor
	FROM
		turma T
	INNER JOIN disciplina DIS ON
		DIS.Codg_Disciplina = T.Disciplina
	INNER JOIN professor PRO ON
		PRO.Id_Numero = T.Professor
	WHERE
		T.Ano = ".$_GET['ano']." 
	ORDER BY 
		T.Turma";
$resultado = mysql_query($comando) or die('Erro na consulta da turma. '.mysql_error());
$numero = mysql_num_rows($resultado);
?>
<html>
<head>
<title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(ano,turma,curso,disciplina,professor){
	if(confirm("Confirma a exclusão deste Registro?"))
		window.location = 'excluir_turma.php?ano='+ano+'&turma='+turma+'&curso='+curso+'&disciplina='+disciplina+'&professor='+ professor;
	}
</script>
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
			  <h3>Consulta de Turmas </h3>
			</div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" align="right" background="../../imagens/spacer.gif"><a href="JavaScript:history.back(-1)" class="Texto">&lt;&lt; Voltar</a>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" valign="top">
			<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
				<tr bgcolor="#EEEEEE">
				  <td width="45%" height="15" class="Texto" style="padding-left: 0.3em"><strong>Disciplina</strong></td>
				  <td width="45%" class="Texto" style="padding-left: 0.3em;"><strong>Professor</strong></td>
			      <td width="10%" align="center" class="Texto"><strong>Op&ccedil;&otilde;es</strong></td>
				</tr>
				<?php
				if($numero < 1){
				?>
				<tr>
				  <td height="15" colspan="3" align="center" class="Texto" style="color:#FF0000">Nenhum registro encontrado.</td>
				</tr>
				<?php
				}else{
					$conta = 0;
					$muda_turma = '0';
					while($dados = mysql_fetch_array($resultado)){
						if($conta % 2 == 1){
							$cor = '#DDEEFF';
						}else{
							$cor = '#FFFFFF';
						}
						if($muda_turma != '0'){
							if($muda_turma != $dados['Turma']){
				?>
				<tr>
					<td background="../../imagens/spacer.gif" height="4" colspan="3" bgcolor="#000000"></td>
				</tr>
				<tr>
				  <td bgcolor="#FFEEE6" height="15" colspan="2" align="left" class="Texto" style="padding-left: 0.3em"><b><i>Ano:&nbsp;<?php print($dados['Ano']); ?>&nbsp;|&nbsp;Turma:&nbsp;<?php print($dados['Turma']); ?>-<?php print($dados['Nome']); ?></i></b></td>
				  <td bgcolor="#FFEEE6" height="15" align="center"><a href="alterar_data_turma.php?ano=<?=$dados['Ano']?>&turma=<?=$dados['Turma']?>&descTurma=<?=$dados['Nome']?>"><img src="../../imagens/data.gif" title="Alterar a data da turma" border="0" align="absmiddle" /></a></td>
				</tr>
				<?php
							}
						}
						if($conta == 0){
				?>
				<tr>
					<td background="../../imagens/spacer.gif" height="4" colspan="3" bgcolor="#000000"></td>
				</tr>
				<tr>
				  <td bgcolor="#FFEEE6" height="15" colspan="2" align="left" class="Texto" style="padding-left: 0.3em"><b><i>Ano:&nbsp;<?php print($dados['Ano']); ?>&nbsp;|&nbsp;Turma:&nbsp;<?php print($dados['Turma']); ?>-<?php print($dados['Nome']); ?></i></b></td>
				  <td bgcolor="#FFEEE6" height="15" align="center"><a href="alterar_data_turma.php?ano=<?=$dados['Ano']?>&turma=<?=$dados['Turma']?>&descTurma=<?=$dados['Nome']?>"><img src="../../imagens/data.gif" title="Alterar a data da turma" border="0" align="absmiddle" /></a></td>
				</tr>
				<?php
						}
				?>
				<tr bgcolor="<?php print($cor); ?>">
				  <td height="15" align="left" class="Texto" style="padding-left: 0.3em"><?php print($dados['NomeDisciplina']); ?></td>
				  <td class="Texto" style="padding-left: 0.3em;"><?php print($dados['NomeProfessor']); ?></td>
			      <td align="center" class="Texto"><a href="alterar_professor_turma.php?ano=<?=$dados['Ano']?>&turma=<?=$dados['Turma']?>&prof=<?=$dados['Professor']?>&disciplina=<?=$dados['Disciplina']?>"><img src="../../imagens/alterar.gif" title="Alterar professor e/ou disciplina da turma" border="0" align="absmiddle" /></a>&nbsp;
					<a href="#" onClick="Confirma_Exclusao(<?php print($dados['Ano']); ?>,'<?php print($dados['Turma']); ?>',<?php print($dados['Curso']); ?>,<?php print($dados['Disciplina']); ?>,'<?php print($dados['Professor']); ?>')"><img src="../../imagens/excluir.gif" alt="Excluir" width="16" height="16" border="0" align="absmiddle"></a></td>
				</tr>
				<?php
						$conta++;
						$muda_turma = $dados['Turma'];
					}
				}
				?>
			</table>
		  <br>
		  </td>
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