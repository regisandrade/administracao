<?php
require('../../conexao.php');

if(isset($_POST['btnAlterar'])){
	$comando = "UPDATE turma SET Professor = '".$_POST['novoProfessor']."' 
		WHERE 
		Turma = '".$_POST['turma']."'
		AND
		Disciplina = ".$_POST['disciplina']."
		AND
		Professor = '".$_POST['profAntigo']."'";

	$altResultado = mysql_query($comando) or die('Erro na altreração do professor.<br>'.mysql_error());
	
	// Detalhes
	$msg = "Professor alterado com sucesso.";
	$pagina = "alt_prof_disc.php?turma=".$_POST['turma']."&disciplina=".$_POST['disciplina']."&professor=".$_POST['profAntigo'];
?>
	<script language="javascript">
		alert('<?php print($msg); ?>');
		parent.document.location = 'alterar_prof_diciplina.php';
	</script>
<?php
}// Fim btnAlterar

// Selecionar todos os professores
$sqlProf = "SELECT * FROM professor ORDER BY Nome";
$resProf = mysql_query($sqlProf) or die('Erro na consulta dos Professores'.mysql_error());

// Selecionar os dados da turma
$sqlTurmas = "
SELECT
	TUR.Turma,
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
	TUR.Turma = '".$_GET['turma']."'
	AND
	DIS.Codg_Disciplina = ".$_GET['disciplina']."
	AND
	PRO.Id_Numero = '".$_GET['professor']."'";
$resTurmas = mysql_query($sqlTurmas) or die('Erro na consulta das Turmas'.mysql_error());
$regTurmas = mysql_fetch_array($resTurmas);

?>
<style type="text/css">
.Texto{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color:#000000;
	padding-left: 0.3em;
}
.TextoFormulario {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #000000;
	background-color: #EEEEEE;
	border: 1px solid #71828A;
}
</style>
<table width="100%" cellspacing="2" cellpadding="0">
<form name="formAlterar" action="alt_prof_disc.php" method="post">
  <caption class="Texto">
    <strong>ALTERAR PROFESSOR </strong>
  </caption>
  <tr>
    <td width="20%" height="17" bgcolor="#DDDDDD" class="Texto"><strong>Turma:</strong></td>
    <td width="80%" bgcolor="#DDDDDD" class="Texto"><input type="hidden" name="turma" value="<?php print($regTurmas['Turma']); ?>" /><?php print($regTurmas['Turma']); ?></td>
  </tr>
  <tr>
    <td height="17" bgcolor="#DDDDDD" class="Texto"><strong>Curso:</strong></td>
    <td bgcolor="#DDDDDD" class="Texto"><input type="hidden" name="curso" value="<?php print($regTurmas['Codg_Curso']); ?>" /><?php print($regTurmas['Curso']); ?></td>
  </tr>
  <tr>
    <td height="17" bgcolor="#DDDDDD" class="Texto"><strong>Disciplina:</strong></td>
    <td bgcolor="#DDDDDD" class="Texto"><input type="hidden" name="disciplina" value="<?php print($regTurmas['Codg_Disciplina']); ?>" /><?php print($regTurmas['Disciplina']); ?></td>
  </tr>
  <tr>
    <td height="17" bgcolor="#DDDDDD" class="Texto"><strong>Prof. Antigo:</strong> </td>
    <td bgcolor="#DDDDDD" class="Texto"><input type="hidden" name="profAntigo" value="<?php print($regTurmas['Id_Numero']); ?>" /><?php print($regTurmas['Professor']); ?></td>
  </tr>
  <tr>
    <td height="17" bgcolor="#EFEFEF" class="Texto" style="color:#FF0000"><strong>Novo Professor:</strong> </td>
    <td bgcolor="#EFEFEF" style="padding-left: 0.2em"><select name="novoProfessor" class="TextoFormulario">
			<option value="0">[-- Selecionar Professor --]</option>
		<?php
		while($regProf = mysql_fetch_array($resProf)){
		?>
			<option value="<?php print($regProf['Id_Numero']); ?>"><?php print($regProf['Nome']); ?></option>
		<?php
		}
		?>
		</select>
		</td>
  </tr>
  <tr>
    <td height="40">&nbsp;</td>
    <td><input name="btnAlterar" type="submit" id="btnAlterar" value="Alterar" class="TextoFormulario" />&nbsp;&nbsp;<input name="btnVoltar" type="button" id="btnVoltar" value="Voltar" onclick="JavaScript: history.back(-1)" class="TextoFormulario" /></td>
  </tr>
</form>
</table>
</body>
</html>
