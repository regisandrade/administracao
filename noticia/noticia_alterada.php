<?php 
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Alterar Curso
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Formatação da Data
$data_not = explode('/',$_POST['data']);
$data = $data_not[2].'-'.$data_not[1].'-'.$data_not[0];

$comando = "
UPDATE noticia SET
	Titulo = '".$_POST['titulo']."',
	Descricao = '".$_POST['descricao']."',
	Autor = '".$_POST['autor']."',
	Data = '$data'
WHERE
	Codg_Noticia = ".$_POST['codg_noticia'];
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta da Noticia. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());
?>
<script>
	alert('Notícia alterado com sucesso!');
	document.location='listar_noticias.php';	
</script>