<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Inclusão de Aluno
//=============================================//

require('../conexao.inc.php'); //== Conexão com o Banco de Dados

// VERIFICAR SE A DISCIPLINA EXISTE COM O MESMO NOME
$sql_disciplina = "SELECT * FROM disciplina WHERE Nome = '".$_GET['nome']."'";
$res_disciplina = mysql_query($sql_disciplina) or die ("Erro na Consulta da Disciplina.");
if(mysql_num_rows($res_disciplina) > 0){
?>
	<script>
		alert("Existe uma disciplina cadastrada com este nome.");
		history.back();
	</script>
<?php
	die;
}

//== Data do Cadastro
$data_cadastro = date('Y-m-d');

//== Incluir dados da Disciplina
$cmd_disciplina = "
	INSERT INTO	disciplina (
		Nome,
		Horas_Aula,
		Data_Cadastro
	)VALUES(
		'".$_GET['nome']."',
		'".$_GET['hora_aula']."',
		'$data_cadastro'
	)
";
mysql_query($cmd_disciplina) or die ("Erro na Gravação da Disciplina.");

?>
<script>
	alert('Disciplina Incluída com sucesso!');
	document.location='incluir_disciplina.php';	
</script>
