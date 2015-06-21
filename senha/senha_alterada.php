<?php
//=============================================//
// Proprietсrio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Rщgis Rodrigues de Andrade
// Pсgina : Excluir Link
//=============================================//

require('../../conexao.php'); //== Faz a conexуo com o banco

$cmd_usuario = "SELECT * FROM usuario_adm WHERE Login = '$login'";
$res_usuario = mysql_query($cmd_usuario) or die ("Erro na Consulta do Usuсrio de Administraчуo. ".mysql_error());
$num = mysql_num_rows($res_usuario);

if($num < 1){
	$mensagem = "Login nуo cadastrado.";
	header("location: alterar_senha.php?msg=$mensagem");
	exit;
}

$cmd_alterar = "
UPDATE usuario_adm SET
	Senha = '$nova_senha',
	Confirma = '$repetir_senha'
WHERE
	Login = '$login'";
mysql_query($cmd_alterar) or die ("Erro na Alteraчуo do Usuсrio. ".mysql_error());

$mensagem = "Senha Alterada com sucesso.";
header("location: alterar_senha.php?msg=$mensagem");

?>