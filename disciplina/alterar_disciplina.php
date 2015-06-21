<?php
require('../../conexao.php'); //== Faz conexão com o Banco de Dados

//== Consulta da Disciplina
$comando = "
SELECT
	Codg_Disciplina,
	Nome AS Disciplina,
	Horas_Aula
FROM
	disciplina 
WHERE
	Codg_Disciplina = ".$_GET['codg_disciplina'];
$result = mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta da Disciplina. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());

$dados = mysql_fetch_array($result);

?>

<html>

<head>

<title>Administração :: IPECON - Ensino e Consultoria</title>

<script language="JavaScript">

function Verificar(){

	if(document.form_disciplina.nome.value==''){

		alert('Favor, digitar o Nome da Disciplina.');

		document.form_disciplina.nome.focus();

		return false;

	}

	if(document.form_disciplina.hora_aula.value==''){

		alert('Favor, digitar a Hora/Aula.');

		document.form_disciplina.hora_aula.focus();

		return false;

	}

}

</script>

<style type="text/css">

<!--

.style1 {

	font-size: x-small;

	font-family: Verdana, Arial, Helvetica, sans-serif;

}

-->

</style>

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

			  <h3>Alterar Disciplina </h3>

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

				<form name="form_disciplina" method="get" action="disciplina_alterada.php" onSubmit="return Verificar()">

				<input type="hidden" name="codg_disciplina" value="<?php print($_GET['codg_disciplina']); ?>">

				  <tr> 

					<td width="14%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Disciplina:</td>

					<td width="86%" style="padding-left: 0.3em"><input name="nome" type="text" class="TextoFormulario" size="60" maxlength="150" value="<?php print($dados['Disciplina']); ?>"></td>

				  </tr>

				  <tr> 

					<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Hora/Aula:</td>

					<td style="padding-left: 0.3em"><input name="hora_aula" type="text" class="TextoFormulario" size="15" maxlength="15" value="<?php print($dados['Horas_Aula']); ?>"></td>

				  </tr>

				  <tr> 

					<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>

					<td style="padding-left: 0.3em"><input name="alterar" type="submit" value="Alterar">

					  &nbsp;&nbsp;

					  <input type="button" name="voltar" value="Voltar" onClick="history.back()"></td>

				  </tr>

				  <script language="JavaScript">document.form_disciplina.codg_professor.focus()</script>

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