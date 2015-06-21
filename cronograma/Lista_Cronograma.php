<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados

// Consultar as turmas
$sql_turma = "SELECT DISTINCT Turma, Nome FROM turma  ORDER BY Nome";
$res_turma = mysql_query($sql_turma) or die('Erro na consulta das Turmas. '.mysql_error());
// Fim consulta turma

// Consulta Cronograma
$query = "
SELECT DISTINCT
      CRO.Id_Numero,
      CRO.Turma,
      TUR.Nome AS NomeTurma,
      CRO.Disciplina AS CodgDisciplina,
      DISC.Nome AS Disciplina,
      DATE_FORMAT(Data_01,'%d/%m/%Y') AS Data_01,
      DATE_FORMAT(Data_02,'%d/%m/%Y') AS Data_02,
      DATE_FORMAT(Data_03,'%d/%m/%Y') AS Data_03,
      DATE_FORMAT(Data_04,'%d/%m/%Y') AS Data_04,
      DATE_FORMAT(Data_05,'%d/%m/%Y') AS Data_05,
      DATE_FORMAT(Data_06,'%d/%m/%Y') AS Data_06
FROM
    cronograma CRO
INNER JOIN turma TUR ON
    TUR.Turma = CRO.Turma
INNER JOIN disciplina DISC ON
    DISC.Codg_Disciplina = CRO.Disciplina
WHERE CRO.Id_Numero > 0 \n\r";

if(!empty($_REQUEST['turma'])){
	$query .= "and CRO.Turma = '".$_REQUEST['turma']."'";
}

$query .= "
ORDER BY
	TUR.Nome, CRO.Data_01, CRO.Data_02, CRO.Data_03, CRO.Data_04, CRO.Data_05, CRO.Data_06 DESC";
$resultado = mysql_query($query) or die('Erro na consulta do Cronograma. '.$query);
$numero = mysql_num_rows($resultado);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<style type="text/css">
tr.linha:hover{
	background-color: #FFFF99;
}
</style>
<script src="../js/prototype.js" type="text/javascript"></script>
<script language="JavaScript1.2">
// Excluir a turma
function  excluirTurma(codg){
	if(confirm("Confirma a exclusão desta Turma?")){
		window.location = 'excluir_cronograma.php?codgTurma='+codg;
	}
}

// Função para uma mensagem de exclusão
function  ConfirmaExclusaoCronograma(codg,local,turma){
	// Local = 1 -> cadastro
	// Local = 2 -> consulta
	if(confirm("Confirma a exclusão deste Cronograma?")){
		window.location = 'excluir_cronograma.php?codg='+codg+'&local='+local+'&turma='+turma;
	}
}

