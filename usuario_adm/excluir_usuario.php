<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Usuario
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

$comando  = "DELETE FROM usuario_adm WHERE id = ".$_REQUEST['id'];
mysql_query($comando) or die ("Erro na Exclus�o do Usu�rio Adm. ".mysql_error());

header("location: listar_usuario.php");
?>rio.php");
?>
