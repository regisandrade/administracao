<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Alterar Aluno
//=============================================//

session_start();

require('../../conexao.php'); //== Faz a conex�o com o banco

//== Descri��o do STATUS
//== 0 --> Inativo
//== 1 --> Ativo

//== Alterar a tabela de aluno
$cmd_aluno = "
	UPDATE aluno SET
		Status = ".$_GET['status'].",
		Usuario_Alteracao = '".$_SESSION['login']."',
		Data_Alteracao = '".date('Y-m-d')."'
	WHERE
		Id_Numero = '".$_GET['id_numero']."' 
		AND 
		Ano = ".$_GET['ano'];
mysql_query($cmd_aluno) or die ("Erro na Altera��o do Aluno.");

// Desativar usuario_aluno
$cmdUsuarioAluno = "UPDATE usuario_aluno SET status = ".$_GET['status']." WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($cmdUsuarioAluno) or die ("Erro na Altera��o do Aluno.");

// Otimizar Tabelas
$sql = 'OPTIMIZE TABLE aluno, usuario_aluno'; 
mysql_query($sql) or die ("Erro na Otimiza��o das Tabelas.");

?>
<script>
	alert('Aluno(a) alterado(a) com sucesso!');
	document.location="resultado_alunos.php?curso=<?php print($_GET['curso']); ?>&ano=<?php print($_GET['ano']); ?>";	
</script>