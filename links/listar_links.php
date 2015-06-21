<?php
require('../../conexao.php');

$comando = "SELECT * FROM links ORDER BY Tipo, Descricao";
$result = mysql_query($comando) or die ("Erro na Consulta do Link. ".mysql_error());
$num = mysql_num_rows($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(codg)
	{
	if(confirm("Confirma a exclusão deste Link?"))
		window.location = 'excluir_link.php?codg_link='+ codg;
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
			  <h3>Consulta de Link's </h3>
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
					<tr bgcolor="#EEEEEE"> 
						<td width="92%" height="15" align="left" class="Texto" style="padding-left: 0.3em"><b>Descri&ccedil;&atilde;o</b></td>
						<td width="8%" align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Opções</b></td>
					</tr>
					<tr>
						<td background="../../imagens/spacer.gif" height="1" bgcolor="#000000" colspan="2"></td>
					</tr>
					<?php
					if($num < 1){
					?>
					<tr> 
						<td height="18" colspan="2" align="center" class="Texto"><font color="#FF0000">Nenhum registro encontrado.</font></td>
					</tr>
					<?php
					}else{
						$conta = 0;
						$muda_tipo = 0;
						while($registro = mysql_fetch_array($result)){
							if($conta % 2 == 1){
								$cor = '#DDEEFF';
							}else{
								$cor = '#FFFFFF';
							}
							
							// Mudar Tipo
							if($muda_tipo != 0){
								if($muda_tipo != $registro['Tipo']){
					?>
					<tr>
						<td background="../../imagens/spacer.gif" height="2" bgcolor="#000000" colspan="2"></td>
					</tr>
					<tr>
						<td height="15" colspan="2" align="left" class="Texto" style="padding-left: 0.3em;" bgcolor="#FFCC99"><B><?php
						 switch($registro['Tipo']){
							case 1:
								print('UNIVERSIDADES');
							break;
							case 2:
								print('BIBLIOTECA');
							break;
							case 3:
								print('OUTROS');
							break;
							case 4:
								print('CONSELHOS DE CLASSE - FEDERAIS E REGIONAIS');
							break;
						}
					?></B></td>
					</tr>
					<?php
								}
							}
							if($conta == 0){
					?>
					<tr>
						<td height="15" colspan="2" align="left" class="Texto" style="padding-left: 0.3em;" bgcolor="#FFCC99"><B><?php
						switch($registro['Tipo']){
							case 1:
								print('UNIVERSIDADES');
							break;
							case 2:
								print('BIBLIOTECA');
							break;
							case 3:
								print('OUTROS');
							break;
							case 4:
								print('CONSELHOS DE CLASSE - FEDERAIS E REGIONAIS');
							break;
						}
					?></B></td>
					</tr>
					<?php
							}
					?>
					<tr bgcolor="<?php print($cor); ?>">
						<td height="15" align="left" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><?php print($registro['Descricao']); ?></td>
						<td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="alterar_link.php?codg_link=<?php print($registro['Codg_Link']); ?>"><img src="../../imagens/alterar.gif" border="0" title="Alterar"></a>&nbsp;|&nbsp;<a href="#" onClick="Confirma_Exclusao('<?php print($registro['Codg_Link']); ?>')"><img src="../../imagens/excluir.gif" title="Excluir" border="0"></a></td>
					</tr>
					<tr bgcolor="<?php print($cor); ?>">
					  <td height="15" align="left" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="http://www.<?php print($registro['Link']); ?>" target="_blank">http://www.<?php print($registro['Link']); ?></a></td>
					  <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em">&nbsp;</td>
				  </tr>
					<?php
							$conta++;
							$muda_tipo = $registro['Tipo'];
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