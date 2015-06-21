<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados

// Selecionar os cursos
$sql_curso = "SELECT * FROM curso ORDER BY Nome";
$res_curso = mysql_query($sql_curso) or die('Erro na consulta dos cursos');

// Selecionar as Disciplinas
$sql_disciplina = "SELECT * FROM disciplina ORDER BY Nome";
$res_disciplina = mysql_query($sql_disciplina) or die('Erro na consulta das disciplinas');

// Selecionar os professores
$sql_professor = "SELECT * FROM professor ORDER BY Nome";
$res_professor = mysql_query($sql_professor) or die('Erro na consulta dos professores.');

?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="JavaScript">
function Verificar(nForm){
	if(document.form_turma.ano.value == ''){
		alert('Favor, selecionar o Ano.');
		document.form_turma.ano.focus();
		return false;
	}
	if(document.form_turma.codigo.value==''){
		alert('Favor, digitar o Código da Turma.');
		document.form_turma.codigo.focus();
		return false;
	}
	if(document.form_turma.nome.value==''){
		alert('Favor, digitar o Nome da Turma.');
		document.form_turma.nome.focus();
		return false;
	}
	if(document.form_turma.curso.value == ''){
		alert('Favor, selecionar o Curso.');
		document.form_turma.curso.focus();
		return false;
	}
	if(document.form_turma.disciplina.value == ''){
		alert('Favor, selecionar a Disciplina.');
		document.form_turma.disciplina.focus();
		return false;
	}
	if(document.form_turma.professor.value == ''){
		alert('Favor, selecionar Professor(a).');
		document.form_turma.professor.focus();
		return false;
	}
	
	// Gravar dados
	ano = nForm.ano.value;
	codigo = nForm.codigo.value;
	nome = nForm.nome.value;
	curso = nForm.curso.value;
//	inicial = nForm.data_final.value;
//	final = nForm.data_final.value;
	disciplina = nForm.disciplina.value;
	professor = nForm.professor.value;
	
	//pagina = "gride_turmas.php?ano="+ano+"&codigo="+codigo+"&nome="+nome+"&curso="+curso+"&disciplina="+disciplina+"&professor="+professor+"&data_inicial="+inicial+"&data_final="+final;
	pagina = "gride_turmas.php?ano="+ano+"&codigo="+codigo+"&nome="+nome+"&curso="+curso+"&disciplina="+disciplina+"&professor="+professor;
	gride_turmas.location = pagina;

	// Limpar os campos
	nForm.disciplina.value = '';
	nForm.professor.value = '';

	// Direcionar o cursor
	nForm.disciplina.focus();
}

// Formatar data
function FormataData(campo,teclapress)  {
	var tecla = teclapress.keycode;
	vr = teclapress;
	
	vr = vr.replace(".","");
	vr = vr.replace("/","");
	tam = vr.length ;

	if ( tecla != 9 && tecla != 8 )   {
		if ( tam > 2 && tam < 5 )
			document.form_turma[campo].value = vr.substr(0,tam - 2) + '/' + vr.substr( tam - 2, tam );
		if ( tam > 5 && tam < 8 )
			document.form_turma[campo].value = vr.substr(0, 2)+'/' +vr.substr( 2, 2) + '/' + vr.substr( 4, 4);
	}
}
</script>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body onLoad="document.form_turma.ano.focus()">
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
			  <h3>Cadastro de Turmas </h3>
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
                      <form name="form_turma" method="get">
                            <tr>
                              <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Ano:</td>
                              <td style="padding-left: 0.3em;"><?php include('../../form_ano.php'); ?></td>
                        </tr>
                            <tr>
                              <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em">C&oacute;digo:</td>
                              <td width="78%" style="padding-left: 0.3em;"><input name="codigo" type="text" class="TextoFormulario" id="codigo" size="15" maxlength="15">&nbsp;<span  class="Texto style1">*</span></td>
                            </tr>
                            <tr>
                              <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Nome:</td>
                              <td style="padding-left: 0.3em"><input name="nome" type="text" class="TextoFormulario" id="nome" size="46" maxlength="100"></td>
                            </tr>
                            <tr>
                              <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Curso:</td>
                              <td style="padding-left: 0.3em"><select name="curso" class="TextoFormulario" id="curso">
                                    <option value="">[-- Selecionar --]</option>
                                    <?php
                                    while($reg_curso = mysql_fetch_array($res_curso)){
                                    ?>
                                    <option value="<?php print($reg_curso['Codg_Curso']); ?>"><?php print($reg_curso['Nome']); ?></option>
                                    <?php
                                    }
                                    ?>
                          </select></td>
                        </tr>
                            <tr>
                              <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Disciplina:</td>
                              <td style="padding-left: 0.3em"><select name="disciplina" class="TextoFormulario" id="disciplina">
                                    <option value="">[-- Selecionar --]</option>
                                    <?php
                                    while($reg_disciplina = mysql_fetch_array($res_disciplina)){
                                    ?>
                                    <option value="<?php print($reg_disciplina['Codg_Disciplina']); ?>"><?php print($reg_disciplina['Nome']); ?></option>
                                    <?php
                                    }
                                    ?>
                          </select></td>
                        </tr>
                            <tr>
                              <td height="22" align="right" class="Texto" style="padding-left: 0.3em">Professor:</td>
                              <td style="padding-left: 0.3em"><select name="professor" class="TextoFormulario" id="professor">
                                    <option value="">[-- Selecionar --]</option>
                                    <?php
                                    while($reg_professor = mysql_fetch_array($res_professor)){
                                    ?>
                                    <option value="<?php print($reg_professor['Id_Numero']); ?>"><?php print($reg_professor['Nome']); ?></option>
                                    <?php
                                    }
                                    ?>
                          </select></td>
                        </tr>
                            <tr>
                              <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
                              <td style="padding-left: 0.3em"><input name="gravar" type="button" id="gravar" value="Gravar" onClick="Verificar(this.form)">
                                    &nbsp;&nbsp;<input name="Limpar" type="reset" id="Limpar" onClick="document.form_turma.ano.focus()" value="Limpar"></td>
                            </tr>
                            <tr>
                              <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
                              <td class="Texto style1" style="padding-left: 0.3em">* Aten&ccedil;&atilde;o:<br>
                                O c&oacute;digo de cada turma e criado da seguinte forma: a primeira letra de cada nome e mais o n&uacute;mero da turma, <strong>exemplo: Controladoria e Finan&ccedil;as, turma 3, fica assim: CF003.</strong> </td>
                        </tr>
                            <tr>
                              <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
                              <td class="Texto style1" style="padding-left: 0.3em">&nbsp;</td>
                        </tr>
                            <tr>
                              <td colspan="2" class="Texto" style="padding-left: 0.3em"><iframe name="gride_turmas" src="gride_turmas.php" width="100%" height="250" frameborder="0"></iframe></td>
                        </tr>
                            <tr>
                              <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
                              <td class="Texto style1" style="padding-left: 0.3em">&nbsp;</td>
                        </tr>
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