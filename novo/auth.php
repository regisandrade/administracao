<?php
session_start();
require('conexao.inc.php'); //== Conexão com o Banco de Dados

$comando = "SELECT Login, Senha FROM usuario_adm WHERE Login = '".$_POST['login']."' AND Senha = '".$_POST['senha']."'";
$result = mysql_query($comando);
$registro = mysql_fetch_array($result);
$num = mysql_num_rows($result);

if($num == 0){
	$msg = 'Usuário não esta correto.';
	header("location: index.php?mensagem=$msg");
	exit;
}

if($num > 0){
	//== Consultar todos os alunos deste dia e mes
	$consulta = "SELECT
		  Nome,
		  e_Mail,
		  DATE_FORMAT(Data_Nascimento,'%d/%m') AS Data_Nasc,
		  Id_Numero,
		  Enviado
		FROM
		  aluno
		WHERE
		  e_Mail <> '' 
		  AND
		  Data_Nascimento <> '0'
		  AND
		  DAYOFMONTH(Data_Nascimento)= '".date('d')."'
		  AND
		  MONTH(Data_Nascimento) = '".date('m')."'
		  AND
		  Web = 2
		  AND
		  Enviado = 0";
	$resultado = mysql_query($consulta) or die('Erro na consulta dos alunos para envio de e-mail cartão de aniversario.<br>'.mysql_error());
	$numero = mysql_num_rows($resultado);
	
	if($numero != 0){
		while($dados = mysql_fetch_array($resultado)){
			//== Enviar e-mail
	
			/* Destinatário */
			$para = $dados['Nome']." <".$dados['e_Mail'].">";
			
			/* Assunto */
			$assunto = "Feliz aniversário";
			
			/* Mensagem */
			$mensagem = '
			<html>
			<head>
			<title>Feliz Aniversário</title>
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
				<td width="10" rowspan="5" background="http://www.ipecon.com.br/imagens/cartao/fundo_azul.png">&nbsp;</td>
				<td width="460" height="13" bgcolor="#125FAB"></td>
				<td width="10" rowspan="5" background="http://www.ipecon.com.br/imagens/cartao/fundo_azul.png">&nbsp;</td>
			  </tr>
			  <tr>
				<td valign="top"><img src="http://www.ipecon.com.br/imagens/cartao/bolo.jpg" width="460" height="291"></td>
			  </tr>
			  <tr>
				<td height="190" align="center" valign="top" class="Texto"><h4><br>
					<br>
					É o que lhe deseja a equipe do Ipecon.<br>
				<br>
				<br>
				<br>
				<img src="http://www.ipecon.com.br/imagens/logo_email_ipecon.gif" width="127" height="30"></h4></td>
			  </tr>
			  <tr>
				<td height="14" background="http://www.ipecon.com.br/imagens/cartao/barra_inferior.png"></td>
			  </tr>
			  <tr>
				<td height="52" align="center" bgcolor="#105DAD" class="Nome">'.$dados['Nome'].'</td>
			  </tr>
			</table>
			</body>
			</html>';
			
			/* Headers. */
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			
			/* Adicionar Origem */
			$headers .= "From: Ipecon <ipecon@ipecon.com.br>\r\n";
			$headers .= "Cc: IPECON <ipecon@ipecon.com.br>\r\n";
			
			/* and now mail it */
			mail($para, $assunto, $mensagem, $headers);
			
			//== Atualizar o campo enviado para 1
			$comando = "UPDATE aluno SET Enviado = 1 WHERE Id_Numero = '".$dados['Id_Numero']."'";
			mysql_query($comando) or die('Erro na alteração do campo Enviado da tabela de aluno.<br>'.mysql_error());
		}// FIM WHILE
	}// FIM IF
	$_SESSION['login'] = $registro['Login'];
	$_SESSION['empresa'] = "IPECON - Consultória e treinamento";
	$_SESSION['tituloPagina'] = "Área administrativa :: IPECON - Consultória e treinamento";
	$_SESSION['tituloRodape'] = "&copy;&nbsp;2003&nbsp;IPECON - Consultória e treinamento. Todos os direitos reservados";
	header("location: home.php");
}else{
	$msg = 'Usuário ou senha não confere.';
	header("location: index.php?mensagem=$msg");

}
?>
