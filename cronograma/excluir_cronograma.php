<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
die();*/
// Excluir a turma
if($_REQUEST['codgTurma']){
    $comando = "DELETE FROM cronograma WHERE Turma = '".$_REQUEST['codgTurma']."'";
}
// Excluir um registro
if($_REQUEST['codg']){
    $comando = "DELETE FROM cronograma WHERE Id_Numero = ".$_REQUEST['codg'];
}
mysql_query($comando) or die('Erro na exclusão do Cronograma.');

// Se a variável local estiver setada, direcionar para o cadastro
if($_REQUEST['local'] == 1){
	$direcionar = "incluir_cronograma.php?codgTurma=".$_REQUEST['turma'];
}else{
	$turma = '';
	if(!empty($_REQUEST['turma'])){
		$turma = "?turma=".$_REQUEST['turma'];
	}
	$direcionar = "Lista_Cronograma.php".$turma;
}

?>
<script language="javascript">
	document.location="<?php echo $direcionar; ?>"
</script>