<?php
require('../../conexao.php'); // Faz a conexão com o banco
$cmd_curso = "SELECT * FROM curso WHERE STATUS = 1 ORDER BY Nome";
$res_curso = mysql_query($cmd_curso) or die('Erro na consulta do Curso. ');

/* Buscar os dados para atualização */
if(isset($_REQUEST['codgCurriculo'])){
	$sql = "select
				CUR.*,
				PRO.Nome
			from
				curriculo CUR
			inner join professor PRO on
				PRO.Id_Numero = CUR.CodgProfessor
			where
				CUR.codgCurriculo = ".$_REQUEST['codgCurriculo'];
	$resultado = mysql_query($sql);
	$registro  = mysql_fetch_object ($resultado);
}
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">

function Verificar(){
	if($('codgProfessor').value==''){
		alert('Favor, selecionar o(a) Professor(a).');
		$('codgProfessor').focus();
		return false;
	}
}

function abrirJanela(file,titulo,largura,altura){
	posx = (screen.width/2)-(largura/2)
	posy = (screen.height/2)-(altura/2)
	propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px, status=1, scrollbars=1" ;
	window.open(file,titulo,propriedades);
}

function limparNomeProfessor(){
	$('codgProfessor').value = "";
	$('nomeProfessor').innerHTML = "Selecionar um professor";
}

function mostrarTipo(tipo){
	if(tipo == "url"){
		$('divUrl').show();
		$('divUrl').focus();
		$('divArq').hide();
	}else{
		$('divArq').show();
		$('divArq').focus();
		$('divUrl').hide();
	}
}
</script>
<script type="text/javascript" src="../js/prototype.js"></script>
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
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Cadastro de Currículo</h3></div></td>
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
				<form name="formCurriculo" id="formCurriculo" method="post" action="gravar.php" enctype="multipart/form-data" onSubmit="return Verificar()">
				<input type="hidden" name="ligado" value="1">
				<input type="hidden" name="codgCurriculo" value="<?php echo $registro->codgCurriculo ?>">
				<tr>
					<td width="18%" height="22" align="right" class="Texto" style="padding-right: 0.3em">Curso:</td>
					<td width="82%" style="padding-left: 0.3em"><select name="codgCurso" id="codgCurso" class="TextoFormulario">
						<option value="??">[-- Selecione um Curso--]</option>
						<?php
						while($reg_curso = mysql_fetch_array($res_curso)){
						?>
						<option value="<?php echo $reg_curso['Codg_Curso']; ?>" <?php echo ($reg_curso['Codg_Curso'] == $registro->codgCurso ? 'selected' : '') ?>><?php echo $reg_curso['Nome']; ?></option>
						<?php
						}
						?>
					</select>&nbsp;<span style="font-family:verdana; font-size:9px; color:#FF0000">"Relação de cursos ativos."</span></td>
				  </tr>
				  <tr>
						<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Professor:&nbsp;<a href="#" onClick="JavaScript:limparNomeProfessor();" title="Limpar o nome do professor"><img src="../imagens/icons/limpa.gif" border="0" /></a>&nbsp;<a href="#" onClick="JavaScript:abrirJanela('../selecionarProfessor.php','ListarProfessores',450,250);"><img src="../imagens/icons/buscar.jpg" border="0" /></a></td>
						<td style="padding-left: 0.3em" class="Texto"><input type="hidden" name="codgProfessor" id="codgProfessor" value="<?php echo $registro->CodgProfessor; ?>" /><label name="nomeProfessor" id="nomeProfessor"><?php echo ($registro->Nome ? $registro->Nome : '<strong>Selecionar um professor</strong>'); ?></label></td>
				  </tr>
				<tr>
					<td width="18%" height="22" align="right" class="Texto" style="padding-right: 0.3em">Titulação:</td>
					<td width="82%" style="padding-left: 0.3em"><select name="titulacao" id="titulacao" class="TextoFormulario">
						<option value="">[-- Selecione uma titulação--]</option>
						<option value="Graduação" <?php echo ($registro->titulacao == 'Graduação' ? 'selected' : '') ?>>Graduação</option>
						<option value="Especialista" <?php echo ($registro->titulacao == 'Especialista' ? 'selected' : '') ?>>Especialista</option>
						<option value="Mestre" <?php echo ($registro->titulacao == 'Mestre' ? 'selected' : '') ?>>Mestre</option>
						<option value="Doutor" <?php echo ($registro->titulacao == 'Doutor' ? 'selected' : '') ?>>Doutor</option>
						<option value="PhD" <?php echo ($registro->titulacao == 'PhD' ? 'selected' : '') ?>>PhD</option>
					</select></td>
				  </tr>
				<tr>
					<td width="18%" height="22" align="right" class="Texto" style="padding-right: 0.3em">PUC:</td>
					<td width="82%" style="padding-left: 0.3em"><select name="puc" id="puc" class="TextoFormulario">
						<option value="" selected>[-- Selecione --]</option>
						<option value="Sim" <?php echo ($registro->puc == 'Sim' ? 'selected' : '') ?>>Sim</option>
						<option value="Não" <?php echo ($registro->puc == 'Não' ? 'selected' : '') ?>>Não</option>
					</select></td>
				  </tr>
				  <tr>
						<td height="22" align="right" class="Texto" style="padding-left: 0.3em">Endereço Lattes:</td>
						<td style="padding-left: 0.3em">http://<input name="url" type="text" size="40" class="TextoFormulario" id="url" value="<?php echo $registro->url ?>" /></td>
				  </tr>
				  <tr>
						<td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
						<td style="padding-left: 0.3em"><input name="gravar" type="submit" id="gravar" value="Enviar" class="TextoFormulario">&nbsp;&nbsp;<input type="button" name="voltar" value="Cancelar" onClick="history.back()" class="TextoFormulario"></td>
				  </tr>
				</form>
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
