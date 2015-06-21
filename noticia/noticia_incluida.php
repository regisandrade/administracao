<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Inclusão de Notícia
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Data de Inclusão
$data_inclusao = date('Y-m-d');

//== Formatação da Data
$data_not = explode('/',$_POST['data']);
$data = $data_not[2].'-'.$data_not[1].'-'.$data_not[0];

$comando = "
	INSERT INTO	noticia (
		Titulo,
		Descricao,
		Autor,
		Data,
		Data_Inclusao
	)VALUES(
		'".$_POST['titulo']."',
		'".$_POST['descricao']."',
		'".$_POST['autor']."',
		'$data',
		'$data_inclusao'
	)
";
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta da Noticia. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());
?>
<script>
	alert('Notícia incluída com sucesso!');
	document.location='incluir_noticia.php';	
</script>