<?php
//=============================================//
// Propriet�rio : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : R�gis Rodrigues de Andrade
// P�gina : Excluir Aviso
//=============================================//

require('../../conexao.php'); //== Faz a conex�o com o banco

$comando  = 'DELETE FROM aviso WHERE Codg_Aviso = '.$_GET['codg_aviso'];
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Exclus�o do Aviso. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());

header("location: listar_avisos.php");
?>