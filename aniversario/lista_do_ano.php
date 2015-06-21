<?PHP
session_start();
require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Selecionar Aluno
$comando = '
SELECT
	Nome,
	e_Mail,
	DATE_FORMAT(Data_Nascimento,"%d/%m") AS Data_Nasc,
	DATE_FORMAT(Data_Nascimento,"%m") AS Mes_Nasc
FROM
	aluno
WHERE
	Data_Nascimento <> "0"
	AND
	Web = 2
ORDER BY
	DATE_FORMAT(Data_Nascimento,"%m"), DATE_FORMAT(Data_Nascimento,"%d/%m"), Nome';
$resultado = mysql_query($comando) or die('Erro na consulta dos alunos.'.mysql_error().'<br>'.$comando);
$numero = mysql_num_rows($resultado);
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
// -->
</SCRIPT>
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
	<table width="100%" height="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana">
			  <h3>Lista de Aniversariantes do Ano</h3>
			</div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
		</tr>
		<tr>
			<td colspan="2" valign="top"><div align="right" class="Texto"><a href="JavaScript: history.back()">Voltar</a></div>
			 <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr bgcolor="#D2D2A6">
				<td width="57%" height="15" bgcolor="#D2D2A6" style="padding-left: 0.3em"><strong class="Texto">Nome</strong></td>
				<td width="37%" style="padding-left: 0.3em"><strong class="Texto">e-Mail</strong></td>
				<td width="8%" style="padding-left: 0.3em"><strong class="Texto">Data</strong></td>
			  </tr>
			  <tr>
				<td colspan="3" background="../imagens/spacer.gif" bgcolor="#000000" height="2"></td>
			  </tr>
			  <?php
				$conta = 0;
				$volta = 0;
				$muda_mes = 0;
				while($dados = mysql_fetch_array($resultado)){
					if($muda_mes != '0'){
						if($muda_mes != $dados['Mes_Nasc']){
			  ?>
			  <tr>
				<td colspan="3" background="../imagens/spacer.gif" bgcolor="#333333" height="1"></td>
			  </tr>
			  <tr>
				<td class="Texto" colspan="3" style="padding-left: 0.3em" bgcolor="#EBEBD6"><b><?php
				//== Imprimir o Mês
				switch($dados['Mes_Nasc']){
					case 01:
						print('Janeiro');
					break;
					case 02:
						print('Fevereiro');
					break;
					case 03:
						print('Março');
					break;
					case 04:
						print('Abril');
					break;
					case 05:
						print('Maio');
					break;
					case 06:
						print('Junho');
					break;
					case 07:
						print('Julho');
					break;
					case 08:
						print('Agosto');
					break;
					case 09:
						print('Setembro');
					break;
					case 10:
						print('Outubro');
					break;
					case 11:
						print('Novembro');
					break;
					case 12:
						print('Dezembro');
					break;
				}
				?></b></td>
			  </tr>
			  <?php
						$volta = 0;
						}
					}
					if($conta == 0){
			  ?>
			  <tr>
				<td colspan="3" background="../imagens/spacer.gif" bgcolor="#333333" height="1"></td>
			  </tr>
			  <tr>
				<td class="Texto" colspan="3" style="padding-left: 0.3em" bgcolor="#EBEBD6"><b><?php
				//== Imprimir o Mês
				switch($dados['Mes_Nasc']){
					case 01:
						print('Janeiro');
					break;
					case 02:
						print('Fevereiro');
					break;
					case 03:
						print('Março');
					break;
					case 04:
						print('Abril');
					break;
					case 05:
						print('Maio');
					break;
					case 06:
						print('Junho');
					break;
					case 07:
						print('Julho');
					break;
					case 08:
						print('Agosto');
					break;
					case 09:
						print('Setembro');
					break;
					case 10:
						print('Outubro');
					break;
					case 11:
						print('Novembro');
					break;
					case 12:
						print('Dezembro');
					break;
				}
				?></b></td>
			  </tr>
			  <?php
					}
			  ?>
			  <tr onMouseOut="mOut(this,'FFFFFF')" onMouseOver="mOvr(this,'9C9CB1')">
				<td class="Texto" style="padding-left: 0.3em"><?php print(strtoupper($dados['Nome'])); ?></td>
				<td class="Texto" style="padding-left: 0.3em"><?php
			if($dados['e_Mail'] == ''){
				print('<span style="color: #FF0000">Não tem e-mail cadastrado.</span>');
			}else{
			?>
				<a href="mailto:<?php print($dados['e_Mail']); ?>"><?php print($dados['e_Mail']); ?></a>
			<?php
			}
			?></td>
				<td class="Texto" style="padding-left: 0.3em"><?php print($dados['Data_Nasc']); ?></td>
			  </tr>
			  <?php
				$conta++;
				$volta++;
				$muda_mes = $dados['Mes_Nasc'];
			  }
			  ?>
			  <tr>
				<td colspan="3" background="../imagens/spacer.gif" bgcolor="#000000" height="1"></td>
			  </tr>
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