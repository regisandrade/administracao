<?php
require('../../conexao.php');

function formatarData($data){
	$dt = substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4);
	return $dt;
}

//== Selecionar Cursos
$sqlCursos = "SELECT * FROM curso WHERE Status = 1 ORDER BY Nome ";
$rsCursos = mysql_query($sqlCursos) or die('Erro na consulta dos Cursos. ');

// bloco 1 - defina o número de registros exibidos por página
$num_por_pagina = 50;

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
SELECT DISTINCT
	TA.Sequencia,
	TA.Ano,
	TA.Id_Numero,
	TA.Nome,
	TC.Nome AS NomeCurso,
	TA.e_Mail,
	TE.Cidade,
	TA.Curso, TA.cidadeCurso,
	TA.Data_Cadastro,
	TE.Fone_Residencial,
	TE.Fone_Comercial,
	TE.Celular
FROM aluno TA
INNER JOIN endereco TE ON TA.Id_Numero = TE.Id_Numero
INNER JOIN curso TC ON TA.Curso = TC.Codg_Curso
WHERE
	TE.Tipo_Pessoa = 'A' AND
	TA.Web = 1 AND
	TA.Status in (0,1) ";
if($_REQUEST['nome']){
    $nome = $_REQUEST['nome'];
    $comando .= " AND LOWER(TA.nome) LIKE LOWER('%".$_REQUEST['nome']."%')";
}
if($_REQUEST['codgCurso']){
    $codgCurso = $_REQUEST['codgCurso'];
    $comando .= " AND TA.Curso = ".$_REQUEST['codgCurso'];
}


if(!isset($_REQUEST['excel'])){
	$comando .= " ORDER BY
	TC.Nome, TA.Data_Cadastro DESC";

	$comando .= " LIMIT ".$primeiro_registro.", ".$num_por_pagina;
}else{
	$comando .= " ORDER BY TA.Data_Cadastro DESC";
}


//echo $comando;
$result = mysql_query($comando) or die ("Erro na Consulta do Aluno.<br>Comando:".$comando."<br>Erro: ".mysql_error());
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

