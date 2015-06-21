<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados

if($_REQUEST['data1'] != ''){
	$dt_1 = explode('/',$_REQUEST['data1']);
	$data_1 = $dt_1[2].'-'.$dt_1[1].'-'.$dt_1[0];
}
if($_REQUEST['data2'] != ''){
	$dt_2 = explode('/',$_REQUEST['data2']);
	$data_2 = $dt_2[2].'-'.$dt_2[1].'-'.$dt_2[0];
}
if($_REQUEST['data3'] != ''){
	$dt_3 = explode('/',$_REQUEST['data3']);
	$data_3 = $dt_3[2].'-'.$dt_3[1].'-'.$dt_3[0];
}
if($_REQUEST['data4'] != ''){
	$dt_4 = explode('/',$_REQUEST['data4']);
	$data_4 = $dt_4[2].'-'.$dt_4[1].'-'.$dt_4[0];
}
if($_REQUEST['data5'] != ''){
	$dt_5 = explode('/',$_REQUEST['data5']);
	$data_5 = $dt_5[2].'-'.$dt_5[1].'-'.$dt_5[0];
}
if($_REQUEST['data6'] != ''){
	$dt_6 = explode('/',$_REQUEST['data6']);
	$data_6 = $dt_6[2].'-'.$dt_6[1].'-'.$dt_6[0];
}

$comando = "
UPDATE cronograma SET
	Turma = '".$_REQUEST['turma']."',
	Disciplina = ".$_REQUEST['disciplina'].",
	Data_01 = '$data_1',
	Data_02 = '$data_2',
	Data_03 = '$data_3',
	Data_04 = '$data_4',
	Data_05 = '$data_5',
	Data_06 = '$data_6'
WHERE
	Id_Numero = ".$_REQUEST['codg'];
//echo "<pre>"; print_r($_REQUEST); die;
mysql_query($comando) or die('Erro na gravação do Cronograma. '.$comando);


// Se a variável local estiver setada, direcionar para o cadastro
if(isset ($_REQUEST['local'])){
	$direcionar = "incluir_cronograma.php?codgTurma=".$_REQUEST['turma'];
}else{
	$direcionar = "Lista_Cronograma.php";
}

?>
<script language="javascript">
	alert('Cronograma alterado com sucesso!');
	document.location="<?php echo $direcionar; ?>"
</script>