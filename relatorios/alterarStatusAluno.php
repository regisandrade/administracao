<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Aluno
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

//== MUDAR O STATUS DO ALUNO PARA 2, PORQUE O MESMO � CLASSIFICADO COMO ALUNO EM POTENCIAL
$comando  = "UPDATE aluno SET Status = 2 WHERE Id_Numero = '".$_GET['id_numero']."' AND Ano = ".$_GET['ano'];
mysql_query($comando) or die ("Erro na ALTERA��O do status do Aluno.");

//== MUDAR O STATUS DO USUARIOALUNO PARA 2-DESATIVADO
$cmdLogin  = "UPDATE usuario_aluno SET status = 2 WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($cmdLogin) or die ("Erro na ALTERA��O do status do UsuarioAluno.");

// Otimizar Tabelas
$sql = "OPTIMIZE TABLE aluno, usuario_aluno";
mysql_query($sql) or die ("Erro na Otimiza��o das Tabelas.");

header("location: alunos_cadastrados_pela_web.php");
?>
