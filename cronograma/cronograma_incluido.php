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

$comando = "INSERT INTO cronograma (
	Turma,
	Disciplina,
	Data_01,
	Data_02,
	Data_03,
	Data_04,
	Data_05,
	Data_06
) VALUES (
	'".$_REQUEST['turma']."',
	".$_REQUEST['disciplina'].",
	'$data_1',
	'$data_2',
	'$data_3',
	'$data_4',
	'$data_5',
	'$data_6'
)";
//print($comando);exit;
mysql_query($comando) or die('Erro na gravação do Cronograma. '.$comando);

// Local = 1 -> cadastro
// Local = 2 -> consulta
switch($_REQUEST['local']){
	case 1:
		$direcionar = "incluir_cronograma.php?codgTurma=".$_REQUEST['turma'];
	break;
	case 2:
		$direcionar = "Lista_Cronograma.php";
	break;

}

?>
<script language="javascript">
	alert('Cronograma incluido com sucesso!');
	document.location="<?php echo $direcionar;?>"
</script>