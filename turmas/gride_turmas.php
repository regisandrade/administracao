<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados
?>
<html>
<head>
<title>Administra&ccedil;&atilde;o :: IPECON - Ensino e Consultoria</title>
<link href="../../ipecon.css" rel="stylesheet" type="text/css">
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
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(ano,turma,curso,disciplina,professor){
	if(confirm("Confirma a exclusão deste Registro?"))
		window.location = 'excluir_registro_turma.php?ano='+ano+'&turma='+turma+'&curso='+curso+'&disciplina='+disciplina+'&professor='+ professor;
	}
</script>
</head>
<body class="Texto">
<?php
// Fazer a gravação dos dados da turma, verificando sempre as variaveis enviadas.
if(isset($_REQUEST['ano']) && isset($_REQUEST['codigo']) && isset($_REQUEST['nome']) && isset($_REQUEST['curso']) && isset($_REQUEST['disciplina']) && isset($_REQUEST['professor'])){
	// Gravar os dados na tabela de turma

	// Verificar se a Turma já foi cadastrada
	$consulta = "SELECT * FROM turma WHERE Ano = ".$_REQUEST['ano']." AND Turma = '".$_REQUEST['codigo']."' AND Curso = ".$_REQUEST['curso']." AND Disciplina = ".$_REQUEST['disciplina']." AND Professor = '".$_REQUEST['professor']."'";
	$resultado = mysql_query($consulta) or die ("Erro na consulta da Turma. ".mysql_error());
	$numero = mysql_num_rows($resultado);

	if($numero > 0){
		print('<br><b>Esta Turma já esta cadastrada.</b>');
		exit;
	}

	//== Formatação da Data
//	$data = explode('/',$_REQUEST['data_inicial']);
//	$data_inicio = $data[2].'-'.$data[1].'-'.$data[0];
//
//	//== Formatação da Data
//	$data1 = explode('/',$_REQUEST['data_final']);
//	$data_fim = $data1[2].'-'.$data1[1].'-'.$data1[0];

	$comando = "
		INSERT INTO	turma (
			Ano,
			Turma,
			Nome,
			Curso,
			Disciplina,
			Professor,
			Data_Inicial,
			Data_Final
		)VALUES(
			".$_REQUEST['ano'].",
			'".$_REQUEST['codigo']."',
			'".$_REQUEST['nome']."',
			".$_REQUEST['curso'].",
			".$_REQUEST['disciplina'].",
			'".$_REQUEST['professor']."',
			'0000-00-00',
			'0000-00-00'
		)
	";
	//echo "<pre>"; print_r($comando); die;
	mysql_query($comando) or die ("Erro na Gravação da Turma. ".mysql_error());
}

if(isset($_REQUEST['ano']) && isset($_REQUEST['codigo'])){
	// Consulta os dados da turma
	$consulta = "
	SELECT
	  T.*,
	  CUR.Nome AS NomeCurso,
	  DIS.Nome AS NomeDisciplina,
	  PRO.Nome AS NomeProfessor,
	  DATE_FORMAT(T.Data_Inicial,'%d/%m/%Y') AS Data_Inicial,
	  DATE_FORMAT(T.Data_Final,'%d/%m/%Y') AS Data_Final
	FROM
	  turma T
	INNER JOIN curso CUR ON
	  CUR.Codg_Curso = T.Curso
	INNER JOIN disciplina DIS ON
	  DIS.Codg_Disciplina = T.Disciplina
	INNER JOIN professor PRO ON
	  PRO.Id_Numero = T.Professor
	WHERE
	  T.Ano = ".$_REQUEST['ano']."
	  AND
	  T.Turma = '".$_REQUEST['codigo']."'
	ORDER BY
	  T.Nome
	";
	$resultado = mysql_query($consulta) or die ("Erro na consulta da Turma. ".mysql_error());
	$numero = mysql_num_rows($resultado);

	if($numero < 1){
?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5" background="../../imagens/spacer.gif"></td>
  </tr>
  <tr>
    <td height="15" align="center" style="color:#FF0000">Nenhum registro encontrado para esta turma.<br>Por favor, cadastrar um novo registro ou click no botão limpár para cadastrar uma nova turma.</td>
  </tr>
</table>
<?php
	}else{
  	  $volta = 0;
	  while($dados = mysql_fetch_array($resultado)){
	    if($volta == 0){
  ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#DDDDDD" class="Texto">
  <tr>
    <td width="13%" height="15" align="right" style="padding-left: 0.3em"><strong>Ano:</strong></td>
    <td width="87%" style="padding-left: 0.3em"><?php print($dados['Ano']); ?></td>
  </tr>
  <tr>
    <td height="15" align="right" style="padding-left: 0.3em"><strong>Turma:</strong></td>
    <td style="padding-left: 0.3em"><?php print($dados['Turma']); ?>|<?php print($dados['Nome']); ?></td>
  </tr>
  <tr>
    <td height="15" align="right" style="padding-left: 0.3em"><strong>Curso:</strong></td>
    <td style="padding-left: 0.3em"><?php print($dados['NomeCurso']); ?></td>
  </tr>
  <tr>
    <td height="15" align="right" style="padding-left: 0.3em"><strong>Data Inicial:</strong></td>
    <td style="padding-left: 0.3em"><?php print($dados['Data_Inicial']); ?></td>
  </tr>
  <tr>
    <td height="15" align="right" style="padding-left: 0.3em"><strong>Data Final:</strong></td>
    <td style="padding-left: 0.3em"><?php print($dados['Data_Final']); ?></td>
  </tr>
</table>
<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Texto">
  <tr bgcolor="#EEEEEE">
    <td width="50%" height="15" style="padding-left: 0.3em"><strong>Disciplina</strong></td>
    <td width="40%" style="padding-left: 0.3em"><strong>Professor</strong></td>
    <td width="10%" align="center"><strong>Op&ccedil;&otilde;es</strong></td>
  </tr>
  <?php
		}
  ?>
  <tr>
    <td height="15" style="padding-left: 0.3em"><?php print($dados['NomeDisciplina']); ?></td>
    <td style="padding-left: 0.3em"><?php print($dados['NomeProfessor']); ?></td>
    <td align="center"><a href="#" onClick="Confirma_Exclusao(<?php print($dados['Ano']); ?>,'<?php print($dados['Turma']); ?>',<?php print($dados['Curso']); ?>,<?php print($dados['Disciplina']); ?>,'<?php print($dados['Professor']); ?>')"><img src="../../imagens/excluir.gif" alt="Excluir registro" width="16" height="16" border="0"></a></td>
  </tr>
  <?php
  	  $volta++;
	  }
  ?>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5" background="../../imagens/spacer.gif"></td>
  </tr>
  <tr>
    <td height="15" align="center"><input type="button" name="nova" value="Gravar nova Turma?" onClick="parent.location='incluir_turma.php'"></td>
  </tr>
</table>
<?php
	}
}
?>
</body>
</html>
