<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Notas &amp; Frequências</title>
<link rel="stylesheet" href="../../../novo/css/site.css" type="text/css" />
</head>

<body style="background-color: #FFFFFF">
<?php
require('../../../conexao.php');

//== Consultar Notas
$sql = "
SELECT
	DISTINCT
	AC.Turma,
	DIS.Nome AS NomeDisciplina,
	AC.Nota,
	AC.Frequencia
FROM
	alunos_academicos AC
INNER JOIN disciplina DIS ON
	DIS.Codg_Disciplina = AC.Disciplina
WHERE
	    AC.Turma = '".$_GET['turma']."'
	AND AC.Aluno = '".$_GET['idAluno']."'
ORDER BY
	DIS.Nome";
$resultado = mysql_query($sql) or die ("<font face='Verdana' size='2'>Erro na Consulta da  Nota/Frequência. <br><b>sql:</b> <font color='#FF0000'>".$sql."</font><br><b>Erro:</b> ".mysql_error());
$numero = mysql_num_rows($resultado);
?>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td height="30" colspan="3" style="padding-left: 0.3em" valign="middle">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left" class="Texto"><b>Turma:</b>&nbsp;<?=$_GET['turma'];?><br /><strong>Aluno:</strong>&nbsp;<?=$_GET['nomeAluno'];?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr bgcolor="#DDDDDD">
		<td width="78%" height="17" class="Texto" style="padding-left: 0.3em"><b>Disciplina</b></td>
		<td width="12%" align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Frequência</b></td>
		<td width="10%" align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Nota</b></td>
	</tr>
	<?php
		if($numero < 1){
	?>
	<tr>
		<td class="Texto" colspan="3" align="center"><font color="#FF0000">Nenhum registro encontrado.</font></td>
	</tr>
	<?php
		}else{
		$conta = 0;
		$numero = 1;
		while($dados = mysql_fetch_array($resultado)){
			if($conta % 2 == 1){
				$cor = '#DDEEFF';
			}else{
				$cor = '#FFFFFF';
			}
	?>
	<tr bgcolor="<?php print($cor); ?>">
		<td height="17" class="Texto" style="padding-left: 0.3em; border-right: 1px #DDDDDD solid; border-left: 1px #DDDDDD solid; border-bottom: 1px solid #DDDDDD;"><?php print($numero.'. '.$dados['NomeDisciplina']); ?></td>
		<td class="Texto" align="center" style="padding-left: 0.3em; padding-right: 0.3em; border-right: 1px #DDDDDD solid; border-bottom: 1px solid #DDDDDD;"><?php print($dados['Frequencia']); ?></td>
		<td class="Texto" align="center" style="padding-left: 0.3em; padding-right: 0.3em; border-right: 1px #DDDDDD solid; border-bottom: 1px solid #DDDDDD;"><?php print(number_format($dados['Nota'],1,',','.')); ?></td>
	</tr>
	<?php
		$conta++;
		$numero++;
		}
	?>
	<tr>
		<td height="40" class="Texto" colspan="3" style="text-align: center"><input type="button" name="botao" value="Imprimir" onClick="window.print()" style="border: solid 1px #000000; background-color: #FFFFFF" />&nbsp;&nbsp;<input type="button" name="btnFechar" value="Fechar janela" onClick="window.close()" style="border: solid 1px #000000; background-color: #FFFFFF" /></td>
	</tr>
	<?php
		}
	?>
</table>
</body>
</html>
