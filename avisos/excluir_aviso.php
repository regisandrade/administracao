<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Aviso
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = 'DELETE FROM aviso WHERE Codg_Aviso = '.$_GET['codg_aviso'];
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Exclusão do Aviso. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());

header("location: listar_avisos.php");
?>