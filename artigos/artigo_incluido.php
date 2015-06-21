<?php
require('../../conexao.php'); // Faz a conexão com o banco

/* A pasta que será usada como local de repositorio deve estar setada como leitura para todos.
chomod 777 pasta_a_ser_usada
*/
if(!$_POST['ligado']) {
	header('Location: incluir_artigo.php'); /* Caso não tenha sido escolhido o arquivo, volta ao formulario.*/
}else{
	$pasta = "../../artigos_publicados";
    /* Coloque aqui, a pasta no servidor onde os arquivos serão salvos.
    /* Atenção: se você não souber sua pasta no servidor, contate o
    /* administrador do mesmo. */

	//== Retirar acentos 
	$_FILES['txt_arquivo']['name'] = strtr($_FILES['txt_arquivo']['name'],"SOZsozY¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ",
				"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");

  $destino = $pasta."/".$_FILES['txt_arquivo']['name']; // Não altere esta variável.
	
  if(!move_uploaded_file($_FILES['txt_arquivo']['tmp_name'], $destino)) {
		// Executa o comando do upload no servidor
		echo "<center><font face='verdana' size='2'>Não foi possível enviar o arquivo!</font></center>";
		echo '<center><a href="incluir_exercicio.php">voltar</a></center>';
		exit;
		/* Caso não foi possível enviar o arquivo, mostra o erro. */
	}
	// Gerar permissão para o arquivo
	//chmod("/artigos/".$txt_arquivo_name,0655);
}

//== Retirar acentos 
$txt_arquivo = strtr($_FILES['txt_arquivo']['name'],"SOZsozY¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ",
			"SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
			
//== Data do Cadastro
$data_cadastro = date('Y-m-d');

//== Faz a Inclusão na Tabela de Exercícios
$query_artigo = "
	INSERT INTO artigo (
		Descricao,
		Artigo,
		Todos,
		Data
	)VALUES(
		'".$_POST['descricao']."',
		'".$txt_arquivo."',
		".$_POST['todos'].",
		'$data_cadastro')";

mysql_query($query_artigo) or die ("Erro na Gravação do Artigo: ".mysql_error());

// Dar permissão para leitura e execução do arquivo
//chmod("../../artigos/".$_FILES['txt_arquivo']['name'], 0755);
?>
<script>
	alert('Artigo incluído com sucesso!');
	document.location='incluir_artigo.php';	
</script>
