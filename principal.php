<?php
session_start();
require('conexao.inc.php'); //== Conexão com o Banco de Dados

//== Consulta de Usuarios
$comando = "SELECT * FROM usuario_adm WHERE Login = '".$_SESSION['login']."'";
$result = mysql_query($comando) or die ("Erro na Consulta do Usuario.<br>Comando: ".$comando."<br>Erro: ".mysql_error());
$registro = mysql_fetch_array($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="emx_nav_left.css" type="text/css">
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19" height="19"><img src="img_menu/top_esquerda.gif" width="19" height="19"></td>
    <td height="19" background="img_menu/topo.gif">&nbsp;</td>
    <td width="19"><img src="img_menu/top_direita.gif" width="19" height="19"></td>
  </tr>
  <tr>
    <td height="100%" background="img_menu/esquerda.gif">&nbsp;</td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
	<!-- Conteúdo -->
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		  <td colspan="2" align="left" valign="top" style="padding-left: 0.3em"><br>
			<h3 style="font-family:Verdana;">&Aacute;rea administrativa - IPECON </h3>
			<br>
			<font face="Verdana" size="2">
			<font color="#FF0000"><i><?php print($registro['Nome']); ?></i></font>, seja bem vindo a área Administrativa do site.<br>
			Voc&ecirc; ter&aacute; acesso a toda &agrave; &aacute;rea administrativa, acessando o menu superio.<br> 
			<br />
			<br />
			<hr>
			&bull;&nbsp;Para alterar um professor de disciplina, <a href="disciplina/alterar_prof_diciplina.php">click aqui</a>.			</font>
		  </td>
		</tr>
	</table>
	<!-- Fim -->
	</td>
    <td background="img_menu/direita.gif">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="img_menu/baixo_esquerda.gif" width="19" height="19"></td>
    <td height="19" background="img_menu/baixo.gif">&nbsp;</td>
    <td><img src="img_menu/baixo_direita.gif" width="19" height="19"></td>
  </tr>
</table>
</body>
</html>
