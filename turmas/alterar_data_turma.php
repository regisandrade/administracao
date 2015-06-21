<?php
//== ConexÃ£o com o Banco de Dados
require('../../conexao.php');

/** ALTERAR DATA DA TURMA **/
if(isset($_POST['alterar'])){
	// Formatação da Data
	$data = explode('/',$_REQUEST['dtInicial']);
	$_REQUEST['dtInicial'] = $data[2].'-'.$data[1].'-'.$data[0];

	$data = explode('/',$_REQUEST['dtFinal']);
	$_REQUEST['dtFinal'] = $data[2].'-'.$data[1].'-'.$data[0];
	
	$sql_alterar = "UPDATE turma SET 
		Data_Inicial = '".$_REQUEST['dtInicial']."', 
		Data_Final = '".$_REQUEST['dtFinal']."',
                turmaFechada = '".$_REQUEST['turmaFechada']."'
	WHERE 
		Ano = ".$_REQUEST['ano']." AND 
		Turma = '".$_REQUEST['turma']."'";
	
	if(!mysql_query($sql_alterar)){
		die('ERRO: ALTERAR DATA DA TURMA');
		exit;
	}
?>
	<script language="javascript">
		alert('Alteração realizada com sucesso.');
		window.location = "resultado_consultar_turmas.php?ano=<?=$_REQUEST['ano']?>";
	</script>
<?php
	exit;
}// FIM IF ALTERAR

/** BUSCAR OS DADOS DA TURMA, DATA INICIAL E DATA FINAL**/
$sql = "SELECT Data_Inicial, Data_Final, turmaFechada FROM turma WHERE Ano = ".$_REQUEST['ano']." AND Turma = '".$_REQUEST['turma']."'";
$resultado = mysql_query($sql) or die('ERRO NA CONSULTA DA DATA DA TURMA.');
$dados = mysql_fetch_array($resultado);

/** DATAS PARA IMPRESSÃƒO NA TELA **/
$dtInicial = substr($dados['Data_Inicial'],8,2).'/'.substr($dados['Data_Inicial'],5,2).'/'.substr($dados['Data_Inicial'],0,4);
$dtFinal = substr($dados['Data_Final'],8,2).'/'.substr($dados['Data_Final'],5,2).'/'.substr($dados['Data_Final'],0,4);
?>
<html>
<head>
<title>AdministraÃ§Ã£o :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>
<body onLoad="document.form_turma.disciplina.focus()">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19" height="19"><img src="../img_menu/top_esquerda.gif" width="19" height="19"></td>
    <td width="162" height="19" background="../img_menu/topo.gif">&nbsp;</td>
    <td width="19"><img src="../img_menu/top_direita.gif" width="19" height="19"></td>
  </tr>
  <tr>
    <td height="100%" background="../img_menu/esquerda.gif">&nbsp;</td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
	<!-- ConteÃºdo -->
	<table width="100%" height="95%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Alterar data inicial e final da turma</h3>
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
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
			  <form name="form_turma" method="post" action="alterar_data_turma.php">
				<input type="hidden" name="ano" value="<?=$_REQUEST['ano']?>" />
				<input type="hidden" name="turma" value="<?=$_REQUEST['turma']?>" />
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Ano:</td>
				  <td style="padding-left: 0.3em;" class="Texto"><strong><?=$_REQUEST['ano']?></strong></td>
			    </tr>
				<tr>
				  <td width="22%" height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Turma:</td>
				  <td width="78%" style="padding-left: 0.3em;" class="Texto"><strong><?=$_REQUEST['turma'].'-'.$_REQUEST['descTurma']?></strong></td>
				</tr>
				<tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Data Inicial:</td>
				  <td style="padding-left: 0.3em"><input type="text" name="dtInicial" id="dtInicial" size="11" value="<?=$dtInicial?>" class="TextoFormulario" /></td>
			   </tr>
                            <tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Data Final:</td>
				  <td style="padding-left: 0.3em"><input type="text" name="dtFinal" id="dtFinal" size="11" value="<?=$dtFinal?>" class="TextoFormulario" /></td>
			   </tr>
                            <tr>
				  <td height="22" align="right" class="Texto" style="padding-left: 0.3em" bgcolor="#EEEEEE">Turma Fechada?</td>
                                  <td style="padding-left: 0.3em" class="Texto" ><input type="radio" name="turmaFechada" id="turmaFechada" value="S" <?php echo ($dados['turmaFechada'] == 'S' ? 'checked' : ''); ?> />Sim<br/>
                                  <input type="radio" name="turmaFechada" id="turmaFechada" value="N" <?php echo ($dados['turmaFechada'] == 'N' ? 'checked' : ''); ?> />Não</td>
			   </tr>
				<tr>
				  <td height="35" class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td style="padding-left: 0.3em"><input name="alterar" type="submit" id="alterar" value="Alterar">
					&nbsp;&nbsp;<input name="Voltar" type="button" id="Voltar" onClick="JavaScript:history.back(-1)" value="Voltar"></td>
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