/******** gerer arquivo xls **********/
if($_REQUEST['excel'] == 1){
    // definimos o tipo de arquivo
    header("Content-type: application/msexcel");

    // Como será gravado o arquivo
    header("Content-Disposition: attachment; filename=lista-alunos-pre-inscricao.xls");

    // montando a tabela
    echo "<table>";
        echo "<tr>";
            echo "<td colspan=\"7\"><strong>LISTA DE PESSOAS CADASTRADAS - PRÉ-INSCRIÇÃO</strong></td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td><strong>Curso</strong></td>";
            echo "<td><strong>Nome</strong></td>";
            echo "<td><strong>E-mail</strong></td>";
            echo "<td><strong>Telefone Residencial</strong></td>";
            echo "<td><strong>Telefone Celular</strong></td>";
            echo "<td><strong>Telefone Comercial</strong></td>";
            echo "<td><strong>Data do cadastro</strong></td>";
        echo "</tr>";
    $resXls = mysql_query($comando);
    $i=1;
    while ($rs = mysql_fetch_array($resXls)){
        echo "<tr>";
            echo "<td>".$rs["NomeCurso"]."</td>";
            echo "<td>".$rs["Nome"]."</td>";
            echo "<td>".$rs["e_Mail"]."</td>";
            echo "<td>".$rs["Fone_Residencial"]."</td>";
            echo "<td>".$rs["Fone_Comercial"]."</td>";
            echo "<td>".$rs["Celular"]."</td>";
            echo "<td>".formatarData($rs['Data_Cadastro'])."</td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    die();
}
?>
<html>
<head>
<title>Administração :: IPECON - Ensino e Consultoria</title>
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
-->
</style>
<script type="text/javascript"  language="javascript">
//== Ativar o aluno
function AtivarAluno(valor,ano,nome,curso){
    if(confirm('Deseja matricular este Aluno(a): '+nome+'?')){
        window.open('ativar_aluno.php?aluno='+valor+'&ano='+ano+'&codgCurso='+curso,'Matricular','left=2200');
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

function AbrirContrato(codg, ano, curso, tipo){
    window.open('../aluno/contratoAluno.php?id_numero='+codg+'&ano='+ano+'&curso='+curso+'&tipo='+tipo,'Contrato');
}

function formaDePagamento(codg, ano, nome, curso, nomeCurso, largura, altura){
    posx = (screen.width/2)-(largura/2)
    posy = (screen.height/2)-(altura/2)
    propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px, scrollbars=1, status=1" ;

    window.open('../formaDePagamento/index.php?id_numero='+codg+'&ano='+ano+'&nome='+nome+'&curso='+curso+'&nomeCurso='+nomeCurso,'formaDePagamento',propriedades);
}

function gerarExcel(){
	var codCurso = document.form1.codgCurso.value;
	window.open('alunos_cadastrados_pela_web.php?excel=1&codgCurso='+codCurso,'ArquivoExcel');
}

function abrirDadosAluno(codg, ano, largura, altura){
    posx = (screen.width/2)-(largura/2)
    posy = (screen.height/2)-(altura/2)
    propriedades = "width="+largura+"px, height="+altura+"px, top="+posy+"px, left="+posx+"px, scrollbars=1, status=1" ;

    window.open('../aluno/alterar_aluno.php?id_numero='+codg+'&ano='+ano, 'DadosAluno', propriedades);
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
td.linha:hover{
	background-color: #0061D7;
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
    <td background="../img_menu/esquerda.gif">&nbsp;</td>
    <td width="100%" valign="top" bgcolor="#FFFFFF">
	<!-- Conteúdo -->
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Alunos Cadastrados pela Internet</h3></div></td>
		</tr>
		<tr>
		  <td height="2" colspan="2" background="../../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
		</tr>
		<tr>
		  <td height="10" colspan="2" background="../../imagens/spacer.gif"></td>
		</tr>
		<tr>
		  <td>Nome:</td>
		  <td>Curso:</td>
		</tr>
		<tr><form name="form1" method="POST" action="alunos_cadastrados_pela_web.php">

		  <td><input type="text" name="nome" id="nome" size="35" value="<?php echo $_REQUEST['nome'];?>" class="TextoFormulario" /></td>
		  <td><select name="codgCurso" id="codgCurso" class="TextoFormulario">
				<option value="">[-- Selecionar --]</option>
				<?PHP
				while($regCurso = mysql_fetch_array($rsCursos)){
				?>
				<option value="<?php echo $regCurso['Codg_Curso']; ?>" <?php echo ($regCurso['Codg_Curso'] == $_REQUEST['codgCurso'] ? 'selected' : ''); ?>><?php echo $regCurso['Nome']; ?></option>
				<?php
				}
			?>
			</select>&nbsp;&nbsp;<input type="submit" name="botPesquisar" value="Pesquisar" class="botao" />&nbsp;<input type="button" onclick="gerarExcel()" name="botArquivo" value="Gerar Arquivo" class="botao" />
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
						<td style="padding-left: 0.3em; height: 16px"><b>Nome</b></td>
						<td style="padding-left: 0.3em"><b>Cidade do Curso</b></td>
						<td style="padding-left: 0.3em"><b>Cidade</b></td>
						<td style="padding-left: 0.3em"><b>Data Cadastro</b></td>
					    <td align="center"><b>Ação</b></td>
					    <td align="center"><b>Contrato</b></td>
					</tr>
					<?php
					if($num < 1){
					?>
					<tr>
						<td colspan="6" align="center"><font color="#FF0000">Nenhum registro encontrado.</font></td>
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
						<td background="../../imagens/spacer.gif" height="5" colspan="6"></td>
					</tr>
					<tr>
						<td colspan="6" bgcolor="#FFECD9" style="padding-left: 0.3em; font-weight:bold; height: 16px"><?=strtoupper($registro['NomeCurso'])?></td>
					</tr>
					<?php
								}
							}
							if($conta == 0){
					?>
					<tr>
						<td background="../../imagens/spacer.gif" height="5" colspan="6"></td>
					</tr>
					<tr>
						<td colspan="6" bgcolor="#FFECD9" style="padding-left: 0.3em; font-weight:bold; height: 16px"><?=strtoupper($registro['NomeCurso'])?></td>
					</tr>
					<?php
                        	}
					?>
					<tr bgcolor="<?php print($cor); ?>" class="linha">
						<td style="padding-left: 0.3em; height: 16px"><?=strtoupper($registro['Nome'])?></td>
						<td style="padding-left: 0.3em"><?php echo (!empty($registro['cidadeCurso']) ? "<strong>".$registro['cidadeCurso']."</strong>" : 'Goiânia')?></td>
						<td style="padding-left: 0.3em"><?=strtoupper($registro['Cidade'])?></td>
						<td style="padding-left: 0.3em"><?=formatarData($registro['Data_Cadastro'])?></td>
						<td align="center" valign="middle"><a href="JavaScript:abrirDadosAluno('<?php echo $registro['Id_Numero']; ?>',<?php echo $registro['Ano']; ?>,780,590)" title="Alterar dados de <?=strtoupper($registro['Nome'])?>"><img src="../../imagens/alterar.gif" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<?php if($registro['Ano'] != date('Y')){ ?><a href="JavaScript:alterarAno(<?=$registro['Sequencia']?>,<?=$registro['Ano']?>,'<?=$registro['Nome']?>')" title="Alterar o ano do Cadastro"><img alt="Transferencia"  src="../imagens/icons/transferencia.gif" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<?php }?><a href="JavaScript:AbrirPagina('<?php print($registro['Id_Numero']); ?>',<?php print($registro['Ano']); ?>,<?php print($registro['Curso']); ?>);" title="Imprimir ficha de inscrição"><img alt="Imprimir"  src="../../imagens/gif_imprimir.gif" width="16" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<a href="JavaScript:AtivarAluno('<?php print($registro['Id_Numero']); ?>',<?php print($registro['Ano']); ?>,'<?php print($registro['Nome']); ?>',<?=$registro['Curso']?>);" title="Matricular o Aluno(a): <?php print($registro['Nome']); ?>"><img alt="" src="../../imagens/favoritos.gif" width="12" height="14" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<a href="JavaScript:confirmarAlteracao('<?php print($registro['Id_Numero']); ?>',<?=$registro['Ano']; ?>,'<?=strtoupper($registro['Nome']); ?>')" title="Aluno(a) potencial: <?php print($registro['Nome']); ?>"><img alt="" src="../../imagens/bloquear.gif" width="12" height="14" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<a href="JavaScript:formaDePagamento('<?php print($registro['Id_Numero']); ?>',<?php echo $registro['Ano']; ?>,'<?php echo $registro['Nome']; ?>',<?php echo $registro['Curso']?>,'<?php echo $registro['NomeCurso']?>',852,520)" title="Forma de pagamento para o(a) Aluno(a): <?php print($registro['Nome']); ?>"><img alt="Cifrao" src="../imagens/icons/ico_cifrao.gif" width="12" height="14" border="0" align="absmiddle"></a></td>
						<td align="center" valign="middle"><a href="JavaScript:AbrirContrato('<?php echo $registro['Id_Numero']; ?>',<?php echo $registro['Ano']; ?>,<?php echo $registro['Curso']; ?>,'B');" title="Contrato com boleto"><img alt="Boleto"  src="../imagens/icons/ico_boleto.gif" width="16" height="16" border="0" align="absmiddle"></a>&nbsp;|&nbsp;<a href="JavaScript:AbrirContrato('<?php echo $registro['Id_Numero']; ?>',<?php echo $registro['Ano']; ?>,<?php echo $registro['Curso']; ?>,'C');" title="Contrato com cheque"><img src="../imagens/icons/ico_cheque.jpg" alt="Cheque" border="0" align="absmiddle"></a></td>
					</tr>
					<?php
							$conta++;
							$muda_curso = $registro['Curso'];
                        }
					}
					?>
					<tr>
						<td colspan="6" class="navegacao"><?php // exibir painel na tela
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
