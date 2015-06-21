<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Aluno
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

//== MUDAR O STATUS DO ALUNO PARA 2, PORQUE O MESMO É CLASSIFICADO COMO ALUNO EM POTENCIAL
$comando  = "UPDATE aluno SET Status = 2 WHERE Id_Numero = '".$_GET['id_numero']."' AND Ano = ".$_GET['ano'];
mysql_query($comando) or die ("Erro na ALTERAÇÃO do status do Aluno.");

//== MUDAR O STATUS DO USUARIOALUNO PARA 2-DESATIVADO
$cmdLogin  = "UPDATE usuario_aluno SET status = 2 WHERE Id_Numero = '".$_GET['id_numero']."'";
mysql_query($cmdLogin) or die ("Erro na ALTERAÇÃO do status do UsuarioAluno.");

// Otimizar Tabelas
$sql = "OPTIMIZE TABLE aluno, usuario_aluno";
mysql_query($sql) or die ("Erro na Otimização das Tabelas.");

header("location: alunos_cadastrados_pela_web.php");
?>
