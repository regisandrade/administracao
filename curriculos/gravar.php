<?php
require('../../conexao.php'); // Faz a conexão com o banco

if(!$_POST['ligado']) {
	header('Location: enviar.php');
}
/* Retirar no checklist */
/*echo "<pre>";
print_r($_REQUEST);
print_r($sql);
echo "</pre>";*/


/* Verificar se o professor já esta com seu curriculo cadastrado */
$sql = "select
				*
		from
				curriculo
		where
			    codgCurso     = ".$_REQUEST['codgCurso']."
			and CodgProfessor = '".$_REQUEST['codgProfessor']."'";

if(!empty($_REQUEST['codgCurriculo'])){
	$sql .= " and codgCurriculo <> ".$_REQUEST['codgCurriculo'];
}

$registros = mysql_query($sql) or die ("Erro na consulta dos curriculos");
$numero = mysql_num_rows($registros);
if($numero > 0){
	$mensagem = "O currículo para este professor neste curso já esta cadastrado.";
?>
<script>
	alert('<?php echo $mensagem ?>');
	document.location='enviar.php';
	return false;
</script>
<?php
die();
}

if(!empty($_REQUEST['codgCurriculo'])){
	$sql = "update curriculo
			set codgCurso     =  {$_REQUEST['codgCurso']},
				CodgProfessor = '{$_REQUEST['codgProfessor']}',
				url           = '{$_REQUEST['url']}',
				titulacao     = '{$_REQUEST['titulacao']}',
				puc           = '{$_REQUEST['puc']}'
			where
				codgCurriculo = {$_REQUEST['codgCurriculo']}";
	$paginaRetorno = "listar.php";
	$msgRetorno    = "Currículo alterado com sucesso!";
}else{
	//== Data do Cadastro
	$data_inclusao = date('Y-m-d');

	//== Faz a Inclusão na Tabela de Curriculo
	$sql = "
	INSERT INTO curriculo (
		   codgCurso,
		   CodgProfessor,
		   arquivo,
		   url,
		   titulacao,
		   puc,
		   dataInclusao
	)VALUES(
		   ".$_REQUEST['codgCurso'].",
		   '".$_REQUEST['codgProfessor']."',
		   'null',
		   '".$_REQUEST['url']."',
		   '".$_REQUEST['titulacao']."',
		   '".$_REQUEST['puc']."',
		   '".$data_inclusao."'
	)";
	$paginaRetorno = "enviar.php";
	$msgRetorno    = "Currículo enviado com sucesso!";
}

mysql_query($sql) or die ("Erro na Gravação do Curriculo: ".mysql_error());
?>
<script>
	alert('<?php echo $msgRetorno ?>');
	document.location="<?php echo $paginaRetorno ?>";
</script>
