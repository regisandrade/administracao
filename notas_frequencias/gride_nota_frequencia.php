<?php
require('../../conexao.php'); //== Conex�o com o Banco de Dados
//echo "<pre>";
//print_r($_REQUEST);
//echo "</pre>";
//die;
?>
<html>
<head>
<title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
td{
	font: normal 0.7em/1em Verdana, Arial, Helvetica, sans-serif;
}
.TextoFormulario{
	font: normal 0.9em/1em Verdana, Arial, Helvetica, sans-serif;
	border: solid 1px #999999;
}
-->
</style>
</head>
<body>
<?php
// Fazer a grava��o dos dados da turma, verificando sempre as variaveis enviadas.
if(isset($_REQUEST['turma']) && isset($_REQUEST['disciplina'])){
	// Consulta os os alunos e suas notas e frequencia
	$consulta = "
	SELECT
		  AC.Aluno,
		  ALU.Nome AS NomeAluno,
		  AC.Turma,
		  AC.Disciplina,
		  DIS.Nome AS NomeDisciplina,
		  AC.Nota,
		  AC.Frequencia
	FROM
		alunos_academicos AC
	INNER JOIN aluno ALU ON
		  ALU.Id_Numero = AC.Aluno
	INNER JOIN disciplina DIS ON
		  DIS.Codg_Disciplina = AC.Disciplina
	WHERE
		 ALU.Web = 2 AND
		 AC.Turma = '".$_REQUEST['turma']."'
		 AND
		 AC.Disciplina = ".$_REQUEST['disciplina']."
		 AND
		 ALU.Ano = ".$_REQUEST['ano']."
		 AND
		 ALU.Curso = ".$_REQUEST['curso']."
	ORDER BY
		ALU.Nome";
//	echo "<pre>";
//	echo $consulta;
//	echo "</pre>";
//	die;
	$resultado = mysql_query($consulta) or die ("Erro na consulta da Matricula. ".mysql_error());

  $volta = 1;
	$conta = 0;
    while($dados = mysql_fetch_array($resultado)){
		if($conta % 2 == 1){
			$cor = '#DDEEFF';
		}else{
			$cor = '#EFEFEF';
		}
	  if($volta == 1){
	  	// Buscar o nome do professor
		$cmd_pro = "
		SELECT
			TUR.Professor,
			PRO.Nome AS NomeProfessor
		FROM
			turma TUR
		INNER JOIN professor PRO ON
			PRO.Id_Numero = TUR.Professor
		WHERE
			TUR.Turma = '".$_REQUEST['turma']."'
			AND
			TUR.Disciplina = ".$_REQUEST['disciplina']."
		";
		//print($cmd_pro);
		$res_pro = mysql_query($cmd_pro) or die('Erro na consulta do Professor. '.mysql_error());
		$reg_pro = mysql_fetch_array($res_pro);
  ?>
<form name="nota" method="post" action="gravar.php">
<input name="ano" type="hidden" value="<?=$_REQUEST['ano']; ?>">
<input name="turma" type="hidden" value="<?=$_REQUEST['turma']; ?>">
<input name="disciplina" type="hidden" value="<?=$_REQUEST['disciplina']; ?>">
<input name="curso" type="hidden" value="<?=$_REQUEST['curso']; ?>">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td width="8%" height="15" style="padding-left: 0.3em"><strong>Disciplina:</strong></td>
    <td width="92%" style="padding-left: 0.3em"><?php print($dados['NomeDisciplina']); ?></td>
  </tr>
  <tr>
    <td width="8%" height="15" style="padding-left: 0.3em"><strong>Professor:</strong></td>
    <td width="92%" style="padding-left: 0.3em"><?php print($reg_pro['NomeProfessor']); ?></td>
  </tr>
</table>
<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
  <tr bgcolor="#DDDDDD">
    <td width="70%" height="15" style="padding-left: 0.3em"><strong>Alunos(as)</strong></td>
    <td width="15%" style="padding-left: 0.3em"><strong>Nota</strong></td>
    <td width="15%" style="padding-left: 0.3em"><strong>Frequ&ecirc;ncia</strong></td>
  </tr>
  <?php
	  }
  ?>
  <tr bgcolor="<?php print($cor); ?>">
    <td height="15" style="padding-left: 0.3em"><?php print($volta); ?>.&nbsp;<?php print($dados['NomeAluno']); ?><input type="hidden" name="aluno[]" value="<?php print($dados['Aluno']); ?>"></td>
    <td style="padding-left: 0.3em"><input type="text" name="nota[]" size="5" maxlength="4" class="TextoFormulario" value="<?php print(number_format($dados['Nota'],1,',','.')); ?>"></td>
    <td style="padding-left: 0.3em"><input type="text" name="frequencia[]" size="5" maxlength="4" class="TextoFormulario" value="<?php print($dados['Frequencia']); ?>"></td>
  </tr>
  <?php
		$volta++;
	  $conta++;
	}
  ?>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5" background="../../imagens/spacer.gif"></td>
  </tr>
  <tr>
    <td height="15" align="center"><input name="gravar" type="submit" value="Gravar"></td>
  </tr>
</table>
</form>
<?php
}else{
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15" align="center"><b>Por favor, selecione uma Disciplina e click no bot�o Buscar.</b></td>
  </tr>
</table>
<?php
}
?>
</body>
</html>