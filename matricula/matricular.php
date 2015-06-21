<?php
require('../../conexao.php'); //== Faz a conexão com o banco

// pegar o nome do curso
$nturma = explode('|', $_REQUEST['turma']);
$codg_turma = $nturma[0];
$nome_turma = $nturma[1];
$codg_curso = $nturma[2];
$ano_turma = $nturma[3];

// Consultar Alunos
$cmd_aluno = "SELECT * FROM aluno WHERE Curso = ".$codg_curso." AND Ano = ".$ano_turma." AND Web = 2 ORDER BY Nome";
//print($cmd_aluno);
$res_aluno = mysql_query($cmd_aluno) or die('Erro na consulta dos Alunos');

// Consultar Disciplina
$cmd_disciplina = "SELECT
	DISTINCT
	TUR.Disciplina,
	DISC.Nome AS NomeDisciplina,
	TUR.Ano
FROM
	turma TUR
INNER JOIN disciplina DISC ON
	DISC.Codg_Disciplina = TUR.Disciplina
WHERE
	TUR.Turma = '".$codg_turma."'
ORDER BY
	DISC.Nome";
$res_disciplina = mysql_query($cmd_disciplina) or die('Erro na consulta dos Disciplinas');
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
			  <h3>Matr&iacute;cula de Alunos</h3>
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
			  <form name="form_matricula" method="get" action="gride_matricula.php">
			  <input name="nome_turma" type="hidden" value="<?php print($nome_turma); ?>">
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Turma:</td>
				  <td width="78%" class="Texto" style="padding-left: 0.3em"><input name="turma" type="hidden" id="turma" value="<?php print($codg_turma); ?>"><b><?php print($codg_turma); ?></b></td>
			    </tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Curso:</td>
				  <td style="padding-left: 0.3em" class="Texto"><input name="curso" type="hidden" id="curso" value="<?php print($codg_curso); ?>"><b><?php print($nome_turma); ?></b></td>
				</tr>
				<tr>
				  <td height="22" align="right" valign="top" class="Texto" style="padding-left: 0.3em">Aluno:</td>
				  <td bgcolor="#DEDEDE" class="Texto" style="padding-left: 0.3em">
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <?php
				  $coluna = 0; //== Inicializa a variavel de colunas
				  $volta = 1;
				  while($reg_aluno = mysql_fetch_array($res_aluno)){
					if($coluna == 0){
						print('<tr>');
					}
				  ?>
					<td class="Texto" align="left"><input type="checkbox" name="item_aluno[]" checked value="<?php print($reg_aluno['Id_Numero']); ?>"><?php print($volta.'. '.$reg_aluno['Nome']); ?></td>
				  <?php
					$coluna = $coluna + 1;
					if($coluna == 2){
						$coluna = 0;
						print('</tr>');
					}
					$volta++;
				  }
				  ?>
				  </table><br>
				  </td>
			    </tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" valign="top">Disciplinas:</td>
				  <td bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em">
				  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <?php
				  $coluna = 0; //== Inicializa a variavel de colunas
				  while($reg_disciplina = mysql_fetch_array($res_disciplina)){
					if($coluna == 0){
						print('<input name="ano" type="hidden" value="'.$reg_disciplina['Ano'].'">');
						print('<tr>');
					}
				  ?>
					<td class="Texto" align="left"><input type="checkbox" name="item[]" checked value="<?php print($reg_disciplina['Disciplina']); ?>"><?php print($reg_disciplina['NomeDisciplina']); ?></td>
				  <?php
					$coluna = $coluna + 1;
					if($coluna == 2){
						$coluna = 0;
						print('</tr>');
					}
				  }
				  ?>
				  </table><br>
				  </td>
			    </tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="incluir" type="submit" id="incluir" value="Incluir">
					&nbsp;&nbsp;<input name="voltar" type="reset" id="voltar" onClick="history.back()" value="Voltar"></td>
				</tr>
				<tr>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em">&nbsp;</td>
			    </tr>
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