function atualizar(){
	$('formListaCronograma').submit();
}
</script>
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
	<form name="formListaCronograma" id="formListaCronograma" action="" metod="POST">
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Consulta de Cronogramas </h3>
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
				<table width="100%" border="0" cellpadding="0" cellspacing="4" class="Texto">
					<tr>
						<td width="10%"><strong>Filtrar por turma:</strong></td>
						<td width="90%"><select name="turma" id="turma" class="TextoFormulario" onChange="atualizar()">
								<option value="0">-- Selecionar uma Turma --</option>
								<option value="0">[Selecionar todas as Turmas]</option>
							<?
							while($reg_turma = mysql_fetch_array($res_turma)){
							?>
					  			<option value="<?php echo $reg_turma['Turma']; ?>" <?php echo ($_REQUEST['turma'] == $reg_turma['Turma'] ? "selected" : "") ?>><?php echo $reg_turma['Turma'].'|'.$reg_turma['Nome']; ?></option>
							<?
							}
							?>
							</select>
						</td>
					</tr>
				</table>
				<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="Texto">
				  <tr bgcolor="#dddddd">
					<td width="38%" style="padding-left: 0.3em"><strong>Disciplina</strong></td>
					<td width="9%" style="padding-left: 0.3em"><strong>1&ordf; Data </strong></td>
					<td width="9%" style="padding-left: 0.3em"><strong>2&ordf; Data </strong></td>
					<td width="9%" style="padding-left: 0.3em"><strong>3&ordf; Data</strong></td>
					<td width="9%" style="padding-left: 0.3em"><strong>4&ordf; Data </strong></td>
					<td width="9%" style="padding-left: 0.3em"><strong>5&ordf; Data </strong></td>
					<td width="9%" style="padding-left: 0.3em"><strong>6&ordf; Data</strong></td>
					<td width="8%">&nbsp;</td>
				  </tr>
				  <?php
				  if($numero == 0){
				  ?>
				  <tr align="center">
					<td height="17" colspan="8"><span class="style1">Nenhum registro encontrado. </span></td>
				  </tr>
				  <?php
				  }else{
					$conta = 0;
					$muda_curso = '0';
					while($dados = mysql_fetch_array($resultado)){
						if($conta % 2 == 1){
							$cor = '#DDEEFF';
						}else{
							$cor = '#FFFFFF';
						}
							if($muda_curso != '0'){
								if($muda_curso != $dados['Turma']){
				  ?>
					<tr>
						<td bgcolor="#FFECD9" colspan="8" align="left" class="Texto" style="padding-left: 0.3em; font-weight:bold"><?php print($dados['Turma']); ?>|<?php print($dados['NomeTurma']); ?>&nbsp;-&nbsp;<a href="JavaScript:excluirTurma('<?php print($dados['Turma']); ?>')" title="Excluir todos disciplina da turma"><img src="../../imagens/excluir.gif" alt="Excluir Cronograma" width="16" height="16" border="0"></a></td>
					</tr>
					<?php
								}
							}
							if($conta == 0){
					?>
					<tr>
                                            <td bgcolor="#FFECD9" colspan="8" align="left" class="Texto" style="padding-left: 0.3em; font-weight:bold"><?php print($dados['Turma']); ?>|<?php print($dados['NomeTurma']); ?>&nbsp;-&nbsp;<a href="JavaScript:excluirTurma('<?php print($dados['Turma']); ?>')" title="Excluir todos disciplina da turma"><img src="../../imagens/excluir.gif" alt="Excluir Cronograma" width="16" height="16" border="0"></a></td>
					</tr>
					<?php
							}
					?>
				  <tr bgcolor="<?php print($cor); ?>" class="linha">
					<td style="padding-left: 0.3em"><?php print($dados['Disciplina']); ?></td>
					<td style="padding-left: 0.3em"><?php print($dados['Data_01']); ?></td>
					<td style="padding-left: 0.3em"><?php print($dados['Data_02']); ?></td>
					<td style="padding-left: 0.3em"><?php print($dados['Data_03']); ?></td>
					<td style="padding-left: 0.3em"><?php print($dados['Data_04']); ?></td>
					<td style="padding-left: 0.3em"><?php print($dados['Data_05']); ?></td>
					<td style="padding-left: 0.3em"><?php print($dados['Data_06']); ?></td>
                    <td align="center"><a href="alterar_cronograma.php?codg=<?php echo $dados['Id_Numero']; ?>&codgDisciplina=<?php echo $dados['CodgDisciplina']; ?>&codgTurma=<?php echo $dados['Turma']; ?>" title="Alterar"><img src="../../imagens/alterar.gif" alt="Alterar Cronograma" width="16" height="16" border="0"></a>&nbsp;|&nbsp;<a href="JavaScript:ConfirmaExclusaoCronograma(<?php echo $dados['Id_Numero']; ?>,2,'<?php echo $dados['Turma']; ?>')" title="Excluir"><img src="../../imagens/excluir.gif" alt="Excluir Cronograma" width="16" height="16" border="0"></a></td>
				  </tr>
				  <?php
					$conta++;
					$muda_curso = $dados['Turma'];
					}
				  }
				  ?>
				</table>
			</td>
		</tr>
	</table>
	</form>
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