<?php
require('../../conexao.php');

$comando = "
	SELECT
		id,
		Nome,
		Sexo,
		Login
	FROM
		usuario_adm";

$result = mysql_query($comando);
$num = mysql_num_rows($result);
?>
<html>
<head>
<title>Administra��o :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript1.2">
// Fun��o para uma mensagem de exclus�o
function  Confirma_Exclusao(codg)
	{
	if(confirm("Confirma a exclus�o deste Usu�rio?"))
		window.location = 'excluir_usuario.php?id='+ codg;
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
	<!-- Conte�do -->
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Consulta de Usu&aacute;rios </h3>
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
						<td width="60%" align="left" class="Texto" style="padding-left: 0.3em"><b>Nome</b></td>
						<td width="15%" align="left" class="Texto" style="padding-left: 0.3em"><b>Sexo</b></td>
						<td width="15%" align="left" class="Texto" style="padding-left: 0.3em"><b>Login</b></td>
						<td width="10%" align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Op��es</b></td>
					</tr>
					<?php
					if($num < 1){
					?>
					<tr> 
						<td colspan="4" align="center" class="Texto"><font color="#FF0000">Nenhum registro encontrado.</font></td>
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
						<td align="left" class="Texto" style="padding-left: 0.3em"><?php print($registro['Sexo']); ?></td>
						<td align="left" class="Texto" style="padding-left: 0.3em"><?php print($registro['Login']); ?></td>
						<td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="alterar_usuario.php?id=<?php print($registro['id']); ?>"><img src="../../imagens/alterar.gif" border="0" title="Alterar"></a>&nbsp;|&nbsp;<a href="#" onClick="Confirma_Exclusao('<?php print($registro['id']); ?>')"><img src="../../imagens/excluir.gif" border="Excluir" title="Excluir"></a></td>
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
