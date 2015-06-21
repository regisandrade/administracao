<?php
//=============================================//
// Proprietário : IPECON - Ensino e Consultoria
// Site : www.ipecon.com.br
// Autor : Régis Rodrigues de Andrade
// Página : Excluir Noticia
//=============================================//

require('../../conexao.php'); //== Faz a conexão com o banco

$comando  = 'DELETE FROM noticia WHERE Codg_Noticia = '.$codg_noticia;
mysql_query($comando) or die ("<font face='Verdana' size='2'>Erro na Consulta da Noticia. <br><b>Comando:</b> <font color='#FF0000'>".$comando."</font><br><b>Erro:</b> ".mysql_error());

header("location: listar_noticias.php");
?>