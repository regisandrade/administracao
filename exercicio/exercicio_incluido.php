<?php
//echo "<pre>";print_r($_FILES);die;
require('../../conexao.php'); // Faz a conex�o com o banco

/* A pasta que ser� usada como local de repositorio deve estar setada como leitura para todos.
chomod 777 pasta_a_ser_usada
*/
if(empty($_REQUEST['ligado'])) {
	header('Location: incluir_exercicio.php'); /* Caso n�o tenha sido escolhido o arquivo, volta ao formulario.*/
}else{
	$pasta = "/home/ipecon1/public_html/exercicios";
    /* Coloque aqui, a pasta no servidor onde os arquivos ser�o salvos.
    /* Aten��o: se voc� n�o souber sua pasta no servidor, contate o
    /* administrador do mesmo. */

	//== Retirar acentos
	$arquivo = strtr($_FILES['txt_arquivo']['name'],"SOZsozY��������������������������������������������������������������",
				"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
	//print($arquivo);exit;
    $dest = $pasta."/".$arquivo; // N�o altere esta vari�vel.

    if(!move_uploaded_file($_FILES['txt_arquivo']['tmp_name'], $dest)) {
		// Executa o comando do upload no servidor
		echo "<center><font face='verdana' size='2'>N�o foi poss�vel enviar o arquivo!</font></center>";
		echo '<center><a href="incluir_exercicio.php">voltar</a></center>';
		exit;
		/* Caso n�o foi poss�vel enviar o arquivo, mostra o erro. */
	}
}

//== Retirar acentos
$arquivo = strtr($_FILES['txt_arquivo']['name'],"SOZsozY��������������������������������������������������������������",
			"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");

//== Data do Cadastro
$data_cadastro = date('Y-m-d');

//== Faz a Inclus�o na Tabela de Exerc�cios
$query_exercicio = "
	INSERT INTO exercicio (
		Ano,
		Exercicio,
		Turma,
		Tipo_Material,
		Data_Cadastro
	)VALUES(
		".$_POST['ano'].",
		'".$arquivo."',
		'".$_POST['turma']."',
		".$_POST['tipo_material'].",
		'$data_cadastro'
	)";
//die($query_exercicio);
mysql_query($query_exercicio) or die ("Erro na Grava��o do Exerc�cio: ".mysql_error());

// Dar permiss�o para leitura e execu��o do arquivo
//chmod("/home/ipecon1/public_html/exercicios/".$_POST['txt_arquivo']."", 0755);
?>
<script>
	alert('Exerc�cio inclu�do com sucesso!');
	document.location='incluir_exercicio.php';
</script>