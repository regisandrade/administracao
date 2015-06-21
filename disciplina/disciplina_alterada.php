<?php 
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Alterar Disciplina
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

$comando = "
	UPDATE disciplina SET
		Nome = '".$_GET['nome']."',
		Horas_Aula = '".$_GET['hora_aula']."'
	WHERE
	Codg_Disciplina = ".$_GET['codg_disciplina'];
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta da Disciplina. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());
?>
<script>
	alert('Disciplina alterada com sucesso!');
	document.location='listar_disciplinas.php';	
</script>