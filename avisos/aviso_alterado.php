<?php 
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Alterar Aviso
//=============================================//

require('../../conexao.php'); //== Conexão com o Banco de Dados

$comando = "
UPDATE aviso SET
	Titulo = '".$_REQUEST['titulo']."',
	Descricao = '".$_REQUEST['descricao']."'
WHERE
	Codg_Aviso = ".$_REQUEST['codg_aviso'];
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta do Aviso. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());
?>
<script>
	alert('Aviso alterado com sucesso!');
	document.location='listar_avisos.php';	
</script>
