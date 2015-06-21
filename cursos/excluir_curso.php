<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Curso
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = 'DELETE FROM curso WHERE Codg_Curso = '.$codg_curso;
mysql_query($comando) or die ("Erro na Exclusão do Curso. ".mysql_error());

header("location: listar_cursos.php");
?>