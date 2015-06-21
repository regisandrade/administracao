<?
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Conexão com o Banco de Dados
//=============================================//

$conexao = mysql_connect("localhost", "ipecon1_ipecon", "nich1504") or die("Não consegui conectar ao Banco de Dados IPECON. ".mysql_error());
$db = "ipecon1_ipecon";

/*$conexao = mysql_connect("localhost", "root", "123456") or die("Não consegui conectar ao Banco de Dados IPECON. ".mysql_error());
$db = "ipecon";*/

$result1 = mysql_select_db($db, $conexao) or die("Não pode selecionar Base de Dados. ".mysql_error());
?>
