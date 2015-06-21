<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Inclusão de Turmas
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

// Verificar se a Turma já foi cadastrada
$consulta = "SELECT * FROM turmas WHERE Id_Turma = '".$_GET['codigo']."'";
$resultado = mysql_query($consulta) or die ("Erro na consulta da Turma. ".mysql_error());
$numero = mysql_num_rows($resultado);

if($numero > 0){
?>
<script>
	alert('Esta Turma já esta cadastrada.');
	history.back();
</script>
<?php
	exit;
}

$comando = "
	INSERT INTO	turmas (
		Id_Turma,
		Descricao
	)VALUES(
		'".$_GET['codigo']."',
		'".$_GET['nome']."'
	)
";
mysql_query($comando) or die ("Erro na Gravação da Turma. ".mysql_error());
?>
<script>
	alert('Turma incluída com sucesso!');
	document.location='incluir_turma.php';	
</script>