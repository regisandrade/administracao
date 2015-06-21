<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados

$nturma = explode('|', $_GET['turma']);
$codg_turma = $nturma[0];
$nome_turma = $nturma[1];
$ano_turma = $nturma[2];
$codgCurso = $nturma[3];
?>
<html>
<head>
<title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
tr.linha:hover{
	background-color: #FFFF99;
}
</style>
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(ano,aluno,turma,disciplina,nome_turma,curso){
	if(confirm("Confirma a exclusão deste Registro?"))
		window.location = 'excluir_registro_matricula.php?ano='+ano+'&aluno='+aluno+'&turma='+turma+'&disciplina='+disciplina+'&nome_turma='+nome_turma+'&curso='+curso;
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
			  <h3>Consulta de Alunos Matriculados </h3>
			</div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
		</tr>
		<tr>
		  <td colspan="2" valign="top" class="Texto">
			<?php
			// Consulta os dados da turma
			$consulta = "
			SELECT
			  MAT.*,
			  ALU.Nome AS NomeAluno,
			  DIS.Nome AS NomeDisciplina
			FROM
			  matricula MAT
			INNER JOIN disciplina DIS ON
			  DIS.Codg_Disciplina = MAT.Disciplina
			INNER JOIN aluno ALU ON
			  ALU.Id_Numero = MAT.Aluno
			WHERE
			  ALU.Ano = ".$ano_turma."
			  AND
			  MAT.Turma = '".$codg_turma."'
			  AND
			  ALU.Curso = ".$codgCurso."
			ORDER BY
			  ALU.Nome, DIS.Nome
			";
			//echo "<pre>";
			//print_r($consulta);
			//echo "</pre>";
			$resultado = mysql_query($consulta) or die ("Erro na consulta da Matricula. ".mysql_error());
			$numero = mysql_num_rows($resultado);

			// Contar a quantidade de alunos matriculados
			$sql = "SELECT DISTINCT COUNT(*) AS qtdeAlunos FROM matricula WHERE Ano = '".$ano_turma."' AND Turma = '".$codg_turma."'";
			$rs = mysql_query($sql) or die ("Erro na consulta da Quatidade de Matriculas. ".mysql_error());
			$reg = mysql_fetch_array($rs);
			/*<br />Qtde de alunos matriculados: <?=$reg['qtdeAlunos'];?>*/
			?>
			<table width="100%" cellpadding="0" cellspacing="0" class="Texto">
			  <tr>
				<td width="5%" height="15" style="padding-left: 0.3em" valign="top"><strong>Turma:</strong></td>
				<td width="90%" style="padding-left: 0.3em"><strong><?php print($codg_turma.'|'.$nome_turma); ?></strong></td>
				<td width="5%" align="right" style="padding-right: 0.3em"><a href="JavaScript:history.back(-1)">&lt;&lt;&nbsp;Voltar</a></td>
			  </tr>
			</table>
			<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Texto">
			  <tr bgcolor="#EFEFEF">
 				<td width="91%" height="15" style="padding-left: 0.3em"><strong>Disciplina</strong></td>
				<td width="9%" align="center"><strong>Op&ccedil;&otilde;es</strong></td>
			  </tr>
			  <?php
			  if($numero == 0){
			  ?>
			  <tr>
				<td height="15" colspan="2" align="center" class="Texto" style="color:#FF0000">Nenhum aluno matriculado para esta turma.</td>
			  </tr>
			  <?php
			  }else{
			  	$conta = 0;
				  $muda_aluno = '0';
				  $volta = 0;
				  $num = 1;
				  $somaAluno = 0;
				  while($dados = mysql_fetch_array($resultado)){
					if($muda_aluno != 0){
						if($muda_aluno != $dados['Aluno']){
							$somaAluno++;
			  ?>
			  <tr>
				<td background="../imagens/spacer.gif" height="2" colspan="2" bgcolor="#000000"></td>
			  </tr>
			  <tr>
				<td bgcolor="#DDDDDD" height="15" colspan="2" style="padding-left: 0.3em; font-weight:bold; color:#990000"><?php echo $somaAluno; ?> - Aluno(a):&nbsp;<?php print(strtoupper($dados['NomeAluno'])); ?></td>
			  </tr>
			  <?php
			  			$volta = 0;
						$num = 1;
						}
					}
					if($conta == 0){
						$somaAluno++;
			  ?>
			  <tr>
				<td background="../imagens/spacer.gif" height="2" colspan="2" bgcolor="#000000"></td>
			  </tr>
			  <tr>
				<td bgcolor="#DDDDDD" height="15" colspan="2" style="padding-left: 0.3em; font-weight:bold; color:#990000"><?php echo $somaAluno; ?> - Aluno(a):&nbsp;<?php print(strtoupper($dados['NomeAluno'])); ?></td>
			  </tr>
			  <?php
					}
			  ?>
			  <tr bgcolor="#FFFFFF" class="linha">
				<td height="15" style="padding-left: 0.3em"><?php print($num.'-'.$dados['NomeDisciplina']); ?></td>
				<td align="center"><a href="#" onClick="Confirma_Exclusao(<?php print($dados['Ano']); ?>,'<?php print($dados['Aluno']); ?>','<?php print($dados['Turma']); ?>',<?php print($dados['Disciplina']); ?>,'<?php print($nome_turma); ?>','<?php echo $codgCurso; ?>')"><img src="../../imagens/excluir.gif" alt="Excluir registro" width="16" height="16" border="0"></a></td>
			  </tr>
			  <?php
				  $conta++;
				  $volta++;
				  $num++;
				  $muda_aluno = $dados['Aluno'];
				  }
			  }
			  ?>
			</table>
			<table width="100%"  border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td height="5" background="../imagens/spacer.gif"></td>
			  </tr>
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
