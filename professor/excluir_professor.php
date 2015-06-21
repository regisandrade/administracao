<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Professor
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = "DELETE FROM professor WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando) or die ("Erro na Exclusão do Professor. ".mysql_error());

$comando_2  = "DELETE FROM endereco WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_2) or die ("Erro na Exclusão do Endereço do Professor. ".mysql_error());

//== Excluir Login do Usuário Professor
$comando_3  = "DELETE FROM usuario_professor WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($comando_3) or die ("Erro na Exclusão do Login do Professor.<br>Comando:".$comando_3."<br>Erro: ".mysql_error());

header("location: listar_professores.php");
?>