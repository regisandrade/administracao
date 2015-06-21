<?php
require('../../conexao.php');

$comando = "
SELECT
	Codg_Artigo,
	Descricao,
	Artigo,
	Todos
FROM
	artigo
ORDER BY
	Descricao
";

$result = mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta dos Artigos. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());;
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
			  <h3>Consulta de Artigos </h3>
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
				  <td width="67%" height="18" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>Artigo</b></td> 
				  <td width="25%" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; font-weight: bold;">Todos (Alunos/Ipecon) </td>
				  <td width="8%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Opções</b></td>
				</tr>
				<?php
				if($num < 1){
				?>
				<tr> 
				  <td colspan="3" align="center" class="Texto"><font color="#FF0000">Nenhum registro encontrado.</font></td>
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
				  <td align="left" class="Texto" style="padding-left: 0.3em"><a href="http://www.ipecon.com.br/artigos_publicados/<?php print($registro['Artigo']); ?>" target="_blank"><img src="../../imagens/disco.gif" border="0" align="absmiddle">			  <?php print($registro['Descricao']); ?></a></td>
				  <td align="left" class="Texto" style="padding-left: 0.3em"><?php
				  if($registro['Todos'] == 1){
					print('SIM');
				  }else{
					print('&nbsp;');	
				  }
				  ?></td>
				  <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="#" onClick="Confirma_Exclusao('<?php print($registro['Codg_Artigo']); ?>','<?php print($registro['Artigo']); ?>')"><img src="../../imagens/excluir.gif" border="0" title="Excluir"></a></td>
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
