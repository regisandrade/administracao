<?php
require('../../conexao.php');

switch($_GET['tipo']){
	// Liberar
	case 1:
		$comando = "
		UPDATE depoimento SET
			Status = 1
		WHERE
			ID_Depoimento = ".$_GET['id_depoimento'];
		$msg = "Depoimento liberado com sucesso!";
	break;
	
	// Bloquear
	case 2:
		$comando = "
		UPDATE depoimento SET
			Status = 0
		WHERE
			ID_Depoimento = ".$_GET['id_depoimento'];
		$msg = "Depoimento bloqueado com sucesso!";
	break;
	
	// Excluir
	case 3:
		$comando = "DELETE FROM depoimento WHERE ID_Depoimento = ".$_GET['id_depoimento'];
		$msg = "Depoimento excluído com sucesso!";
	break;
}
mysql_query($comando) or die('Erro na Atualização do Depoimento. '.mysql_error().'<br>'.$comando);
?>
<script>
	alert('<?php print($msg); ?>');
	document.location = "listar_depoimento.php";
</script>