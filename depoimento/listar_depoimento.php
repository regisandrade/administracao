<?php
require('../../conexao.php');

$comando = "
SELECT
	DEP.ID_Depoimento,
	ALU.Nome AS Aluno,
	CUR.Nome AS Curso,
	DEP.Depoimento,
	DEP.Status
FROM
	depoimento DEP
INNER JOIN aluno ALU ON
	ALU.Id_Numero = DEP.Aluno
INNER JOIN curso CUR ON
	CUR.Codg_Curso = DEP.Codg_Curso
ORDER BY
	CUR.Nome
";

$result = mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta dos Depoimentos. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());;
$num = mysql_num_rows($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(codg,nome){
	if(confirm("Confirma a exclusão deste Artigo?"))
		window.location = 'excluir_artigo.php?codg_artigo='+codg+'&artigo='+nome;
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
			  <h3>Aprovar Depoimentos</h3>
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
				<table width="250" border="0" cellpadding="0" cellspacing="0" class="Texto">
					<tr>
						<td height="18" align="right" style="padding-right: 0.5em"><b>Legenda:</b></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td height="18" align="right" style="padding-right: 0.5em"><img src="../../imagens/favoritos.gif" border="0"></td>
						<td>Liberar depoimento</td>
					</tr>
					<tr>
						<td height="18" align="right" style="padding-right: 0.5em"><img src="../../imagens/bloquear.gif" border="0"></td>
						<td>Bloquear depoimento</td>
					</tr>
					<tr>
						<td height="18" align="right" style="padding-right: 0.5em"><img src="../../imagens/excluir.gif" border="0"></td>
						<td>Excluir depoimento</td>
					</tr>
					<tr>
						<td height="18" align="right" style="padding-right: 0.5em"><img src="../img_adm/status_depoimento.gif" border="0"></td>
						<td>Depoimento Liberado</td>
					</tr>
				</table><br>
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td width="25%" height="18" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>Aluno</b></td> 
				  <td width="15%" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; font-weight: bold;">Curso</td>
				  <td width="50%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Depoimento</b></td>
				  <td width="10%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em">&nbsp;</td>
				</tr>
				<?php
				if($num < 1){
				?>
				<tr> 
				  <td colspan="3" align="center" class="Texto"><font color="#FF0000">Nenhum registro encontrado.</font></td>
				</tr>
				<?php
				}else{
					while($registro = mysql_fetch_array($result)){
				?>
				<tr bgcolor="<?php if($registro['Status'] == 1){ print('#FFFFCC'); } ?>"> 
				  <td align="left" class="Texto" style="padding-left: 0.3em"><?php print($registro['Aluno']); ?></td>
				  <td align="left" class="Texto" style="padding-left: 0.3em"><?php print($registro['Curso']); ?></td>
				  <td align="left" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em; text-align: justify"><?php print(nl2br($registro['Depoimento'])); ?></td>
				  <td class="Texto" align="center"><a href="atualizar.php?tipo=1&id_depoimento=<?php print($registro['ID_Depoimento']); ?>" title="Liberar Depoimento"><img src="../../imagens/favoritos.gif" border="0"></a>&nbsp;|&nbsp;<a href="atualizar.php?tipo=2&id_depoimento=<?php print($registro['ID_Depoimento']); ?>" title="Bloquear Depoimento"><img src="../../imagens/bloquear.gif" border="0"></a>&nbsp;|&nbsp;<a href="atualizar.php?tipo=3&id_depoimento=<?php print($registro['ID_Depoimento']); ?>" title="Excluir Depoimento"><img src="../../imagens/excluir.gif" border="0"></a></td>
				</tr>
				<?php
					}
				}
				?>
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


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Exemplo</title>
<link rel="stylesheet" href="../imagens/emx_nav_left.css" type="text/css">
</head>
<body>
</body>
</html>