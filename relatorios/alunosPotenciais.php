<?php
require('../../conexao.php');

//== Selecionar Cursos
$sqlCursos = "SELECT * FROM curso WHERE Status = 1 ORDER BY Nome ";
$rsCursos = mysql_query($sqlCursos) or die('Erro na consulta dos Cursos. ');

// bloco 1 - defina o número de registros exibidos por página
$num_por_pagina = 20;

// bloco 2 - descubra o número da página que será exibida
// se o numero da página não for informado, definir como 1
$pagina = $_REQUEST['pagina'];

if(!$pagina){
    $primeiro_registro = 0;
    $pagina = 1;
}else{
    $primeiro_registro = ($pagina - 1) * $num_por_pagina;
}
$nome = "";
$comando = "
SELECT DISTINCT
    TA.Sequencia,
    TA.Ano,
    TA.Id_Numero,
    TA.Nome,
    TC.Nome AS NomeCurso,
    TA.e_Mail,
    TE.Cidade,
    TA.Curso
FROM
    aluno TA
LEFT JOIN endereco TE ON
    TA.Id_Numero = TE.Id_Numero
INNER JOIN curso TC ON
    TA.Curso = TC.Codg_Curso
WHERE
    TE.Tipo_Pessoa = 'A' AND
    TA.Web = 1 AND
    TA.Status = 2";
if($_REQUEST['nome']){
    $nome = $_REQUEST['nome'];
    $comando .= " AND LOWER(TA.nome) LIKE LOWER('%".$_REQUEST['nome']."%')";
}
if($_REQUEST['codgCurso']){
    $codgCurso = $_REQUEST['codgCurso'];
    $comando .= " AND TA.Curso = ".$_REQUEST['codgCurso'];
}
$comando .= " ORDER BY
    TC.Nome, UPPER(TA.Nome)
LIMIT ".$primeiro_registro.", ".$num_por_pagina;

//echo $comando;
$result = mysql_query($comando) or die ("Erro na Consulta do Aluno.<br>Comando:".$comando."<br>Erro: ".mysql_error());
$num = mysql_num_rows($result);

// bloco 3 -  construa e exiba um painel de navegabilidade entre as páginas
$consulta = "
    SELECT DISTINCT
    TA.Sequencia,
    TA.Ano,
    TA.Id_Numero,
    TA.Nome,
    TC.Nome AS NomeCurso,
    TA.e_Mail,
    TE.Cidade,
    TA.Curso
FROM
    aluno TA
LEFT JOIN endereco TE ON
    TA.Id_Numero = TE.Id_Numero
INNER JOIN curso TC ON
    TA.Curso = TC.Codg_Curso
WHERE
    TE.Tipo_Pessoa = 'A' AND
    TA.Web = 1 AND
    TA.Status = 2";
