<?PHP
session_start();
require('../conexao.php'); //== Conexão com o Banco de Dados

// Excluir um usuário
if(isset($_REQUEST['idAluno'])){
	$comando = "DELETE FROM usuario_aluno WHERE Sequencia = ".$_REQUEST['idAluno'];
	mysql_query($comando) or die('Erro na exclusão da Senha do Aluno.'.mysql_error().'<br>'.$comando);
}

// SEPARA OS VALORES

//== Selecionar Aluno
$comando = "SELECT
      AC.Aluno
     ,TUR.Turma
     ,TUR.Nome AS NomeTurma
     ,ALU.Nome
     ,UA.Login
     ,UA.Senha
     ,UA.Sequencia
FROM 
      alunos_academicos AC
INNER JOIN aluno ALU ON
      ALU.Id_Numero = AC.ALUNO
INNER JOIN turma TUR ON
      TUR.Turma = AC.Turma
INNER JOIN usuario_aluno UA ON
      UA.Id_Numero = AC.Aluno
WHERE
      ALU.Web    = 2
  AND ALU.Status = 1 \n";

// se escolheu a turma
if(isset($_REQUEST['turma'])){
	$d = explode("|",$_REQUEST['turma']);
	$_turma = $d[0];
	$_ano = $d[1];

	$comando .= "AND AC.Turma = '".$_turma."'
	 AND AC.Ano = '".$_ano."' \n";
}

// se digitou o nome do aluno
if(isset($_REQUEST['aluno'])){
	$comando .= " AND ALU.Nome LIKE '%".$_REQUEST['aluno']."%' \n";
}

$comando .= " 
GROUP BY
      AC.ALUNO
     ,TUR.Turma
ORDER BY
      AC.Turma, ALU.Nome";

// echo "<pre>";
// print_r($comando);
$resultado = mysql_query($comando) or die('Erro na consulta dos alunos.'.mysql_error().'<br>'.$comando);
$numero = mysql_num_rows($resultado);
//ALU.Status = 1
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<SCRIPT language=javascript>
<!--
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
function excluirUsuario(seq,turma){
	if(confirm("Tem certeza que deseja excluir este Usuário?")){
		document.location = "usuario_aluno.php?idAluno="+seq+"&turma="+turma;
	}
}
function alterarSenha(seq,largura,altura,titulo){
	posx = (screen.width/2)-(largura/2)
	posy = (screen.height/2)-(altura/2)
	url     = "alterarSenhaAluno.php";
	params  = "?seq="+seq;
	propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px status=1" ;
	window.open(url+params,titulo,propriedades);
}
// -->
</SCRIPT>
<link rel="stylesheet" href="emx_nav_left.css" type="text/css">
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19" height="19"><img src="img_menu/top_esquerda.gif" width="19" height="19"></td>
    <td width="162" height="19" background="img_menu/topo.gif">&nbsp;</td>
    <td width="19"><img src="img_menu/top_direita.gif" width="19" height="19"></td>
  </tr>
  <tr>
    <td height="100%" background="img_menu/esquerda.gif">&nbsp;</td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
	<!-- Conteúdo -->
	<table width="100%" height="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Senha dos Alunos</h3>
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
			 <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="2">
			 	<caption align="center" class="Texto"><strong>Relação de alunos Ativos e Inativos</strong></caption>
			  <tr bgcolor="#D2D2A6">
				<td width="37%" height="15" style="padding-left: 0.3em"><strong class="Texto">NOME</strong></td>
				<td width="27%" style="padding-left: 0.3em"><strong class="Texto">LOGIN</strong></td>
				<td width="30%" style="padding-left: 0.3em"><strong class="Texto">SENHA</strong></td>
				<td>&nbsp;</td>
			  </tr>
			  <?php
				$conta = 0;
				$volta = 0;
				$muda_turma = 0;
				while($dados = mysql_fetch_array($resultado)){
					if($dados['Login'] == NULL){
						$dados['Login'] = "<span style=\"color: #FF0000\">Login não cadastrado</span>";
					}
					if($dados['Senha'] == NULL){
						$dados['Senha'] = "<span style=\"color: #FF0000\">Senha não cadastrada</span>";
					}
					if($muda_turma != '0'){
						if($muda_turma != $dados['Turma']){
			  ?>
			  <tr>
				<td class="Texto" colspan="4" style="padding-left: 0.3em" bgcolor="#EBEBD6"><b><?php print(strtoupper($dados['Turma'].' | '.$dados['NomeTurma'])); ?></b></td>
			  </tr>
			  <?php
						$volta = 0;
						}
					}
					if($conta == 0){
			  ?>
			  <tr>
				<td class="Texto" colspan="4" style="padding-left: 0.3em" bgcolor="#EBEBD6"><b><?php print(strtoupper($dados['Turma'].' | '.$dados['NomeTurma'])); ?></b></td>
			  </tr>
			  <?php
					}
			  ?>
			  <tr onMouseOut="mOut(this,'FFFFFF')" onMouseOver="mOvr(this,'EBEBD6')">
				<td class="Texto" style="padding-left: 0.3em; border-left: 1px solid #EBEBD6; border-right: 1px solid #EBEBD6; border-top: 1px solid #EBEBD6;"><?php print(strtoupper($dados['Nome'])); ?></td>
				<td class="Texto" style="padding-left: 0.3em; border-right: 1px solid #EBEBD6; border-top: 1px solid #EBEBD6;"><?php print($dados['Login']); ?></td>
				<td class="Texto" style="padding-left: 0.3em; border-right: 1px solid #EBEBD6; border-top: 1px solid #EBEBD6;"><?php print($dados['Senha']); ?></td>
				<td style="border-right: 1px solid #EBEBD6; border-top: 1px solid #EBEBD6; text-align: center"><a href="#" onClick="alterarSenha(<?=$dados['Sequencia']?>,350,200,'ALterarSenhaAluno')"><img src="../imagens/alterar.gif" alt="Alterar senha" border="0" /></a>&nbsp;|&nbsp;<a href="#" onClick="excluirUsuario(<?=$dados['Sequencia']?>,'<?=$_REQUEST['turma']?>')"><img src="../imagens/excluir.gif" alt="Excluir senha" border="0" /></a></td>
			  </tr>
			  <?php
				$conta++;
				$volta++;
				$muda_turma = $dados['Turma'];
			  }
			  ?>
			  <tr>
				<td colspan="4" background="imagens/spacer.gif" bgcolor="#000000" height="1"></td>
			  </tr>
			  <tr>
				<td colspan="4" height="30" align="center"><b class="Texto">TOTAL DE ALUNOS CADASTRADOS:&nbsp;<?php print($numero); ?></b></td>
			  </tr>
			</table>
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
