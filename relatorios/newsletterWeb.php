<?php
include_once("../conexao.inc.php");

function formatarData($data){
	$dt = substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4);
	return $dt;
}

if($_REQUEST['idNews'] && $_REQUEST['idNews'] != 0){
    $del = "DELETE FROM newsletter WHERE id = ".$_REQUEST['idNews'];
    $resDel = mysql_query($del);
    if(!$resDel){
        echo "Erro ao excluir Newsletter!";
        exit;
    }
}

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

$comando = "SELECT * FROM newsletter ORDER BY dataCadastro LIMIT ".$primeiro_registro.", ".$num_por_pagina;
$result = mysql_query($comando) or die ("Erro na Consulta.");
$num = mysql_num_rows(mysql_query($comando));

// bloco 3 -  construa e exiba um painel de navegabilidade entre as páginas
$consulta = "SELECT * FROM newsletter ORDER BY dataCadastro";
$total_alunos = mysql_num_rows(mysql_query($consulta));

$total_paginas = $total_alunos/$num_por_pagina;

$prev = $pagina - 1;
$next = $pagina + 1;
// se página maior que 1 (um), então temos link para a página anterior
if ($pagina > 1) {
    $prev_link = "<a href=\"$PHP_SELF?pagina=$prev\">&lt;&lt;&nbsp;Anterior</a>";
} else { // senão não há link para a página anterior
    $prev_link = "&lt;&lt;&nbsp;Anterior";
}
// se número total de páginas for maior que a página corrente,
// então temos link para a próxima página
if ($total_paginas > $pagina) {
    $next_link = "<a href=\"$PHP_SELF?pagina=$next\">Próxima&nbsp;&gt;&gt;";
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
        $painel .= " <a href='".$PHP_SELF."?pagina=".$x."'>[".$x."]</a>";
    }
}
// gerer arquivo xls
if($_REQUEST['excel'] == 1){
    // definimos o tipo de arquivo
    header("Content-type: application/msexcel");

    // Como será gravado o arquivo
    header("Content-Disposition: attachment; filename=newsletter.xls");

    // montando a tabela
    echo "<table>";
        echo "<tr>";
            echo "<td colspan=\"4\">LISTA DE PESSOAS CADASTRADAS - NEWSLETTER</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<td></td>";
            echo "<td>Nome</td>";
            echo "<td>E-mail</td>";
            echo "<td>Data do cadastro</td>";
        echo "</tr>";
    $resultado = mysql_query($consulta);
    $i=1;
    while ($rs = mysql_fetch_array($resultado)){
        echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>" . $rs["nome"] . "</td>";
            echo "<td>" . $rs["email"] . "</td>";
            echo "<td>". formatarData($rs['dataCadastro']) ."</td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    die();
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
<script>
	function excluirRegistro(id,pagina){
		if(confirm("Tem certeza que deseja excluir o registro?")){
			window.location = "newsletterWeb.php?idNews="+id+"&pagina="+pagina;
		}
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
                    <td colspan="2" valign="top" height="25"><div id="pageName" style="font-family:Verdana"><h3>Newsletter</h3></div></td>
                </tr>
                <tr>
                    <td height="2" colspan="2" background="../imagens/spacer.gif" bgcolor="#CCCCCC"></td>
                </tr>
                <tr>
                    <td height="10" colspan="2" background="../imagens/spacer.gif"></td>
                </tr>
                <tr>
                    <td height="10" colspan="2" background="../imagens/spacer.gif"></td>
                </tr>
                <tr>
                    <td colspan="2" valign="top">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="3">
                            <tr>
                                <td colspan="2">Exportar arquivo .xls <a href="newsletterWeb.php?excel=1"><img src="../imagens/icons/excel_icon.gif" height="25" width="25" border="0" alt="" align="middle" /></a>
                                </td>
                            </tr>
                            <tr bgcolor="#EEEEEE">
                                <td style="padding: 2px"><strong>Nome</strong></td>
                                <td style="padding: 2px"><strong>e-Mail</strong></td>
                                <td style="padding: 2px"><strong>Data</strong></td>
                                <td style="padding: 2px">&nbsp;</td>
                            </tr>
                            <?php
                                if($num < 1){
                            ?>
                            <tr>
                                <td colspan="3" align="center" class="Texto">
                                    <font color="#FF0000">Nenhum registro encontrado.</font>
                                </td>
                            </tr>
                            <?php
                            }else{
                                $conta = 0;
                                $volta = 1;
                                while($registro = mysql_fetch_array($result)){
                                    $cor = ($conta % 2 == 1 ? '#DDEEFF' : '#FFFFFF');
                            ?>
                                    <tr bgcolor="<?=$cor?>" class="linha">
                                        <td style="padding: 2px"><?php echo $registro['nome']; ?></td>
                                        <td style="padding: 2px"><?php echo $registro['email']; ?></td>
                                        <td style="padding: 2px"><?php echo formatarData($registro['dataCadastro']); ?></td>
                                        <td style="padding: 2px; text-align: center;"><a href="#" onClick="excluirRegistro(<?php echo $registro['id']; ?>,<?php echo $pagina?>)" title="Excluir registro"><img src="http://www.ipecon.com.br/imagens/excluir.gif" border="0" /></a></td>
                                    </tr>
                            <?php
                                    $conta++;
                                    $volta++;
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2" class="navegacao">
                                <?php // exibir painel na tela
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
