<?
// Função de e-mail

/* Cabeçalho. */
$cabecalho  = "MIME-Version: 1.0\r\n";
$cabecalho .= "Content-type: text/html; charset=iso-8859-1\r\n";
$cabecalho .= "From: Ipecon <ipecon@ipecon.com.br>\r\n";
$cabecalho .= "Bcc: ipecon@ipecon.com.br";
//$cabecalho .= "Bcc: Regis Andrade <regisandrade@centauronet.com.br>\r\n";

$msg = '<span style="font-family: verdana; font-size:11px">'.nl2br($_POST['mensagem']).'</span>';

/* and now mail it */
mail($_POST['para'], $_POST['assunto'], $msg, $cabecalho);

?>
<script language="JavaScript">
	alert('Mensagem enviada com sucesso!');
	document.location = 'select_aluno.php';
</script>