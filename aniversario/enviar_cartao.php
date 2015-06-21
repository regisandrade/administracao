<?
/* esse script serve para você enviar informações para uma determinada pessoa*/

/* Destinatário */
$para = $_GET['nome']." <".$_GET['nome_email'].">";

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
    <td valign="top"><img src="http://www.ipecon.com.br/imagens/cartao/bolo.png" width="460" height="291"></td>
  </tr>
  <tr>
    <td height="190" align="center" valign="top" class="Texto"><h4><br>
        <br>
        É o que lhe deseja toda a equipe do Ipecon.<br>
    <br>
    <br>
    <br>
    <img src="http://www.ipecon.com.br/imagens/logo_email_ipecon.gif" width="127" height="30"></h4></td>
  </tr>
  <tr>
    <td height="14" background="http://www.ipecon.com.br/imagens/cartao/barra_inferior.png"></td>
  </tr>
  <tr>
    <td height="52" align="center" bgcolor="#105DAD" class="Nome">'.$_GET['nome'].'</td>
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

?>
<script language="JavaScript">
	alert('Cartão de aniversário enviado com sucesso!');
	document.location= 'lista_do_mes.php';
</script>