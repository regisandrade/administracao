<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Curso
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

$comando  = 'DELETE FROM curso WHERE Codg_Curso = '.$codg_curso;
mysql_query($comando) or die ("Erro na Exclus�o do Curso. ".mysql_error());

header("location: listar_cursos.php");
?>