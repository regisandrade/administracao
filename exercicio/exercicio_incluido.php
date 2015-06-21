<?php
//echo "<pre>";print_r($_FILES);die;
require('../../conexao.php'); // Faz a conexão com o banco

/* A pasta que será usada como local de repositorio deve estar setada como leitura para todos.
chomod 777 pasta_a_ser_usada
*/
if(empty($_REQUEST['ligado'])) {
	header('Location: incluir_exercicio.php'); /* Caso não tenha sido escolhido o arquivo, volta ao formulario.*/
}else{
	$pasta = "/home/ipecon1/public_html/exercicios";
    /* Coloque aqui, a pasta no servidor onde os arquivos serão salvos.
    /* Atenção: se você não souber sua pasta no servidor, contate o
    /* administrador do mesmo. */

	//== Retirar acentos
	$arquivo = strtr($_FILES['txt_arquivo']['name'],"SOZsozY¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİßàáâãäåæçèéêëìíîïğñòóôõöøùúûüıÿ",
				"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
	//print($arquivo);exit;
    $dest = $pasta."/".$arquivo; // Não altere esta variável.

    if(!move_uploaded_file($_FILES['txt_arquivo']['tmp_name'], $dest)) {
		// Executa o comando do upload no servidor
		echo "<center><font face='verdana' size='2'>Não foi possível enviar o arquivo!</font></center>";
		echo '<center><a href="incluir_exercicio.php">voltar</a></center>';
		exit;
		/* Caso não foi possível enviar o arquivo, mostra o erro. */
	}
}

//== Retirar acentos
$arquivo = strtr($_FILES['txt_arquivo']['name'],"SOZsozY¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏĞÑÒÓÔÕÖØÙÚÛÜİßàáâãäåæçèéêëìíîïğñòóôõöøùúûüıÿ",
			"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");

//== Data do Cadastro
$data_cadastro = date('Y-m-d');

//== Faz a Inclusão na Tabela de Exercícios
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
mysql_query($query_exercicio) or die ("Erro na Gravação do Exercício: ".mysql_error());

// Dar permissão para leitura e execução do arquivo
//chmod("/home/ipecon1/public_html/exercicios/".$_POST['txt_arquivo']."", 0755);
?>
<script>
	alert('Exercício incluído com sucesso!');
	document.location='incluir_exercicio.php';
</script>