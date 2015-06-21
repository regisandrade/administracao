<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Disciplina
//=============================================//

require('../conexao.inc.php'); //== Faz a conexão com o banco

$comando  = "DELETE FROM disciplina WHERE Codg_Disciplina = ".$_GET['codg_disciplina'];
mysql_query($comando) or die ("Erro na Exclusão da Disciplina. ".mysql_error());

header("location: listar_disciplinas.php");
?>