if($_REQUEST['nome']){
    $consulta .= " AND LOWER(TA.nome) LIKE LOWER('%".$_REQUEST['nome']."%')";
}
if($_REQUEST['codgCurso']){
    $consulta .= " AND TA.Curso = ".$_REQUEST['codgCurso'];
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
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
<link rel="stylesheet" href="../emx_nav_left.css" type="text/css">
<script language="javascript">
//== Ativar o aluno
function AtivarAluno(valor,ano,nome){
	if(confirm('Deseja ativar este Aluno(a): '+nome+'?')){
		window.open('ativar_aluno.php?aluno='+valor+'&ano='+ano,'Ativar','left=2200');
	}
}

// ESTA FUNÇÃO COLOCA O ESTATUS DO ALUNO = 2 QUE SIGNIFICA QUE ELE FOI COLOCADO EM ALUNO EM POTENSIAL
function  confirmarAlteracao(codg, ano, nome){
	if(confirm("Deseja colocar o(a) Aluno(a): "+nome+" na lista de aluno(a) em potencial?")){
		window.location = 'alterarStatusAluno.php?id_numero='+codg+'&ano='+ano;
	}
}

// Detalhes do Aluno
function AbrirPagina(codg, ano, curso){
	window.open('detalhe_aluno.php?id_numero='+codg+'&ano='+ano+'&curso='+curso,'Detalhe','left=10 top=10 width=550 height=300 scrollbars=1');
}

// Alterar ano
function alterarAno(seq,ano,nome){
	var w = 400;
	var h = 130;
	var lado = (screen.width - w) / 2;
	var topo = (screen.height - h) / 2;
	var propriedades = 'height='+h+',width='+w+',top='+topo+',left='+lado+'';

	window.open('alterarAno.php?seq='+seq+'&ano='+ano+'&nome='+nome,'Ano',propriedades);
}

// Função para uma mensagem de exclusão
function  Confirma_Exclusao(codg,ano,nome,curso)
	{
	if(confirm("Confirma a exclusão deste Aluno(a): "+nome+"?"))
		window.location = 'excluir_aluno.php?id_numero='+ codg + '&ano=' + ano + '&nome=' + nome + '&codgCurso=' + curso;
	}
</script>
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
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Alunos em Potencial</h3></div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
		</tr>
		<tr>
		  <td height="20">Nome:</td>
		  <td>Curso:</td>
		</tr>
		<tr><form method="POST" action="alunosPotenciais.php">
		  <td height="20"><input type="text" name="nome" id="nome" size="35" value="<?php echo $_REQUEST['nome'];?>" class="TextoFormulario" /></td>
		  <td><select name="codgCurso" id="codgCurso" class="TextoFormulario">
                        <option value="">[-- Selecionar --]</option>
                        <?PHP
                        while($regCurso = mysql_fetch_array($rsCursos)){
                        ?>
                        <option value="<?php echo $regCurso['Codg_Curso']; ?>" <?php echo ($regCurso['Codg_Curso'] == $_REQUEST['codgCurso'] ? 'selected' : ''); ?>><?php echo $regCurso['Nome']; ?></option>
                        <?php
                        }
			?>
			</select>&nbsp;&nbsp;<input type="submit" name="botPesquisar" value="Pesquisar" class="botao" />
                  </td>
                  </form>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
		</tr>
		<tr>
			<td colspan="2" valign="top">
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
					<tr bgcolor="#EEEEEE">
						<td style="padding-left: 0.3em"><b>Nome</b></td>
						<td style="padding-left: 0.3em"><b>Cidade</b></td>
					    <td align="center"><b>Ação</b></td>
					</tr>
					<?php
					if($num < 1){
					?>
					<tr>
						<td colspan="4" align="center"><font color="#FF0000">Nenhum registro encontrado.</font></td>
					</tr>
					<?php
					}else{
						$conta = 0;
						$muda_curso = 0;
						while($registro = mysql_fetch_array($result)){
							if($conta % 2 == 1){
								$cor = '#DDEEFF';
							}else{
								$cor = '#FFFFFF';
							}
							if($muda_curso != 0){
								if($muda_curso != $registro['Curso']){
					?>
					<tr>
						<td background="../../imagens/spacer.gif" height="5" colspan="3"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFECD9" style="padding-left: 0.3em; font-weight:bold"><?=strtoupper($registro['NomeCurso'])?></td>
					</tr>
					<?php
								}
							}
							if($conta == 0){
					?>
					<tr>
						<td background="../../imagens/spacer.gif" height="5" colspan="3"></td>
					</tr>
					<tr>
						<td height="15" colspan="3" bgcolor="#FFECD9" style="padding-left: 0.3em; font-weight:bold"><?=strtoupper($registro['NomeCurso'])?></td>
					</tr>
					<?php
							}
					?>
					<tr bgcolor="<?php print($cor); ?>" class="linha">
						<td style="padding-left: 0.3em"><?=strtoupper($registro['Nome'])?></td>
						<td style="padding-left: 0.3em"><?=strtoupper($registro['Cidade'])?></td>
					    <td align="center" valign="middle"><?php if($registro['Ano'] != date('Y')){ ?><a href="JavaScript:alterarAno(<?=$registro['Sequencia']?>,<?=$registro['Ano']?>,'<?=$registro['Nome']?>')" title="Alterar o ano do Cadastro"><img src="../imagens/icons/transferencia.gif" border="0" align="absmiddle" /></a>&nbsp;|&nbsp;<?php }?><a href="JavaScript:AbrirPagina('<?php print($registro['Id_Numero']); ?>',<?php print($registro['Ano']); ?>,<?php print($registro['Curso']); ?>);"><img src="../../imagens/gif_imprimir.gif" width="16" height="15" border="0" align="absmiddle" /></a>&nbsp;|&nbsp;<a href="JavaScript:AtivarAluno('<?php print($registro['Id_Numero']); ?>',<?php print($registro['Ano']); ?>,'<?php print($registro['Nome']); ?>');" title="Ativar o Aluno(a): <?php print($registro['Nome']); ?>"><img src="../../imagens/favoritos.gif" width="12" height="14" border="0" align="absmiddle" /></a>&nbsp;|&nbsp;<a href="JavaScript:Confirma_Exclusao('<?php echo $registro['Id_Numero']; ?>',<?php echo $registro['Ano']; ?>,'<?php echo $registro['Nome']; ?>',<?php echo $registro['Curso']; ?>);" title="Excluir o Aluno(a): <?php print($registro['Nome']); ?>"><img src="../../imagens/excluir.gif" width="12" height="14" border="0" align="absmiddle" /></a></td>
					</tr>
					<?php
							$conta++;
							$muda_curso = $registro['Curso'];
						}
					}
					?>
                                <tr>
                                    <td colspan="3" class="navegacao"><?php // exibir painel na tela
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
</body>
</html>
