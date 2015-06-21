<?php
require('../../conexao.php');

$comando = "
SELECT
	Codg_Exercicio,
	Exercicio,
	Tipo_Material,
	Turma
FROM
	exercicio
ORDER BY 
	Turma";

$result = mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta dos Exercícios. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());;
$num = mysql_num_rows($result);
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<script language="JavaScript1.2">
// Função para uma mensagem de exclusão
function  Confirma_Exclusao(codg,nome)
	{
	if(confirm("Confirma a exclusão deste Exercício?"))
		window.location = 'excluir_exercicio.php?codg_exercicio='+codg+'&exercicio='+nome;
	}
</script>
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
			  <h3>Consulta de Material </h3>
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
				<tr> 
				  <td width="52%" height="15" align="left" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>Disciplina</b></td>
				  <td width="25%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><b>Material</b></td>
				  <td width="15%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em"><strong>Tipo</strong></td>
				  <td width="8%" align="center" bgcolor="#EEEEEE" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><b>Opções</b></td>
				</tr>
				<?php
				if($num < 1){
				?>
				<tr> 
				  <td colspan="4" align="center" class="Texto"><font color="#FF0000">Nenhum registro encontrado.</font></td>
				</tr>
				<?php
				}else{
					$conta = 0;
					$muda_turma = '0';
					while($registro = mysql_fetch_array($result)){
						// Separar turma da disciplina
						$separa = explode('|',$registro['Turma']);
						$turma = $separa[0];
						$disciplina = $separa[1];
						// Fim separar
						
						// Consultar a disciplina
						$cmd_disciplina = "SELECT Nome AS Disciplina FROM disciplina WHERE Codg_Disciplina = ".$disciplina;
						$res_disciplina = mysql_query($cmd_disciplina) or die('Erro na consulta da disciplina. '.mysql_error());
						$reg_disciplina = mysql_fetch_array($res_disciplina);
						// Fim Consulta disciplina

						// Consultar a turma
						$cmd_turma = "SELECT DISTINCT Nome FROM turma WHERE Turma = '".$turma."'";
						$res_turma = mysql_query($cmd_turma) or die('Erro na consulta da turma. '.mysql_error());
						$reg_turma = mysql_fetch_array($res_turma);
						// Fim Consulta turma
						
						if($conta % 2 == 1){
							$cor = '#DDEEFF';
						}else{
							$cor = '#FFFFFF';
						}
						if($muda_turma != '0'){
							if($muda_turma != $turma){
				?>
				<tr>
					<td background="../../imagens/spacer.gif" height="4" colspan="4" bgcolor="#000000"></td>
				</tr>
				<tr>
				  <td bgcolor="#FFEEE6" height="15" colspan="4" align="left" class="Texto" style="padding-left: 0.3em"><b><i>Turma:&nbsp;<?php print($turma); ?>-<?php print($reg_turma['Nome']); ?></i></b></td>
				</tr>
				<?php
							}
						}
						if($conta == 0){
				?>
				<tr>
					<td background="../../imagens/spacer.gif" height="4" colspan="4" bgcolor="#000000"></td>
				</tr>
				<tr>
				  <td bgcolor="#FFEEE6" height="15" colspan="4" align="left" class="Texto" style="padding-left: 0.3em"><b><i>Turma:&nbsp;<?php print($turma); ?>-<?php print($reg_turma['Nome']); ?></i></b></td>
				</tr>
				<?php
						}
				?>
				<tr bgcolor="<?php print($cor); ?>"> 
				  <td align="left" class="Texto" style="padding-left: 0.3em"><?php print($reg_disciplina['Disciplina']); ?></td>
				  <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="http://www.ipecon.com.br/exercicios/<?php print($registro['Exercicio']); ?>" target="_blank"><img src="../../imagens/disco.gif" border="0"><br><?php print($registro['Exercicio']); ?></a></td>
				  <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><?php
				  switch($registro['Tipo']){
					case 1:
						print('Exercício');
					break;
					case 2:
						print('Material didático');
					break;
					case 3:
						print('Material de apoio');
					break;
					case 4:
						print('Trabalho');
					break;
					case 5:
						print('Apostila');
					break;
				  }
				  ?></td>
				  <td align="center" class="Texto" style="padding-left: 0.3em; padding-right: 0.3em"><a href="#" onClick="Confirma_Exclusao('<?php print($registro['Codg_Exercicio']); ?>','<?php print($registro['Exercicio']); ?>')"><img src="../../imagens/excluir.gif" border="0" title="Excluir"></a></td>
				</tr>
				<?php
						$conta++;
						$muda_turma = $turma;
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
