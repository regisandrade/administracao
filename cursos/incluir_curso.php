<?php
session_start();
require('../../conexao.php'); //== Conexão com o Banco de Dados
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(){
	if(document.form_cursos.nome.value==''){
		alert('Favor, digitar o Nome do Curso.');
		document.form_cursos.nome.focus();
		return false;
	}

	if(document.form_cursos.qtde_horas.value==''){
		alert('Favor, digitar a Quantidade de Horas para o Curso.');
		document.form_cursos.qtde_horas.focus();
		return false;
	}

	if(document.form_cursos.turma.value==''){
		alert('Favor, digitar a Turma.');
		document.form_cursos.turma.focus();
		return false;
	}

	if(document.form_cursos.data_inicio.value==''){
		alert('Favor, digitar a Data de Início do Curso.');
		document.form_cursos.data_inicio.focus();
		return false;
	}

	if(document.form_cursos.data_fim.value==''){
		alert('Favor, digitar a Data Final do Curso.');
		document.form_cursos.data_fim.focus();
		return false;
	}
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
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Cadastro de Cursos </h3></div></td>
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
			  <form name="form_cursos" method="get" action="curso_incluido.php" onSubmit="return Verificar()">
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Nome:</td>
				  <td width="78%" style="padding-left: 0.3em"><input name="nome" type="text" class="TextoFormulario" size="46" maxlength="150"></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Quantidade de Horas:</td>
				  <td style="padding-left: 0.3em"><input name="qtde_horas" type="text" class="TextoFormulario" id="qtde_horas" size="15" maxlength="15"></td>
				</tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="gravar" type="submit" id="gravar" value="Gravar">
					&nbsp;&nbsp;
					<input name="Limpar" type="reset" id="Limpar" onClick="document.form_cursos.nome.focus()" value="Limpar"></td>
				</tr>
				<script language="JavaScript">document.form_cursos.nome.focus()</script>
			  </form>
			</table></td>
		</tr>
		<tr>
			<td colspan="2" align="center" valign="bottom"><div class="Texto" id="siteInfo">Administra&ccedil;&atilde;o IPECON | &copy;2004 IPECON Ensino e Consultoria Ltda.</div></td>
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