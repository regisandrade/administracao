<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Disciplina
//=============================================//

require('../conexao.inc.php'); //== Faz a conex�o com o banco

$comando  = "DELETE FROM disciplina WHERE Codg_Disciplina = ".$_GET['codg_disciplina'];
mysql_query($comando) or die ("Erro na Exclus�o da Disciplina. ".mysql_error());

header("location: listar_disciplinas.php");
?>
