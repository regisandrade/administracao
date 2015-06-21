<?php
session_start();
require('../../conexao.php'); //== Conexão com o Banco de Dados
// Consultar as turmas
$sql_turma = "SELECT DISTINCT Turma, Nome FROM turma  ORDER BY Nome";
$res_turma = mysql_query($sql_turma) or die('Erro na consulta das Turmas. '.mysql_error());
// Fim consulta turma

// Consultar as disciplinas
$sql_disciplina = "SELECT DISTINCT TUR.Disciplina AS CodgDisciplina,
                    DISC.Nome as NomeDisciplina
                   FROM turma TUR
                   INNER JOIN disciplina DISC ON DISC.Codg_Disciplina = TUR.Disciplina ";
if($_REQUEST['codgTurma']){
    $sql_disciplina .= "WHERE TUR.Turma = '".$_REQUEST['codgTurma']."'";
}
$sql_disciplina .= " ORDER BY DISC.Nome";
$res_disciplina = mysql_query($sql_disciplina) or die('Erro na consulta das Disciplinas. '.mysql_error());
// Fim consulta disciplina
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="../js/prototype.js"></script>
<script language="JavaScript">
function Verificar(){
	if(document.form_cronograma.turma.value == 0){
		alert('Favor, selecionar uam Turma.');
		document.form_cronograma.turma.focus();
		return false;
	}
	if(document.form_cronograma.disciplina.value == 0){
		alert('Favor, selecionar uma Disciplina.');
		document.form_cronograma.disciplina.focus();
		return false;
	}
	if(document.form_cronograma.data1.value == ''){
		alert('Favor, digitar a 1ª Data.');
		document.form_cronograma.data1.focus();
		return false;
	}
	if(document.form_cronograma.data2.value == ''){
		alert('Favor, digitar a 2ª Data.');
		document.form_cronograma.data2.focus();
		return false;
	}
	if(document.form_cronograma.data3.value == ''){
		alert('Favor, digitar a 3ª Data.');
		document.form_cronograma.data3.focus();
		return false;
	}
	if(document.form_cronograma.data4.value == ''){
		alert('Favor, digitar a 4ª Data.');
		document.form_cronograma.data4.focus();
		return false;
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

// Formatar a data
function FormataData(campo,teclapress)  {
	var tecla = teclapress.keycode;
	vr = teclapress;

	vr = vr.replace(".","");
	vr = vr.replace("/","");
	tam = vr.length ;

	if ( tecla != 9 && tecla != 8 )   {
		if ( tam > 2 && tam < 5 )
			document.form_cronograma[campo].value = vr.substr(0,tam - 2) + '/' + vr.substr( tam - 2, tam );
		if ( tam > 5 && tam < 8 )
			document.form_cronograma[campo].value = vr.substr(0, 2)+'/' +vr.substr( 2, 2) + '/' + vr.substr( 4, 4);
	}
}

function novoCronograma(){
    document.location = "incluir_cronograma.php"
}

function mostraErro(transport) {
    fAguarde(false);
    alert ('Erro: '+transport.responseText);
}
function mostrarItens() {
    var url = 'ajaxListaCronogramaIncluido.php?turma='+$('turma').value;
    var params = Form.serialize($('form_cronograma'));
    var ajax = new Ajax.Updater(
        {success: 'resultados'},
        url,
            {method: 'post',
                //parameters: params,
                onFailure: mostraErro,
                evalScripts: true
            });
}
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
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
			  <h3>Cadastro de Cronogramas</h3>
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
			  <form name="form_cronograma" id="form_cronograma" method="get" action="cronograma_incluido.php" onSubmit="return Verificar()">
			  <input type="hidden" name="local" value="1" />
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">Turma:</td>
				  <td width="78%" style="padding-left: 0.3em"><select name="turma" id="turma" class="TextoFormulario" onChange="mostrarItens()">
					<option value="0">-- Selecionar Turma --</option>
					<?
					while($reg_turma = mysql_fetch_array($res_turma)){
					?>
					  <option value="<?php echo $reg_turma['Turma']; ?>" <?php echo (isset($_REQUEST['codgTurma']) && $reg_turma['Turma'] == $_REQUEST['codgTurma'] ? 'selected' : '')?>><?php echo $reg_turma['Turma'].'|'.$reg_turma['Nome']; ?></option>
					<?
					}
					?>
					</select>
				  </td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Disciplina:</td>
				  <td style="padding-left: 0.3em"><select name="disciplina" id="disciplina" class="TextoFormulario">
					<option value="0">-- Selecionar Disciplina --</option>
					<?
					while($reg_disciplina = mysql_fetch_array($res_disciplina)){
					?>
					  <option value="<?php print($reg_disciplina['CodgDisciplina']); ?>"><?php print($reg_disciplina['NomeDisciplina']); ?></option>
					<?
					}
					?>
					</select>
				  </td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td class="Texto" style="padding-left: 0.3em">1&ordf; Data:
				<input name="data1" type="text" class="TextoFormulario" id="data1" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
				<span class="style1">*</span>              2&ordf; Data:
					<input name="data2" type="text" class="TextoFormulario" id="data2" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
					<span class="style1">*</span>              3&ordf; Data:
				  <input name="data3" type="text" class="TextoFormulario" id="data3" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
				  <span class="style1">*</span><br>
				  4&ordf; Data:
				  <input name="data4" type="text" class="TextoFormulario" id="data4" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
				  <span class="style1">*</span>              5&ordf; Data:
				  <input name="data5" type="text" class="TextoFormulario" id="data5" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
				  <span class="style1">*</span>              6&ordf; Data:
				  <input name="data6" type="text" class="TextoFormulario" id="data6" size="11" maxlength="10" onKeyPress="FormataData(this.name, this.value)">
				  <span class="style1">*</span> <br>
				  <span class="style1">*Aten&ccedil;&atilde;o, digitar a data sem barra &quot;/&quot;.</span> </td>
				</tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="gravar" type="submit" id="gravar" value="Gravar">

				  &nbsp;&nbsp;<input name="limpar" type="reset" id="limpar" onClick="novoCronograma()" value="Novo Cronograma"></td>
				</tr>
				<tr>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em">&nbsp;</td>
				</tr>
				<tr>
                                    <td colspan="2"><div id="resultados">&nbsp;</div></td>
				</tr>
				<script language="JavaScript">document.form_cronograma.turma.focus()</script>
			  </form>
			</table></td>
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
    <script type="text/javascript">
        mostrarItens();
    </script>
</body>
</html>