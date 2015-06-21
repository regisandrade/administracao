<?php

require('../../conexao.php');

$comando = "
SELECT
	Codg_Curso,
	Nome,
	Qtde_Horas,
	Status
FROM
	curso
ORDER BY 
	Status desc, Nome
";
$result = mysql_query($comando);
$num = mysql_num_rows($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(codg)
	{
	if(confirm("Confirma a exclusão deste Curso?"))
		window.location = 'excluir_curso.php?codg_curso='+ codg;
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
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Consulta de Cursos </h3>
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
				<tr> 
				  <td width="54%" height="15" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>Nome</b></td>
				  <td width="19%" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>Horas</b></td>
				  <td width="17%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><strong>Situa&ccedil;&atilde;o</strong></td>
				  <td width="10%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Opções</b></td>
				</tr>
				<?php
						if($num < 1){
						?>
				<tr> 
				  <td colspan="4" align="center" class="Texto"><font color="#FF0000">Nenhum 
					registro encontrado.</font></td>
				</tr>
				<?php
				}else{
					$conta = 0;
					while($registro = mysql_fetch_array($result)){
						if($conta % 2 == 1){
							$cor = '#DDEEFF';
						}else{
							$cor = '#FFFFFF';
						}
				?>
				<tr bgcolor="<?php print($cor); ?>"> 
				  <td align="left" class="Texto" style="padding-left: 0.3em"><?php print($registro['Nome']); ?></td>
				  <td align="left" class="Texto" style="padding-left: 0.3em"><?php print($registro['Qtde_Horas']); ?></td>
				  <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><?php
				  switch($registro['Status']){
					case 0:
						print('<span style="color: #FF0000">Inativo</span>');
					break;
					case 1:
						print('Ativo');
					break;
				  }
				  ?>
				  </td>
				  <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="alterar_curso.php?codg_curso=<?php print($registro['Codg_Curso']); ?>"><img src="../../imagens/alterar.gif" title="Alterar" border="0"></a></td>
				</tr>
				<?php
						$conta++;
					}
				}
				?>
			  </table>
			</td>
		</tr>
	</table>
	<!-- Fim &nbsp;|&nbsp;<a href="#" onClick="Confirma_Exclusao(<?php print($registro['Codg_Curso']); ?>)"><img src="../../imagens/excluir.gif" border="0" title="Excluir"></a> -->
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