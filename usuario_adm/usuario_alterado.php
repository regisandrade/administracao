<?php 
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Alterar Usu�rio
//=============================================//

require('../../conexao.php'); //== Conex�o com o Banco de Dados

$comando = "
	UPDATE usuario_adm SET
		Nome = '".$_REQUEST['nome']."',
		Sexo = '".$_REQUEST['sexo']."'
	WHERE
		id = ".$_REQUEST['id'];
mysql_query($comando) or die ("Erro na Altera��o do Usu�rio. ".mysql_error());
?>
<script>
	alert('Usu�rio alterado com sucesso!');
	document.location='listar_usuario.php';	
</script>
