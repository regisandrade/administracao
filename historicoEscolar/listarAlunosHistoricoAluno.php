<?php
require('../../conexao.php');

//== Selecionar o nome e a turma
$seq = explode('|',$_POST['turma']);
$codg_turma = $seq[0];
$nome_turma = $seq[1];
$ano_turma = $seq[2];

// Consultar Alunos
$sql = "SELECT DISTINCT A.Id_Numero, A.Nome
	FROM
		aluno A
	INNER JOIN alunos_academicos AC ON AC.Aluno = A.Id_Numero
	WHERE
		A.Ano = '".$ano_turma."' AND
		AC.Turma = '".$codg_turma."'
	ORDER BY
		A.Nome";

$resultado = mysql_query($sql) or die('Erro na consulta das Disciplinas');
$numero = mysql_num_rows($resultado);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<script language="javascript">
function mOvr(src,clrOver) {
	src.style.cursor = 'hand';
	src.bgColor = clrOver;
}

function mOut(src,clrIn) {
	src.style.cursor = 'default';
	src.bgColor = clrIn;
}

function mClk(src) {
	if(event.srcElement.tagName=='TD'){
		src.children.tags('A')[0].click();
	}
}

function visualizar(codAluno,nomeAluno,largura,altura){
	posx = (screen.width/2)-(largura/2);
	posy = (screen.height/2)-(altura/2);
	propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px status=1";
	window.open('visualizarHistoricoEscolar.php?turma=<?=$codg_turma?>&idAluno='+codAluno+'&nomeAluno='+nomeAluno,'Notas',propriedades);
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
		  <td height="25" colspan="2" valign="top"><div id="pageName" style="font-family:Verdana">
			<h3>Consultar Hist&oacute;rico do Aluno</h3>
		  </div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../imagens/spacer.gif"></td>
		</tr>
		<tr>
			<td colspan="2" valign="top">
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td height="15" align="right" class="Texto" style="padding-left: 0.3em">Ano:</td>
				  <td class="Texto" style="padding-left: 0.3em"><b><?php print($ano_turma); ?></b></td>
			    </tr>
				<tr>
				  <td width="10%" height="15" align="right" class="Texto" style="padding-left: 0.3em">Turma:</td>
				  <td width="90%" class="Texto" style="padding-left: 0.3em"><b><?php print($codg_turma); ?></b></td>
				</tr>
				<tr>
				  <td height="15" align="right" class="Texto" style="padding-left: 0.3em">Curso:</td>
				  <td class="Texto" style="padding-left: 0.3em"><b><?php print($nome_turma); ?></b></td>
				</tr>
				<tr>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
				  <td class="Texto" style="padding-left: 0.3em">&nbsp;</td>
			    </tr>
			  </table>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
					<tr style="background-color: #DDD; height: 17px">
						<th class="Texto" style="width: 80%"><strong>Aluno</strong></th>
						<th class="Texto" style="width: 20%"><strong>Hist&oacute;rico Escolar</strong></th>
					</tr>
					<?php
					if($numero == 0){
					?>
					<tr style="background-color: #DDD; height: 17px">
						<td colspan="2" class="Texto" style="text-align: center; color: #FF0000">Nenhum registro encontrado.</td>
					</tr>
					<?php
					}else{
						$conta = 0;
						while($dados = mysql_fetch_array($resultado)){
							$conta++;
					?>
					<tr style="height: 17px;" onMouseOut="mOut(this,'FFFFFF')" onMouseOver="mOvr(this,'DEDEDE')">
						<td class="Texto" style="width: 85%; padding-left: 0.3em; border: solid 1px #DDD"><?=$conta.'. '.$dados['Nome']?></td>
						<td class="Texto" style="width: 15%; border: solid 1px #DDD; text-align: center"><a href="visualizarHistoricoEscolar.php?aluno=<?php echo $dados['Id_Numero']?>&turma=<?php echo $codg_turma?>&ano=<?php echo $ano_turma?>" target="_blank">[Visualizar]</a></td>
					</tr>
					<?php
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
