<?php
require('../../conexao.php'); //== Conexão com o Banco de Dados

//== Consultar os alunos
$consulta = "
SELECT
  Nome,
  e_Mail,
  DATE_FORMAT(Data_Nascimento,'%d/%m') AS Data_Nasc,
  Id_Numero
FROM
  aluno
WHERE
  e_Mail <> ''
  AND
  Data_Nascimento <> '0'
  AND
  MONTH(Data_Nascimento) = '".date('m')."'
  AND
  Web = 2
  AND
  Enviado = 0
ORDER BY
  DATE_FORMAT(Data_Nascimento,'%m'), DATE_FORMAT(Data_Nascimento,'%d/%m'), Nome";
$resultado = mysql_query($consulta) or die('Erro na consulta dos aniversariantes.<br>'.mysql_error());
$numero = mysql_num_rows($resultado);

if($numero != 0){
  while($resultado = mysql_fetch_array($resultado)){
    if($resultado['Data_Nasc'] == date('d/m')){
		/* esse script serve para você enviar informações para uma determinada pessoa*/

		/* Destinatário */
		$para = $resultado['Nome']." <".$resultado['e_Mail'].">";

		/* Assunto */
		$assunto = "Feliz aniversário ".$resultado['Nome'];

		/* Mensagem */
		$mensagem = '
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<title>IPECON Pós-Graduação - Feliz Aniversário</title>
			<style type="text/css">
			<!--
			body {
				margin-left: 0px;
				margin-top: 0px;
			}
			.Texto {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-weight: bold;
			}
			.Nome {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-weight: bold;
				font-size:14px;
				color:#FFFFFF;
			}
			-->
			</style>
		</head>
		<body>
		<table width="480" height="554"  border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="10" rowspan="5" bgcolor="#105DAD">&nbsp;</td>
			<td width="460" height="13" bgcolor="#125FAB"></td>
			<td width="10" rowspan="5" bgcolor="#105DAD">&nbsp;</td>
		  </tr>
		  <tr>
			<td valign="top"><img src="http://www.ipecon.com.br/imagens/cartao/bolo.jpg" width="460" height="380"></td>
		  </tr>
		  <tr>
			<td height="190" align="center" valign="top" class="Texto">
			    <h2>FELIZ ANIVERSÁRIO</h2>
			    <h4>É o que lhe deseja a equipe do Ipecon.</h4>
			    <br>
			    <br>
    			<img src="http://www.ipecon.com.br/imagens/marcaBoleto.jpg" />
    		</td>
		  </tr>
		  <tr>
			<td height="14" bgcolor="#105DAD"></td>
		  </tr>
		  <tr>
			<td height="52" align="center" bgcolor="#105DAD" class="Nome">'.$resultado['Nome'].'</td>
		  </tr>
		</table>
		</body>
		</html>';

		/* Headers. */
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		/* Adicionar Origem */
		$headers .= "From: Ipecon Pós-Graduação <ipecon@ipecon.com.br>";
		$headers .= "Cc: IPECON <ipecon@ipecon.com.br>";

		/* and now mail it */
		mail($para, $assunto, $mensagem, $headers);

		//== Alterar o campo Enviado
		$comando = "UPDATE aluno SET Enviado = 1 WHERE Id_Numero = '".$resultado['Id_Numero']."'";
		mysql_query($comando) or die('Erro na alteração da tabela de aluno, campo Enviado.<br>'.mysql_error());
	}
  }
}
?>