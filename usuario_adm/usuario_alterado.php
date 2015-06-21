<?php 
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Alterar Usuário
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

$comando = "
	UPDATE usuario_adm SET
		Nome = '".$_REQUEST['nome']."',
		Sexo = '".$_REQUEST['sexo']."'
	WHERE
		id = ".$_REQUEST['id'];
mysql_query($comando) or die ("Erro na Alteração do Usuário. ".mysql_error());
?>
<script>
	alert('Usuário alterado com sucesso!');
	document.location='listar_usuario.php';	
</script>
