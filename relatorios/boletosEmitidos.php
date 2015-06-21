<?php
include_once("../conexao.inc.php");

if($_REQUEST['fazer']){
	$cmd = "UPDATE boletos SET status = '".$_REQUEST['fazer']."' WHERE id = ".$_REQUEST['id'];
	mysql_query($cmd) or die ("Erro na alteração do status do Boletos.");
}

//== Selecionar Cursos
$sqlCursos = "SELECT * FROM curso WHERE Status = 1 ORDER BY Nome ";
$rsCursos = mysql_query($sqlCursos) or die('Erro na consulta dos Cursos. ');

// bloco 1 - defina o número de registros exibidos por página
$num_por_pagina = 30;

// bloco 2 - descubra o número da página que será exibida
// se o numero da página não for informado, definir como 1
$pagina = $_REQUEST['pagina'];

if(!$pagina){
    $primeiro_registro = 0;
    $pagina = 1;
}else{
    $primeiro_registro = ($pagina - 1) * $num_por_pagina;
}

$comando = "
SELECT A.*
	, C.Codg_Curso, C.Nome AS Curso
	, B.id, B.idNumero, B.codgCurso, B.nossoNumero, B.status
FROM
	boletos B
INNER JOIN aluno A ON A.Id_Numero = B.IdNumero
INNER JOIN curso C ON C.Codg_Curso = B.codgCurso
WHERE 1=1 ";
if($_REQUEST['nome']){
    $nome = $_REQUEST['nome'];
    $comando .= " AND LOWER(A.nome) LIKE LOWER('%".$_REQUEST['nome']."%')";
}
if($_REQUEST['nossoNumero']){
    $comando .= " AND B.nossoNumero = '".$_REQUEST['nossoNumero']."'";
}
if($_REQUEST['codgCurso']){
    $codgCurso = $_REQUEST['codgCurso'];
    $comando .= " AND C.Codg_Curso = ".$_REQUEST['codgCurso'];
}
$comando .= " ORDER BY C.Codg_Curso DESC, B.nossoNumero
LIMIT ".$primeiro_registro.", ".$num_por_pagina;

//echo $comando;
$result = mysql_query($comando) or die ("Erro na Consulta do Boletos.");
$num = mysql_num_rows($result);

// bloco 3 -  construa e exiba um painel de navegabilidade entre as páginas
$consulta = "
    SELECT A.*
	, C.Codg_Curso, C.Nome AS Curso
	, B.id, B.idNumero, B.codgCurso, B.nossoNumero, B.status
FROM
	boletos B
INNER JOIN aluno A ON A.Id_Numero = B.IdNumero
INNER JOIN curso C ON C.Codg_Curso = B.codgCurso
WHERE 1=1 ";
if($_REQUEST['nome']){
    $consulta .= " AND LOWER(A.nome) LIKE LOWER('%".$_REQUEST['nome']."%')";
}
if($_REQUEST['nossoNumero']){
    $consulta .= " AND B.nossoNumero = ".$_REQUEST['nossoNumero'];
}
if($_REQUEST['codgCurso']){
    $consulta .= " AND B.codgCurso = ".$_REQUEST['codgCurso'];
}

$total_alunos = mysql_num_rows(mysql_query($consulta));

$total_paginas = $total_alunos/$num_por_pagina;

$prev = $pagina - 1;
$next = $pagina + 1;
// se página maior que 1 (um), então temos link para a página anterior
if ($pagina > 1) {
    $prev_link = "<a href=\"$PHP_SELF?pagina=$prev&nome=$nome&codgCurso=$codgCurso\">&lt;&lt;&nbsp;Anterior</a>";
} else { // senão não há link para a página anterior
    $prev_link = "&lt;&lt;&nbsp;Anterior";
}
// se número total de páginas for maior que a página corrente,
// então temos link para a próxima página
if ($total_paginas > $pagina) {
    $next_link = "<a href=\"$PHP_SELF?pagina=$next&nome=$nome&codgCurso=$codgCurso\">Próxima&nbsp;&gt;&gt;";
} else {
    // senão não há link para a próxima página
    $next_link = "Próxima&nbsp;&gt;&gt;";
}

// vamos arredondar para o alto o número de páginas  que serão necessárias para exibir todos os
// registros. Por exemplo, se  temos 20 registros e mostramos 6 por página, nossa variável
// $total_paginas será igual a 20/6, que resultará em 3.33. Para exibir os  2 registros
// restantes dos 18 mostrados nas primeiras 3 páginas (0.33),  será necessária a quarta página.
// Logo, sempre devemos arredondar uma  fração de número real para um inteiro de cima e isto é
// feito com a  função ceil()/
$total_paginas = ceil($total_paginas);
$painel = "";
for ($x=1; $x<=$total_paginas; $x++) {
    if ($x==$pagina) {
        // se estivermos na página corrente, não exibir o link para visualização desta página
        $painel .= " [".$x."] ";
    } else {
        $painel .= " <a href='".$PHP_SELF."?pagina=".$x."&nome=".$nome."&codgCurso=".$codgCurso."'>[".$x."]</a>";
    }
}
?>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<style type="text/css">
<!--
a{
    font: normal 12px Verdana, Arial, Helvetica, sans-serif;
}
.navegacao{
    text-align: center;
    font: normal 12px Verdana, Arial, Helvetica, sans-serif;
    padding-top: 10px;
}
td {
	font: normal 12px Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
}
-->
tr.linha:hover{
	background-color: #FFFF99;
}

