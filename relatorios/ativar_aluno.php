<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
//=============================================//
session_start();

require('../../conexao.php'); //== Faz a conexão com o banco

//== Ativar o aluno
$cmd_aluno = "
	UPDATE aluno SET
		Web = 2,
		Status = 1
	WHERE
		Id_Numero = '".$_REQUEST['aluno']."'
		AND
		Ano = ".$_REQUEST['ano'];
mysql_query($cmd_aluno) or die ("Erro na Alteração do Aluno.");

//== Ativar o usuarioAluno
$cmdUsuario = "
	UPDATE usuario_aluno SET
		status = 1
	WHERE
		Id_Numero = '".$_REQUEST['aluno']."'";
mysql_query($cmdUsuario) or die ("Erro na Alteração do usuarioAluno.");

$sql = 'OPTIMIZE TABLE aluno, usuario_aluno';
mysql_query($sql) or die ("Erro na Otimização das Tabelas.");

?>
<script>
	alert('Aluno(a) ativado(a) com sucesso!');
	window.opener.location.reload();
	window.close();
</script>