<?php
/*
 * Criado em 14/04/2008
 *
 * Autor: Regis Andrade
 * e-mail: regisandrade@gmail.com
 * Nome do arquivo: selecionarProfessor.php
 */
require('../conexao.php'); // Faz a conexão com o banco
$sql = "SELECT * FROM professor";
if(!empty($_REQUEST['txtNome'])){
	$sql .= " WHERE Nome LIKE '%".$_REQUEST['txtNome']."%'";
}
$sql .= " ORDER BY Nome";
$resultado = mysql_query($sql) or die('Erro na consulta do Professor.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR">

<head>
<style type="text/css">
body{
	margin: 0px;
	padding: 0px;
}
.formulario{
	font: normal 13px Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	border: solid 1px #666666;
}
td{
	font: normal 13px Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
}
h3{
	margin: 0px;
	padding: 0px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	text-align: center;
}
.cabecalho{
	background-color: #DDDDDD;
}
</style>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript">
	function selecionar(vlr1,vlr2){
		window.opener.$('codgProfessor').value = vlr1;
		window.opener.$('nomeProfessor').innerHTML = vlr2;
		window.close();
	}
</script>
<title>Selecionar Professor</title>
</head>
<body>
<h3>Lista de professores</h3>
<form name="frmProfessor" action="selecionarProfessor.php" method="post">
	<table width="100%" border="0">
		<tr>
			<td align="center"><strong>Nome:</strong>&nbsp;<input type="text" class="formulario" name="txtNome" size="30" />&nbsp;<input type="submit" name="btnPesquisar" value="Pesquisar" class="formulario" /></td>
		</tr>
	</table>
</form>
<table width="100%" border="0">
	<tr>
		<td class="cabecalho" align="center"><strong>Selecionar</strong></td>
		<td class="cabecalho"><strong>Nome</strong></td>
	</tr>
	<?php
	while($dados = mysql_fetch_array($resultado)){
	?>
	<tr>
		<td align="center" height="15"><a href="#" onClick="selecionar('<?=$dados['Id_Numero']?>','<?=$dados['Nome']?>')" title="Selecionar"><img src="imagens/gif_ativar.gif" border="0" /></a></td>
		<td><?=$dados['Nome']?></td>
	</tr>
	<?php
	}
	?>
</table>
</body>
</html>