</style>
<script type="text/javascript"  language="javascript">
function printBoleto(id,cur){
	largura = 680;
	altura = 550;
	posx = (screen.width/2)-(largura/2);
	posy = (screen.height/2)-(altura/2);
	propriedades = "width="+largura+", height="+altura+", top="+posy+", left="+posx+" status=1, menubar=1, scrollbars=1";
	window.open('../../boletophp/boleto_itau.php?idNumero='+id+'&curso='+cur,'Notas',propriedades);
}
</script>
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
		  <td colspan="3" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Boletos emitídos</h3></div></td>
		</tr>
		<tr>
		  <td height="2" colspan="3" background="../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="3" background="../imagens/spacer.gif"></td>
		</tr>
		<form method="POST" action="boletosEmitidos.php">
		<tr>
		   <td colspan="3">
		   	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		   	   <tr>
		   	      <td width="10%">Nome:</td>
		   	      <td><input type="text" name="nome" id="nome" size="35" value="<?php echo $_REQUEST['nome'];?>" class="TextoFormulario" /></td>
		   	   </tr>
		   	   <tr>
		   	      <td>Nosso Número:</td>
		   	      <td><input type="text" name="nossoNumero" id="nossoNumero" size="20" value="<?php echo $_REQUEST['nossoNumero'];?>" class="TextoFormulario" /</td>
		   	   </tr>
		   	   <tr>
		   	      <td>Curso</td>
		   	      <td><select name="codgCurso" id="codgCurso" class="TextoFormulario">
	                        <option value="">[-- Selecionar --]</option>
	                        <?PHP
	                        while($regCurso = mysql_fetch_array($rsCursos)){
	                        ?>
	                        <option value="<?php echo $regCurso['Codg_Curso']; ?>" <?php echo ($regCurso['Codg_Curso'] == $_REQUEST['codgCurso'] ? 'selected' : ''); ?>><?php echo $regCurso['Nome']; ?></option>
	                        <?php
	                        }
				?>
				</select>&nbsp;&nbsp;<input type="submit" name="botPesquisar" value="Pesquisar" class="botao" /></td>
		   	   </tr>
		   	</table>
		   </td>
		</tr>
		</form>
		<tr>
		  <td height="10" colspan="3" background="../imagens/spacer.gif"></td>
		</tr>
		<tr>
			<td colspan="3" valign="top">
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
					<tr bgcolor="#EEEEEE">
						<td style="padding: 2px"><b>Nome</b></td>
						<td style="padding: 2px"><b>Curso</b></td>
						<td style="padding: 2px"><b>Nosso número</b></td>
					    <td align="center" style="padding: 2px"><b>Situação</b></td>
					    <td align="center" style="padding: 2px">&nbsp;</td>
					</tr>
					<?php
					if($num < 1){
					?>
					<tr>
						<td colspan="5" align="center"><font color="#FF0000">Nenhum registro encontrado.</font></td>
					</tr>
					<?php
					}else{
						$conta = 0;
						$volta = 1;
                                                $valor = 0; // curso+id_numero+nosso_numero
						while($registro = mysql_fetch_array($result)){
                                                    if($valor != $registro['Codg_Curso'].$registro['nossoNumero'].$registro['Id_Numero']){
							if($conta % 2 == 1)
								$cor = '#DDEEFF';
							else
								$cor = '#FFFFFF';

							if($registro['status'] == 'P'){
								$stilo = "; color: 000; font-weight: bold;";
								$status = "<strong>Pago</strong>";
							}else{
								$stilo = "; color: red;";
								$status = "Não pago";
							}
					?>
					<tr bgcolor="<?=$cor?>" class="linha">
						<td style="padding: 2px"><?=$volta.' - '.$registro['Nome']?></td>
						<td style="padding: 2px"><?=$registro['Curso']?></td>
						<td style="padding: 2px"><?=$registro['nossoNumero']?></td>
						<td style="padding: 2px<?=$stilo?>"><?=$status?></td>
					    <td align="center" style="padding: 2px"><a href="enviarBoletoEmail.php?idNumero=<?=$registro['Id_Numero']?>&amp;curso=<?=$registro['Codg_Curso']?>&amp;para=<?=$registro['e_Mail']?>&amp;nomeAluno=<?=$registro['Nome']?>&amp;nomeCurso=<?=$registro['Curso']?>" target="_blank"><img src="../imagens/icons/email.gif" border="0" alt="" /></a>&nbsp;<a href="#" onClick="JavaScript:printBoleto('<?=$registro['idNumero']?>',<?=$registro['codgCurso']?>);"><img src="../imagens/icons/gif_impressora.gif" border="0" alt="" /></a><a href="boletosEmitidos.php?fazer=P&id=<?=$registro['id']?>"><img src="../imagens/icons/Ok.gif" border="0" alt=""></a>&nbsp;<a href="boletosEmitidos.php?fazer=N&id=<?=$registro['id']?>"><img src="../imagens/icons/inativo.gif" border="0" alt=""></a></td>
					</tr>
					<?php
							$conta++;
							$volta++;

                                                        $valor = $registro['Codg_Curso'].$registro['nossoNumero'].$registro['Id_Numero'];
                                                    }

						}
					}
					?>
                                <tr>
                                    <td colspan="5" class="navegacao"><?php // exibir painel na tela
                                    echo $prev_link."&nbsp;".$painel."&nbsp;".$next_link;
                                    ?>
                                    </td>
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