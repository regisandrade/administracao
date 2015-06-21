<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Usuario
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = "DELETE FROM usuario_adm WHERE id = ".$_REQUEST['id'];
mysql_query($comando) or die ("Erro na Exclusão do Usuário Adm. ".mysql_error());

header("location: listar_usuario.php");
?>rio.php");
?>
