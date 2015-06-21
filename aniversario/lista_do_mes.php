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
	MONTH(Data_Nascimento) = '.date('m').'
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
<link rel="stylesheet" href="../../ipecon.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
}
-->
</style></head>
<body>
<br>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
		<td class="Texto">Legenda:<br>
		<img src="../../imagens/email.gif" align="absmiddle">&nbsp;-&nbsp;Enviar cartão de aniversário
		</td>
	</tr>
</table>
<br>
<table width="100%" height="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
		<td colspan="2" valign="top">
		 <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <?php
			$volta = 0;
			while($dados = mysql_fetch_array($resultado)){
				if($volta == 0){
		  ?>
		  <tr>
			<td colspan="4" background="../imagens/spacer.gif" bgcolor="#333333" height="1"></td>
		  </tr>
		  <tr bgcolor="#D2D2A6">
			<td colspan="4" class="Texto" style="padding-left: 0.3em"><b><?php
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
		  <tr bgcolor="#EBEBD6">
			<td width="57%" height="15" bgcolor="#EBEBD6" style="padding-left: 0.3em"><strong class="Texto">Nome</strong></td>
			<td width="37%" style="padding-left: 0.3em"><strong class="Texto">e-Mail</strong></td>
			<td width="8%" align="right" style="padding-left: 0.3em"><strong class="Texto">Data</strong></td>
		    <td width="8%" align="right" style="padding-left: 0.3em">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="4" background="../imagens/spacer.gif" bgcolor="#000000" height="2"></td>
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
			<td align="right" class="Texto" style="padding-right: 0.3em"><?php print($dados['Data_Nasc']); ?></td>
		    <td align="right" class="Texto" style="padding-right: 0.3em"><a href="enviar_cartao.php?nome=<?php print(strtoupper($dados['Nome'])); ?>&para_email=<?php print($dados['e_Mail']); ?>"><img src="../../imagens/email.gif" width="15" height="16" border="0"></a>&nbsp;</td>
		  </tr>
		  <?php
			$volta++;
		  }
		  ?>
		  <tr>
			<td colspan="4" background="../imagens/spacer.gif" bgcolor="#000000" height="1"></td>
		  </tr>
		</table>
	  </td>
	</tr>
</table>
</body>
</html>